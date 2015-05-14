<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    Application::useModele('domaines');
    
    class DocumentsController extends Controller {
        
        function __construct() {
            $this->setActionParDefaut('index');
        }
        
        public function indexAction() {
            $page = Application::getPage();
            $page->setTemplate('index');
            $page->setVue('index');
            $page->ajouterCSS('index');
        }
        
        public function fmAction() {
            /*if (!Authentification::estConnecte()) {
                HTTPHelper::rediriger('?controller=utilisateurs&action=connexion');
            }*/
            $page = Application::getPage();
            $page->setTemplate('application');
            $page->setVue('editer_fm');
            Page::ajouterCSS("bootstrap-theme.min");
            Page::ajouterCSS("bootstrap.min");
            Page::ajouterScript("jquery.min");
        }
        
        public function creAction() {
            /*if (!Authentification::estConnecte()) {
                HTTPHelper::rediriger('?controller=utilisateurs&action=connexion');
            }*/
            $page = Application::getPage();
            $page->setTemplate('application');
            $page->setVue('editer_cre');
            Page::ajouterCSS("bootstrap-theme.min");
            Page::ajouterCSS("bootstrap.min");
            Page::ajouterScript("jquery.min");
        }
    }
