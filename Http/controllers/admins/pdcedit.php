<?php

use Models\AddPdc;

try {
    $id = $_GET['id'];
    if (!$id) {
        throw new Exception("id is required!");
    }

<<<<<<< HEAD:Http/controllers/admin/pdcedit.php
    $data = AddPdc::get_by_id($id);
    view('admin/pdcEdit.view.php', ['PDC' => $data]);
=======
    $data = Pdc::get_by_id($id);
    view('admins/pdcEdit.view.php', ['PDC'=>$data]);
>>>>>>> 1c509f9 (admins can create pdcs):Http/controllers/admins/pdcedit.php
} catch (Exception $e) {
    die($e->getMessage());
}
