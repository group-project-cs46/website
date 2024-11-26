<?php require base_path('views/partials/auth/auth.php') ?>

<main style="margin-top: 4rem">
    <div class="container">
        <h1 class="title">Account Information</h1>
        <div class="info">
            <label class="label">Name:</label>
            <p class="text"><?= htmlspecialchars($user['name']) ?></p>
        </div>
        <div class="info">
            <label class="label">Email:</label>
            <p class="text"><?= htmlspecialchars($user['email']) ?></p>
        </div>
    </div>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>