<?php

define('OK_RESPONSE', 1);

function api_auth_startSession() {
  return array(
    'access_token' => api_generateAccessToken()
  );
}

function api_cards_get() {
  global $lang, $session_id;

  $cards = logic_getNextCards($session_id, $lang, PLOT_YES);

  return api_wrapList($cards, count($cards));
}

function api_cards_mark() {
  global $input, $session_id, $lang;

  $card_id = (int)$input['card_id'];
  $answer = (bool)$input['answer'];
  $cards = logic_getNextCards($session_id, $lang, $answer ? PLOT_YES : PLOT_NO);
  $jobs = logic_getJobs($session_id);

  return array(
    'cards' => api_wrapList($cards, count($cards)),
    'jobs'  => api_wrapList($jobs, count($jobs))
  );
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