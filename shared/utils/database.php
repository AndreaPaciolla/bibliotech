<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "configuration.php";

function dbConnect() {
    $connStr = "host=".Configuration::$db_host." port=".Configuration::$db_port." dbname=".Configuration::$db_name." user=".Configuration::$db_user . " password=".Configuration::$db_pass;

    return pg_connect($connStr);
}

?>