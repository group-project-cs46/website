<?php

use Models\AddLecturer;

try {
    $data = AddLecturer::get_all();
} catch (Exception $e) {
    die($e->getMessage());
}

view('admin/lecturerManage.view.php', ['LECTURER_data'=>$data]);