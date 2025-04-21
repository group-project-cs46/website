<?php

use Models\AddEventStudent;

$id = $_POST['id'];

try {
    AddEventStudent::delete($id);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/eventStudentsManage');


