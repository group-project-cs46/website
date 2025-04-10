<?php

use Models\Pdc;

try {
    $data = Pdc::get_all();
} catch (Exception $e) {
    die($e->getMessage());
}

view('admins/pdcManage.view.php', ['PDC_data' => $data]);