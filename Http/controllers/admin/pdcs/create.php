<?php

view('/admins/pdcs/create.view.php', [
    'heading' => 'Create PDC',
    'errors' => $_SESSION['_flash']['errors'] ?? [],
]);