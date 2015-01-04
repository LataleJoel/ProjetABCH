<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
 ?>
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-primary">
        <div class="panel-heading">S'IDENTIFIER</div>
        <div class="panel-body">
            <form method="POST" id="clearingForm" class="form-horizontal" action="index.php">
                <?php FormHelper::cleCSRF(); ?>
                <p class="erreur-form">
                    <?php echo Page::getInstance()->formMessage ?>
                </p>   
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="login">Login</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="login" name="login" value="<?php echo $this->login;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="password">Mot de passe</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $this->password;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-4">
                        <button type="submit" id="connexion" class="btn btn-default" name="connexion" value="1">Connexion</button>
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
                login: {
                    validators: {
                        notEmpty: {
                            message: 'Champ vide'
                        },
                        stringLength: {
                            max: 256,
                            message: 'Le login fait plus de 256 caractères'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Champ vide'
                        },
                        stringLength: {
                            max: 256,
                            message: 'Le mot de passe fait plus de 256 caractères'
                        }
                    }
                }
            }
        });
});
</script>
    
