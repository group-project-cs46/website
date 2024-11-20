<?php

namespace Core;

use Core\Database;
use Core\App;

// Resolve database connection from App container
$db = App::resolve(Database::class);

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Create Advertisement
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $jobType = $_POST['job_type'];
        $jobRole = $_POST['job_role'];
        $responsibilities = $_POST['responsibilities'];
        $qualifications = $_POST['qualification_skills'];
        $maxCVs = $_POST['maxCVs'];
        $companyLink = $_POST['company_link'];

        $query = "INSERT INTO advertisements (job_type, job_role, responsibilities, qualification_skills, maxCVs, company_link, vacancy_count) 
                  VALUES (:job_type, :job_role, :responsibilities, :qualification_skills, :maxCVs, :company_link, 1)";
        $params = [
            'job_type' => $jobType,
            'job_role' => $jobRole,
            'responsibilities' => $responsibilities,
            'qualification_skills' => $qualifications,
            'maxCVs' => $maxCVs,
            'company_link' => $companyLink,
        ];
        $db->query($query, $params);

        echo json_encode(['success' => true]);
        exit;
    }
}

// Retrieve advertisement details by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM advertisements WHERE id = :id";
    $params = ['id' => $id];
    $advertisement = $db->query($query, $params)->first();

    if ($advertisement) {
        echo json_encode(['success' => true, 'advertisement' => $advertisement]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

// Handle DELETE action
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['action']) && $input['action'] === 'delete') {
        $id = $input['id'];

        $query = "DELETE FROM advertisements WHERE id = :id";
        $params = ['id' => $id];
        $result = $db->query($query, $params);

        echo json_encode(['success' => $result]);
        exit;
    }
}
// Handle UPDATE action
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['action']) && $input['action'] === 'update') {
        $id = $input['id'];
        $vacancyCount = $input['vacancy_count'];

        $query = "UPDATE advertisements SET vacancy_count = :vacancy_count WHERE id = :id";
        $params = ['id' => $id, 'vacancy_count' => $vacancyCount];
        $result = $db->query($query, $params);

        echo json_encode(['success' => $result]);
        exit;
    }
}


// Retrieve all advertisements
$query = "SELECT id, job_type, vacancy_count FROM advertisements";
$advertisements = $db->query($query, [])->get();

// Pass data to the view
view('company/advertisment.view.php', ['advertisements' => $advertisements]);
