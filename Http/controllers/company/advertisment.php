<?php

use Core\Database;
use Core\App;

// Resolve database connection from App container
$db = App::resolve(Database::class);

// Get the authenticated user (assuming this function returns the logged-in user's details)
$auth_user = auth_user();

// Ensure the user is authenticated and has a company_id
if (!$auth_user || !isset($auth_user['id'])) {
    // Redirect to login if not authenticated
    header('Location: /login');
    exit;
}

$company_id = $auth_user['id'];

// Retrieve advertisements for the authenticated company with job role name by joining with internship_roles
$query = "SELECT a.*, ir.name AS job_role 
          FROM advertisements a 
          LEFT JOIN internship_roles ir ON a.internship_role_id = ir.id 
          WHERE a.company_id = :company_id";
$advertisements = $db->query($query, ['company_id' => $company_id])->get();

// Pass data to the view
view('company/advertisment.view.php', ['advertisements' => $advertisements]);