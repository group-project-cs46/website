<?php

use Models\Ad;
use Models\Application;
use Models\Company;
use Models\TechTalk;

$month_num = $_GET['month'] ?? null;

if (!$month_num) {
    $month_num = date('n');
}
$month_num = (int)$month_num;

$year = $_GET['year'] ?? null;
if (!$year) {
    $year = date('Y');
}
$year = (int)$year;

$dateObj = DateTime::createFromFormat('!m', $month_num);
$month_text = $dateObj->format('F');

$first_day = getFirstDayOfMonth($year, $month_num);

$today = null;

if ($month_num == date('n') && $year == date('Y')) {
    $today = date('j');
}

$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month_num, $year);



$techtalks = TechTalk::findForMonthAndYear($month_num, $year);
$interviews = Application::thatHasInterviewForMonthAndYearByStudentId($month_num, $year, auth_user()['id']);
$events = [];

// Process TechTalks
foreach ($techtalks as $techtalk) {
    $datetime = new DateTime($techtalk['datetime']);
    $events[] = [
        'type' => 'techtalk',
        'id' => $techtalk['id'],
        'title' => 'TechTalk: ' . ($techtalk['description'] ?: 'by ' . $techtalk['company_name']),
        'date' => $datetime->format('Y-m-d'),
        'start_time' => $datetime->format('H:i:s'),
        'end_time' => null,
        'description' => $techtalk['description'],
        'company_name' => $techtalk['company_name'],
        'host_name' => $techtalk['host_name'],
        'host_email' => $techtalk['host_email'],
        'datetime' => $techtalk['datetime'],
        'venue' => $techtalk['venue'],
    ];
}

// Process Interviews
foreach ($interviews as $interview) {
    $events[] = [
        'type' => 'interview',
        'id' => $interview['id'],
        'title' => 'Interview for Ad #' . $interview['ad_id'],
        'date' => $interview['date'],
        'start_time' => $interview['start_time'],
        'end_time' => $interview['end_time'],
        'description' => 'Interview scheduled with  ' . $interview['company_name'],
        'company_name' => $interview['company_name'],
        'host_name' => null,
        'company_email' => $interview['company_email'],
        'datetime' => $interview['date'] . ' ' . $interview['start_time'],
        'venue' => $interview['venue'],
        'internship_role' => $interview['internship_role'],
    ];
}

// Group events by day
$eventsByDay = [];
foreach ($events as $event) {
    $day = (int)date('j', strtotime($event['date']));
    if (!isset($eventsByDay[$day])) {
        $eventsByDay[$day] = [];
    }
    $eventsByDay[$day][] = $event;
}

//dd($eventsByDay);


//dd($first_day);
view('students/events/index.view.php', [
    'heading' => 'Techtalks',
    'month_text' => $month_text,
    'year' => $year,
    'first_day' => $first_day,
    'days_in_month' => $days_in_month,
    'today' => $today,
    'month_num' => (int)$month_num,
    'eventsByDay' => $eventsByDay,
]);