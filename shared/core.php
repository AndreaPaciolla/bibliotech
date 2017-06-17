<?php
@session_start();

require  __DIR__ . DIRECTORY_SEPARATOR . "utils". DIRECTORY_SEPARATOR . "database.php";

function isLoggedUser() {
    return isset($_SESSION['user']);
}

function getCities() {
    if( $db = dbConnect()) {
        $result = pg_query($db, "SELECT * FROM citta;");
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }

        return pg_fetch_all($result);
    }
}

// FUNCTION THAT RETURNS ALL THE ROLES
function getRuoli() {
    if( $db = dbConnect()) {
        $result = pg_query($db, "SELECT * FROM ruolo;");
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }

        return pg_fetch_all($result);
    }
}

function userExists($userEmail) {
    if( $db = dbConnect()) {
        $result = pg_query($db, "SELECT email FROM utente where email='".$userEmail."' LIMIT 1;");
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }
        return pg_fetch_all($result);
    }
}

function doLogin($userEmail, $userPwd) {
    if( $db = dbConnect()) {
        $result = pg_query($db, "SELECT * FROM utente WHERE email='".$userEmail."' LIMIT 1;");
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }

        $_SESSION['user'] = pg_fetch_array($result, 0, PGSQL_ASSOC);
        return $_SESSION['user'] !== NULL;
    }
}

function registerUser($formData) {
    // get form data correctly
    $ruolo = $formData['ruolo'];
    $nome = $formData['nome'];
    $cognome = $formData['cognome'];
    $telefono = $formData['telefono'];
    $email = $formData['email'];
    $tessera = $formData['tessera'];
    $id_citta = $formData['id_citta'];
    $password = $formData['password'];

    if( $db = dbConnect() ) {
        $result = pg_query($db, "INSERT INTO utente(id_ruolo, nome, cognome, telefono, email, tessera, data_registrazione, id_citta, password) VALUES('$ruolo', '$nome', '$cognome', '$telefono', '$email', '$tessera', current_date(), '$id_citta', '$password')");
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }

        $_SESSION['user'] = pg_fetch_array($result, 0, PGSQL_ASSOC);
        return $_SESSION['user'] !== NULL;
    }
    die($formData);
}

function doLogout() {
    session_unset('user');
    Header('Location: ./');
}

// Event handlers
if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'doLogout': doLogout(); break;
        default: exit;
    }
}

?>