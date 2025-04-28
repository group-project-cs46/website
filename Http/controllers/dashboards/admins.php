<?php

use Models\AddPdc; // <-- Add this line

$pdcCount = AddPdc::get_total_count(); // <-- Add this line
dd($pdcCount);
view('dashboards/admin.view.php', [
    'PDC_COUNT' => $pdcCount // <-- Add this line
]);
