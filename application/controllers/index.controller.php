<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    Application::useModele('utilisateurs');
    Application::useHelper('utilisateurs');
    
    class IndexController extends Controller {
        
        function __construct() {
            $this->setActionParDefaut('index');
        }
        
        public function deconnexionAction() {
            Authentification::deconnecter();
            HTTPHelper::rediriger("index.php");
        }
        
        public function indexAction() {
            if (Authentification::estConnecte()) {
                if (UtilisateursHelper::estAdmin(Authentification::getUtilisateurId())) {
                    $page = Application::getPage();
                    $page->setTemplate('application');
                    $page->setVue('index_admin');
                    Page::ajouterCSS("bootstrap-theme.min");
                    Page::ajouterCSS("bootstrap.min");
                } else {
                    $page = Application::getPage();
                    $page->setTemplate('application');
                    $page->setVue('index_prof');
                    Page::ajouterCSS("bootstrap-theme.min");
                    Page::ajouterCSS("bootstrap.min");
                }
            } else {
                $page = Application::getPage();
                $page->setTemplate('application');
                $page->setVue('connexion');
                Page::ajouterCSS("bootstrap.min");
                Page::ajouterCSS("bootstrap-theme.min");
                Page::ajouterCSS("bootstrapValidator.min");
                Page::ajouterScript("jquery.min");
                Page::ajouterScript("bootstrap.min");
                Page::ajouterScript("bootstrapValidator.min");

                $page->login = filter_var(HTTPHelper::post('login', ''), FILTER_SANITIZE_STRING);
                $page->login = trim($page->login);

                $page->password = filter_var(HTTPHelper::post('password', ''), FILTER_UNSAFE_RAW);
                
                if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
                    return;
                }
                
                if (!FormHelper::validerCleCSRF()) {
                    throw new Erreur("Session invalide");
                }

                if (empty($page->login)) {
                    $page->formMessage = "Veuillez entrer un login"; return;
                }

                if (empty($page->password)) {
                    $page->formMessage = "Veuillez entrer un mot de passe"; return;
                }

                if (!Authentification::authentifier($page->login, $page->password)) {
                    $page->formMessage = "Le login et le mot de passe sont incorrects";
                } else { 
                    if (UtilisateursHelper::estAdmin(Authentification::getUtilisateurId())) {
                        HTTPHelper::rediriger("index.php");
                    } else {
                        HTTPHelper::rediriger("index.php");
                    }
                }          
            }
        }
    }
