<?php

use Models\Pdc;

$user = auth_user();
$user_id = $user['id'];

$pdcs = Pdc::get_all();

//dd($pdcs);

view('admins/pdcs/index.view.php', [
    'heading' => 'Jobs',
    'pdcs' => $pdcs
]);