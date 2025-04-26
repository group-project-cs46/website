<?php

use Models\pdcBlacklistedcompanies;


$blacklistedcompanies = pdcBlacklistedcompanies::fetchAll();
view('PDC/BlacklistedCompanies.view.php', ['blacklistedcompanies' => $blacklistedcompanies]);