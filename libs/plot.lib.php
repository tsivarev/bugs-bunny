<?php

require_once 'config_skills.php';

define('PLOT_TEXT', 'text');
define('PLOT_YES', 'yes');
define('PLOT_NO', 'no');
define('PLOT_COURSES', 'courses');
define('PLOT_LINK', 'link');
define('PLOT_NAME', 'name');
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
    array(SKILL_HEALTH => -0.3, SKILL_LOW => 1, SKILL_CLEANING => -0.2, SKILL_HEALTH_CARE => -0.1),
    array(),
    array(),
    array()
  );
}

function acceptDecision($step, $answer, $skills, $categories, $courses) {
  global $words, $word2categories;

  $plot = getPlot();

  list($is_plot, $plot_id, $word_id) = parseStep($step);

  if ($is_plot) {
    $step_info = $plot[$plot_id];

    $answer_info = $step_info[$answer];
    if ($answer_info) {
      if ($answer_info[PLOT_SKILLS]) {
        foreach ($answer_info[PLOT_SKILLS] as $skill => $change) {
          if (!isset($skills[$skill])) {
            $skills[$skill] = $change;
          } else {
            $skills[$skill] += $change;
          }
        }
      }
      if (isset($answer_info[PLOT_CATEGORY])) {
        foreach ($answer_info[PLOT_CATEGORY] as $category => $change) {
          if (!isset($categories[$change])) {
            $categories[$category] = $change;
          } else {
            $categories[$category] += $change;
          }
        }
      }
      if ($answer == PLOT_NO) {
        if (isset($answer_info[PLOT_COURSES])) {
          log_msg('ADD COURSE');
          $dont_add = false;
          foreach ($courses as $cours) {
            if ($cours[PLOT_NAME] === $answer_info[PLOT_COURSES][PLOT_NAME]) {
              $dont_add = true;
            }
          }
          if (!$dont_add) {
            $courses[] = $answer_info[PLOT_COURSES];
          }
        }
      }
    }
  } else {
    if ($answer == PLOT_YES) {
      $word = $words[$word_id];

      $wordCats = $word2categories[$word];
      $selected_cats = array();
      foreach ($wordCats as $cat_id => $weight) {
        $selected_cat = findExistingCategoryId($cat_id);
        if ($selected_cat && !isset($selected_cats[$selected_cat])) {
          $selected_cats[$selected_cat] = true;
          if (!isset($categories[$selected_cat])) {
            $categories[$selected_cat] = $weight;
          } else {
            $categories[$selected_cat] += $weight;
          }
        }
      }
    }
  }

  log_msg('new skills: ' . print_r($skills, true));
  log_msg('new cats: ' . print_r($categories, true));

  return array(
    $skills,
    $categories,
    $courses
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
      if (!isset($step_info[PLOT_IF])) {
        $plot_step_id = $current_step;
        break;
      }

      log_msg('IF_PLOT: ' . print_r($skills, true));

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

  $weighted_categories = weightCategories($skills, $categories);

  $word = suggestWord($plot_step_id, $weighted_categories, $used_words);

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
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_LOW_SPEAKING => 0.3)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_HIGH_SPEAKING => -2)),
      PLOT_COURSES => array(PLOT_LINK => 'https://www.hel.fi/sto/fi/opiskelu/maahanmuuttajat-immigrants/suomi-toisena-kielena-en', PLOT_NAME => 'Finnish language courses', 'emoji' => '🇫🇮')
    ),
    2 => array(
      PLOT_TEXT => 'Higher degree',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_EDUCATION => 1, SKILL_TECHNICAL => 0.2, SKILL_LOW => -0.5, SKILL_INTELLIGENCE => 1)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_EDUCATION => -0.3, SKILL_LOW => 0.2, SKILL_INTELLIGENCE => -0.2)),
    ),
    3 => array(
      PLOT_TEXT => 'Puhun hyvin suomeksi',
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HIGH_SPEAKING => 0.2)),
      PLOT_IF => array(SKILL_LOW_SPEAKING => array(PLOT_BIGGER, 0)),
      PLOT_COURSES => array(PLOT_LINK => 'https://www.hel.fi/sto/fi/opiskelu/maahanmuuttajat-immigrants/suomi-toisena-kielena-en', PLOT_NAME => 'Finnish language courses')
    ),
    4 => array(
      PLOT_TEXT => 'Math',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_TECHNICAL => 1, SKILL_LOW => -0.2, SKILL_INTELLIGENCE => 0.3)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_LOW => 0.3, SKILL_INTELLIGENCE => -0.4)),
      PLOT_COURSES => array(PLOT_LINK => 'http://www.eira.fi/fi/tule-opiskelemaan/enrol-to-high-school/', PLOT_NAME => 'Enrol High School', 'emoji' => '👨‍🎓')
    ),
    5 => array(
      PLOT_TEXT => 'Computers',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_COMPUTER => 1, SKILL_LOW => -0.2, SKILL_INTELLIGENCE => 0.3, SKILL_TECHNICAL => 0.1)),
      PLOT_NO => array(PLOT_SKILLS => array(SKILL_LOW => 0.2, SKILL_INTELLIGENCE => -0.1)),
      PLOT_COURSES => array(PLOT_LINK => 'http://sto.digipap.eu/opinto-ohjelma/index.html#278', PLOT_NAME => 'ICT Courses', 'emoji' => '💻')
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
      PLOT_TEXT => 'Ok with labour work',
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
      PLOT_TEXT => 'Assisting people',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HELP => 1)),
    ),
    13 => array(
      PLOT_TEXT => 'To clean',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_CLEANING => 1.2)),
    ),
    14 => array(
      PLOT_TEXT => 'Medicine',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HEALTH_CARE => 1, SKILL_LOW => -0.1)),
    ),
    15 => array(
      PLOT_TEXT => 'Hygiene Passport holder',
      PLOT_TRANSLATE => true,
      PLOT_YES => array(PLOT_SKILLS => array(SKILL_HEALTH => 1)),
    ),
  );
}

