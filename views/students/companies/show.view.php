<?php require base_path('views/partials/auth/auth.php') ?>

    <main>
        <div class="container">
            <div style="display: flex; justify-content: space-between">
                <div>
                    <div class="info">
                        <label class="label">Name:</label>
                        <p class="text"><?= htmlspecialchars($user['name']) ?></p>
                    </div>
                    <div class="info">
                        <label class="label">Email:</label>
                        <p class="text"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                    <div class="info">
                        <label class="label">Mobile:</label>
                        <p class="text"><?= htmlspecialchars($user['mobile'] ?? '') ?></p>
                    </div>

                    <?php if (isset($user['index_number'])): ?>
                        <div class="info">
                            <label class="label">Index Number:</label>
                            <p class="text"><?= htmlspecialchars($user['index_number']) ?></p>
                        </div>
                    <?php endif ?>

                    <?php if (isset($user['registration_number'])): ?>
                        <div class="info">
                            <label class="label">Registration Number:</label>
                            <p class="text"><?= htmlspecialchars($user['registration_number']) ?></p>
                        </div>
                    <?php endif ?>

                    <?php if (isset($user['website'])): ?>
                        <div class="info">
                            <label class="label">Website:</label>
                            <a href="<?= htmlspecialchars($user['website']) ?>" target="_blank" class="text"><?= htmlspecialchars($user['website']) ?></a>
                        </div>
                    <?php endif ?>

<!--                    address -->
                    <?php if (isset($user['building']) || isset($user['street_name']) || isset($user['city']) || isset($user['postal_code']) || isset($user['address_line_2'])): ?>
                        <div class="info">
                            <label class="label">Address:</label>
                            <p class="text">
                                <?= htmlspecialchars($user['building'] ?? '') ?>,
                                <?= htmlspecialchars($user['street_name'] ?? '') ?>,
                                <?= htmlspecialchars($user['city'] ?? '') ?>,
                                <?= htmlspecialchars($user['postal_code'] ?? '') ?>,
                                <?= htmlspecialchars($user['address_line_2'] ?? '') ?>
                            </p>
                        </div>
                    <?php endif ?>

                </div>

                <div>
                    <img src="<?= $photo ?>" alt="Profile Picture" id="profilePic"
                         style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 1px solid var(--gray-200);">
                </div>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>