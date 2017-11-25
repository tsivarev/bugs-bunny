<?php

function logic_dropSession($session_id) {
  global $MC;

  $MC->delete('info' . $session_id);
}

function logic_getNextCards($session_id, $lang, $current_answer, $step) {
  global $MC;

  $plot = getPlot();
  $step_value = $MC->get('info' . $session_id);

  $result = array();
  if (!$step_value) {
    list($step, $step_info, $skills, $categories, $used_words) = startPlot();
    $max_plot_id = 1;
    $result[] = logic_wrapCard($step, $step_info, $lang);
  } else {
    list($skills, $categories, $used_words, $max_plot_id) = $step_value;
    list($skills, $categories) = acceptDecision($step, $current_answer, $skills, $categories);
  }


  list($next_step, $used_words, $word) = findNextStep($step, $skills, $categories, $used_words, $max_plot_id);

  if ($word) {
    $text = translate_query($lang, $word, 'fi');

    $result[] = array(
      'id'        => $next_step,
      'text'      => $text,
    );
  } else {
    $result[] = logic_wrapCard($next_step, $plot[$next_step], $lang);
    $max_plot_id = $next_step;
  }

  $MC->set('info' . $session_id, array($skills, $categories, $used_words, $max_plot_id));

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
    if (!isset($job_category_ids[$row['category_id']])) {
      $job_category_ids[$row['category_id']] = array();
    }

    $job_category_ids[$row['category_id']][] = $row['job_id'];
  }

  $job_ids = array();
  foreach ($category_ids as $category_id => $value) {
    if (!isset($job_category_ids[$category_id])) {
      continue;
    }

    $found = array_slice($job_category_ids[$category_id], 0, 3);
    foreach ($found as $job_id) {
      $job_ids[$job_id] = 1;
    }
  }

  $job_ids = array_slice(array_keys($job_ids),0, 100);

  $result = db_query('SELECT * from JOBS where ID IN ('.implode(',', $job_ids).')');
  $jobs = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $json = json_decode($row['json'], true);

    if (!isset($json['tehtavanimi'])) {
      continue;
    }

    if (!isset($json['palkkausteksti'])) {
      continue;
    }

    if (!isset($json['yhteystiedot'])) {
      continue;
    }

    if (!isset($json['tyoaikatekstiYhdistetty'])) {
      continue;
    }


    $jobs[] = array(
      'id'        => $json['ilmoitusnumero'],
      'title'     => translate_query($lang, $json['tehtavanimi'], 'fi'),
      'salary'    => translate_query($lang, $json['palkkausteksti'], 'fi'),
      'address'   => str_replace('\r\n', ' ', $json['yhteystiedot']),
      'work_time' => translate_query($lang, $json['tyoaikatekstiYhdistetty'], 'fi'),
    );
  }


  return $jobs;
}

