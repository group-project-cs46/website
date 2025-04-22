<?php

use Models\Application;
use Models\Complaint;
use Models\Report;
use Models\User;

$auth_user = auth_user();

$accusable_entities = [];

$selected_company = Application::selectedCompanyByStudentId($auth_user['id']);

if ($selected_company) {
    $accusable_entities[] = $selected_company;
}

$admin = User::find(1);
$accusable_entities[] = $admin;


$complaints = Complaint::findAllByStudentId($auth_user['id']);

//dd($complaints);


view('students/complaints/index.view.php', [
    'errors' => $_SESSION['_flash']['errors'] ?? [],
    'accusable_entities' => $accusable_entities,
    'complaints' => $complaints,
]);