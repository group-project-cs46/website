<?php

use Core\Session;
use Http\Forms\StudentComplaint;
use Models\Complaint;


$form = StudentComplaint::validate($attributes = [
    'subject' => $_POST['subject'],
    'description' => $_POST['description'],
    'accused_id' => $_POST['accused_id'],
]);

Complaint::create(auth_user()['id'], $attributes['accused_id'], $attributes['subject'], $attributes['description']);

Session::flash('toast', 'Complaint submitted successfully!');
redirect('/students/complaints');