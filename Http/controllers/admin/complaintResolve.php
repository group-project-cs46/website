<?php

use Models\AdminComplaint;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        AdminComplaint::updateStatus($id, 'resolved');
    }

    header('Location: /complaints');
    exit;
}
redirect(path: '/complaints');


