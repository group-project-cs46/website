<?php

use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id']
])->find();

authorize($note['user_id'] === $currentUserId);

view('notes/edit.view.php', [
    'note' => $note,
    'errors' => []
]);