<?php

use Models\CompanyTechtalk;
use Models\CompanyLecturerVisit;

// Fetch data from the database
$techtalk = CompanyTechtalk::fetchAll();
$companyLecturerVisit = CompanyLecturerVisit::fetchAll();

view('company/schedule.view.php', ['techtalk' => $techtalk]);