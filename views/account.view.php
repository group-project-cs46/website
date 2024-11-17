<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="margin-top: 4rem">
        <div class="container">
            <h1 class="title">Account Information</h1>
            <div class="info">
                <label class="label">Name:</label>
                <p class="text"><?= htmlspecialchars($user['name']) ?></p>
            </div>
            <div class="info">
                <label class="label">Email:</label>
                <p class="text"><?= htmlspecialchars($user['email']) ?></p>
            </div>

            <?php if ($user['role'] === 2) : ?>
                <div class="cv-section">
                    <h2 class="subtitle">Your CVs</h2>
                    <?php if ($cvs) : ?>
                    <?php foreach ($cvs as $cv) : ?>
                        <div class="cv" style="display: flex; gap: 1rem; align-items: center">
                            <span class=""><?= $cv['original_name'] ?></span>
                            <form action="/cv/delete" method="POST">
                                <input type="hidden" name="id" value="<?= $cv['id'] ?>">
                                <button type="submit" class="button small" style="background-color: maroon">
                                    Delete
                                </button>
                            </form>
                        </div>
                    <?php endforeach ?>
<!--                        <div class="cv-download">-->
<!--                            <form action="/cv/show" method="GET">-->
<!--                                <input type="hidden" name="id" value="--><?php //= $cv['id'] ?><!--">-->
<!--                                <button type="submit" class="download-button">-->
<!--                                    Download CV-->
<!--                                </button>-->
<!--                            </form>-->
<!--                        </div>-->
                    <?php else : ?>
                        You have no uploaded CVs
                    <?php endif ?>
                    <form action="/cv/store" method="POST" enctype="multipart/form-data" class="upload-form" style="margin-top: 1rem">
                        <div>
                            <label for="cv" class="label">Choose CV:</label>
                            <input type="file" name="cv" id="cv" class="file-input">
                            <?php if (isset($errors['cv'])) : ?>
                                <p class="error"><?= $errors['cv'] ?></p>
                            <?php endif ?>
                        </div>
                        <div>
                            <button type="submit" class="button">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif ?>

        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>