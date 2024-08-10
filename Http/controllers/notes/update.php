<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;


$id = $_POST['id'];

$note = $db->query('SELECT * FROM notes WHERE id = ?', [$id])->findOrFail();


authorize($note['user_id'] == $currentUserId);


$errors = [];

if (!Validator::string($_POST['body'], 1, 100)) {
    $errors['body'] = 'The body must be between 1 and 100 characters.';
}

if (count($errors)) {
    view('notes/edit.view.php', [
        'errors' => $errors,
    ]);
    return;
}


$db->query("UPDATE notes SET body = ? WHERE id = ?", [
    $_POST['body'],
    $id,
]);


header('location: /notes');
die();
