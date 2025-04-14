<?php

use Models\AddStudent;


$students = AddStudent::fetch_student();


view('PDC/ManageStudents.view.php',['students' => $students]);