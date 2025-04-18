<?php

use Models\companyStudent;

// Fetch applied students from the database
try {
    $appliedStudents = companyStudent::fetchAllStudents();
    $appliedData = [
        'appliedStudents' => $appliedStudents,
        'errorApplied' => empty($appliedStudents) ? 'No applied students found.' : null
    ];
} catch (\Exception $e) {
    error_log('Error fetching applied students: ' . $e->getMessage());
    $appliedData = [
        'appliedStudents' => [],
        'errorApplied' => 'An error occurred while fetching applied students. Please try again later.'
    ];
}

// Fetch shortlisted students from the database
try {
    $shortlistedStudents = companyStudent::fetchShortlitedStudents();
    $shortlistedData = [
        'shortlistedStudents' => $shortlistedStudents,
        'errorShortlisted' => empty($shortlistedStudents) ? 'No shortlisted students found.' : null
    ];
} catch (\Exception $e) {
    error_log('Error fetching shortlisted students: ' . $e->getMessage());
    $shortlistedData = [
        'shortlistedStudents' => [],
        'errorShortlisted' => 'An error occurred while fetching shortlisted students. Please try again later.'
    ];
}

// Fetch selected students from the database
try {
    $selectedStudents = companyStudent::fetchSelectedStudents();
    $selectedData = [
        'selectedStudents' => $selectedStudents,
        'errorSelected' => empty($selectedStudents) ? 'No selected students found.' : null
    ];
} catch (\Exception $e) {
    error_log('Error fetching selected students: ' . $e->getMessage());
    $selectedData = [
        'selectedStudents' => [],
        'errorSelected' => 'An error occurred while fetching selected students. Please try again later.'
    ];
}

// Merge all data into a single array
$data = array_merge($appliedData, $shortlistedData, $selectedData);

// Pass the data to the view
view('company/list.view.php', $data);