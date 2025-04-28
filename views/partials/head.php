<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaunchPad</title>

    <link rel="stylesheet" href="/styles/normalize.css">
    <link rel="stylesheet" href="/styles/tooltip.css">
    <link rel="stylesheet" href="/styles/base.css">
    <link rel="stylesheet" href="/styles/toast.css">
    <!--    <script src="https://cdn.tailwindcss.com"></script>-->
    <script src="https://kit.fontawesome.com/934c15dc39.js" crossorigin="anonymous"></script>
</head>
<body style="font-family: sans-serif">

<!--Toast-->
<div class="toast-container"></div>
<?php if (\Core\Session::has('toast')): ?>
    <div id="toast-message" style="display: none">
        <?= \Core\Session::getFlash('toast') ?>
    </div>

<?php endif; ?>

<?php if (\Core\Session::has('toast_type')): ?>
    <div id="toast-type" style="display: none">
        <?= \Core\Session::getFlash('toast_type') ?>
    </div>
<?php endif; ?>

<!--Toast End-->



