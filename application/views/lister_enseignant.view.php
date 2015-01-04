<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    
?>
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Libellé</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach ($this->domaines as $domaine) {
    ?>
        <tr>
            <td><?php echo $domaine["id"];?></td>
            <td><?php echo $domaine["libelle"];?></td>
            <td>modifier</td>
            <td>supprimer</td>
        </tr>
    <?php
    }
?>
        </tbody>
    </table>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>