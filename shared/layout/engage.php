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
                                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword" class="sr-only">Nome</label>
                                    <input type="text" name="password" id="inputPassword" class="form-control" placeholder="Nome" required>
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
                                    <label for="inputTessera" class="sr-only">Tessera</label>
                                    <input type="text" name="tessera" id="inputTessera" class="form-control" placeholder="Tessera" required>
                                </div>

                                <div class="form-group">
                                    <label for="inputDataNascita" class="sr-only">Data di nascita</label>
                                    <input type="date" name="data_nascita" id="inputDataNascita" class="form-control" placeholder="Data di nascita" required>
                                </div>

                                <div class="form-group">
                                    <label for="inputCittaResidenza" class="sr-only">Citta di residenza</label>
                                    <select class="form-control" name="citta_residenza" id="inputCittaResidenza">
                                        <option value="1">Bari</option>
                                        <option value="2">Milano</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputSesso">Sesso?</label>
                                    <label class="radio-inline">
                                        <input class="radio-inline" type="radio" name="gender" value="1" checked>Uomo
                                    </label>
                                    <label class="radio-inline">
                                        <input class="radio-inline" type="radio" name="gender" value="2">Donna<br>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="inputRuolo">Ruolo</label>
                                    <label class="radio-inline">
                                        <input class="radio-inline" type="radio" name="ruolo" value="1" checked>Studente
                                    </label>
                                    <label class="radio-inline">
                                        <input class="radio-inline" type="radio" name="ruolo" value="2">Docente
                                    </label>
                                    <label class="radio-inline">
                                        <input class="radio-inline" type="radio" name="ruolo" value="3">Dipendente
                                    </label>
                                    <label class="radio-inline">
                                        <input class="radio-inline" type="radio" name="ruolo" value="4">Altro
                                    </label>
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