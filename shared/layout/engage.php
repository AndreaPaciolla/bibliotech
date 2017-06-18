<?php $ruoli = getRuoli(); ?>
<?php $citta = getCities(); ?>
<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <h1>Bibliotech</h1><br>
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Login form -->
                            <form id="login-form" method="POST" action="" name="form-signin">
                                <div class="form-group">
                                    <label for="inputEmail" class="sr-only">Email address</label>
                                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword" class="sr-only">Password</label>
                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                </div>

                                <button class="form-control btn btn-login" type="submit" name="login">Sign in</button>
                            </form>

                            <!-- Signup form -->
                            <form id="register-form" method="POST" action="" name="form-signup" style="display:none">

                                <div class="form-group">
                                    <label for="inputEmail" class="sr-only">Email address</label>
                                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword" class="sr-only">Password</label>
                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                </div>

                                <div class="form-group">
                                    <label for="inputNome" class="sr-only">Nome</label>
                                    <input type="text" name="nome" id="inputNome" class="form-control" placeholder="Nome" required>
                                </div>

                                <div class="form-group">
                                    <label for="inputCognome" class="sr-only">Cognome</label>
                                    <input type="text" name="cognome" id="inputCognome" class="form-control" placeholder="Cognome" required>
                                </div>

                                <div class="form-group">
                                    <label for="inputTelefono" class="sr-only">Telefono</label>
                                    <input type="text" name="telefono" id="inputTelefono" class="form-control" placeholder="Telefono" required>
                                </div>

                                <div class="form-group">
                                    <label for="inputCittaResidenza" class="sr-only">Citta di residenza</label>
                                    <select class="form-control" name="id_citta" id="inputCittaResidenza">
                                        <?php foreach($citta as $citt => $c): ?>
                                            <option value="<?php echo $c['id']; ?>"><?php echo $c['nome']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!--<div class="form-group">
                                    <label for="inputSesso">Sesso?</label>
                                    <label class="radio-inline">
                                        <input class="radio-inline" type="radio" name="sesso" value="M" checked>Uomo
                                    </label>
                                    <label class="radio-inline">
                                        <input class="radio-inline" type="radio" name="sesso" value="F">Donna<br>
                                    </label>
                                </div>-->

                                <div class="form-group">
                                    <label for="inputRuolo">Ruolo</label>
                                    <?php foreach($ruoli as $ruolo => $value) { ?>
                                        <label class="radio-inline">
                                            <input required class="radio-inline" type="radio" name="ruolo" value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?>
                                        </label>
                                    <?php } ?>
                                </div>

                                <button class="form-control btn btn-register" type="submit" name="form-signup-submit">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

// SIGN IN FORM
if(isset($_POST['login']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if(userExists($_POST['email'])) {
        // user exists, do the login
        if(doLogin($_POST['email'], $_POST['password'])) {
            goHome();
        } else {
            echo "<script>alert('Password non valida');</script>";
        }
    } else {
        echo "<script>alert('Utente non riconosciuto');</script>";
    }
}

// SIGN UP FORM
if(isset($_POST['form-signup-submit'])) {
    if(userExists($_POST['email'])) {
        // user exists, do the login
        echo "<script>alert('L\'email esiste.');</script>";
    } else {
        if(registerUser($_POST)) {
            echo "<script>alert('Utente registrato! Effettua il login');</script>";
        } else {
            echo "<script>alert('Errore durante la registrazione');</script>";
        }
    }
}

?>