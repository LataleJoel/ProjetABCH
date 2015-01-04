<?php
defined('__COUPDEPOUCE__') or die('Acces interdit');

abstract class UtilisateursHelper {

    public static function estAdmin($id) {
        $db = Application::getDB();
        $sql = 'SELECT admin FROM utilisateurs WHERE id = :id';
        $req = $db->prepare($sql);      
        $req->bindValue(':id', $id); 

        try {
            $req->execute();
        } catch (PDOException $ex) {
            throw new Erreur("Erreur SQL ".$ex->getMessage());
        }

        $res = $req->fetchColumn(0);
        return $res;
    }
}