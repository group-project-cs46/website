<?php

use Models\pdc_techtalk;

// Fetch data from the database
$techtalk = pdc_techtalk::fetchAll();

// Pass the data to the view
view('PDC/Schedule.view.php', ['techtalk' => $techtalk]);