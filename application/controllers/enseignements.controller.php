<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    Application::useModele('enseignements');
    Application::useModele('domaines');
    Application::useModele('sections');
    
    class EnseignementsController extends Controller {
        
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
            
            $page->libelle = filter_var(HTTPHelper::post('libelle', ''), FILTER_SANITIZE_STRING);
            $page->libelle = trim($page->libelle);
            
            $page->credits = filter_var(HTTPHelper::post('credits', ''), FILTER_SANITIZE_STRING);
            $page->credits = trim($page->credits);
        }
        
        private function _formulaire($action) {
            $page = Application::getPage();
            $page->setTemplate('application');
            $page->setVue('editer_enseignement');
            Page::ajouterCSS("bootstrap.min");
            Page::ajouterCSS("bootstrap-theme.min");
            Page::ajouterCSS("bootstrapValidator.min");
            Page::ajouterScript("jquery.min");
            Page::ajouterScript("bootstrap.min");
            Page::ajouterScript("bootstrapValidator.min");
            $page->action = $action;
            $modelSections = new SectionsModel();
            $page->listeSections = $modelSections->lister();  
            $modelDomaines = new DomainesModel();
            $page->listeDomaines = $modelDomaines->lister();
            
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
            
            if (empty($page->credits)) {
                $page->formMessage = "Il faut saisir des crédits"; return;
            }
            
            
            /*$model = new UtilisateursModel();  
            switch($page->action) {
                case 'ajouter':
                    $model->sauver($page->nom, $page->prenom, 0, $page->statut, $login, 'toto');
                    break;*/
                /*case 'editer':
                    $modelCoupsDePouce->modifier($page->id, $page->titre, $page->accroche, $page->description, DateTime::createFromFormat("d/m/Y H:i", $page->date), $page->salle, $page->places, $page->formation);
                    break;
            }*/
                   
            //HTTPHelper::rediriger("?controller=coups_de_pouce&action=lister");       
        }
    }
