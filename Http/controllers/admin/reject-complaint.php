<?php

// use Models\AdminComplaint;

// // Check if ID is posted
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
//     $id = $_POST['id'];

//     AdminComplaint::deleteById($id);

// }
// redirect(path: '/complaints');
use Models\AdminComplaint;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    AdminComplaint::updateStatus($id, 'rejected'); 
}

redirect(path: '/complaints');

