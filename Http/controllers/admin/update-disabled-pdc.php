<?php

use Models\Pdc;

$id = $_POST['id'];
$status = $_POST['status'];

try {
    Pdc::update_disabled($id, $status);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/pdcManage');
