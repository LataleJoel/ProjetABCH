<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    Page::getInstance()->listeSections = array_merge(array("---"), Page::getInstance()->listeSections);
 ?>

<section id="editer-enseignement">
    <div class="conteneur">
        <fieldset>
            <legend>
                <h2 class="titre">
                    <?php
                    switch($this->action) {
                        case "ajouter" : 
                            ?> Ajouter un enseignement <?php
                            break;
                        case "editer" : 
                            ?> Editer un enseignement <?php
                            break;
                    }
                    ?>
                </h2>
            </legend>
            <form id="clearingForm" method="POST" action="?controller=enseignements&action=<?php echo $this->action;?>">
                <?php FormHelper::cleCSRF(); ?>
                <p class="erreur-form"> 
                    <?php echo $this->formMessage;?>
                </p>
                <input type="hidden" name="id" value="<?php echo $this->id;?>" />   
                <div class="form-group">
                    <label for="libelle" class="control-label">Libellé</label>
                    <input type="text" class="form-control" id="libelle" name="libelle" maxlenght="256" value="<?php echo $this->libelle;?>"/>
                </div>
                <div class="form-group">
                    <label for="section">Section : </label>
                    <select class="form-control" id="section" name="section">
                        <?php
                        foreach (Page::getInstance()->listeSections as $section) {
                            if ($section == $this->section) {
                                HTMLHelper::option($section, null, $section);
                            } else {
                                HTMLHelper::option($section);
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Semestre</label>
                    <div>
                        <label class="radio-inline">
                            <input type="radio" name="semestre" value="1"> Semestre 1
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="semestre" value="2"> Semestre 2
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="credits">Crédits</label>
                    <input type="text" class="form-control" id="credits" name="credits" maxlenght="256" value="<?php echo $this->credits;?>"/>
                </div>
                <div class="form-group">
                    <button type="submit" id="envoyer" class="btn btn-default" name="envoyer" value="1">Envoyer</button>
                </div>
                
            </form>           
        </fieldset>
    </div>
</section>  



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
                        message: 'Il faut saisir un libellé'
                    }
                }
            },
            semestre: {
                validators: {
                    notEmpty: {
                        message: 'Il faut choisir un semestre'
                    }
                }
            },
            credits: {
                validators: {
                    notEmpty: {
                        message: 'Il faut saisir des crédits'
                    }
                }
            }
        }
    });
});
</script>