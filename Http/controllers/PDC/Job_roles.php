<?php

use Models\pdcRoles;


$job_roles = pdcRoles::fetchAll();

//dd($job_roles);
view('PDC/Job_roles.view.php', ['job_roles' => $job_roles]);