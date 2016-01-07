<?php

error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
define('MYSQL_HOST', 'localhost');
define('MYSQL_BENUTZER', 'root');
define('MYSQL_KENNWORT', '');
define('MYSQL_DATENBANK', 'paul');

$db_link = mysqli_connect(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

if ($db_link) {
    mysqli_set_charset($db_link, 'utf8');
} else {
    die('keine Verbindung möglich: ' . mysqli_error());
}

