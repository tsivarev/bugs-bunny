<?php

define('BASE_DIRECTORY', '/var/www');
define('LOGS_DIRECTORY', BASE_DIRECTORY . '/logs');

$MC = new Memcached();
$MC->addServer('localhost', 11211);

$host = "localhost";
$username = "root";
$password = "testPassword";
$db_name = "bb";

// Create connection
$DB = mysqli_connect($host, $username, $password, $db_name);
mysqli_set_charset($DB,"utf8");

ini_set('memory_limit', '256M');
