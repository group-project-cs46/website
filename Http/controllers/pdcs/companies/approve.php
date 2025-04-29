<?php

use Models\Company;
use Core\App;
use Core\Mail;

$company_id = $_POST['id'];

if (auth_user()['role'] == 3) {
    Company::approve($company_id);

    
    $company = Company::getById($company_id); 
    if ($company) {
        $email = $company->email;
        
        // Send approval email to the company
        $mailer = App::resolve(Mail::class);
        $subject = 'Your Company Has Been Approved';
        $message = 'Congratulations! Your company has been successfully approved by the PDC. You can now Login to the system.';
        $mailer->send($email, $subject, $message);
    } else {
        throw new Exception('Company not found.');
    }
}

redirect('/pdcs/companies');

