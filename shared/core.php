<?php
@session_start();

require  __DIR__ . DIRECTORY_SEPARATOR . "utils". DIRECTORY_SEPARATOR . "database.php";
require  __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor". DIRECTORY_SEPARATOR . "autoload.php";

function isLoggedUser() {
    return isset($_SESSION['user']);
}

function goHome() {
    echo "<script>window.location.href = './';</script>";
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

function getRoleByUserId($id_utente) {
    $query = "SELECT ruolo.tempomax AS tempomax, 
                     ruolo.librimax AS librimax, 
                     ruolo.nome AS nomeruolo 
              FROM ruolo, utente
              WHERE utente.id_ruolo = ruolo.id AND utente.id = $id_utente";

    if( $db = dbConnect() ) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        //die(print_r(pg_fetch_all($result)));
        return pg_fetch_all($result)[0];

    }
}

function getBookCopies() {
    if( $db = dbConnect()) {
        $query = "SELECT copia.id AS id_copia, 
                         copia.scaffale AS copia_scaffale, 
                         copia.sezione AS copia_sezione, 
                         libro.id AS id_libro, 
                         libro.titolo AS titolo_libro, 
                         libro.isbn AS isbn, 
                         autore.nome AS nome_autore, 
                         autore.cognome AS cognome_autore, 
                         autore.id AS id_autore,
                         casaeditrice.denominazione AS casaeditrice,
                         casaeditrice.id AS id_casa_editrice
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
            $query = "SELECT prestito.data_inizio AS data_inizio, 
                             copia.id AS id_copia,
                             copia.scaffale AS copia_scaffale,
                             copia.sezione AS copia_sezione,
                             libro.titolo AS titolo_libro, 
                             libro.isbn AS isbn, 
                             autore.nome AS nome_autore, 
                             autore.cognome AS cognome_autore, 
                             casaeditrice.denominazione AS casaeditrice, 
                             prestito.id AS id_prestito
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
    $role = getRoleByUserId($id_utente);

    $queryPossibilitRichiestaPrestito = "SELECT COUNT(*) AS prestiti_in_corso FROM prestito WHERE id_utente=$id_utente AND prestito.data_fine IS NULL";
    $queryRegistraPrestito = "INSERT INTO prestito(id_utente, id_copia, data_inizio) VALUES($id_utente, $id_copia, '$data_inizio')";
    $queryStornaGiacenza = "UPDATE copia SET disponibile=FALSE WHERE copia.id = $id_copia";

    if( $db = dbConnect() ) {
        $result = pg_query($db, $queryPossibilitRichiestaPrestito);
        if (!$result) {
            echo "An error occurred.\n" . pg_last_error($db);
            return false;
            exit;
        }

        $row = pg_fetch_all($result)[0];
        if( (int)$row['prestiti_in_corso'] >= (int)$role['librimax'] ) {
            echo "<script>alert('Non puoi richiedere altri libri. Concludi prima qualche prestito.');</script>";
            goHome();
            return false;
            exit;
        }

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
        goHome();
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
        goHome();
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

function refreshUserSession() {
    $currentUserId = $_SESSION['user']['id'];

    $query = "SELECT * FROM utente WHERE id=$currentUserId";

    if( $db = dbConnect()) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        $_SESSION['user'] = pg_fetch_all($result)[0];
        return true;
    }
}

function editProfile($userData) {
    //die(print_r($userData));
    // RETRIEVE CURRENT USER FROM SESSION - WE ARE LOGGED IN
    $currentUserId=$_SESSION['user']['id'];

    // MAP ALL THE INFORMATION ARRIVING BY USER FORM
    $nome = $userData['nome'];
    $cognome = $userData['cognome'];
    $data_nascita = ($userData['data_nascita']) ? $userData['data_nascita'] : NULL;
    $id_citta = $userData['id_citta'];
    $id_citta_nascita = $userData['id_citta_nascita'];
    $telefono = $userData['telefono'];

    // LET'S PREPARE THE UPDATE USER PROFILE QUERY
    $query = "UPDATE utente    
              SET nome='$nome',
                  cognome='$cognome',
                  id_citta=$id_citta,
                  id_citta_nascita=$id_citta_nascita,
                  telefono=$telefono,
                  data_nascita='$data_nascita'
              WHERE utente.id=$currentUserId";

    // A LITTLE BIT OF LOGIC TO DIAL WITH
    if( $db = dbConnect()) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        // UPDATE THE SESSION DATA TOO
        if(refreshUserSession()) {
            return true;
        } else {
          return false;
        }

    }

}


function getAuthorById($id_autore) {
    $query = "SELECT * FROM autore WHERE autore.id = $id_autore";

    if( $db = dbConnect()) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        return pg_fetch_all($result)[0];

    }

}

function getEditorById($id_casa_editrice) {
    $query = "SELECT * FROM casaeditrice WHERE casaeditrice.id = $id_casa_editrice";

    if( $db = dbConnect()) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        return pg_fetch_all($result)[0];

    }
}

function getBookById($id_libro) {
    $query = "SELECT libro.titolo AS titolo, 
                     libro.isbn AS isbn,
                     libro.edizione AS edizione,
                     libro.anno_pubblicazione AS anno_pubblicazione,
                     lingua.nome AS lingua,
                     casaeditrice.denominazione AS casaeditrice, 
                     casaeditrice.id AS id_casa_editrice
              FROM libro, lingua, casaeditrice, autore, autore_libro
              WHERE libro.id_lingua = lingua.id AND libro.id_casaeditrice=casaeditrice.id AND libro.id=$id_libro";
    if( $db = dbConnect()) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        return pg_fetch_all($result)[0];

    }
}

function getAuthorsByBookId($id_libro) {
    $query = "SELECT autore.nome AS nome, 
                     autore.cognome AS cognome, 
                     autore.id AS id_autore 
              FROM autore, autore_libro
              WHERE autore.id=autore_libro.id_autore AND autore_libro.id_libro=$id_libro";

    if( $db = dbConnect()) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        return pg_fetch_all($result);

    }

}

function getCopyById($id_copia) {
    $query = "SELECT libro.titolo AS titolo, 
                     libro.id AS id_libro,
                     libro.isbn AS isbn
              FROM copia, libro
              WHERE copia.id=$id_copia AND copia.id_libro=libro.id";

    if( $db = dbConnect()) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        return pg_fetch_all($result)[0];

    }
}

function getRatesByCopyId($id_copia) {
    $query = "SELECT prestito.voto AS voto,
                     prestito.commento AS commento,
                     utente.nome AS nome_utente,
                     utente.cognome AS cognome_utente
              FROM prestito, utente
              WHERE prestito.id_copia=$id_copia AND prestito.id_utente=utente.id AND prestito.data_fine IS NOT NULL";

    if( $db = dbConnect() ) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        //die(print_r(pg_fetch_all($result)));
        return pg_fetch_all($result);

    }
}

function getAverageRateByCopyId($id_copia) {
    $query = "SELECT AVG(prestito.voto) AS votomedio
              FROM prestito
              WHERE prestito.id_copia=$id_copia AND prestito.voto IS NOT NULL
              GROUP BY prestito.id_copia";

    if( $db = dbConnect() ) {
        $result = pg_query($db, $query);
        if (!$result) {
            echo "An error occurred.\n";
            return false;
            exit;
        }

        //die(print_r(pg_fetch_all($result)));
        return pg_fetch_all($result)[0];

    }
}

?>