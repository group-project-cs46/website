<?php

//require base_path('Validator.php');

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);


$errors = [];


if (!Validator::string($_POST['body'], 1, 100)) {
    $errors['body'] = 'The body must be between 1 and 100 characters.';
}

if (!empty($errors)) {
    view('notes/create.view.php', [
        'errors' => $errors
    ]);
    return;
}

$db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)", [
    'body' => $_POST['body'],
    'user_id' => 1,
]);

header('location: /notes');
die();
