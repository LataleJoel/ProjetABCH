<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    Application::useModele('utilisateurs');
    
    class EnseignantsController extends Controller {
        
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
            $page->setTemplate('dev');
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
        
        private function _recuperation() {
            $page = Application::getPage();
            
            $page->id = HTTPHelper::post('id', 0);
            
            $page->nom = filter_var(HTTPHelper::post('nom', ''), FILTER_SANITIZE_STRING);
            $page->nom = trim($page->nom);
            
            $page->prenom = filter_var(HTTPHelper::post('prenom', ''), FILTER_SANITIZE_STRING);
            $page->prenom = trim($page->prenom);
            
            $page->statut = filter_var(HTTPHelper::post('statut', ''), FILTER_SANITIZE_STRING);
        }
        
        private function _formulaire($action) {
            $page = Application::getPage();
            $page->setTemplate('application');
            $page->setVue('editer_enseignant');
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
            
            if (empty($page->nom)) {
                $page->formMessage = "Il faut saisir un nom"; return;
            }
            
            if (strlen($page->nom) > 256) {
                $page->formMessage = "Le nom doit être composé d'au plus 256 caractères"; return;
            }
            
            if (empty($page->prenom)) {
                $page->formMessage = "Il faut saisir un prénom"; return;
            }
            
            if (strlen($page->prenom) > 256) {
                $page->formMessage = "Le prénom doit être composé d'au plus 256 caractères"; return;
            }
            
            if (empty($page->statut)) {
                $page->formMessage = "Il faut choisir un statut"; return;
            }
            
            $login = substr($page->nom, 0, 6).substr($page->prenom, 0, 1);
            
            $model = new UtilisateursModel();  
            switch($page->action) {
                case 'ajouter':
                    $model->sauver($page->nom, $page->prenom, 0, $page->statut, $login, 'toto');
                    break;
                /*case 'editer':
                    $modelCoupsDePouce->modifier($page->id, $page->titre, $page->accroche, $page->description, DateTime::createFromFormat("d/m/Y H:i", $page->date), $page->salle, $page->places, $page->formation);
                    break;*/
            }
                   
            //HTTPHelper::rediriger("?controller=coups_de_pouce&action=lister");       
        }
    }
