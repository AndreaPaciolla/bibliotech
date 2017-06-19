<?php $user = getUserById($_GET['id_utente']); ?>
<?php $citta = getCities(); ?>
<?php $ruolo = getRoleByUserId($_GET['id_utente']); ?>

<h2 class="sub-header">Utente: <?php echo $user['nome'] . ' ' . $user['cognome']; ?></h2>

<table class="table table-striped">
    <tbody>
        <tr>
            <td>Nome</td>
            <td><?php echo $user['nome']; ?></td>
        </tr>
        <tr>
            <td>Cognome</td>
            <td><?php echo $user['cognome']; ?></td>
        </tr>
        <tr>
            <td>Indirizzo email</td>
            <td><?php echo $user['email']; ?></td>
        </tr>
        <tr>
            <td>Telefono</td>
            <td><?php echo $user['telefono']; ?></td>
        </tr>
        <tr>
            <td>Data di registrazione</td>
            <td><?php echo $user['data_registrazione']; ?></td>
        </tr>
        <tr>
            <td>Data di nascita</td>
            <td><?php echo (isset($user['data_nascita'])) ? $user['data_nascita'] : 'Non indicata'; ?></td>
        </tr>
        <tr>
            <td>Numero tessera</td>
            <td><?php echo $user['tessera']; ?></td>
        </tr>
        <tr>
            <td>Citta di nascita</td>
            <td><?php foreach($citta as $key => $value) echo ($value['id'] == $user['id_citta_nascita']) ? $value['nome'] : ''; ?></td>
        </tr>
        <tr>
            <td>Citta di residenza</td>
            <td><?php foreach($citta as $key => $value) echo ($value['id'] == $user['id_citta']) ? $value['nome'] : ''; ?></td>
        </tr>
        <tr>
            <td>Indirizzo di residenza</td>
            <td><?php echo (isset($user['indirizzo'])) ? $user['indirizzo'] : 'Non indicato'; ?></td>
        </tr>
        <tr>
            <td>Sesso</td>
            <td><?php echo $user['sesso']; ?></td>
        </tr>
        <tr>
            <td>Ruolo</td>
            <td><?php echo $ruolo['nomeruolo']; ?></td>
        </tr>
    </tbody>
</table>