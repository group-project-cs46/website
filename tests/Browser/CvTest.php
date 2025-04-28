<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

it('allows student to upload a PDF CV', function () {
    $host = 'http://localhost:4444';
    $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

    // Log in as a student
    $driver->get('http://localhost:8000/login');
    $driver->findElement(WebDriverBy::name('email'))->sendKeys('student@launchpad.com');
    $driver->findElement(WebDriverBy::name('password'))->sendKeys('12345678');
    $driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

    // Wait for redirect to dashboard
    $driver->wait()->until(
        WebDriverExpectedCondition::urlContains('/dashboard')
    );

    // Navigate to /students/cvs
    $driver->get('http://localhost:8000/students/cvs');

    // Wait for CVs page to load
    $driver->wait()->until(
        WebDriverExpectedCondition::urlContains('/students/cvs')
    );

    // Path to a test PDF file (must exist on the test machine)
    $testPdfPath = __DIR__ . '/fixtures/test_cv.pdf';

    // Fill the file input
    $fileInput = $driver->findElement(WebDriverBy::cssSelector('input[type="file"][name="cv"]'));
    $fileInput->sendKeys($testPdfPath);

    // Optionally, fill the type field
    $driver->findElement(WebDriverBy::name('type'))->sendKeys('Professional');

    // Submit the form
    $driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

    // Wait for the page to reload with the updated grid
    $driver->wait()->until(
        WebDriverExpectedCondition::presenceOfElementLocated(
            WebDriverBy::xpath("//div[contains(@class, 'grid-item') and contains(text(), 'test_cv.pdf')]")
        )
    );

    // Verify the uploaded CV appears in the grid
    $gridItem = $driver->findElement(WebDriverBy::xpath("//div[contains(@class, 'grid-item') and contains(text(), 'test_cv.pdf')]"))->getText();
    expect($gridItem)->toContain('test_cv.pdf');

    // Verify the type appears in the grid
    $typeItem = $driver->findElement(WebDriverBy::xpath("//div[contains(@class, 'grid-item') and contains(text(), 'Professional')]"))->getText();
    expect($typeItem)->toContain('Professional');

    $driver->quit();
});

it('rejects non-PDF file uploads', function () {
    $host = 'http://localhost:4444';
    $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

    // Log in as a student
    $driver->get('http://localhost:8000/login');
    $driver->findElement(WebDriverBy::name('email'))->sendKeys('student@launchpad.com');
    $driver->findElement(WebDriverBy::name('password'))->sendKeys('12345678');
    $driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

    // Wait for redirect to dashboard
    $driver->wait()->until(
        WebDriverExpectedCondition::urlContains('/dashboard')
    );

    // Navigate to /students/cvs
    $driver->get('http://localhost:8000/students/cvs');

    // Wait for CVs page to load
    $driver->wait()->until(
        WebDriverExpectedCondition::urlContains('/students/cvs')
    );

    // Path to a test non-PDF file (e.g., .txt)
    $testNonPdfPath = __DIR__ . '/fixtures/test_file.txt';

    // Fill the file input
    $fileInput = $driver->findElement(WebDriverBy::cssSelector('input[type="file"][name="cv"]'));
    $fileInput->sendKeys($testNonPdfPath);

    // Submit the form
    $driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

    // Wait for error message
    $driver->wait()->until(
        WebDriverExpectedCondition::presenceOfElementLocated(
            WebDriverBy::cssSelector('p.error')
        )
    );

    // Verify error message
    $errorMessage = $driver->findElement(WebDriverBy::cssSelector('p.error'))->getText();
    expect($errorMessage)->not()->toBeEmpty();

    // Verify still on the CVs page
    expect($driver->getCurrentURL())->toContain('/students/cvs');

    $driver->quit();
});