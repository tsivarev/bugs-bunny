<?php

require_once 'config_skills.php';

define('PLOT_TEXT', 'text');
define('PLOT_YES', 'yes');
define('PLOT_NO', 'no');
define('PLOT_SKILLS', 'skills');
define('PLOT_CATEGORY', 'category');
define('PLOT_TRANSLATE', 'translate');
define('PLOT_IF', 'if');
define('PLOT_BIGGER', '>');

function startPlot() {
  $plot = getPlot();

  return array(
    1,
    $plot[1],
    array(SKILL_HEALTH => -0.3, SKILL_LOW => 1, SKILL_CLEANING => -0.2),
    array(),
    array()
  );
}

function acceptDecision($step, $answer, $skills, $categories) {
  global $words, $word2categories;

  $plot = getPlot();

  list($is_plot, $plot_id, $word_id) = parseStep($step);

  if ($is_plot) {
    $step_info = $plot[$plot_id];

    $answer_info = $step_info[$answer];
    if ($answer_info) {
      if ($answer_info[PLOT_SKILLS]) {
        foreach ($answer_info[PLOT_SKILLS] as $skill => $change) {
          $skills[$skill] += $change;
        }
      }
      if ($answer_info[PLOT_CATEGORY]) {
        foreach ($answer_info[PLOT_CATEGORY] as $category => $change) {
          $categories[$category] += $change;
        }
      }
    }
  } else {
    $word = $words[$word_id];

    $wordCats = $word2categories[$word];
    foreach ($wordCats as $cat_id => $weight) {
      $categories[$cat_id] += $weight;
    }
  }

  return array(
    $skills,
    $categories,
  );
}

function parseStep($step) {
  if (is_numeric($step)) {
    return array(true, $step, null);
  }
  list($step, $word_id) = explode('_', $step);
  return array(false, $step, $word_id);
}

function findNextStep($step, $skills, $categories, $used_words, $max_plot_id) {
  global $wordIndexes;

  $plot = getPlot();

  list(, $plot_id) = parseStep($step);

  $plot_step_id = -1;
  if ($plot_id > 0) {
    $current_step = $max_plot_id + 1;
    while (isset($plot[$current_step])) {
      $step_info = $plot[$current_step];
      if (!$step_info[PLOT_IF]) {
        $plot_step_id = $current_step;
        break;
      }

      $if = $step_info[PLOT_IF];
      $passed_if = true;

      foreach ($if as $skill => $skill_condition) {
        $skill_value = $skills[$skill];

        list($condition, $need_value) = $skill_condition;

        switch ($condition) {
          case PLOT_BIGGER:
            if ($skill_value <= $need_value) {
              $passed_if = false;
            }
            break;
          default: //wtf!
        }
      }

      if ($passed_if) {
        $plot_step_id = $current_step;
        break;
      }
      $current_step++;
    }
  }

  $word = suggestWord($plot_step_id, $categories, $used_words);

  if ($word) {
    $word_id = $wordIndexes[$word];
    $used_words[$word] = true;
    return array($plot_id . '_' . $word_id, $used_words, $word);
  }

  return array($plot_step_id, $used_words, null);
}

function getPlot() {
  return array(
    1 => array(
      PLOT_TEXT => 'Ymmärrän, mitä kirjoitetaan täällä',
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_LOW_SPEAKING => 1)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_HIGH_SPEAKING => -2))
    ),
    2 => array(
      PLOT_TEXT => 'I have higher degree',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_EDUCATION => 1, SKILL_TECHNICAL => 0.2, SKILL_LOW => -0.5, SKILL_INTELLIGENCE => 1)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_EDUCATION => -0.3, SKILL_LOW => 0.2, SKILL_INTELLIGENCE => -0.2)),
    ),
    3 => array(
      PLOT_TEXT => 'Puhun hyvin suomeksi',
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HIGH_SPEAKING => 1)),
      PLOT_IF => array(SKILL_LOW_SPEAKING => array(PLOT_BIGGER, 0))
    ),
    4 => array(
      PLOT_TEXT => 'I know math',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_TECHNICAL => 1, SKILL_LOW => -0.2, SKILL_INTELLIGENCE => 0.3)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_LOW => 0.3, SKILL_INTELLIGENCE => -0.4)),
    ),
    5 => array(
      PLOT_TEXT => 'I know how to use computers',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_COMPUTER => 1, SKILL_LOW => -0.2, SKILL_INTELLIGENCE => 0.3, SKILL_TECHNICAL => 0.1)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_LOW => 0.2, SKILL_INTELLIGENCE => -0.1)),
    ),
    6 => array(
      PLOT_TEXT => 'Animals',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_ANIMALS => 1)),
    ),
    7 => array(
      PLOT_TEXT => 'Software developer',
      PLOT_TRANSLATE => true,
      PLOT_IF => array(SKILL_EDUCATION => array(PLOT_BIGGER, 0), SKILL_TECHNICAL => array(PLOT_BIGGER, 0), SKILL_COMPUTER => array(PLOT_BIGGER, 0),),
      PLOT_YES => array(PLOT_CATEGORY => array(25 => 1))
    ),
    8 => array(
      PLOT_TEXT => 'I like working with hands',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HANDS => 1, SKILL_INTELLIGENCE => -0.3)),
    ),
    9 => array(
      PLOT_TEXT => 'Cars',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_CARS => 1, SKILL_INTELLIGENCE => -0.1)),
    ),
    10 => array(
      PLOT_TEXT => 'Mechanisms',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_MECHANICS => 1, SKILL_INTELLIGENCE => -0.2)),
    ),
    11 => array(
      PLOT_TEXT => 'To trade',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_SALES => 1)),
    ),
    12 => array(
      PLOT_TEXT => 'Help others',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HELP => 1)),
    ),
    13 => array(
      PLOT_TEXT => 'To clean',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_CLEANING => 1.2)),
    ),
    14 => array(
      PLOT_TEXT => 'I know medicine',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HEALTH_CARE => 1, SKILL_LOW => -0.1)),
    ),
    15 => array(
      PLOT_TEXT => 'I have Hygiene Passport',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HEALTH => 1)),
    ),
  );
}

function suggestWord($step, $categories, $used_words) {
  global $category2words;

  if ($step > 0 && $step < 5) return null;

  if ($step != -1 && mt_rand(0, 1) == 1) return null;

  $result = array();

  foreach ($categories as $category_id => $weight) {
    foreach ($category2words[$category_id] as $word) {
      if ($used_words[$word]) continue;
      $result[$word] += $weight;
    }
  }

  arsort($result);

  $positive = array_filter($result, function ($v) {
    return $v >= 0;
  });

  $shuffled = weightedShuffle($positive);

  return $shuffled[5];
}
