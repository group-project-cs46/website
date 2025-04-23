<?php

use Core\App;
use Models\AddStudent;

try {
    if (!isset($_FILES['csvFile']) || $_FILES['csvFile']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('No valid CSV file uploaded.');
    }

    $file = $_FILES['csvFile']['tmp_name'];
    $fileType = $_FILES['csvFile']['type'];
    $fileSize = $_FILES['csvFile']['size'];

    if (!in_array($fileType, ['text/csv', 'application/csv', 'text/plain']) || $fileSize > 2 * 1024 * 1024) {
        throw new Exception('Invalid file type or size. Please upload a CSV file (max 2MB).');
    }

    $csvData = array_map('str_getcsv', file($file));
    if (empty($csvData)) {
        throw new Exception('Empty CSV file.');
    }

    $header = array_shift($csvData);
    $expectedHeader = ['name', 'registration_number', 'course', 'email', 'index_number'];

    if (array_map('strtolower', $header) !== $expectedHeader) {
        throw new Exception('Invalid CSV header. Expected: ' . implode(',', $expectedHeader));
    }

    $students = [];
    $errors = [];
    $line = 2;

    foreach ($csvData as $row) {
        if (count($row) < 5) {
            $errors[] = "Line $line: Insufficient columns.";
            $line++;
            continue;
        }

        $name = trim($row[0]);
        $registration_number = trim($row[1]);
        $course = trim($row[2]);
        $email = trim($row[3]);
        $index_number = trim($row[4]);

        if (empty($name) || empty($registration_number) || empty($course) || empty($email) || empty($index_number)) {
            $errors[] = "Line $line: Missing required fields.";
            $line++;
            continue;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Line $line: Invalid email format.";
            $line++;
            continue;
        }

        if (!in_array(strtolower($course), ['computer science', 'information systems'])) {
            $errors[] = "Line $line: Invalid course.";
            $line++;
            continue;
        }

        try {
            $password = password_hash($index_number, PASSWORD_DEFAULT);
            $student = AddStudent::create_student($registration_number, $course, $email, $name, $index_number, $password);
            $students[] = $student;
        } catch (Exception $e) {
            $errors[] = "Line $line: " . $e->getMessage();
        }

        $line++;
    }

    if (empty($errors)) {
        echo json_encode([
            'success' => true,
            'message' => count($students) . ' students added successfully.',
            'students' => $students
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Some records could not be processed.',
            'errors' => $errors
        ]);
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

exit;
