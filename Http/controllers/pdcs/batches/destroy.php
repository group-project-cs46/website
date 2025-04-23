<?php

use Core\Session;
use Http\Forms\CreateBatch;
use Models\Batch;

$batch_id = $_POST['id'] ?? null;


$ads_for_batch = \Models\Ad::getByBatchId($batch_id);

if ($ads_for_batch) {
    Session::flash('toast', 'Cannot be deleted because there are ads for this internship process');
    redirect('/pdcs/batches');
}



Batch::delete($batch_id);

redirect('/pdcs/batches');