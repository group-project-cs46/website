<?php

use Models\AddEventStudent;

try {
    $id = $_GET['id'];
    if (!$id) {
        throw new Exception("id is required!");
    }

    $data = AddEventStudent::get_by_id($id);
    view('admin/eventStudentsEdit.view.php', ['student' => $data]);
} catch (Exception $e) {
    die($e->getMessage());
}