<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
 ?>

<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
            <div class="panel-heading"><?php
                    switch($this->action) {
                        case "ajouter" : 
                            ?> AJOUTER UN ENSEIGNANT <?php
                            break;
                        case "editer" : 
                            ?> Editer un enseignant <?php
                            break;
                    }
                    ?></div>
            <div class="panel-body">
            <form id="clearingForm" class="form-horizontal" method="POST" action="?controller=enseignants&action=<?php echo $this->action;?>">
                <?php FormHelper::cleCSRF(); ?>
                <p class="erreur-form"> 
                    <?php echo $this->formMessage;?>
                </p>
                <input type="hidden" name="id" value="<?php echo $this->id;?>" />    
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="nom">Nom</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id="nom" name="nom" maxlenght="256" value="<?php echo $this->nom;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="prenom">Prenom</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="prenom" name="prenom" maxlenght="256" value="<?php echo $this->prenom;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Statut</label>
                    <div class="col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="statut" value="0"> Vacataire
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="statut" value="1"> Permanent
                        </label>
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
            nom: {
                validators: {
                    notEmpty: {
                        message: 'Il faut saisir un nom'
                    }
                }
            },
            prenom: {
                validators: {
                    notEmpty: {
                        message: 'Il faut saisir un prenom'
                    }
                }
            },
            statut: {
                validators: {
                    notEmpty: {
                        message: 'Il faut choisir un statut'
                    }
                }
            }
        }
    });
});
</script>