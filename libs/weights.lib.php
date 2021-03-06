<?php

function weightCategories($skills, $categories) {
  global $category2skill;

  static $cache;
  if ($cache) return $cache;

  $result = array();
  foreach ($category2skill as $category_id => $needed_skills) {
    $result[$category_id] = 0;
    if (isset($categories[$category_id])) {
      $result[$category_id] += $categories[$category_id];
    }
    foreach ($needed_skills as $skill) {
      if (isset($skills[$skill])) {
        $result[$category_id] += $skills[$skill];
      }
    }
  }

  arsort($result);

  $cache = $result;
  return $result;
}
