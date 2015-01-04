<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
 ?>


        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
            <div class="panel-heading"><?php
                    switch($this->action) {
                        case "ajouter" : 
                            ?> AJOUTER UN DOMAINE <?php
                            break;
                        case "editer" : 
                            ?> Editer un domaine <?php
                            break;
                    }
                    ?></div>
            <div class="panel-body">
            <form id="clearingForm" class="form-horizontal" method="POST" action="?controller=domaines&action=<?php echo $this->action;?>">
                <?php FormHelper::cleCSRF(); ?>
                <p class="erreur-form"> 
                    <?php echo $this->formMessage;?>
                </p>
                <input type="hidden" name="id" value="<?php echo $this->id;?>" />    
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="libelle">Libellé</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="libelle" name="libelle" value="<?php echo $this->libelle;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-4">
                        <button type="submit" id="envoyer" class="btn btn-default" name="envoyer" value="1">Envoyer</button>
                    </div>
                </div>
            </form>   
            </div>
            </div>
        </div>



<script>
$(document).ready(function() {
    $('#clearingForm').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                libelle: {
                    validators: {
                        notEmpty: {
                            message: 'Champ vide'
                        },
                        stringLength: {
                            max: 256,
                            message: 'Le libellé fait plus de 256 caractères'
                        }
                    }
                }
            }
        });
});
</script>