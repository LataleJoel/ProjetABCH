<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
?>
<html>
    <head>
        <title>Gestion FM CRE</title>
        <meta charset="UTF-8">
        <?php Page::enteteCSS(); ?> 
        <?php Page::inclureJS(); ?>  
    </head>
    <body>
        <header id="page-header">
            <nav class="navbar navbar-static-top navbar-inverse">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">Gestion FM CRE</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (Authentification::estConnecte()) { ?>
                            <li><p class="navbar-text"><?php echo Authentification::getUtilisateur()['nom'].' '.Authentification::getUtilisateur()['prenom'] ?></p> </li>
                            <li>
                            <form class="navbar-form" method="post" action="index.php?controller=index&action=deconnexion">
                                <button type="submit" class="btn btn-default">Deconnexion</button>
                            </form>
                            </li>
                            <?php } ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        
        <main> 
            <div class="conteneur">
                <section id="application">
                    <?php Page::afficherVue();?>
                </section>
            </div>
        </main>
        
        <footer id="page-footer" class="clear">        
            
        </footer>
        <?php //Page::inclureJS(); ?>
    </body>
</html>
