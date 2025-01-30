<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="margin-top: 4rem">
        <div class="container">
            <h1 class="title">Account Information</h1>
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
                </div>

                <div>
                    <img src="<?= $photo ?>" alt="Profile Picture" id="profilePic"
                         style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 1px solid var(--gray-200);">
                    <form action="/users/profile/photo" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="_method" value="PATCH">

                        <input type="file" name="file" accept="image/*">
                        <button type="submit" class="button">Upload</button>
                    </form>
                </div>
            </div>

            <div style="margin-top: 2rem; border-top: 1px solid var(--gray-200); padding-top: 1rem">
                <form action="/users/change_password" method="post"
                      style="display:flex; flex-direction: column; gap: 1rem">
                    <div>
                        <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                            Current Password
                            <input class="input" type="password" name="current_password" required>
                            <?php if (isset($errors['current_password'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['current_password'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                            New Password
                            <input class="input" type="password" name="password" required
                                   value="<?= old('email') ?? '' ?>">
                            <?php if (isset($errors['password'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['password'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                            Confirm Password
                            <input class="input" type="password" name="confirm_password" required>
                            <?php if (isset($errors['confirm_password'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['confirm_password'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <div>
                            <button class="button is-primary">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara.css">
    <link rel="stylesheet" href="/styles/form.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>