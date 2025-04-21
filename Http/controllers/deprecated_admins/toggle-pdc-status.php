<?php

use Models\AddPdc;

$id = $_POST['id'] ?? null;

if ($id) {
    AddPdc::toggle_status($id);
}

header('Location: /pdcManage');
exit;
