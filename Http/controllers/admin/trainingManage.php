<?php

use Models\TrainingSession;

try {
    $data = TrainingSession::get_all();
} catch (Exception $e) {
    die($e->getMessage());
}

view('admin/trainingManage.view.php', ['TRAINING_SESSION'=>$data]);

