<?php

use Models\AdminComplaint;

    $complaints = AdminComplaint::getAll();
view('admin/complaintManage.view.php', [
    'COMPLAINT_DATA' => $complaints
]);


