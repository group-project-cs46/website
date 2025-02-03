<?php

use Models\Ad;
use Models\Company;
use Models\TechTalk;

$month_num = date('n');
$month_text = date('F');
$year = date('Y');
$first_day = getFirstDayOfMonth($year, $month_num);
$today = date('j');


$techtalks = TechTalk::findForCurrentMonth();

//dd($techtalks);

$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month_num, $year);
//dd($first_day);
view('students/techtalks/index.view.php', [
    'heading' => 'Techtalks',
    'month_text' => $month_text,
    'year' => $year,
    'first_day' => $first_day,
    'days_in_month' => $days_in_month,
    'today' => $today,
    'techtalks' => $techtalks
]);