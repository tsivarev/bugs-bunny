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
    list($step, $step_info, $skills, $categories, $used_words, $courses) = startPlot();
    $max_plot_id = 1;
    $result[] = logic_wrapCard($step, $step_info, $lang);
  } else {
    list($skills, $categories, $used_words, $max_plot_id, $courses) = $step_value;
    list($skills, $categories, $courses) = acceptDecision($step, $current_answer, $skills, $categories, $courses);
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

  $MC->set('info' . $session_id, array($skills, $categories, $used_words, $max_plot_id, $courses));

  return array($result, $skills, $categories, $courses);
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
  $category_ids = array_filter($weights, function ($v) {
    return $v >= 0;
  });

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
      $job_ids[$job_id] = $value;
    }
  }

  $job_ids = array_keys($job_ids);

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

    if (!isset($json['tyopaikanOsoite'])) {
      continue;
    }

    if (!isset($json['tyoaikatekstiYhdistetty'])) {
      continue;
    }

    if (isset($json['sijainti'])) {
      list($a, $b) = explode(',', $json['sijainti']);
      $distance = distance($a, $b, 60.1811483, 24.8090845, "K") * 1000;
      if ($distance < 500) {
        $distance = '<500m';
      } else {
        if ($distance < 1000) {
          $distance = '<1km';
        } else {
          if ($distance < 3000) {
            $distance = '<3km';
          } else {
            if ($distance < 5000) {
              $distance = '<5km';
            } else {
              if ($distance < 100000) {
                $distance = '<100km';
              } else {
                $distance = '>100km';
              }
            }
          }
        }
      }
    } else if (isset($json['postitoimipaikka'])){
      $distance = ucfirst($json['postitoimipaikka']);
    } else {
      $distance = '';
    }

//    $job_categories = '';
//    if (isset($json['ammattikoodi'])) {
//      $job_category_ids = $json['ammattikoodi'];
//    }

    $jobs[] = array(
      'id'        => $json['ilmoitusnumero'],
      'title'     => translate_query($lang, $json['tehtavanimi'], 'fi'),
      'salary'    => translate_query($lang, $json['palkkausteksti'], 'fi'),
      'address'   => str_replace('\r\n', ' ', $json['tyopaikanOsoite']),
      'distance'  => $distance,
      'work_time' => translate_query($lang, $json['tyoaikatekstiYhdistetty'], 'fi'),
    );
  }

  if (count($jobs) > 50) {
    $jobs = array_slice($jobs,0, rand(50, min(100, count($jobs))));
  }

  return $jobs;
}

function haversineGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
    return ($miles * 0.8684);
  } else {
    return $miles;
  }
}

function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}
