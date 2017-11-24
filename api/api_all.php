<?php

define('OK_RESPONSE', 1);

function api_auth_startSession() {
  return array(
    'access_token' => api_generateAccessToken()
  );
}

function api_cards_get() {
  global $lang, $session_id;

  $items = array();
  $items[] = array(
    'id'        => 1,
    'image_url' => 'test.png',
    'text'      => translate_query($lang, 'test')
  );

  return api_wrapList($items, count($items));
}

function api_cards_sendEvents() {
  global $input, $session_id;

  $events = (array)$input['events'];

  return OK_RESPONSE;
}

function api_jobs_get() {
  global $input, $session_id;

  $items = array();
  $items[] = array(
    'id'          => 1,
    'title'       => 'driver',
    'description' => 'test',
  );

  return api_wrapList($items, count($items));
}

function api_jobs_apply() {
  global $input, $session_id;

  $job_id = (int)$input['job_id'];

  return OK_RESPONSE;
}

function api_jobs_ignore() {
  global $input, $session_id;

  $job_id = (int)$input['job_id'];

  return OK_RESPONSE;
}