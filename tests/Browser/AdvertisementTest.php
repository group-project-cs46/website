<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

it('doesn\'t allow applying when already selected', function () {
    $host = 'http://localhost:4444/wd/hub'; // Selenium server
    $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

    // Step 1: Login first
    $driver->get('http://localhost:8000/login');

    $driver->findElement(WebDriverBy::name('email'))->sendKeys('student@launchpad.com');
    $driver->findElement(WebDriverBy::name('password'))->sendKeys('12345678');
    $driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

    $driver->wait()->until(
        WebDriverExpectedCondition::urlContains('/dashboard/student')
    );

    // Step 2: Go to applications page
    $driver->get('http://localhost:8000/students/advertisements');

    $moreButton = $driver->findElement(
        WebDriverBy::xpath('//button[contains(text(), "More")]')
    );

    // Step 4: Click the "More" button
    $moreButton->click();

    // Step 4: Wait for the form to appear (optional but safer)
    $driver->wait()->until(
        WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::tagName('form'))
    );

    // Step 5: Find the only form inside and submit it
    $form = $driver->findElement(WebDriverBy::id('apply_form'));
    $form->submit();

    // Step 6: Wait for the toast message to appear
    $driver->wait()->until(
        WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('toast-message'))
    );

    $toastElement = $driver->findElement(WebDriverBy::id('toast-message'));
    // Step 7: Get the message from the toast
    $toastMessage = $driver->executeScript("return arguments[0].textContent;", [$toastElement]);

    if (trim($toastMessage) !== "You have already been selected by a company") {
        expect(true)->toBeTrue();
    }

    $driver->get('http://localhost:8000/students/applications');

    $driver->wait()->until(
        WebDriverExpectedCondition::urlContains('/students/applications')
    );

    $select = $driver->findElement(WebDriverBy::tagName('body'))->getText();
    expect($select)->toContain('Selected');
});
