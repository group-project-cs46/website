<?php

use Models\PdcRounds;
use Models\pdcDashboard;

$rounds = PdcRounds::getAllRounds();

   //Add the dashboard data
   $approvedAds = pdcDashboard::fetchApprovedadds();
   $registeredCompanies = pdcDashboard::countRegisteredcompanies();
   $blacklistedCompanies = pdcDashboard::countBlacklistedcompanies();
   $registeredStudents = pdcDashboard::countRegisteredstudents(); 
   $hiredStudents = pdcDashboard::countHiredstudents();

view('dashboards/pdc.view.php', [
    'rounds' => $rounds,
     'approvedAds' => $approvedAds,
     'registeredCompanies' => $registeredCompanies,
     'blacklistedCompanies' => $blacklistedCompanies,
     'registeredStudents' => $registeredStudents,
     'hiredStudents' => $hiredStudents
]);
