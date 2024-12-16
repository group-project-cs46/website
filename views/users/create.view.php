<?php require base_path('views/partials/layouts/guest/open.php') ?>

    <link rel="stylesheet" href="/styles/thathsara/thathsara3.css">

    <section>
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem 1.5rem; margin: auto; height: 100vh;">
            <a href="/" style="display: flex; align-items: center; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: 600; color: var(--gray-800)">
                <img style="width: 2rem; height: 2rem; margin-right: 0.5rem;" src="/logo.svg" alt="logo">
                Launchpad
            </a>
            <div style="width: 100%; background-color: #f7fafc; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); margin-top: 0; max-width: 28rem; padding: 0;">
                <div style="padding: 1.5rem; space-y: 1rem;">
                    <h1 style="font-size: 1.25rem; font-weight: 700; line-height: 1.25; color: var(--gray-800)">
                        Create Your Company Account
                    </h1>
                    <form style="space-y: 1rem;" method="post">
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                Email
                                <input type="email" name="email" placeholder="name@company.com" required value="<?= old('email') ?? '' ?>">
                                <?php if (isset($errors['email'])): ?>
                                    <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['email'] ?></span>
                                <?php endif ?>
                            </label>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                Password
                                <input type="password" name="password" placeholder="••••••••" required value="<?= old('password') ?? '' ?>">
                                <?php if (isset($errors['password'])): ?>
                                    <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['password'] ?></span>
                                <?php endif ?>
                            </label>
                        </div>

                        <div style="padding-block: 1rem">
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Company Name
                                    <input type="text" name="name" placeholder="Xpert" required value="<?= old('name') ?? '' ?>">
                                    <?php if (isset($errors['name'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['name'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>


                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Building Number or Name
                                    <input type="text" name="building" placeholder="232/B" required value="<?= old('building') ?? '' ?>">
                                    <?php if (isset($errors['building'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['building'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Street Name
                                    <input type="text" name="street_name" placeholder="T B Jaya Mawatha" required value="<?= old('street_name') ?? '' ?>">
                                    <?php if (isset($errors['street_name'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['street_name'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Address Line 2
                                    <input type="text" name="address_line_2" placeholder="Optional" value="<?= old('address_line_2') ?? '' ?>">
                                    <?php if (isset($errors['address_line_2'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['address_line_2'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    City
                                    <input type="text" name="city" placeholder="Colombo" required value="<?= old('city') ?? '' ?>">
                                    <?php if (isset($errors['city'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['city'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>

                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                    Postal Code
                                    <input type="text" name="postal_code" placeholder="10100" required value="<?= old('postal_code') ?? '' ?>">
                                    <?php if (isset($errors['postal_code'])): ?>
                                        <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['postal_code'] ?></span>
                                    <?php endif ?>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                                Website
                                <input type="text" name="website" placeholder="https://company.com" required value="<?= old('website') ?? '' ?>">
                                <?php if (isset($errors['website'])): ?>
                                    <span style="color: #e11d48; font-size: 0.75rem;"><?= $errors['website'] ?></span>
                                <?php endif ?>
                            </label>
                        </div>
                        <button type="submit" class="button" style="width: 100%; ">
                            Sign Up
                        </button>
                        <p style="font-size: 0.875rem; font-weight: 300; color: #6b7280;">
                            Already have an account?
                            <a href="/login" style="font-weight: 500; color: #0284c7; hover:underline;">
                                Log In
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php require base_path('views/partials/layouts/guest/close.php') ?>