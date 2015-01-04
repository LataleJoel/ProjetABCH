<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');

    class UtilisateursModel extends Model {
        
        public function sauver($nom, $prenom, $admin, $statut, $login, $password) {
            $sql = "INSERT INTO utilisateurs SET nom = :nom, prenom = :prenom, admin = :admin, statut = :statut,"
                    . " login = :login, password = :password, creation = :creation";
            $req = $this->db->prepare($sql);
            
            $creation = date('Y-m-d H:i:s');
            $req->bindValue(':nom', strtoupper($nom));  
            $req->bindValue(':prenom', ucfirst($prenom));
            $req->bindValue(':admin', $admin);  
            $req->bindValue(':statut', $statut);
            $req->bindValue(':login', $login);      
            $req->bindValue(':password', Authentification::encoder($password, $creation));      
            $req->bindValue(':creation', $creation);
            
            try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur('Erreur SQL : '.$ex->getMessage());
            }
        }
        
        public function lister() {
            
            $sql = "SELECT domaines.id, libelle, message, dateFinMessage FROM domaines WHERE annee = :annee";        
            $req = $this->db->prepare($sql);              
            $req->bindValue(':annee', Application::getConfig()->annee_courante);
            
            try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur("Erreur SQL ".$ex->getMessage());
            }
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }  
        
        public function estAdmin($id) {
            if ($id == 0) {
                throw new Erreur('Mauvais identifiant : '.$id);
            }
            
            $sql = "SELECT admin FROM utilisateurs WHERE id = :id";
            $req = $this->db->prepare($sql);
            
            $req->bindValue(':id', $id);
            
            try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur('Erreur SQL : '.$ex->getMessage());
            }
            
            return $req->fetchColumn(PDO::FETCH_ASSOC);
        }
    }
    
    

