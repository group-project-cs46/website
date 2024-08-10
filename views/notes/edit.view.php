<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

    <main class="container">
        <h1 class="is-size-3">Create a note</h1>

        <form action="/note" method="post">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <label>
                Body
                <textarea class="textarea" name="body" placeholder="e.g. Hello world"><?= $note['body'] ?? '' ?></textarea>
                <?php if (isset($errors['body'])) : ?>
                    <p class="help is-danger"><?= $errors['body'] ?></p>
                <?php endif ?>
            </label>

            <button type="submit" class="button is-link">Update</button>
        </form>

        <form method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <button type="submit" class="button is-danger">Delete</button>
        </form>

        <a href="/note?id=<?= $note['id'] ?>">Cancel</a>
    </main>

<?php require base_path('views/partials/foot.php') ?>