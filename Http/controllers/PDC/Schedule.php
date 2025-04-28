<?php

use Models\Company;
use Models\pdc_techtalk;
use Models\pdcCompanyvisit;

$companies = Company::fetchapprovedcompanies();
$lecturers = pdcCompanyvisit::fetchAlllecturers();
$techtalk = pdc_techtalk::fetchAll();

$visits = pdcCompanyvisit::fetchAll();

// Pass the data to the view
view('PDC/Schedule.view.php', ['techtalk' => $techtalk, 'companies' => $companies, 'visits' => $visits

, 'lecturers' => $lecturers]);   