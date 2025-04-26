<?php

use Core\Session;
use Models\Batch;

$batch_id = $_GET['id'] ?? null;

$batch = Batch::getById($batch_id);

view('pdcs/batches/edit.view.php', [
    'batch' => $batch,
    'errors' => Session::getFlash('errors') ?? [],
]);