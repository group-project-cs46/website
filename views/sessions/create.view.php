<?php require base_path('views/partials/layouts/guest/open.php') ?>

    <section style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1rem;">
        <div style="display: flex; flex-direction: column; align-items: center; max-width: 32rem; width: 100%; margin: 0 auto;">
            <a href="/" style="display: flex; align-items: center; margin-bottom: 2rem; text-decoration: none;">
                <img style="width: 2.5rem; height: 2.5rem; margin-right: 0.75rem;" src="/logo.svg" alt="logo">
                <span style="font-size: 1.75rem; font-weight: 700; color: #0ea5e9;">Launchpad</span>
            </a>
            <div style="width: 100%; background-color: #ffffff; border-radius: 1rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); padding: 2rem; transition: transform 0.3s ease;">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1.5rem; text-align: center;">
                    Welcome Back
                </h1>
                <form style="display: flex; flex-direction: column; gap: 1.5rem;" method="post" action="/sessions">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #1f2937;">
                            Email Address
                            <input type="email" name="email"
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; background-color: #f8fafc; color: #1f2937; font-size: 0.875rem; transition: all 0.2s ease; outline: none;"
                                   placeholder="name@company.com"
                                   required
                                   value="<?= old('email') ?? '' ?>"
                                   onfocus="this.style.borderColor='#0ea5e9'; this.style.boxShadow='0 0 0 3px rgba(14, 165, 233, 0.1)';"
                                   onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            <?php if (isset($errors['email'])): ?>
                                <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;"><?= $errors['email'] ?></p>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #1f2937;">
                            Password
                            <input type="password" name="password"
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; background-color: #f8fafc; color: #1f2937; font-size: 0.875rem; transition: all 0.2s ease; outline: none;"
                                   placeholder="••••••••"
                                   required
                                   value="<?= old('password') ?? '' ?>"
                                   onfocus="this.style.borderColor='#0ea5e9'; this.style.boxShadow='0 0 0 3px rgba(14, 165, 233, 0.1)';"
                                   onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            <?php if (isset($errors['password'])): ?>
                                <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;"><?= $errors['password'] ?></p>
                            <?php endif ?>
                        </label>
                    </div>
                    <button type="submit"
                            style="width: 100%; padding: 0.75rem; background-color: #0ea5e9; color: white; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer; transition: background-color 0.2s ease; outline: none;"
                            onmouseover="this.style.backgroundColor='#0284c7';"
                            onmouseout="this.style.backgroundColor='#0ea5e9';">
                        Sign In
                    </button>
                    <div style="text-align: center; font-size: 0.875rem; color: #6b7280;">
                        Forgot your password?
                        <a href="/forgot_password"
                           style="color: #0ea5e9; font-weight: 600; text-decoration: none; transition: color 0.2s ease;"
                           onmouseover="this.style.color='#0284c7'; this.style.textDecoration='underline';"
                           onmouseout="this.style.color='#0ea5e9'; this.style.textDecoration='none';">
                            Reset it
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php require base_path('views/partials/layouts/guest/close.php') ?>