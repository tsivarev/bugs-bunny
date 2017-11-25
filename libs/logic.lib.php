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

    if (!empty($result)) {
      return $result;
    }
  }

  return null;
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

function logic_getJobs($session_id) {
  $result = db_query('SELECT * from JOBS limit 0, 10;');
  $jobs = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $json = json_decode($row['json'], true);

    $jobs[] = array(
      'id'        => $json['ilmoitusnumero'],
      'title'     => $json['tehtavanimi'],
      'salary'    => $json['palkkausteksti'] ?: "unknown",
      'address'   => $json['yhteystiedot'],
      'work_time' => $json['tyoaikatekstiYhdistetty'],
    );
  }

  return $jobs;
}
