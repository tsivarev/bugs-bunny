<?php

header("Content-Type: application/json");

$jobs = json_decode(file_get_contents('jobs.json'), true);
$jobs_ids = array();
foreach ($jobs as $category_id => $category_jobs) {
  $count += count($category_jobs);
  foreach ($category_jobs as $job) {
    $jobs_ids[$job['ilmoitusnumero']] = 1;
  }
}

$jobs_ids = array_keys($jobs_ids);
$total_count = count($jobs_ids);
$result = array();
$j = 0;
$skip = 0;
foreach ($jobs_ids as $job_id) {
  $url = "https://paikat.te-palvelut.fi/tpt-api/tyopaikat/{$job_id}?kieli=fi";
  $response = _request($url);
  $result[$job_id] = $response['response']['docs'][0];
  $j++;
  $skip++;

  if ($skip > 100) {
    $skip = 0;
    $json = json_encode($result);
    file_put_contents('jobs_full.json', $json, FILE_APPEND | LOCK_EX);
    $result = array();
  }

  echo $j . '/'. $skip .'/'. $total_count . "\n";
}


function _request($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $server_output = curl_exec($ch);
  curl_close($ch);

  return json_decode($server_output, true);
}