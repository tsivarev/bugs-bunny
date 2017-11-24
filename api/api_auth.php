<?php

function api_auth_startSession() {
  return array(
    'session' => api_generateSession()
  );
}

function api_auth_check() {
  global $temp_session;

  return $temp_session;
}