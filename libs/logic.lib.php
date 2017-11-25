<?php

function logic_dropSession($session_id) {
  global $MC;

  $MC->delete('info' . $session_id);
}

function logic_getNextCards($session_id, $lang, $current_answer) {
  global $MC;

  $step_value = $MC->get('info' . $session_id);

  if (!$step_value) {
    list($step, $step_info, $skills, $categories) = startPlot();
  } else {
    list($step, $skills, $categories) = $step_value;
    list($step, $step_info, $skills, $categories) = moveByPlot($step, $current_answer, $skills, $categories);
  }

  $MC->set('info' . $session_id, array($step, $skills, $categories));

  if ($step > 0) {
    $result = array();
    if ($step == 1) {
      $result[] = logic_wrapCard($step, $step_info, $lang);
    }

    $next_step = findNextStep($step, $skills);
    if ($next_step > 0) {
      $plot = getPlot();
      $result[] = logic_wrapCard($next_step, $plot[$next_step], $lang);
    }
  }

  return array($result, $skills, $categories);
}

function logic_wrapCard($step, $card, $lang) {
  $text = $card[PLOT_TEXT];
  if ($card[PLOT_TRANSLATE]) {
    $text = translate_query($lang, $text);
  }

  return array(
    'id'        => $step,
    'text'      => ucfirst($text),
    'image_url' => '/static/card_' . $step . '.png'
  );
}

function logic_getJobs($session_id, $lang, $skills, $categories) {
  $weights = weightCategories($skills, $categories);
  $category_ids = array();
  foreach ($weights as $category_id => $value) {
    if ($value <= 0) {
      continue;
    }

    $category_ids[$category_id] = $value;
  }

  $result = db_query('SELECT * from JOBS_CATEGORIES where CATEGORY_ID IN ('.implode(',', array_keys($category_ids)).')');
  $job_category_ids = array();
  while ($row = mysqli_fetch_assoc($result)) {
    if (!$job_category_ids[$row['category_id']]) {
      $job_category_ids[$row['category_id']] = array();
    }

    $job_category_ids[$row['category_id']][] = $row['job_id'];
  }

  $job_ids = array();
  foreach ($category_ids as $category_id => $value) {
    $found = array_slice($job_category_ids[$category_id], 0, 3);
    foreach ($found as $job_id) {
      $job_ids[$job_id] = 1;
    }
  }

  $job_ids = array_keys($job_ids);
  log_msg($job_ids);

  $result = db_query('SELECT * from JOBS where ID IN ('.implode(',', $job_ids).')');
  $jobs = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $json = json_decode($row['json'], true);

    $jobs[] = array(
      'id'        => $json['ilmoitusnumero'],
      'title'     => $json['tehtavanimi'],
      'salary'    => $json['palkkausteksti'] ?: "unknown",
      'address'   => $json['yhteystiedot'],
      'work_time' => translate_query($lang, $json['tyoaikatekstiYhdistetty'], 'fi'),
    );
  }


  return $jobs;
}

