<?php

define('OK_RESPONSE', 1);

function api_auth_startSession() {
  return array(
    'access_token' => api_generateAccessToken()
  );
}

function api_cards_get() {
  global $lang, $session_id;

  $items = logic_getCards($session_id, $lang);

  return api_wrapList($items, count($items));
}

function api_cards_apply() {
  global $input, $session_id;

  $events = (array)$input['events'];

  $items = logic_getJobs($session_id);
  return api_wrapList($items, count($items));
}

function api_cards_ignore() {
  global $input, $session_id;

  $events = (array)$input['events'];

  $items = logic_getJobs($session_id);
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