<?php require base_path('views/partials/layouts/guest/open.php') ;?>

    <div style="display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 0.5rem; margin-inline: 0.5rem">
        <?php if ($_SESSION['user'] ?? false) : ?>
            <a href="/dashboard">
                <button type="button" class="button">
                    Dashboard
                </button>
            </a>
        <?php else : ?>
            <a href="/register">
                <?php echo render('components/button.view.php', ['text' => 'Sign up']) ?>
            </a>
            <a href="/login">
                <button type="button" class="button">
                    Log in
                </button>
            </a>
        <?php endif; ?>
    </div>

    <!-- Hero -->
    <div>
        <div style="max-width: 85rem; margin: 0 auto; padding: 6rem 1rem 2.5rem;">
            <!-- Announcement Banner -->
            <div style="display: flex; justify-content: center;">
                <span style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: white; border: 1px solid #e5e7eb; font-size: 0.75rem; color: #6b7280; padding: 0.5rem 0.75rem; border-radius: 9999px; transition: border-color 0.2s; hover:border-color: #d1d5db; focus:border-color: #d1d5db;">
                    Explore Job Opportunities
                </span>
            </div>
            <!-- End Announcement Banner -->

            <!-- Title -->
            <div style="margin-top: 1.25rem; max-width: 36rem; text-align: center; margin-inline: auto;">
                <h1 style="display: block; font-weight: bold; color: #1f2937; font-size: 2.25rem; md:font-size: 3rem; lg:font-size: 3.75rem;">
                    LaunchPad
                </h1>
            </div>
            <!-- End Title -->

            <div style="margin-top: 1.25rem; max-width: 48rem; text-align: center; margin-inline: auto;">
                <p style="font-size: 1.125rem; color: #6b7280;">The University of Colombo School of Computing (UCSC) internship
                    management system is designed to connect undergraduates with valuable internship opportunities.</p>
            </div>

            <!-- Buttons -->
            <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 0.75rem;">
                <a style="display: inline-flex; justify-content: center; align-items: center; gap: 0.75rem; text-align: center; background-color: #0ea5e9; hover:background-color: #0ea5e9; focus:background-color: #0ea5e9; border: 1px solid transparent; color: white; font-size: 0.875rem; font-weight: 500; border-radius: 9999px; padding: 0.75rem 1rem;"
                   href="#">
                    Log in to your account
                </a>
            </div>
            <!-- End Buttons -->
        </div>
    </div>
    <!-- End Hero -->

<?php require base_path('views/partials/layouts/guest/close.php') ?>