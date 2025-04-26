<?php

use Models\Ad;

$auth_user = auth_user();

$advertisements = Ad::getByCompanyId($auth_user['id']);

view('/companies/advertisements/index.view.php', [
    'advertisements' => $advertisements,
]);