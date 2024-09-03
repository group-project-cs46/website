<?php require base_path('views/partials/layouts/guest/open.php') ?>

<section>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-800">
            <img class="w-8 h-8 mr-2" src="/logo.svg" alt="logo">
            Launchpad
        </a>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 bg-gray-100 border-gray-300">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Create your account
                </h1>
                <form class="space-y-4 md:space-y-6" method="post">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Your email
                            <input
                                    type="email"
                                    name="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-sky-600 focus:border-sky-600 block w-full p-2.5"
                                    placeholder="name@company.com" required
                                    value="<?= old('email') ?? '' ?>"
                            >
                            <?php if (isset($errors['email'])) : ?>
                                <p class="text-rose-700 text-xs"><?= $errors['email'] ?></p>
                            <?php endif ?>
                        </label>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Password
                            <input type="password"
                                   name="password"
                                   placeholder="••••••••"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-sky-600 focus:border-sky-600 block w-full p-2.5"
                                   required=""
                                   value="<?= old('password') ?? '' ?>"
                            >
                            <?php if (isset($errors['password'])) : ?>
                                <p class="text-rose-700 text-xs"><?= $errors['password'] ?></p>
                            <?php endif ?>
                        </label>
                    </div>
                    <button type="submit"
                            class="w-full text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Register
                    </button>
                    <p class="text-sm font-light text-gray-500">
                        Already have an account ?
                        <a href="/login"
                           class="font-medium text-sky-600 hover:underline">
                            Log in
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>


<?php require base_path('views/partials/layouts/guest/close.php') ?>