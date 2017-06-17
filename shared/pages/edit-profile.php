<?php $currentProfile = $_SESSION['user']; ?>
<?php $ruoli = getRuoli(); ?>
<?php $citta = getCities(); ?>

<h2 class="sub-header">Edita il tuo profilo</h2>
<form id="register-form" method="POST" action="" name="form-signup">

    <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input type="email" id="inputEmail" value="<?php echo $currentProfile['email']; ?>" name="email" class="form-control" placeholder="Email address" required disabled>
    </div>

    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" name="password" value="<?php echo $currentProfile['password']; ?>" id="inputPassword" class="form-control" placeholder="Password" required disabled>
    </div>

    <div class="form-group">
        <label for="inputNome">Nome</label>
        <input type="text" name="nome" value="<?php echo $currentProfile['nome']; ?>" id="inputNome" class="form-control" placeholder="Nome" required>
    </div>

    <div class="form-group">
        <label for="inputCognome">Cognome</label>
        <input type="text" name="cognome" value="<?php echo $currentProfile['cognome']; ?>" id="inputCognome" class="form-control" placeholder="Cognome" required>
    </div>

    <div class="form-group">
        <label for="inputTelefono">Telefono</label>
        <input type="text" name="telefono" value="<?php echo $currentProfile['telefono']; ?>" id="inputTelefono" class="form-control" placeholder="Telefono" required>
    </div>

    <div class="form-group">
        <label for="inputTessera">Tessera</label>
        <input type="text" name="tessera" id="inputTessera" value="<?php echo $currentProfile['tessera']; ?>" class="form-control" placeholder="Tessera" required disabled>
    </div>

    <div class="form-group">
        <label for="inputCittaResidenza">Citta di residenza</label>
        <select class="form-control" name="id_citta" id="inputCittaResidenza">
            <?php foreach($citta as $citt => $c): ?>
                <option value="<?php echo $c['id']; ?>" <?php echo ($c['id'] == $currentProfile['id_citta']) ? 'selected' : ''; ?> ><?php echo $c['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="inputSesso">Sesso?</label>
        <label class="radio-inline">
            <input class="radio-inline" type="radio" name="sesso" value="M" <?php echo ($currentProfile['sesso'] == 'M') ? 'checked' : ''; ?>>Uomo
        </label>
        <label class="radio-inline">
            <input class="radio-inline" type="radio" name="sesso" value="F" <?php echo ($currentProfile['sesso'] == 'F') ? 'checked' : ''; ?>>Donna<br>
        </label>
    </div>

    <div class="form-group">
        <label for="inputRuolo">Ruolo</label>
        <?php foreach($ruoli as $ruolo => $value) { ?>
            <label class="radio-inline">
                <input <?php echo ($value['id'] == $currentProfile['id_ruolo']) ? 'checked' : ''; ?> required class="radio-inline" type="radio" name="ruolo" value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?>
            </label>
        <?php } ?>
    </div>

    <button class="form-control btn btn-register" type="submit" name="form-signup-submit">Edit profile</button>
</form>