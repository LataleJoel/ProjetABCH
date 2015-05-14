<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
 ?>
formulaire fm
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">EDITER UNE FICHE MATIERE</div>
        <div class="panel-body">
            <form id="clearingForm" class="form-horizontal" method="POST" action="?controller=documents&action=fm">
                <?php FormHelper::cleCSRF(); ?>
                <p class="erreur-form"><?php echo $this->formMessage;?></p>
                <input type="hidden" name="id" value="<?php echo $this->id;?>" />  
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="objectifs">Objectifs</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="objectifs" id="objectifs"></textarea>
                    </div>
                    <script>
                        CKEDITOR.replace( 'objectifs' );
                    </script>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="programme">Programme synthétique</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="programme" id="programme"></textarea>
                    </div>
                    <script>
                        CKEDITOR.replace( 'programme' );
                    </script>
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

