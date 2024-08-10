<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;


Authenticator::logout();

header('location: /');
die();