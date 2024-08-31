<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

    <main class="container">
        <h1 class="is-size-3">Create a note</h1>

        <form action="/notes" method="post">
            <label>
                Body
                <textarea class="textarea" name="body" placeholder="e.g. Hello world"><?= $_POST['body'] ?? '' ?></textarea>
                <?php if (isset($errors['body'])) : ?>
                    <p class="help is-danger"><?= $errors['body'] ?></p>
                <?php endif ?>
            </label>

            <button type="submit" class="button is-link">Create</button>
        </form>
    </main>

<?php require base_path('views/partials/foot.php') ?>