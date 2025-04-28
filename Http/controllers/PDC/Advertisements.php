<?php

use Models\PdcAdvertisements;

$advertisementdata = PdcAdvertisements::fetchAll();

//dd($advertisementdata);

view('PDC/Advertisements.view.php',['advertisements' => $advertisementdata]);