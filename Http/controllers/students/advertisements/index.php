<?php

use Models\Ad;
use Models\Company;
use Models\Round;

$currentRound = Round::currentRound();

if ($currentRound) {
    $companies = Company::byRoundId($currentRound['id']);


    $company_id = $_GET['company_id'] ?? null;


    if ($company_id) {
        $ads = Ad::byRoundIdAndComapnyId($currentRound['id'], $company_id);
    } else {
        $ads = Ad::byRoundId($currentRound['id']);
    }

} else {
    $companies = [];
    $ads = [];
}


view('students/advertisements/index.view.php', [
    'heading' => 'Jobs',
    'ads' => $ads,
    'companies' => $companies,
    'currentRound' => $currentRound
]);