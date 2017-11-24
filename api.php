<?php

require_once 'config.php';
require_once 'libs/global.lib.php';
require_once 'api/api_auth.php';
require_once 'api/api_functions.php';

$input = array_merge($_POST, $_GET);

header("Content-Type: application/json; charset=utf-8");

$method = (string)$input['method'];
$session = (string)$input['session'];
$temp_session = $session ? api_getSessionUniqueId($session) : null;
$access_token = (string)$input['access_token'];

try {
  api_response(api_invokeMethod($method));
} catch (Exception $e) {
  api_error($e);
}