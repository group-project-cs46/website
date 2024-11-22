<?php require base_path('views/partials/layouts/guest/open.php') ?>

<link rel="stylesheet" href="/styles/thathsara/thathsara3.css">

<section>
    <div
        style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem 1.5rem; margin: auto; height: 100vh;">
        <a href="/"
            style="display: flex; align-items: center; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: 600; color: var(--gray-800)">
            <img style="width: 2rem; height: 2rem; margin-right: 0.5rem;" src="/logo.svg" alt="logo">
            Launchpad
        </a>
        <div
            style="width: 100%; background-color: #f7fafc; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); margin-top: 0; max-width: 28rem; padding: 0;">
            <div style="padding: 1.5rem; space-y: 1rem;">
                <h1 style="font-size: 1.25rem; font-weight: 700; line-height: 1.25; color: var(--gray-800)">
                    Sign in to your account
                </h1>
                <form style="space-y: 1rem;" method="post" action="/sessions">
                    <div>
                        <label
                            style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                            Your email
                            <input type="email" name="email" style="
                                        background-color: #fff;
                                        border: 1px solid #d1d5db;
                                        color: #1a202c;
                                        border-radius: 0.5rem;
                                        focus:ring: #0284c7;
                                        focus:border: #0284c7;
                                        display: block; width: 100%; 
                                        padding: 0.625rem;" placeholder="name@company.com" required
                                value="<?= old('email') ?? '' ?>">
                            <?php if (isset($errors['email'])): ?>
                                <p style="color: #e11d48; font-size: 0.75rem;"><?= $errors['email'] ?></p>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label
                            style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #1a202c;">
                            Password
                            <input type="password" name="password" placeholder="••••••••"
                                style="background-color: #fff; border: 1px solid #d1d5db; color: #1a202c; border-radius: 0.5rem; focus:ring: #0284c7; focus:border: #0284c7; display: block; width: 100%; padding: 0.625rem;"
                                required="" value="<?= old('password') ?? '' ?>">
                            <?php if (isset($errors['password'])): ?>
                                <p style="color: #e11d48; font-size: 0.75rem;"><?= $errors['password'] ?></p>
                            <?php endif ?>
                        </label>
                    </div>
                    <button type="submit" class="button" style="width: 100%; ">
                        Sign in
                    </button>
                    <p style="font-size: 0.875rem; font-weight: 300; color: #6b7280;">
                        Don’t have an account yet?
                        <a href="/register" style="font-weight: 500; color: #0284c7; hover:underline;">
                            Sign up
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require base_path('views/partials/layouts/guest/close.php') ?>