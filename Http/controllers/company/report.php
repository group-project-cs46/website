<?php
use Models\companyReport;
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

// Get the authenticated user's ID
$user_id = auth_user()['id'] ?? null;
if (!$user_id) {
    redirect('/login?error=Please log in to view reports');
    exit();
}

// Fetch reports for the authenticated user
$reports = companyReport::findBySenderId($user_id);

// Pass the reports to the view
view('company/report.view.php', [
    'reports' => $reports,
    'errors' => $_SESSION['_flash']['errors'] ?? []
]);