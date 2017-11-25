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
  db_query('drop table JOBS; drop table JOBS_CATEGORIES;');
  $q = "create table JOBS (
          id int NOT NULL PRIMARY KEY,
          json BLOB
        );
        
        create table JOBS_CATEGORIES (
          job_id int NOT NULL,
          category_id int NOT NULL,
          PRIMARY KEY (category_id, job_id)
        );
        ";

  db_query($q);
}

function db_query($q) {
  global $DB;

  $result = mysqli_query($DB, $q);
  if ($result) {
    return $result;
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


function _db_loadCategories() {
  require_once 'config_skills.php';
  global $category2skill;

  $jobs = json_decode(file_get_contents('jobs.json'), true);

  $result = array();
  $count = 0;
  foreach ($jobs as $category_id => $category_jobs) {
    if (!isset($category2skill[$category_id])) {
      continue;
    }

    $count += count($category_jobs);
    $jobs_ids = array();
    foreach ($category_jobs as $job) {
      $jobs_ids[$job['ilmoitusnumero']] = 1;
    }

    $result[$category_id] = array_keys($jobs_ids);
  }

  foreach ($result as $category_id => $jobs_ids) {
    foreach ($jobs_ids as $job_id) {
      $db_result = db_query("INSERT INTO JOBS_CATEGORIES (job_id, category_id) VALUES ({$job_id}, {$category_id})");
      if ($db_result !== true) {
        log_error("fail");
        exit;
      }
    }
  }

}

function weightedShuffle($obj_2_weights, $smooth_alpha = 0.05) {
  $sum_weight = 0;

  foreach ($obj_2_weights as $obj => $weight) {
    $sum_weight += $weight;
  }

  // add smoothing, so elements with too small weight also will be able to get on the first place
  if (is_numeric($smooth_alpha)) {
    $smooth_add = $smooth_alpha * $sum_weight / count($obj_2_weights);
    $sum_weight = (1. + $smooth_alpha) * $sum_weight;
  } else {
    $smooth_add = 0.;
  }

  $result = array();
  while (!empty($obj_2_weights)) {
    $rand_val = mt_rand() / mt_getrandmax();
    $rand_val *= $sum_weight;

    $rand_obj = false;
    $obj_weight = false;
    foreach ($obj_2_weights as $obj => $weight) {
      $rand_val -= $weight + $smooth_add;
      $obj_weight = $weight;
      $rand_obj = $obj;
      if ($rand_val < 1.e-12) {
        break;
      }
    }
    $result[$rand_obj] = $obj_weight;
    $sum_weight -= $obj_weight;
    unset($obj_2_weights[$rand_obj]);
  }

  return $result;
}
