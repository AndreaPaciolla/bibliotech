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
        <tr>
            <td>Maps</td>
            <td>
                <img width="600" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php foreach($citta as $key => $value) echo ($value['id'] == $casaeditrice['id_citta']) ? $value['nome'] : ''; ?>&key=AIzaSyDDEknVxpWu1vFjtl82Rz7TT7irMbFKWiA&zoom=13&scale=1&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:Sede%7C<?php foreach($citta as $key => $value) echo ($value['id'] == $casaeditrice['id_citta']) ? $value['nome'] : ''; ?>">
            </td>
        </tr>
    </tbody>
</table>