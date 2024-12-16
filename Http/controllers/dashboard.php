<?php

$user = \Models\User::findByEmail($_SESSION['user']['email']);

if ($user['role'] === 1) {
    redirect('/dashboard/admin');
}
if ($user['role'] === 2) {
    redirect('/dashboard/student');
}
if ($user['role'] === 3) {
    redirect('/dashboard/pdc');
}
if ($user['role'] === 4) {
    redirect('/dashboard/company');
}
if ($user['role'] === 5) {
    redirect('/dashboard/lecturer');
}
