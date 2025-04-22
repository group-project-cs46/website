<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\NewPdc;

//dd($_POST);

$form = NewPdc::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'name' => $_POST['name'],
    'mobile' => $_POST['mobile'],
]);

//dd($form);

$db = App::resolve(Database::class);

//dd($attributes);

//$user = $db->query('SELECT * FROM users WHERE email = ?', [$attributes['email']])->find();
//
//if ($user) {
//    Session::flash('errors', [
//        'email' => 'Email already exists'
//    ]);
//    redirect('/admins/pdcs/create');
//}
//
$db->query('INSERT INTO users (email, password, role, approved, name, mobile) VALUES (?, ?, ?, ?, ?, ?)',
    [$attributes['email'], password_hash($attributes['password'], PASSWORD_DEFAULT), 3, 1, $attributes['name'], $attributes['mobile']]);

$lastInsertedId = $db->connection->lastInsertId();

$db->query('INSERT INTO pdcs (id) VALUES (?)',
    [$lastInsertedId]
);

//login([
//    'email' => $attributes['email'],
//    'role' => 4
//]);

Session::flash('toast', 'Account created successfully.');
redirect('/admins/pdcs');