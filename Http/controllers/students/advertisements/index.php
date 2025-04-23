<?php

use Models\Ad;
use Models\Company;
use Models\Round;

//$currentRound = Round::currentRound();

if ($currentRound && $currentRound['restricted']) {
    redirect('/students/advertisements/second_round');
}

//dd($currentRound);


$companies = Company::byRoundId($currentRound['id']);

//    dd($companies);


$company_id = $_GET['company_id'] ?? null;


if ($company_id) {
    $ads = Ad::byRoundIdAndComapnyId($currentRound['id'], $company_id);
} else {
    $ads = Ad::byRoundId($currentRound['id']);
}



view('students/advertisements/index.view.php', [
    'heading' => 'Jobs',
    'ads' => $ads,
    'companies' => $companies,
    'currentRound' => $currentRound
]);