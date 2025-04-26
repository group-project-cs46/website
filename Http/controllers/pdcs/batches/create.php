<?php

use Core\Session;
use Models\Batch;

//$batches = Batch::getAll();

view('pdcs/batches/create.view.php', [
    'errors' => Session::getFlash('errors') ?? [],
]);