<?php

view('users/forgot_password.view.php', [
    'errors' => $_SESSION['_flash']['errors'] ?? [],
]);