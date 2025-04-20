<?php

use Core\Container;

it('can bind and resolve a class', function () {
    $container = new Container();

    $container->bind('foo', fn () => 'bar');

    expect($container->resolve('foo'))->toBe('bar');
});

it('throws an exception if no binding exists', function () {
    $container = new Container();

    expect(fn () => $container->resolve('missing'))
        ->toThrow(Exception::class, 'Nothing bound to missing');
});
