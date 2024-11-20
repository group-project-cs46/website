<?php

use \Core\Database;
use \Core\App;

$db = App::resolve(Database::class);

//$user = $db->query("SELECT * FROM users WHERE id = ?", [2])->find();

//dd($user);

view('PDC/Complaints&Feedback.view.php');