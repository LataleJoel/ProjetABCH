<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
 ?>
<section id="editer-domaine">
    <div class="conteneur">
        <fieldset>
            <legend>
                <h2 class="titre">
                    <?php
                    switch($this->action) {
                        case "ajouter" : 
                            ?> Ajouter un domaine <?php
                            break;
                        case "editer" : 
                            ?> Editer un domaine <?php
                            break;
                    }
                    ?>
                </h2>
            </legend>
            <form method="POST" action="?controller=domaines&action=<?php echo $this->action;?>">
                <?php //FormHelper::cleCSRF(); ?>
                <p class="erreur-form"> 
                    <?php echo $this->formMessage;?>
                </p>
                <input type="hidden" name="id" value="<?php echo $this->id;?>" />    
                <dl>
                    <dt>
                        <label for="titre">Libellé :</label>
                    </dt>
                    <dd>
                        <input id="titre" name="libelle" type="text" maxlenght="256" value="<?php echo $this->libelle;?>"/>
                    </dd>
                               
                    <dt></dt>
                    <dd>
                        <button id="envoyer" class="btn" name="envoyer" type="submit" value="1">Envoyer</button>
                    </dd>
                </dl>
            </form>           
        </fieldset>
    </div>
</section>   