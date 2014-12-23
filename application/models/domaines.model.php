<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');

    class DomainesModel extends Model {
        public function lister($ordre = 'libelle', $direction = 'asc') { 
            if (!in_array($ordre, array('libelle'/*, 'formation', 'date', 'nom'*/))) {
                throw new Erreur("L'ordre n'existe pas : ".$ordre);
            }
            if (!in_array($direction, array('asc', 'desc'))) {
                throw new Erreur("La direction n'existe pas : ".$ordre);
            }
            
            $sql = "SELECT domaines.id, libelle, message, dateFinMessage FROM domaines WHERE annee = :annee ORDER BY ".$ordre." ".$direction;        
            $req = $this->db->prepare($sql);              
            $req->bindValue(':annee', Application::getConfig()->annee_courante);
            
            try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur("Erreur SQL ".$ex->getMessage());
            }
            return new DataSet($req->fetchAll(PDO::FETCH_ASSOC), $ordre, $direction);
        }
    }

