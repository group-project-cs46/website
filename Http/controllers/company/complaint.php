<?php

use Core\Database;
use Core\App;
use Models\companyComplaint;

$db = App::resolve(Database::class);

// Get the authenticated user's ID
$userId = auth_user()['id'];

// Fetch complaints for the current user
$complaints = companyComplaint::getUserComplaints($userId);

view('company/complaint.view.php', [
    'complaints' => $complaints
]);