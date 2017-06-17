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

function getBookCopies() {
    if( $db = dbConnect()) {
        $query = "SELECT copia.id AS id_copia, copia.scaffale AS copia_scaffale, copia.sezione AS copia_sezione, libro.id AS id_libro, libro.titolo AS titolo_libro, libro.isbn AS isbn, autore.nome AS nome_autore, autore.cognome AS cognome_autore, casaeditrice.denominazione AS casaeditrice
                  FROM libro, autore, autore_libro, copia, casaeditrice 
                  WHERE copia.id_libro = libro.id AND libro.id_casaeditrice = casaeditrice.id AND libro.id = autore_libro.id_libro AND autore_libro.id_autore = autore.id AND copia.disponibile = TRUE";
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }

        return pg_fetch_all($result);
    }
}

function getPrestiti($attuali=false, $idUtente) {
    if( $db = dbConnect() ) {

        if($attuali) {
            $query = "SELECT prestito.data_inizio AS data_inizio, libro.titolo AS titolo_libro, libro.isbn AS isbn, autore.nome AS nome_autore, autore.cognome AS cognome_autore, casaeditrice.denominazione AS casaeditrice, prestito.id AS id_prestito
                  FROM libro, autore, autore_libro, copia, casaeditrice, prestito
                  WHERE prestito.id_copia = copia.id AND copia.id_libro = libro.id AND libro.id_casaeditrice = casaeditrice.id AND libro.id = autore_libro.id_libro AND autore_libro.id_autore = autore.id AND prestito.id_utente = $idUtente AND data_inizio IS NOT NULL AND data_fine IS NULL;";
        } else {
            $query = "SELECT prestito.voto AS voto_prestito, prestito.commento AS commento_prestito, prestito.data_fine AS data_fine, prestito.data_inizio AS data_inizio, libro.titolo AS titolo_libro, libro.isbn AS isbn, autore.nome AS nome_autore, autore.cognome AS cognome_autore, casaeditrice.denominazione AS casaeditrice, prestito.id AS id_prestito
                  FROM libro, autore, autore_libro, copia, casaeditrice, prestito
                  WHERE prestito.id_copia = copia.id AND copia.id_libro = libro.id AND libro.id_casaeditrice = casaeditrice.id AND libro.id = autore_libro.id_libro AND autore_libro.id_autore = autore.id AND prestito.id_utente = $idUtente AND data_inizio IS NOT NULL AND data_fine IS NOT NULL;";
        }

        $result = pg_query($db, $query);
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
    $userPwd = md5($userPwd);
    if( $db = dbConnect()) {
        $result = pg_query($db, "SELECT * FROM utente WHERE email='$userEmail' AND password='$userPwd'");
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }

        $rows = pg_fetch_all($result);
        if(is_array($rows) || is_object($rows)) {
            $_SESSION['user'] = $rows[0];
        }

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
    $password = md5(trim($formData['password']));
    $current_date = date('Y-m-d');

    //die(print_r($formData));
    if( $db = dbConnect() ) {
        pg_connection_reset($db);
        $db = dbConnect();
        $result = pg_query($db, "INSERT INTO utente(id_ruolo, nome, cognome, telefono, email, tessera, data_registrazione, id_citta, password) 
                                       VALUES($ruolo, '$nome', '$cognome', '$telefono', '$email', '$tessera', '$current_date', $id_citta, '$password');");
        if (!$result) {
            echo "An error occurred.\n" . pg_last_error($db);
            return false;
            exit;
        }

        doLogin($email, $password);
        return true;
    }
}

function doLogout() {
    session_unset('user');
    Header('Location: ./');
}

function doPrestito() {
    // get form data correctly
    $id_copia = trim($_GET['id_copia']);
    $data_inizio = date('Y-m-d');
    $id_utente = $_SESSION['user']['id'];

    // Controllo se ci sono copie disponibili di questo libro
    $queryRegistraPrestito = "INSERT INTO prestito(id_utente, id_copia, data_inizio) VALUES($id_utente, $id_copia, '$data_inizio')";
    $queryStornaGiacenza = "UPDATE copia SET disponibile=FALSE WHERE copia.id = $id_copia";

    if( $db = dbConnect() ) {
        $result = pg_query($db, $queryRegistraPrestito);
        if (!$result) {
            echo "An error occurred.\n" . pg_last_error($db);
            return false;
            exit;
        }

        $result = pg_query($db, $queryStornaGiacenza);
        if (!$result) {
            echo "An error occurred.\n" . pg_last_error($db);
            return false;
            exit;
        }

        echo "<script>alert('Prestito effettuato');</script>";
        return true;
    }
}

function endPrestito() {
    // get form data correctly
    $id_prestito = trim($_GET['id_prestito']);
    $data_fine = date('Y-m-d');
    $id_utente = $_SESSION['user']['id'];

    // Controllo se ci sono copie disponibili di questo libro
    $queryRegistraFinePrestito = "UPDATE prestito SET data_fine='$data_fine' WHERE prestito.id=$id_prestito";
    $queryAggiornaGiacenza = "UPDATE copia SET disponibile=TRUE WHERE copia.id IN (SELECT id_copia FROM prestito WHERE prestito.id=$id_prestito LIMIT 1)";

    if( $db = dbConnect() ) {
        $result = pg_query($db, $queryRegistraFinePrestito);
        if (!$result) {
            echo "An error occurred.\n" . pg_last_error($db);
            return false;
            exit;
        }

        $result = pg_query($db, $queryAggiornaGiacenza);
        if (!$result) {
            echo "An error occurred.\n" . pg_last_error($db);
            return false;
            exit;
        }

        echo "<script>alert('Prestito rientrato');</script>";
        return true;
    }
}

function evaluatePrestito($idPrestito, $voto, $commento) {
    $query = "UPDATE prestito SET voto = $voto, commento='$commento' WHERE id=$idPrestito";
    if( $db = dbConnect()) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        return true;
    }
}


?>