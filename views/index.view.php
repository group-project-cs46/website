<?php require base_path('views/partials/layouts/guest/open.php') ?>

    <div class="flex justify-end gap-2">
        <?php if ($_SESSION['user'] ?? false) : ?>
        <?php else : ?>
            <a href="/register" class="button is-primary">
                <?php echo render('components/button.view.php', ['text' => 'Sign up']) ?>
            </a>
            <a href="/login">
                <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-500 hover:border-sky-500 hover:text-sky-500 focus:outline-none focus:border-sky-500 focus:text-sky-500 disabled:opacity-50 disabled:pointer-events-none">
                    Log in
                </button>
            </a>
        <?php endif; ?>
    </div>

    <!-- Hero -->
    <div>
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
            <!-- Announcement Banner -->
            <div class="flex justify-center">
                <span class="inline-flex items-center gap-x-2 bg-white border border-gray-200 text-xs text-gray-600 p-2 px-3 rounded-full transition hover:border-gray-300 focus:outline-none focus:border-gray-300"
                >
                    Explore Job Opportunities
                </span>
            </div>
            <!-- End Announcement Banner -->

            <!-- Title -->
            <div class="mt-5 max-w-xl text-center mx-auto">
                <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl">
                    LaunchPad
                </h1>
            </div>
            <!-- End Title -->

            <div class="mt-5 max-w-3xl text-center mx-auto">
                <p class="text-lg text-gray-600">The University of Colombo School of Computing (UCSC) internship
                    management system is designed to connect undergraduates with valuable internship opportunities.</p>
            </div>

            <!-- Buttons -->
            <div class="mt-8 gap-3 flex justify-center">
                <a class="inline-flex justify-center items-center gap-x-3 text-center bg-sky-500 hover:from-sky-500 hover:to-sky-500 focus:outline-none focus:from-sky-500 focus:to-sky-500 border border-transparent text-white text-sm font-medium rounded-full py-3 px-4"
                   href="#">
                    Log in to your account
                </a>
            </div>
            <!-- End Buttons -->
        </div>
    </div>
    <!-- End Hero -->


<?php require base_path('views/partials/layouts/guest/close.php') ?>
