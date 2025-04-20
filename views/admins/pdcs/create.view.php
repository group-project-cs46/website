<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="max-width: 480px; margin: 0 auto; padding: 32px 16px;">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1a202c; margin-bottom: 24px; text-align: center;">
            Create a New PDC Account
        </h1>

        <div style="background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 24px;">
            <form method="POST"
                  action="/admins/pdcs/store"
                  style="display: flex; flex-direction: column; gap: 24px;"
            >
                <!-- Name Field -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                        Name
                        <input
                                type="text"
                                name="name"
                                placeholder="John Doe"
                                required
                                value="<?= old('name') ?? '' ?>"
                                style="margin-top: 4px; width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; color: #1a202c; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#0ea5e9';"
                                onblur="this.style.borderColor='#d1d5db';"
                        >
                        <?php if (isset($errors['name'])): ?>
                            <span style="color: #dc2626; font-size: 0.75rem;"><?= $errors['name'] ?></span>
                        <?php endif ?>
                    </label>
                </div>

                <!-- Email Field -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                        Email
                        <input
                                type="email"
                                name="email"
                                placeholder="name@company.com"
                                required
                                value="<?= old('email') ?? '' ?>"
                                style="margin-top: 4px; width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; color: #1a202c; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#0ea5e9';"
                                onblur="this.style.borderColor='#d1d5db';"
                        >
                        <?php if (isset($errors['email'])): ?>
                            <span style="color: #dc2626; font-size: 0.75rem;"><?= $errors['email'] ?></span>
                        <?php endif ?>
                    </label>
                </div>

                <!-- Password Field -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                        Password
                        <input
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                value="<?= old('password') ?? '' ?>"
                                style="margin-top: 4px; width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; color: #1a202c; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#0ea5e9';"
                                onblur="this.style.borderColor='#d1d5db';"
                        >
                        <?php if (isset($errors['password'])): ?>
                            <span style="color: #dc2626; font-size: 0.75rem;"><?= $errors['password'] ?></span>
                        <?php endif ?>
                    </label>
                </div>

                <!-- Mobile Field -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                        Mobile
                        <input
                                type="tel"
                                name="mobile"
                                placeholder="+9477567890"
                                required
                                value="<?= old('mobile') ?? '' ?>"
                                style="margin-top: 4px; width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; color: #1a202c; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#0ea5e9';"
                                onblur="this.style.borderColor='#d1d5db';"
                        >
                        <?php if (isset($errors['mobile'])): ?>
                            <span style="color: #dc2626; font-size: 0.75rem;"><?= $errors['mobile'] ?></span>
                        <?php endif ?>
                    </label>
                </div>

                <!-- Submit Button -->
                <button class="button" type="submit">
                    Create Account
                </button>
            </form>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>