<?php
@session_start();

require  __DIR__ . DIRECTORY_SEPARATOR . "utils". DIRECTORY_SEPARATOR . "database.php";

function isLoggedUser() {
    return isset($_SESSION['user']);
}

function getUserIdentity($dataForm) {
    if( $db = dbConnect() ) {
        $result = pg_query($db, "SELECT * FROM utente;");
        var_dump(pg_fetch_all($result));
    }
}


?>