<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\Register;
use Models\User;
use Core\Mail;

//dd($_POST);

$email = trim($_POST['email']);

$user = User::find($email);

if (!$user) {
    Session::flash('toast', 'Email not found.');
    redirect('/forgot_password');
}

$mailer = App::resolve(Mail::class);
$db = App::resolve(Database::class);

$token = generateToken();
$expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));



//update or insert postgresql
$db->query('INSERT INTO password_resets (email, token, expiry) VALUES (?, ?, ?) ON CONFLICT (email) DO UPDATE SET token = ?, expiry = ?', [
    $email,
    $token,
    $expiry,
    $token,
    $expiry
]);

//reset url

$url = url('/reset_password', ['token' => $token, 'email' => $email]);

$mailer->send($email, 'Reset your password', $url);

Session::flash('toast', 'We have e-mailed your password reset link to you. Please check your inbox.');
redirect('/forgot_password');


function generateToken() {
    return bin2hex(random_bytes(32)); // Generates a 64-character secure token
}

function url($base, $params = []) {
    $base = 'http://localhost:8000' . $base;
    return $base . '?' . http_build_query($params);
}
