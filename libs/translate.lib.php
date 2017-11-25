<?php

function translate_query($target, $text, $source = 'en') {
  global $MC;

  if ($target == $source) {
    return $text;
  }

  $mc_key = implode('_', array('translate', $target, $source, hash('sha256', $text)));
  $mc_result = $MC->get($mc_key);
  if ($mc_result) {
    return $mc_result;
  }

  $output = _translate_request($target, $text, $source);
  $translation = $output[0][0][0];

  if ($translation) {
    $MC->set($mc_key, $translation);
    return $translation;
  }

  return $text;
}

function _translate_request($target, $text, $source = 'en') {
  $ch = curl_init();
  $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl="
    . $source . "&tl=" . $target . "&dt=t&q=" . urlencode($text);

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $server_output = curl_exec($ch);
  curl_close($ch);

  log_msg($text);
  log_msg($url);
  log_msg($server_output);

  return json_decode($server_output, true);
}