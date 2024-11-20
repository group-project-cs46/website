<?php

use Core\Session;

view('sessions/create.view.php', [
    'errors' => $_SESSION['_flash']['errors'] ?? [],
]);
