<?php

use Models\TrainingSession;

try {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        throw new Exception("Training session ID is required!");
    }

    $data = TrainingSession::get_by_id($id);
    if (!$data) {
        throw new Exception("Training session not found!");
    }

    view('admin/trainingSessionView.view.php', ['TRAINING_SESSION' => $data]);
} catch (Exception $e) {
    die($e->getMessage());
}