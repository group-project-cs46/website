<?php

use Models\lecturer;

try {
    $data = lecturer::get_all();
} catch (Exception $e) {
    die($e->getMessage());
}

view('admin/lecturerManage.view.php', ['LECTURER_data'=>$data]);