<?php

use Models\Company;

use Core\App;
use Core\Mail;

$company_id = $_POST['id'];

// approve only if requesting user is pdc. 3 means pdc
if (auth_user()['role'] == 3) {
    Company::reject($company_id);

    $company = Company::getById($company_id); 
    if ($company) {
        $email = $company->email;
        
        // Send approval email to the company
        $mailer = App::resolve(Mail::class);
        $subject = 'Your Company Has Been Rejected';
        $message = 'Appologize! Your company has been rejected by the PDC. Please contact the PDC (info@ucsc.cmb.ac.lk) for more information.';
        $mailer->send($email, $subject, $message);
    } else {
        throw new Exception('Company not found.');
    }
}

redirect('/pdcs/companies');