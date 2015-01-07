<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    Page::getInstance()->listeSections = array_merge(array("---"), Page::getInstance()->listeSections);
    Page::getInstance()->listeDomaines = array_merge(array("---"), Page::getInstance()->listeDomaines);
 ?>

<div class="col-sm-6 col-md-offset-3">
            <div class="panel panel-primary">
            <div class="panel-heading"><?php
                    switch($this->action) {
                        case "ajouter" : 
                            ?> AJOUTER UN ENSEIGNEMENT <?php
                            break;
                        case "editer" : 
                            ?> Editer un enseignement <?php
                            break;
                    }
                    ?></div>
            <div class="panel-body">
<section id="editer-enseignement">
            <form id="clearingForm" class="form-horizontal" method="POST" action="?controller=enseignements&action=<?php echo $this->action;?>">
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
                    <label class="col-sm-4 control-label" for="domaine">Domaine</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="domaine" name="domaine">
                            <?php
                            foreach (Page::getInstance()->listeDomaines as $domaine) {
                                if ($domaine == $this->domaine) {
                                    HTMLHelper::option($domaine['libelle'], null, $domaine['libelle']);
                                } else {
                                    HTMLHelper::option($domaine['libelle']);
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="section">Section</label>
                    <div class="col-sm-6">
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
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Semestre</label>
                    <div class="col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="semestre" value="1"> Semestre 1
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="semestre" value="2"> Semestre 2
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="credits">Crédits</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="credits" name="credits" value="<?php echo $this->credits;?>"/>
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
                        message: 'Il faut saisir un libellé'
                    }
                }
            },
            section: {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The genre is required'
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