<?php

use Models\AddPdc;

try {
    $data = AddPdc::get_all();
} catch (Exception $e) {
    die($e->getMessage());
}

view('admin/pdcManage.view.php', ['PDC_data' => $data]);