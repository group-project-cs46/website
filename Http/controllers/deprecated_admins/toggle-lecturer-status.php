<?php

use Models\AddLecturer;

$id = $_POST['id'] ?? null;

if ($id) {
    AddLecturer::toggle_status($id);
}

header('Location: /lecturerManage');
exit;
