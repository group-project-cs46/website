<?php

use Models\Ad;
use Models\Company;
use Models\Round;

$currentBatch = \Models\Batch::currentBatch();


if ($currentBatch && $currentBatch['current_round'] == 'second') {
    redirect('/students/advertisements/second_round');
}



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