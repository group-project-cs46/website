
<?php

use Models\AdminComplaint;

    $complaints = AdminComplaint::getAll();
view('dashboards/admin.view.php', [
    'COMPLAINT_DATA' => $complaints
]);


