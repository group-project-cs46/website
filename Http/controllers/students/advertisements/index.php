<?php

use Models\Ad;
use Models\Company;

$companies = Company::all();

$company_id = $_GET['company_id'] ?? null;

if ($company_id) {
    $ads = Ad::allWithCompanyByCompanyId($company_id);
} else {
    $ads = Ad::allWIthCompany();
}


view('students/advertisements/index.view.php', [
    'heading' => 'Jobs',
    'ads' => $ads,
    'companies' => $companies,
]);