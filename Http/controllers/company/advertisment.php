<?php

namespace Core;

use Core\Database;
use Core\App;

// Resolve database connection from App container
$db = App::resolve(Database::class);

// Retrieve all advertisements with job role name by joining with internship_roles
$query = "SELECT a.*, ir.name AS job_role 
          FROM advertisements a 
          LEFT JOIN internship_roles ir ON a.internship_role_id = ir.id";
$advertisements = $db->query($query, [])->get();

// Pass data to the view
view('company/advertisment.view.php', ['advertisements' => $advertisements]);