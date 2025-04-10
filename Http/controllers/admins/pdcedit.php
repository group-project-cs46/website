<?php

use Models\Pdc;

try {
    $id = $_GET['id'];
    if(!$id){
        throw new Exception("id is required!");
    }

    $data = Pdc::get_by_id($id);
    view('admins/pdcEdit.view.php', ['PDC'=>$data]);
} catch (Exception $e) {
    die($e->getMessage());
}


