<?php

function api_auth_startSession() {
  global $input;

  $lang = (string)$input['lang'];

  return base64_encode($lang);
}