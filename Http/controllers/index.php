<?php

use Core\Blade;

//$blade = new Blade(base_path('views'), views_path('cache'));
//
//$blade->component('button', 'components/button');
//
//echo $blade->make('index', ['heading' => 'Home']);

view('index.view.php', [
    'heading' => 'Home'
]);