<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    Application::useModele('domaines');
    
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
            if (!Authentification::estConnecte()) {
                HTTPHelper::rediriger('?controller=utilisateurs&action=connexion');
            }
            $page = Application::getPage();
            $page->setTemplate('application');
            $page->setVue('lister_domaine');
            Page::ajouterCSS("bootstrap-theme.min");
            Page::ajouterCSS("bootstrap.min");
            Page::ajouterCSS("jquery.dataTables.min");
            Page::ajouterScript("jquery.min");
            Page::ajouterScript("jquery.dataTables.min");
            
            $model = new DomainesModel();
            $page->domaines = $model->lister();
        }
        
        public function ajouterAction() {
            /*if (!Authentification::estConnecte()) {
                HTTPHelper::rediriger('?controller=erreur', 'Vous devez être connecté');
            }*/ 
            $this->_recuperation();
            $this->_formulaire('ajouter');
        }
        
        public function editerAction() {
            if (!Authentification::estConnecte()) {
                HTTPHelper::rediriger("?controller=erreur", "Vous devez être connecté");
            } 
            
            $id = HTTPHelper::post('id', 0);
            if ($id == 0) {
                HTTPHelper::rediriger("?controller=erreur", "Erreur édition coup de pouce");
            }
            
            $modelCoupsDePouce = new Coups_De_PouceModel(); 
            $coup_de_pouce = $modelCoupsDePouce->detail($id);
            
            
            if (is_null($coup_de_pouce)) {
                HTTPHelper::rediriger("?controller=erreur", "Erreur édition coup de pouce");
            }
            
            if ($coup_de_pouce['utilisateur_id'] != Authentification::getUtilisateurId()) {
                HTTPHelper::rediriger("?controller=erreur", "Vous n'êtes pas le propriétaire du coup de pouce");
            }
            
            if (is_null(HTTPHelper::post('envoyer'))) {
                $page = Application::getPage();
                $page->id = $coup_de_pouce['id'];
                $page->titre = $coup_de_pouce['titre'];
                $page->accroche = $coup_de_pouce['accroche'];
                $page->description = $coup_de_pouce['description'];
                $page->date = date("d/m/Y h:i", strtotime($coup_de_pouce['date']));
                $page->salle = $coup_de_pouce['salle'];
                $page->places = $coup_de_pouce['places'];
                $page->formation = $coup_de_pouce['formation'];
            } else {
                $this->_recuperation();
            }
                  
            $this->_formulaire('editer');
        }
        
        public function supprimerAction() {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                HTTPHelper::rediriger('?controller=erreur', 'Action non autorisée');
            }

            if (!Authentification::estConnecte()){
                HTTPHelper::rediriger('?contoller=erreur', 'Vous devez être authentifié');
            }

            $domaine_id = filter_var(HTTPHelper::post('id', 0), FILTER_SANITIZE_NUMBER_INT);
            if ($domaine_id == 0 || empty($domaine_id)){
                HTTPHelper::rediriger('?controller=erreur', 'Suppression impossible');
            }

            $model = new DomainesModel();
            $domaine = $model->detail($domaine_id);
            if ($domaine['utilisateur_id'] != Authentification::getUtilisateurId()){
                HTTPHelper::rediriger('?controller=erreur', 'Vous ne pouvez pas supprimer ce domaine');
            }

            $model->supprimer($domaine_id);
            HTTPHelper::rediriger('?controller=domaines&action=lister', 'Domaine supprimé');
        }
        
        private function _recuperation() {
            $page = Application::getPage();
            
            $page->id = HTTPHelper::post('id', 0);
            
            $page->libelle = filter_var(HTTPHelper::post('libelle', ''), FILTER_SANITIZE_STRING);
            $page->libelle = trim($page->libelle);
        }
        
        private function _formulaire($action) {
            $page = Application::getPage();
            $page->setTemplate('application');
            $page->setVue('editer_domaine');
            Page::ajouterCSS("bootstrap.min");
            Page::ajouterCSS("bootstrap-theme.min");
            Page::ajouterCSS("bootstrapValidator.min");
            Page::ajouterScript("jquery.min");
            Page::ajouterScript("bootstrap.min");
            Page::ajouterScript("bootstrapValidator.min");
            $page->action = $action;
            
            if (is_null(HTTPHelper::post('envoyer'))) {
                return;
            } 
                
            if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
                return;
            }
            
            if (!FormHelper::validerCleCSRF()) {
                throw new Erreur("Session invalide");
            }
            
            if (empty($page->libelle)) {
                $page->formMessage = "Il faut saisir un libellé"; return;
            }
            
            if (strlen($page->libelle) > 256) {
                $page->formMessage = "Le libellé doit être composé d'au plus 256 caractères"; return;
            }
            
            $model = new DomainesModel();  
            switch($page->action) {
                case 'ajouter':
                    $model->sauver($page->libelle);
                    break;
                /*case 'editer':
                    $modelCoupsDePouce->modifier($page->id, $page->titre, $page->accroche, $page->description, DateTime::createFromFormat("d/m/Y H:i", $page->date), $page->salle, $page->places, $page->formation);
                    break;*/
            }
                   
            //HTTPHelper::rediriger("?controller=coups_de_pouce&action=lister");       
        }
    }
