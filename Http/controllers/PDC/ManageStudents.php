<?php

use \Core\Database;
use \Core\App;

$db = App::resolve(Database::class);

$query = "SELECT * FROM students";
$students = $db->query($query, [])->get();

//dd($user);

view('PDC/ManageStudents.view.php',['students' => $students]);