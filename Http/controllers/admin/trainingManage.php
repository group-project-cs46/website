<?php

use Models\TrainingSession;

try {
    $data = TrainingSession::get_all();
} catch (Exception $e) {
    die($e->getMessage());
}

//dd($data);

view('admin/trainingManage.view.php', ['TRAINING_SESSION'=>$data]);

