<?php

function logic_getNextCard($session_id, $lang, $current_answer) {
  global $MC;

  $step_value = $MC->get('info' . $session_id);

  if (!$step_value) {
    list($step, $step_info, $skills, $categories) = startPlot();
  } else {
    list($step, $skills, $categories) = $step_value;
    list($step, $step_info, $skills, $categories) = moveByPlot($step, $current_answer, $skills, $categories);
  }

  $MC->set('info'.$session_id, array($step, $skills, $categories));

  if ($step > 0) {
    $text = $step_info[PLOT_TEXT];
    if ($step_info[PLOT_TRANSLATE]) {
      $text = translate_query($lang, $text);
    }
    return array(
      'text' => $text,
      'image_url' => '/static/card_' . $step . '.png'
    );
  }

  return null;
}

function logic_getCards($session_id, $lang) {
  $items = array();

  $items[] = array(
    'id'        => 6,
    'text'      => 'wow',
    'image_url' => 'https://pbs.twimg.com/profile_images/784791896405270530/CMKZpIpw.jpg'
  );
  $items[] = array(
    'id'        => 6,
    'text'      => 'wow',
    'image_url' => 'https://pbs.twimg.com/profile_images/689152280818483200/17UIv0z8.png'
  );
  $items[] = array(
    'id'        => 6,
    'text'      => 'wow',
    'image_url' => 'https://pbs.twimg.com/profile_images/880504880758005760/IWZAANG8.jpg'
  );
  $items[] = array(
    'id'        => 6,
    'text'      => 'wow',
    'image_url' => 'https://pp.userapi.com/c639124/v639124562/5fb90/159RWfhK49w.jpg'
  );
  $items[] = array(
    'id'   => 1,
    'text' => 'driver'
  );
  $items[] = array(
    'id'   => 2,
    'text' => 'teacher'
  );
  $items[] = array(
    'id'        => 6,
    'text'      => 'wow',
    'image_url' => 'https://pp.userapi.com/c639124/v639124562/5fb90/159RWfhK49w.jpg'
  );
  $items[] = array(
    'id'   => 3,
    'text' => 'lol'
  );
  $items[] = array(
    'id'   => 4,
    'text' => 'kek'
  );
  $items[] = array(
    'id'        => 5,
    'image_url' => 'https://pp.userapi.com/c639124/v639124562/5fb90/159RWfhK49w.jpg'
  );

  foreach ($items as $index => $item) {
    if ($item['text']) {
      $items[$index]['text'] = translate_query($lang, $item['text']);
    }
  }

  return $items;
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
