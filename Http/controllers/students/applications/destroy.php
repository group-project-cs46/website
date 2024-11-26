<?php

use Models\Application;

$id = $_POST['id'];

Application::delete($id);

redirect('/students/applications');