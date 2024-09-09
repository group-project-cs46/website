<?php require base_path('views/partials/auth/auth.php') ?>

<main class="p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Account Information</h1>
        <div class="mb-4">
            <label class="block text-gray-700">Name:</label>
            <p class="text-lg"><?= htmlspecialchars($user['name']) ?></p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Email:</label>
            <p class="text-lg"><?= htmlspecialchars($user['email']) ?></p>
        </div>

        <?php if ($user['role'] === 2) : ?>
            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">CV</h2>
<!--                <div class="mb-4">-->
<!--                    <a href="/storage/cv/" class="text-blue-500">Download CV</a>-->
<!--                </div>-->
                <form action="/cv/store" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="cv" class="block text-gray-700">Choose CV:</label>
                        <input type="file" name="cv" id="cv" class="mt-1 block w-full">
                        <?php if (isset($errors['cv'])) : ?>
                            <p class="text-rose-700 text-xs"><?= $errors['cv'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        <?php endif ?>

    </div>
</main>


<?php require base_path('views/partials/auth/auth-close.php') ?>
