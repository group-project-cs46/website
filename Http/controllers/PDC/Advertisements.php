<?php

use Models\PdcAdvertisements;

$advertisementdata = PdcAdvertisements::fetchAll(); 

view('PDC/Advertisements.view.php',['advertisements' => $advertisementdata]);