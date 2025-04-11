<?php

use Models\companyTechtalk;

// Fetch data from the database
$techtalk = companyTechtalk::fetchAll();

// Pass the data to the view
print_r($techtalk);
view('company/schedule.view.php', ['techtalk' => $techtalk]);