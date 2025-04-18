<?php

use Models\PdcRounds;

$rounds = PdcRounds::getAllRounds();

view('dashboards/pdc.view.php',['rounds' => $rounds]);
