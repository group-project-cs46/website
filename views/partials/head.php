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
<!--    <script src="https://cdn.tailwindcss.com"></script>-->
    <script src="https://kit.fontawesome.com/934c15dc39.js" crossorigin="anonymous"></script>
</head>
<body style="font-family: sans-serif">
<?php if (\Core\Session::has('toast')): ?>

<div>
<!--    Toast-->
    <div style="position: fixed;
    right: 0; bottom: 0;
    background-color: var(--gray-800); color: white; padding-inline: 1rem; padding-block: 0.5rem;
    margin: 10px;
    border-radius: 5px;
">
        <?= \Core\Session::getFlash('toast') ?>
    </div>
</div>
<?php endif; ?>



