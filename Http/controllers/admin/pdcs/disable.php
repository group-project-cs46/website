<?php

use Models\Pdc;

$id = $_POST['id'];

Pdc::disable($id);

redirect('/admins/pdcs');