<?php

function logic_getCards($session_id, $lang) {
  $items = array();

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
  $items = array();
  $items[] = array(
    'id'        => 1,
    'title'     => 'driver',
    'salary'    => 'test',
    'work_time' => '10 - 19',
    'address'   => 'here',
    'geo'       => array(60.40301441, 24.96705878),
  );
  $items[] = array(
    'id'        => 1,
    'title'     => 'driver',
    'salary'    => 'test',
    'work_time' => '10 - 19',
    'address'   => 'here',
    'geo'       => array(60.40301441, 24.96705878),

  );
  $items[] = array(
    'id'        => 1,
    'title'     => 'driver',
    'salary'    => 'test',
    'work_time' => '10 - 19',
    'address'   => 'here',
    'geo'       => array(60.40301441, 24.96705878),

  );
  $items[] = array(
    'id'        => 1,
    'title'     => 'driver',
    'salary'    => 'test',
    'work_time' => '10 - 19',
    'address'   => 'here',
    'geo'       => array(60.40301441, 24.96705878),

  );
  $items[] = array(
    'id'        => 1,
    'title'     => 'driver',
    'salary'    => 'test',
    'work_time' => '10 - 19',
    'address'   => 'here',
    'geo'       => array(60.40301441, 24.96705878),

  );
  $items[] = array(
    'id'        => 1,
    'title'     => 'driver',
    'salary'    => 'test',
    'work_time' => '10 - 19',
    'address'   => 'here',
    'geo'       => array(60.40301441, 24.96705878),

  );

  return $items;
}