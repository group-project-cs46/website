<?php

use Models\Company;

$companies = Company::allWithUser();
$approvedCompanies = Company::fetchapprovedcompanies();

view('pdcs/companies/index.view.php', [
    'companies' => $companies, 'approvedcompanies' => $approvedCompanies
]);