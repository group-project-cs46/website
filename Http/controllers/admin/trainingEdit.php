<?php

use Models\TrainingSession;

try {
    $id = $_GET['id'];
    // if (!$id) {
    //     throw new Exception("Training session ID is required!");
    // }

    $data = TrainingSession::get_by_id($id);
   

    view('admin/trainingSessionEdit.view.php', ['TRAINING_SESSION' => $data]);
} catch (Exception $e) {
    die($e->getMessage());
}