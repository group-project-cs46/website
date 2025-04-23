<?php

use Models\Company;
use Models\pdc_techtalk;

$companies = Company::fetchapprovedcompanies();

$techtalk = pdc_techtalk::fetchAll();

// Pass the data to the view
view('PDC/Schedule.view.php', ['techtalk' => $techtalk, 'companies' => $companies]);