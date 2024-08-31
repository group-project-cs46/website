<?php


$router->get('/', 'home.php');
$router->get('/contact', 'contact.php');
$router->get( '/about', 'about.php');
$router->get('/dashboard', 'dashboard.php')->only('auth');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php');
$router->patch('/note', 'notes/update.php');
$router->get( '/note/edit', 'notes/edit.php');
$router->delete('/note', 'notes/destroy.php',);
$router->get( '/notes/create', 'notes/create.php');
$router->post( '/notes', 'notes/store.php');


$router->get('/register', 'users/create.php')->only('guest');
$router->post('/register', 'users/store.php')->only('guest');

$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/sessions', 'sessions/store.php')->only('guest');
$router->delete('/sessions', 'sessions/destroy.php')->only('auth');


$router->get('/jobs', 'jobs/index.php')->only('student');