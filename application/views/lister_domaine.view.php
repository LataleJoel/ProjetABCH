<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    
?>
<div class="col-md-8 col-md-offset-2">
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Libellé</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach ($this->domaines as $domaine) {
    ?>
        <tr>
            <td><?php echo $domaine["libelle"];?></td>
            <td>
                <button type="button" class="btn btn-default btn-xs">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier
                </button> 
                <button type="button" class="cmd_supprimer btn btn-default btn-xs">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Supprimer
                </button>
                <input type="hidden" name="id" value="<?php echo $domaine['id']; ?>" />
            </td>
        </tr>
    <?php
    }
?>
    </tbody>
</table>
</div>
<form id="commande-form" method="POST">
    <input type="hidden" id="id" name="id"/>
</form>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );


$('button.cmd_supprimer').click(function() {
    var id = $(this).siblings('input').val();
    var sform = $('form#commande-form').first();
    sform.attr('action', '?controller=domaines&action=supprimer');
    var sinput = $('form#commande-form input#id');
    sinput.val(id);
    var message = $('.datagrid a#cdp'+id).text();
   
    if (confirm('Voulez-vous vraiment supprimer ce domaine ? : '+message) == true) {
        sform.submit(); 
    } else {
        alert('false');
    }
    
});
</script>

