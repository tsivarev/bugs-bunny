<?php

function api_invokeMethod($method) {
  if (!$method) {
    api_error("Invalid method");
  }

  list($section, $method_name) = explode('.', $method);
  $response = call_user_func('api_' . $section . '_' . $method_name);
  if ($response === null) {
    api_error('Method not found', 400);
  }

  return $response;
}

function _api_renderResponse($data) {
  $json = json_encode($data);
  echo $json;

  exit;
}

function api_response($data) {
  _api_renderResponse(array(
    'response' => $data,
  ));
}

function api_error($message, $code = 400) {
  _api_renderResponse(array(
    'error' => array(
      'code'    => $code,
      'message' => $message
    )));
}

function api_getSession($session) {
  global $MC;

  $unique_id = base64_decode($session);

  return $MC->get('session' . $unique_id);
}

function api_generateAccessToken() {
  global $MC;

  $unique_id = uniqid();
  $MC->set('session' . $unique_id, array(
    'session_id' => $unique_id,
    'time'       => time(),
  ));

  return base64_encode($unique_id);
}

function api_wrapList($items, $count) {
  return array(
    'count' => $count,
    'items' => $items,
  );
}