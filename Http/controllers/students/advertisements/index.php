<?php

use Models\Ad;
use Models\Company;
use Models\Round;

$currentRound = Round::currentRound();

//dd($currentRound);

if ($currentRound && !$currentRound['restricted']) {
    $companies = Company::byRoundId($currentRound['id']);


    $company_id = $_GET['company_id'] ?? null;


    if ($company_id) {
        $ads = Ad::byRoundIdAndComapnyId($currentRound['id'], $company_id);
    } else {
        $ads = Ad::byRoundId($currentRound['id']);
    }

} else if ($currentRound && $currentRound['restricted']) {
    $companies = null;
    $ads = null;

} else {
    $companies = null;
    $ads = null;
}


view('students/advertisements/index.view.php', [
    'heading' => 'Jobs',
    'ads' => $ads,
    'companies' => $companies,
    'currentRound' => $currentRound
]);