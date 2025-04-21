<?php

use Models\AddLecturer;

$id = $_POST['id'];

try {
    AddLecturer::delete($id);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/lecturerManage');


