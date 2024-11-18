<?php

use Core\Database;
use Core\App;


$db = App::resolve(Database::class);



// $user= $db->query("SELECT * FROM users WHERE id = ?", [1])->get();


view('company/schedule.view.php');