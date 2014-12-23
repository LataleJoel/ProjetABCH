<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    
    class DomainesController extends Controller {
        
        function __construct() {
            $this->setActionParDefaut('index');
        }
        
        public function indexAction() {
            $page = Application::getPage();
            $page->setTemplate('index');
            $page->setVue('index');
            $page->ajouterCSS('index');
        }
        
        public function listerAction() {
            $page = Application::getPage();
            $page->setTemplate('application');
            $page->setVue('lister_domaine');
            
            $model = new DomainesModel();
        }
        
        public function ajouterAction() {
            /*if (!Authentification::estConnecte()) {
                HTTPHelper::rediriger('?controller=erreur', 'Vous devez être connecté');
            }*/ 
            $this->_recuperation();
            $this->_formulaire('ajouter');
        }
        
        private function _recuperation() {
            $page = Application::getPage();
            
            $page->id = HTTPHelper::post('id', 0);
            
            $page->libelle = filter_var(HTTPHelper::post('libelle', ''), FILTER_SANITIZE_STRING);
            $page->libelle = trim($page->libelle);
        }

    
    
        private function _formulaire($action) {
            $page = Application::getPage();
            $page->setTemplate('dev');
            $page->setVue('editer_domaine');
            $page->action = $action;
            
            /*$modelFormations = new FormationsModel();
            $page->listeFormations = $modelFormations->lister();        
            
            if (is_null(HTTPHelper::post('envoyer'))) {
                return;
            } 
                
            if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
                return;
            }
            
            if (!FormHelper::validerCleCSRF()) {
                throw new Erreur("Session invalide");
            }
            
            if (empty($page->titre)) {
                $page->formMessage = "Il faut saisir un titre"; return;
            }
            
            if (strlen($page->titre) > 256) {
                $page->formMessage = "Le titre doit être composé d'au plus 256 caractères"; return;
            }
            
            if (empty($page->accroche)) {
                $page->formMessage = "Il faut saisir une accroche"; return;
            }
            
            if (strlen($page->accroche) > 256) {
                $page->formMessage = "L'accroche doit être composé d'au plus 256 caractères"; return;
            }
            
            if (empty($page->description)) {
                $page->formMessage = "Il faut saisir une description"; return;
            }
            
            if (strlen($page->description) > 2048) {
                $page->formMessage = "La description doit être composé d'au plus 2048 caractères"; return;
            }
            
            if (!DateTime::createFromFormat("d/m/Y H:i", $page->date)) {
                $page->formMessage = "La date n'a pas été correctement saisie"; return;
            }
            
            if (empty($page->salle)) {
                $page->formMessage = "Il faut saisir une salle"; return;
            }
            
            if (strlen($page->salle) > 32) {
                $page->formMessage = "La salle doit être composé d'au plus 32 caractères"; return;
            }
            
            if ($page->places < 1 || $page->places > 10) {
                $page->formMessage = "Le nombre de places doit être compris entre 1 et 10"; return;
            }
            
            if ($page->formation == "---") {
                $page->formMessage = "Il faut choisir une formation"; return;
            }
            
            if (!$modelFormations->estValide($page->formation)) {
                $page->formMessage = "Cette formation n'existe pas"; return;
            }
            
            $modelCoupsDePouce = new Coups_De_PouceModel();  
            switch($page->action) {
                case 'ajouter':
                    $modelCoupsDePouce->sauver($page->titre, $page->accroche, $page->description, Authentification::getUtilisateurId(), DateTime::createFromFormat("d/m/Y H:i", $page->date), $page->salle, $page->places, $page->formation);
                    break;
                case 'editer':
                    $modelCoupsDePouce->modifier($page->id, $page->titre, $page->accroche, $page->description, DateTime::createFromFormat("d/m/Y H:i", $page->date), $page->salle, $page->places, $page->formation);
                    break;
            }*/
                   
            //HTTPHelper::rediriger("?controller=coups_de_pouce&action=lister");       
        }
    }
