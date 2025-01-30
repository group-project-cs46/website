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
                </div>

                <div>
                    <img src="<?= $photo ?>" alt="Profile Picture" id="profilePic" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 1px solid var(--gray-200);">
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
                        <label class="label">Current Password</label>
                        <div>
                            <input class="input" type="password" name="current_password" required>
                        </div>
                    </div>
                    <div>
                        <label class="label">New Password</label>
                        <div>
                            <input class="input" type="password" name="password" required>
                        </div>
                    </div>
                    <div>
                        <label class="label">Confirm Password</label>
                        <div>
                            <input class="input" type="password" name="password_confirmation" required>
                        </div>
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