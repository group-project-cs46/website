<?php

view('users/create.view.php', [
    'errors' => $_SESSION['_flash']['errors'] ?? [],
]);