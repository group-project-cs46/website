<?php

use Models\Ad;
use Models\Company;
use Models\TechTalk;

$month_num = $_GET['month'] ?? null;

if (!$month_num) {
    $month_num = date('n');
}

$year = $_GET['year'] ?? null;
if (!$year) {
    $year = date('Y');
}

$dateObj = DateTime::createFromFormat('!m', $month_num);
$month_text = $dateObj->format('F');

$first_day = getFirstDayOfMonth($year, $month_num);

$today = null;

if ($month_num == date('n') && $year == date('Y')) {
    $today = date('j');
}


$techtalks = TechTalk::findForMonthAndYear($month_num, (int)$year);

//dd($techtalks[0]);

//dd($techtalks);



$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month_num, $year);
//dd($first_day);
view('students/events/index.view.php', [
    'heading' => 'Techtalks',
    'month_text' => $month_text,
    'year' => $year,
    'first_day' => $first_day,
    'days_in_month' => $days_in_month,
    'today' => $today,
    'techtalks' => $techtalks,
    'month_num' => (int)$month_num,
]);