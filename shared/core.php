<?php
@session_start();

require  __DIR__ . DIRECTORY_SEPARATOR . "utils". DIRECTORY_SEPARATOR . "database.php";

function isLoggedUser() {
    return isset($_SESSION['user']);
}

function getUserIdentity($dataForm) {
    if( $db = dbConnect() ) {

    }
}


function userExists($userEmail) {
    if( $db = dbConnect()) {
        $result = pg_query($db, "SELECT email FROM utente where email='".$userEmail."' LIMIT 1;");
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }

        return NULL !== ($row = pg_fetch_array($result, 0, PGSQL_ASSOC));
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