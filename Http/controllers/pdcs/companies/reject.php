<?php

use Models\Company;

$company_id = $_POST['id'];

// approve only if requesting user is pdc. 3 means pdc
if (auth_user()['role'] == 3) {
    Company::reject($company_id);
}

redirect('/pdcs/companies');