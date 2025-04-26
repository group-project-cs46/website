<?php

use Models\PdcRounds;
use Models\pdcDashboard;



   //Add the dashboard data
   $approvedAds = pdcDashboard::fetchApprovedadds();
   $registeredCompanies = pdcDashboard::countRegisteredcompanies();
   $blacklistedCompanies = pdcDashboard::countBlacklistedcompanies();
   $registeredStudents = pdcDashboard::countRegisteredstudents(); 
   $hiredStudents = pdcDashboard::countHiredstudents();

view('dashboards/pdc.view.php', [
    
     'approvedAds' => $approvedAds,
     'registeredCompanies' => $registeredCompanies,
     'blacklistedCompanies' => $blacklistedCompanies,
     'registeredStudents' => $registeredStudents,
     'hiredStudents' => $hiredStudents
]);
