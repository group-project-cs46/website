<?php

use Models\Ad;

$ads = Ad::allWIthCompany();

// dd($ads);


view('advertisements/index.view.php', [
    'heading' => 'Jobs',
    'ads' => $ads
]);