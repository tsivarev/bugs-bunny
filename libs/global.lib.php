<?php

function log_msg($message) {
  if (is_array($message)) {
    $message = json_encode($message);
  }
  _log_write('[INFO] ' . $message);
}

function log_error($message) {
  if (is_array($message)) {
    $message = json_encode($message);
  }
  _log_write('[ERROR] ' . $message);
}

function _log_write($message) {
  $trace = debug_backtrace();
  $function_name = isset($trace[2]) ? $trace[2]['function'] : '-';
  $mark = date("H:i:s") . ' [' . $function_name . ']';
  $log_name = LOGS_DIRECTORY . '/log_' . date("j.n.Y") . '.txt';
  file_put_contents($log_name, $mark . " : " . $message . "\n", FILE_APPEND);
}

function _db_init() {
  db_query('drop table JOBS;');
  $q = "create table JOBS (
          job_id int,
          json BLOB,
        );";

  db_query($q);
}

function db_query($q) {
  global $DB;

  return $DB->query($q) === true;
}

function _db_loadJobs() {
  $file = file_get_contents('jobs_full_2.json');
  $file = str_replace("}{", "}\n{", $file);
  $chunks = str_split($file, "\n");

  foreach ($chunks as $chunk) {
    $jobs = json_decode($chunk, true);
    foreach ($jobs as $job) {
      $data = serialize($job);
      db_query("INSERT INTO JOBS (job_id, json) VALUES ({$job['ilmoitusnumero']}, '{$data}')");
    }
  }

}