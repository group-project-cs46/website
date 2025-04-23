<?php
use Core\App;
use Core\Database;
use Models\companyStudent;

header('Content-Type: application/json');

try {
    $students = companyStudent::fetchAllStudents();
    echo json_encode(['success' => true, 'students' => $students]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}