<?php require base_path('views/partials/layouts/guest/open.php') ?>

    <section>
        <div class="container">
            <a href="/" class="logo">
                <img class="logo-img" src="/logo.svg" alt="logo">
                Launchpad
            </a>
            <div class="form-container">
                <div class="form-content">
                    <h1 class="form-title">
                        Create your account
                    </h1>
                    <form class="form" method="post">
                        <div>
                            <label class="form-label">
                                Your email
                                <input
                                        type="email"
                                        name="email"
                                        class="form-input"
                                        placeholder="name@company.com" required
                                        value="<?= old('email') ?? '' ?>"
                                >
                                <?php if (isset($errors['email'])) : ?>
                                    <p class="error-text"><?= $errors['email'] ?></p>
                                <?php endif ?>
                            </label>
                        </div>
                        <div>
                            <label class="form-label">
                                Password
                                <input type="password"
                                       name="password"
                                       placeholder="••••••••"
                                       class="form-input"
                                       required=""
                                       value="<?= old('password') ?? '' ?>"
                                >
                                <?php if (isset($errors['password'])) : ?>
                                    <p class="error-text"><?= $errors['password'] ?></p>
                                <?php endif ?>
                            </label>
                        </div>
                        <button type="submit"
                                class="submit-button">
                            Register
                        </button>
                        <p class="login-text">
                            Already have an account ?
                            <a href="/login"
                               class="login-link">
                                Log in
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

<link rel="stylesheet" href="/styles/thathsara/thathsara2.css">

<?php require base_path('views/partials/layouts/guest/close.php') ?>