<?php

require_once 'libs/plot.lib.php';
require_once 'libs/weights.lib.php';

testPlot();

function testPlot() {
  list($step, $step_info, $skills, $categories) = startPlot();
  list($step, $step_info, $skills, $categories) = moveByPlot($step, PLOT_NO, $skills, $categories);
  list($step, $step_info, $skills, $categories) = moveByPlot($step, PLOT_YES, $skills, $categories);
  list($step, $step_info, $skills, $categories) = moveByPlot($step, PLOT_YES, $skills, $categories);
  list($step, $step_info, $skills, $categories) = moveByPlot($step, PLOT_YES, $skills, $categories);
  list($step, $step_info, $skills, $categories) = moveByPlot($step, PLOT_YES, $skills, $categories);

  print_r(weightCategories($skills, $categories));
}
