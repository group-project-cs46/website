<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

it('loads login page correctly', function () {
    $host = 'http://localhost:4444/wd/hub';
    $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

    $driver->get('http://localhost:8000/login');

    // Verify page title or header
    $header = $driver->findElement(WebDriverBy::tagName('h1'))->getText();
    expect($header)->toBe('Welcome Back');

    // Verify form elements
    expect($driver->findElement(WebDriverBy::name('email')))->toBeTruthy();
    expect($driver->findElement(WebDriverBy::name('password')))->toBeTruthy();
    expect($driver->findElement(WebDriverBy::cssSelector('button[type="submit"]')))->toBeTruthy();

    $driver->quit();
});

it('logs in successfully', function () {
    $host = 'http://localhost:4444/';
    $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

    $driver->get('http://localhost:8000/login');

    $driver->findElement(WebDriverBy::name('email'))->sendKeys('student@launchpad.com');
    $driver->findElement(WebDriverBy::name('password'))->sendKeys('12345678');

    $driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

    $driver->wait()->until(
        WebDriverExpectedCondition::urlContains('/dashboard/student')
    );

    expect($driver->getCurrentURL())->toContain('/dashboard');

    // Verify the welcome message
    $welcomeMessage = $driver->findElement(WebDriverBy::tagName('body'))->getText();
    expect($welcomeMessage)->toContain('Welcome to Your Internship Dashboard');

    $driver->quit();
});

it('shows error for invalid credentials', function () {
    $host = 'http://localhost:4444/wd/hub';
    $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

    $driver->get('http://localhost:8000/login');

    // Fill in the form with invalid credentials
    $driver->findElement(WebDriverBy::name('email'))->sendKeys('invalid@example.com');
    $driver->findElement(WebDriverBy::name('password'))->sendKeys('wrongpassword');

    // Submit the form
    $driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

    // Wait for error message
    $driver->wait()->until(
        WebDriverExpectedCondition::presenceOfElementLocated(
            WebDriverBy::cssSelector('p[style*="color: #dc2626"]')
        )
    );

    // Verify error message
    $errorMessage = $driver->findElement(WebDriverBy::cssSelector('p[style*="color: #dc2626"]'))->getText();
    expect($errorMessage)->not()->toBeEmpty();

    // Verify still on login page
    expect($driver->getCurrentURL())->toContain('/login');

    $driver->quit();
});