<?php

use Models\companyTechtalk;

// Fetch data from the database
$techtalk = companyTechtalk::fetchAll();


view('company/schedule.view.php', ['techtalk' => $techtalk]);