<?php

use Models\Ad;
use Models\Company;


$currentBatch = \Models\Batch::currentBatch();


$companies = Company::byBatchId($currentBatch['id']);


$company_id = $_GET['company_id'] ?? null;


if ($company_id) {
    $ads = Ad::byBatchIdAndComapnyId($currentBatch['id'], $company_id);
} else {
    $ads = Ad::byBatchId($currentBatch['id']);
}



view('students/advertisements/index.view.php', [
    'heading' => 'Jobs',
    'ads' => $ads,
    'companies' => $companies,
    'currentRound' => $currentBatch
]);