<?php require base_path('views/partials/auth/auth.php') ?>
    <main style="font-family: 'Inter', sans-serif; min-height: calc(100vh - 4rem);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 1rem 1rem;">
            <h1 class="title" style="font-size: 2.25rem; font-weight: 700; color: #1a202c; text-align: center; margin-bottom: 2rem;">Company Account Information</h1>

            <!-- Profile Display and Photo Upload -->
            <div style="display: flex; flex-wrap: wrap; gap: 2rem; background: #ffffff; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 2rem; margin-bottom: 2rem;">
                <div style="flex: 1; min-width: 300px;">
                    <div class="info" style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <label style="font-size: 1rem; font-weight: 600; color: #4a5568; width: 150px;">Name:</label>
                        <p style="font-size: 1rem; color: #2d3748;"><?= htmlspecialchars($user['name'] ?? '') ?></p>
                    </div>
                    <div class="info" style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <label style="font-size: 1rem; font-weight: 600; color: #4a5568; width: 150px;">Email:</label>
                        <p style="font-size: 1rem; color: #2d3748;"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                    <div class="info" style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <label style="font-size: 1rem; font-weight: 600; color: #4a5568; width: 150px;">Mobile:</label>
                        <p style="font-size: 1rem; color: #2d3748;"><?= htmlspecialchars($user['mobile'] ?? '') ?></p>
                    </div>
                    <div class="info" style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <label style="font-size: 1rem; font-weight: 600; color: #4a5568; width: 150px;">LinkedIn:</label>
                        <p style="font-size: 1rem; color: #2d3748;"><?= htmlspecialchars($user['linkedin'] ?? '') ?></p>
                    </div>
                    <div class="info" style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <label style="font-size: 1rem; font-weight: 600; color: #4a5568; width: 150px;">Website:</label>
                        <a href="<?= htmlspecialchars($user['website']) ?>" target="_blank">
                            <?= htmlspecialchars($user['website'] ?? '') ?>
                        </a>
                    </div>
                    <div class="info" style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <label style="font-size: 1rem; font-weight: 600; color: #4a5568; min-width: 150px;">Bio:</label>
                        <p style="font-size: 1rem; color: #2d3748;"><?= htmlspecialchars($user['bio'] ?? '') ?></p>
                    </div>
                </div>

                <div>
                    <img src="<?= $_SESSION['user']['photo'] ?? '/default-photo.png' ?>" alt="Profile Picture" id="preview"
                         style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">

                    <form action="/users/profile/photo" enctype="multipart/form-data" method="post" style="display: flex; flex-direction: column; gap: 0.5rem; width: 100%; align-items: center">
                        <input type="hidden" name="_method" value="PATCH">
                        <input id="file" type="file" name="file" accept="image/*" style="display: none">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <label for="file" class="button">Select</label>
                            <button type="submit" class="button">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Combined Settings Form -->
            <div style="background: #ffffff; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 2rem; margin-bottom: 2rem;">
                <h2 class="subtitle" style="font-size: 1.5rem; font-weight: 600; color: #1a202c; margin-bottom: 1.5rem;">Update Company Profile</h2>
                <form action="/accounts/student" method="post" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <input type="hidden" name="_method" value="PATCH">

                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #1a202c; margin-bottom: 0.5rem;">
                            Mobile
                            <input class="input" type="text" name="mobile" value="<?= htmlspecialchars($user['mobile'] ?? '') ?>"
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748; transition: border-color 0.2s;">
                            <?php if (isset($errors['mobile'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['mobile'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #1a202c; margin-bottom: 0.5rem;">
                            LinkedIn URL
                            <input class="input" type="text" name="linkedin" value="<?= htmlspecialchars($user['linkedin'] ?? '') ?>"
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748;">
                            <?php if (isset($errors['linkedin'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['linkedin'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #1a202c; margin-bottom: 0.5rem;">
                            Website
                            <input class="input" type="text" name="website" value="<?= htmlspecialchars($user['website'] ?? '') ?>"
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748;">
                            <?php if (isset($errors['website'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['website'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #1a202c; margin-bottom: 0.5rem;">
                            <div style="margin-bottom: 0.3rem">Bio</div>
                            <textarea class="input" name="bio" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748; min-height: 100px; resize: vertical;"
                            ><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                            <?php if (isset($errors['bio'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['bio'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>


                    <div style="grid-column: span 3; text-align: center;">
                        <button type="submit"
                                style="width: 100%"
                        class="button">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Change Form -->
            <div style="background: #ffffff; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 2rem;">
                <h2 class="subtitle" style="font-size: 1.5rem; font-weight: 600; color: #1a202c; margin-bottom: 1.5rem;">Change Password</h2>
                <form action="/users/change_password" method="post" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #1a202c; margin-bottom: 0.5rem;">
                            Current Password
                            <input class="input" type="password" name="current_password" required
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748;">
                            <?php if (isset($errors['current_password'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['current_password'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #1a202c; margin-bottom: 0.5rem;">
                            New Password
                            <input class="input" type="password" name="password" required
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748;">
                            <?php if (isset($errors['password'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['password'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #1a202c; margin-bottom: 0.5rem;">
                            Confirm Password
                            <input class="input" type="password" name="confirm_password" required
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748;">
                            <?php if (isset($errors['confirm_password'])): ?>
                                <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['confirm_password'] ?></span>
                            <?php endif ?>
                        </label>
                    </div>
                    <div style="grid-column: span 3; text-align: center;">
                        <button type="submit"
                                style="width: 100%"
                                class="button"
                        >
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const fileInput = document.getElementById('file');
        const preview = document.getElementById('preview');

        console.log(fileInput)

        fileInput.addEventListener('change', function () {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result; // Set the image src to the file content
                };

                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });
    </script>

    <link rel="stylesheet" href="/styles/thathsara/thathsara.css">
    <link rel="stylesheet" href="/styles/form.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>