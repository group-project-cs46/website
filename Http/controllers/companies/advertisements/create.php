<?php

use Core\Session;
use Models\Batch;



$internship_roles = \Models\InternshipRole::getAll();

view('companies/advertisements/create.view.php', [
    'errors' => Session::getFlash('errors') ?? [],
    'internship_roles' => $internship_roles,
]);