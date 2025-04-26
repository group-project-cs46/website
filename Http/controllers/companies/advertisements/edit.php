<?php

use Core\Session;
use Models\Ad;

$advertisement_id = $_GET['id'] ?? null;

$advertisement = Ad::getById($advertisement_id);
$internship_roles = \Models\InternshipRole::getAll();


view('companies/advertisements/edit.view.php', [
    'errors' => Session::getFlash('errors') ?? [],
    'advertisement' => $advertisement,
    'internship_roles' => $internship_roles,
]);