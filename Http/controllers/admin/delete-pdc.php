<?php

use Models\Pdc;

$id = $_POST['id'];

try {
    Pdc::delete($id);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/pdcManage');
