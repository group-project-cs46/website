<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="margin-top: 4rem">
        <div class="container">
            <h1 class="title">Account Information</h1>

            <!-- Profile Display and Photo Upload -->
            <div style="display: flex; justify-content: space-between">
                <div>
                    <div class="info">
                        <label class="label">Name:</label>
                        <p class="text"><?= htmlspecialchars($user['name'] ?? '') ?></p>
                    </div>
                    <div class="info">
                        <label class="label">Email:</label>
                        <p class="text"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                    <div class="info">
                        <label class="label">Mobile:</label>
                        <p class="text"><?= htmlspecialchars($user['mobile'] ?? '') ?></p>
                    </div>
                    <div class="info">
                        <label class="label">Bio:</label>
                        <p class="text"><?= htmlspecialchars($user['bio'] ?? '') ?></p>
                    </div>
                    <div class="info">
                        <label class="label">LinkedIn:</label>
                        <p class="text"><?= htmlspecialchars($user['linkedin'] ?? '') ?></p>
                    </div>

                    <?php if (isset($user['role_name']) && $user['role_name'] === 'student'): ?>
                        <div class="info">
                            <label class="label">Index Number:</label>
                            <p class="text"><?= htmlspecialchars($user['index_number'] ?? '') ?></p>
                        </div>
                        <div class="info">
                            <label class="label">Registration Number:</label>
                            <p class="text"><?= htmlspecialchars($user['registration_number'] ?? '') ?></p>
                        </div>
                        <div class="info">
                            <label class="label">Course:</label>
                            <p class="text"><?= htmlspecialchars($user['course'] ?? '') ?></p>
                        </div>
                    <?php elseif (in_array($user['role_name'] ?? '', ['lecturer', 'pdc'])): ?>
                        <div class="info">
                            <label class="label">Title:</label>
                            <p class="text"><?= htmlspecialchars($user['title'] ?? '') ?></p>
                        </div>
                        <div class="info">
                            <label class="label">Employee ID:</label>
                            <p class="text"><?= htmlspecialchars($user['employee_id'] ?? '') ?></p>
                        </div>
                    <?php elseif (roleNumber() === 4): ?>
                        <div class="info">
                            <label class="label">Website:</label>
                            <p class="text"><?= htmlspecialchars($user['website'] ?? '') ?></p>
                        </div>
                    <?php endif ?>
                </div>

                <div>
                    <img src="<?= $_SESSION['user']['photo'] ?>" alt="Profile Picture" id="profilePic"
                         style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 1px solid var(--gray-200);">
                    <form action="/users/profile/photo" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="file" name="file" accept="image/*">
                        <button type="submit" class="button">Upload</button>
                    </form>
                </div>
            </div>

            <!-- General Settings Form -->
            <div style="margin-top: 2rem; border-top: 1px solid var(--gray-200); padding-top: 1rem">
                <h2 class="subtitle">Update Profile</h2>
                <form action="/users/profile/details" method="post" style="display: flex; flex-direction: column; gap: 1rem">
                    <input type="hidden" name="_method" value="PATCH">
                    <div>
                        <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                            Mobile
                            <input class="input" type="text" name="mobile" value="<?= htmlspecialchars($user['mobile'] ?? '') ?>">
                            <?php if (isset($errors['mobile'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['mobile'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                            Bio
                            <textarea class="input" name="bio"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                            <?php if (isset($errors['bio'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['bio'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                            LinkedIn Account
                            <input class="input" type="text" style="width: 100%" name="linkedin" value="<?= htmlspecialchars($user['linkedin'] ?? '') ?>">
                            <?php if (isset($errors['linkedin'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['linkedin'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <button type="submit" class="button is-primary">Update Profile</button>
                </form>
            </div>

            <!-- Role-Specific Settings -->
            <?php if (roleNumber()): ?>
                <div style="margin-top: 2rem; border-top: 1px solid var(--gray-200); padding-top: 1rem">
                    <h2 class="subtitle">Role-Specific Settings</h2>
                    <?php if (roleNumber() === 2): ?> <!-- Assuming 2 is for students -->
<!--                        empty-->
                    <?php elseif (roleNumber() === 4): ?> <!-- Assuming 4 is for company -->
                        <form action="/users/profile/student" method="post" style="display: flex; flex-direction: column; gap: 1rem">
                            <input type="hidden" name="_method" value="PATCH">
                            <div>
                                <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Website
                                    <input class="input" type="text" name="registration_number" value="<?= htmlspecialchars($user['website'] ?? '') ?>" required>
                                    <?php if (isset($errors['website'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['website'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Building Number or Name
                                    <input type="text" name="building" placeholder="232/B" required value="<?= $user['building'] ?? '' ?>">
                                    <?php if (isset($errors['building'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['building'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Street Name
                                    <input type="text" name="street_name" placeholder="T B Jaya Mawatha" required value="<?= $user['street_name'] ?? '' ?>">
                                    <?php if (isset($errors['street_name'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['street_name'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Address Line 2
                                    <input type="text" name="address_line_2" placeholder="Optional" value="<?= $user['address_line_2'] ?? '' ?>">
                                    <?php if (isset($errors['address_line_2'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['address_line_2'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    City
                                    <input type="text" name="city" placeholder="Colombo" required value="<?= $user['city'] ?? '' ?>">
                                    <?php if (isset($errors['city'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['city'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: flex; flex-direction: column; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Postal Code
                                    <input type="text" name="postal_code" placeholder="10100" required value="<?= $user['postal_code'] ?? '' ?>">
                                    <?php if (isset($errors['postal_code'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['postal_code'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>
                            <button type="submit" class="button" style="width: 100%">Update Company Info</button>
                        </form>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <!-- Password Change Form (Unchanged) -->
            <div style="margin-top: 2rem; border-top: 1px solid var(--gray-200); padding-top: 1rem">
                <h2 class="subtitle">Change Password</h2>
                <form action="/users/change_password" method="post" style="display: flex; flex-direction: column; gap: 1rem">
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
                            <input class="input" type="password" name="password" required>
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
                    <button type="submit" class="button is-primary">Change Password</button>
                </form>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara.css">
    <link rel="stylesheet" href="/styles/form.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>