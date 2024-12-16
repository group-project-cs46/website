<?php

use Models\Company;

$companies = Company::allWithUser();

view('pdcs/companies/index.view.php', [
    'companies' => $companies
]);