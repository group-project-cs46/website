<?php

use Models\Ad;

$advertisement_id = $_GET['id'] ?? null;
$advertisement = Ad::getById($advertisement_id);



$auth_user = auth_user();


view('/companies/advertisements/show.view.php', [
    'advertisement' => $advertisement,
]);