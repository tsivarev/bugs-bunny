<?php

require_once 'config.php';
require_once 'libs/global.lib.php';
require_once 'api/api_all.php';
require_once 'api/api_functions.php';

$input = array_merge($_POST, $_GET);

header("Content-Type: application/json; charset=utf-8");

$method = (string)$input['method'];
$access_token = (string)$input['access_token'];
$session = $access_token ? api_getSession($access_token) : null;
$session_id = null;
if ($session) {
  $session_id = $session['session_id'];
}

if (!$session_id && $method != 'auth.startSession') {
  api_error('session is invalid');
}

try {
  api_response(api_invokeMethod($method));
} catch (Exception $e) {
  api_error($e);
}