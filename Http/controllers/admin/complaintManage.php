<?php 

use Models\ViewComplaintAdmin;

try {
    $data = ViewComplaintAdmin::getAllBasicComplaintDetails();

    // Debugging line to see what's inside $data
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    view('admin/complaintManage.view.php', ['COMPLAINT_DATA' => $data]);
} catch (Exception $e) {
    die($e->getMessage());
}
