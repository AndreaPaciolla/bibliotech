<?php $casaeditrice = getEditorById($_GET['id_casa_editrice']); ?>
<?php $citta = getCities(); ?>

<h2 class="sub-header">Casa editrice: <?php echo $casaeditrice['denominazione']; ?></h2>

<table class="table table-striped">
    <tbody>
        <tr>
            <td>Nome</td>
            <td><?php echo $casaeditrice['denominazione']; ?></td>
        </tr>
        <tr>
            <td>Sede</td>
            <td><?php foreach($citta as $key => $value) echo ($value['id'] == $casaeditrice['id_citta']) ? $value['nome'] : ''; ?></td>
        </tr>
    </tbody>
</table>