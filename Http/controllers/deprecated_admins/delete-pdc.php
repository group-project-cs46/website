<?php

use Models\AddPdc;

$id = $_POST['id'];

try {
    AddPdc::delete($id);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/pdcManage');


