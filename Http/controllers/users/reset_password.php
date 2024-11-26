<?php

$email = $_GET['email'];
$token = $_GET['token'];

view('users/reset_password.view.php', [
    'errors' => $_SESSION['_flash']['errors'] ?? [],
    'email' => $email,
    'token' => $token
]);