function suggestWord($step, $categories, $used_words) {
  global $category2words, $words;

  if ($step > 0 && $step < 5) {
    log_msg('skip words bcz of step');
    return null;
  }

  mt_srand();
  srand();

  if ($step != -1 && mt_rand(0, 1) == 1) {
    log_msg('skip words bcz of random');
    return null;
  }

  $result = array();

  foreach ($words as $word) {
    if (isset($used_words[$word])) continue;
    $result[$word] = 0.1;
  }

  foreach ($categories as $category_id => $weight) {
    $short_category_id = findExistingCategoryId($category_id);

    if (isset($category2words[$short_category_id])) {
      if (!is_array($category2words[$short_category_id])) {
        log_error($short_category_id);
      }

      foreach ($category2words[$short_category_id] as $word) {
        if (isset($used_words[$word])) {
          continue;
        }
        $result[$word] += $weight;
      }
    } else if (isset($category2words[$category_id])) {
      if (!is_array($category2words[$category_id])) {
        log_error($category_id);
      }

      foreach ($category2words[$category_id] as $word) {
        if (isset($used_words[$word])) {
          continue;
        }
        $result[$word] += $weight;
      }
    } else {
      log_error($category_id);
    }
  }

  arsort($result);

  $positive = array_filter($result, function ($v) {
    return $v >= 0;
  });

  $shuffled = weightedShuffle($positive, 0.3);

  log_msg('count words ' . count($positive) . ' and count shuffled ' . count($shuffled));

  $index = mt_rand(0, 10);
  $keys = array_keys($shuffled);
  return $keys[$index];
}

function findExistingCategoryId($category_id) {
  global $category2skill;

  $selected_cat = $category_id;
  while ($selected_cat && !isset($category2skill[$selected_cat])) {
    $selected_cat = (int)substr($selected_cat, 0, strlen($selected_cat) - 1);
  }

  return $selected_cat;
}
