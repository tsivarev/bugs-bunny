<?php

function weightCategories($skills, $categories) {
  global $category2skill;

  static $cache;
  if ($cache) return $cache;

  $result = array();
  foreach ($category2skill as $category_id => $needed_skills) {
    $result[$category_id] = 0;
    if ($categories[$category_id]) {
      $result[$category_id] += $categories[$category_id];
    }
    foreach ($needed_skills as $skill) {
      $value = $skills[$skill];
      if ($value) {
        $result[$category_id] += $value;
      }
    }
  }

  arsort($result);

  $cache = $result;
  return $result;
}
