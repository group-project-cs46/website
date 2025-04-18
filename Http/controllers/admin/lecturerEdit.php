<?php

use Models\AddLecturer;

try {
    $id = $_GET['id'];
    if (!$id) {
        throw new Exception("id is required!");
    }

    $data = AddLecturer::get_by_id($id);
    view('admin/lecturerEdit.view.php', ['LECTURER' => $data]);
} catch (Exception $e) {
    die($e->getMessage());
}




