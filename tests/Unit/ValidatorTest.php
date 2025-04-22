<?php

namespace Tests\Unit\Core;

use Core\Validator;
use Tests\TestCase;

describe('Validator', function () {
    describe('string', function () {
        it('validates string within min and max length', function () {
            expect(Validator::string('hello', 1, 10))->toBeTrue();
            expect(Validator::string('hello', 5, 5))->toBeTrue();
        });

        it('fails for string shorter than min length', function () {
            expect(Validator::string('hi', 3, 10))->toBeFalse();
        });

        it('fails for string longer than max length', function () {
            expect(Validator::string('hello', 1, 4))->toBeFalse();
        });

        it('trims string before validation', function () {
            expect(Validator::string('  hello  ', 5, 5))->toBeTrue();
        });

        it('handles empty string', function () {
            expect(Validator::string('', 1, 10))->toBeFalse();
        });
    });

    describe('optionalString', function () {
        it('allows empty string', function () {
            expect(Validator::optionalString(''))->toBeTrue();
        });

        it('validates non-empty string within min and max length', function () {
            expect(Validator::optionalString('hello', 1, 10))->toBeTrue();
        });

        it('fails for non-empty string outside min and max length', function () {
            expect(Validator::optionalString('hi', 3, 10))->toBeFalse();
            expect(Validator::optionalString('hello', 1, 4))->toBeFalse();
        });
    });

    describe('email', function () {
        it('validates valid email addresses', function () {
            expect(Validator::email('test@example.com'))->toBeTruthy();
            expect(Validator::email('user.name@domain.co.uk'))->toBeTruthy();
        });

        it('fails for invalid email addresses', function () {
            expect(Validator::email('invalid.email'))->toBeFalse();
            expect(Validator::email('test@.com'))->toBeFalse();
            expect(Validator::email(''))->toBeFalse();
        });
    });

    describe('url', function () {
        it('validates valid URLs', function () {
            expect(Validator::url('https://example.com'))->toBeTrue();
            expect(Validator::url('http://sub.domain.com/path'))->toBeTrue();
        });

        it('fails for invalid URLs', function () {
            expect(Validator::url('invalid-url'))->toBeFalse();
            expect(Validator::url('ftp://example.com'))->toBeFalse();
            expect(Validator::url(''))->toBeFalse();
        });
    });

    describe('file', function () {
        it('validates valid file upload', function () {
            $file = [
                'name' => 'test.pdf',
                'size' => 1000,
                'error' => UPLOAD_ERR_OK,
                'tmp_name' => '/tmp/test.pdf'
            ];

            expect(Validator::file($file, ['pdf'], 2000))->toBeTrue();
        });

        it('fails for upload error', function () {
            $file = [
                'name' => 'test.pdf',
                'size' => 1000,
                'error' => UPLOAD_ERR_INI_SIZE,
                'tmp_name' => '/tmp/test.pdf'
            ];

            expect(Validator::file($file, ['pdf'], 2000))->toBeFalse();
        });

        it('fails for disallowed extension', function () {
            $file = [
                'name' => 'test.jpg',
                'size' => 1000,
                'error' => UPLOAD_ERR_OK,
                'tmp_name' => '/tmp/test.jpg'
            ];

            expect(Validator::file($file, ['pdf'], 2000))->toBeFalse();
        });

        it('fails for file size exceeding max', function () {
            $file = [
                'name' => 'test.pdf',
                'size' => 3000,
                'error' => UPLOAD_ERR_OK,
                'tmp_name' => '/tmp/test.pdf'
            ];

            expect(Validator::file($file, ['pdf'], 2000))->toBeFalse();
        });

        it('handles case-insensitive extensions', function () {
            $file = [
                'name' => 'test.PDF',
                'size' => 1000,
                'error' => UPLOAD_ERR_OK,
                'tmp_name' => '/tmp/test.PDF'
            ];

            expect(Validator::file($file, ['pdf'], 2000))->toBeTrue();
        });

        it('allows any extension when none specified', function () {
            $file = [
                'name' => 'test.jpg',
                'size' => 1000,
                'error' => UPLOAD_ERR_OK,
                'tmp_name' => '/tmp/test.jpg'
            ];

            expect(Validator::file($file, [], 2000))->toBeTrue();
        });
    });
});
?>