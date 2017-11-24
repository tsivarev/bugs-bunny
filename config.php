<?php

define('BASE_DIRECTORY', '/var/www');
define('LOGS_DIRECTORY', BASE_DIRECTORY.'/logs');

$MC = new Memcached();
$MC->addServer('localhost', 11211);
