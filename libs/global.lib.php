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
          id int NOT NULL PRIMARY KEY,
          json BLOB
        );";

  db_query($q);
}

function db_query($q) {
  global $DB;

  if ($DB->query($q) === true) {
    return true;
  } else {
    $db_error = $DB->error;
    log_error($q . ' -> ' .$db_error);
  }
}

function _db_loadJobs() {
  global $DB;

  $handle = fopen('jobs_full_split.json', "r");
  if ($handle) {
    $count = 0;
    while (($line = fgets($handle)) !== false) {
      $jobs = json_decode($line, true);
      $count += count($jobs);
      foreach ($jobs as $job) {
        $data = mysqli_escape_string($DB, json_encode($job));
        $db_result = db_query("INSERT INTO JOBS (id, json) VALUES ({$job['ilmoitusnumero']}, '{$data}')");
        if ($db_result !== true) {
          log_error("fail");
          exit;
        }

      }
    }

    fclose($handle);
  } else {
    // error opening the file.
  }

  echo $count;
}