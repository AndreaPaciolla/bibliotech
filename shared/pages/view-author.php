<?php $autore = getAuthorById($_GET['id_autore']); ?>
<?php $citta = getCities(); ?>

<h2 class="sub-header">Autore: <?php echo $autore['nome'] . ' ' . $autore['cognome']; ?></h2>

<table class="table table-striped">
    <tbody>
        <tr>
            <td>Nome</td>
            <td><?php echo $autore['nome']; ?></td>
        </tr>
        <tr>
            <td>Cognome</td>
            <td><?php echo $autore['cognome']; ?></td>
        </tr>
        <tr>
            <td>Biografia</td>
            <td><?php echo $autore['biografia']; ?></td>
        </tr>
        <tr>
            <td>Citta di nascita</td>
            <td><?php foreach($citta as $key => $value) echo ($value['id'] == $autore['id_citta_nascita']) ? $value['nome'] : ''; ?></td>
        </tr>
        <tr>
            <td>Data di nascita</td>
            <td><?php echo $autore['data_nascita']; ?></td>
        </tr>
    </tbody>
</table>