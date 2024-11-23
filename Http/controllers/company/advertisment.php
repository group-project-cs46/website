<?php

namespace Core;

use Core\Database;
use Core\App;

// Resolve database connection from App container
$db = App::resolve(Database::class);

// Retrieve all advertisements
$query = "SELECT * FROM advertisements";
$advertisements = $db->query($query, [])->get();


// Pass data to the view
view('company/advertisment.view.php', ['advertisements' => $advertisements]);
