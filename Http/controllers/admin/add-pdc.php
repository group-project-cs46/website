<?php

use Models\Pdc;

$name = $_POST['name'];
$email = $_POST['email'];
$employee_id = $_POST['lecturerId'];
$title = $_POST['position'];
$contact = $_POST['contact'];

try {
    Pdc::create($employee_id,$title,$name,$contact,$email);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/pdcManage');
