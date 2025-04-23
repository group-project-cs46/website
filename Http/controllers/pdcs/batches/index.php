<?php

use Models\Batch;

$batches = Batch::getAll();

view('pdcs/batches/index.view.php', [
    'batches' => $batches
]);