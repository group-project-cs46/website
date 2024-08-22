<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (! Validator::email($email)) {
    $errors['email'] = 'Invalid email';
}

if (! Validator::string($password, 8)) {
    $errors['password'] = 'Password must be at least 8 characters';
}

if (! empty($errors)) {
    view('users/create.view.php', ['errors' => $errors]);
    return;
}

$db = App::resolve(Database::class);

$user = $db->query('SELECT * FROM users WHERE email = ?', [$email])->find();

if ($user) {
    header('location: /');
    die();
}

$db->query('INSERT INTO users (email, password, role) VALUES (?, ?, ?)', [$email, password_hash($password, PASSWORD_DEFAULT), 1]);

login([
    'email' => $email
]);

header('location: /');
die();