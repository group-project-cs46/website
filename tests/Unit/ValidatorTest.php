<?php

use Core\Validator;

it('validates a sn empty string', function () {
    expect(Validator::string(''))->toBeFalse();
});