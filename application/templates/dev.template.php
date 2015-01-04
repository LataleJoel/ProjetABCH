<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Gestion FM CRE</title>
        <meta charset="utf-8">
        <?php Page::enteteCSS(); ?>  
        <?php Page::inclureJS(); ?>  
    </head>
    
    <body>
        <h1>Template : <?php echo basename(__FILE__);?></h1>
        <?php Page::afficherVue(); ?>
        <hr>
        <h3>Page</h3>
        <pre><?php print_r(Application::getPage());?></pre>
        <h3>POST</h3>
        <pre><?php print_r($_POST);?></pre>  
    </body>
</html>

