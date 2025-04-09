<?php

use Models\AddPdc;

try {
    $id = $_GET['id'];
    if (!$id) {
        throw new Exception("id is required!");
    }

    $data = AddPdc::get_by_id($id);
    view('admin/pdcEdit.view.php', ['PDC' => $data]);
} catch (Exception $e) {
    die($e->getMessage());
}
