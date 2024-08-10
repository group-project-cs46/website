<?php

use Core\Validator;

it('validates a string', function () {
    $validator = new Validator();
    expect($validator->string('hello'))->toBeTrue()
        ->and($validator->string(''))->toBeFalse();
});

it('validates an email', function () {
    $validator = new Validator();
    expect($validator->email('thathsaramadhhusha@gmail.com'))->toBe('thathsaramadhhusha@gmail.com')
        ->and($validator->email('thathsaramadhhusha'))->toBeFalse()
        -> and($validator->email('thathsaramadhhusha@gmail'))->toBeFalse();
});