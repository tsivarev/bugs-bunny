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
  return moveByPlot(0, '', array(SKILL_HEALTH => -0.3, SKILL_LOW => 1, SKILL_CLEANING => -0.2), array());
}

function moveByPlot($step, $answer, $skills, $categories) {
  $plot = getPlot();

  $step_info = $plot[$step];
  if (!$step_info && !$step) {
    return array(
      1,
      $plot[1],
      $skills,
      $categories
    );
  }

  if ($step_info) {
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

    $next_step = findNextStep($step, $skills);

    if ($next_step > 0) {
      return array(
        $next_step,
        $plot[$next_step],
        $skills,
        $categories
      );
    }
  }

  return array(
    -1,
    null,
    $skills,
    $categories
  );
}

function findNextStep($step, $skills) {
  $plot = getPlot();

  $current_step = $step + 1;
  while (isset($plot[$current_step])) {
    $step_info = $plot[$current_step];
    if (!$step_info[PLOT_IF]) return $current_step;

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

    if ($passed_if) return $current_step;
    $current_step++;
  }

  return -1;
}

function getPlot() {
  return array(
    1 => array(
      PLOT_TEXT => 'Ymmärrän, mitä kirjoitetaan täällä',
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_LOW_SPEAKING => 1)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_HIGH_SPEAKING => -2))
    ),
    2 => array(
      PLOT_TEXT => 'Puhun hyvin suomeksi',
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HIGH_SPEAKING => 1)),
      PLOT_IF => array(SKILL_LOW_SPEAKING => array(PLOT_BIGGER, 0))
    ),
    3 => array(
      PLOT_TEXT => 'I have higher degree',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_EDUCATION => 1, SKILL_TECHNICAL => 0.2, SKILL_LOW => -0.5, SKILL_INTELLIGENCE => 1)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_EDUCATION => -0.3, SKILL_LOW => 0.2, SKILL_INTELLIGENCE => -0.2)),
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
      PLOT_TEXT => 'Software developer',
      PLOT_TRANSLATE => true,
      PLOT_IF => array(SKILL_EDUCATION => array(PLOT_BIGGER, 0), SKILL_TECHNICAL => array(PLOT_BIGGER, 0), SKILL_COMPUTER => array(PLOT_BIGGER, 0),),
      PLOT_YES => array(PLOT_CATEGORY => array(25 => 1))
    ),
    7 => array(
      PLOT_TEXT => 'I like working with hands',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HANDS => 1, SKILL_INTELLIGENCE => -0.3)),
    ),
    8 => array(
      PLOT_TEXT => 'Cars',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_CARS => 1, SKILL_INTELLIGENCE => -0.1)),
    ),
    9 => array(
      PLOT_TEXT => 'Mechanisms',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_MECHANICS => 1, SKILL_INTELLIGENCE => -0.2)),
    ),
    10 => array(
      PLOT_TEXT => 'Trade',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_SALES => 1)),
    ),
    11 => array(
      PLOT_TEXT => 'Help others',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HELP => 1)),
    ),
    12 => array(
      PLOT_TEXT => 'I know medicine',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HEALTH_CARE => 1, SKILL_LOW => -0.1)),
    ),
    13 => array(
      PLOT_TEXT => 'I have Hygiene Passport',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HEALTH => 1)),
    ),
    14 => array(
      PLOT_TEXT => 'Animals',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_ANIMALS => 1)),
    ),
  );
}


