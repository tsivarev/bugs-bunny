<?php

define('OK_RESPONSE', 1);

function api_auth_startSession() {
  return array(
    'access_token' => api_generateAccessToken()
  );
}

function api_cards_get() {
  global $lang, $session_id;

  list($cards) = logic_getNextCards($session_id, $lang, PLOT_YES, 0);

  return api_wrapList($cards, count($cards));
}

function api_cards_mark() {
  global $input, $session_id, $lang;

  $card_id = (string)$input['card_id'];
  $answer = (bool)$input['answer'];
  list($cards, $skills, $categories, $courses) = logic_getNextCards($session_id, $lang, $answer ? PLOT_YES : PLOT_NO, $card_id);
  if (is_numeric($card_id) && $card_id > 6) {
    $jobs = $categories ? logic_getJobs($session_id, $lang, $skills, $categories) : array();
  } else {
    $jobs = array();
  }

  return array(
    'courses' => api_wrapList($courses, count($courses)),
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

