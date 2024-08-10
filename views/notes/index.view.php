<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

    <main class="container">
        <ul>
            <?php foreach ($notes as $note) : ?>
                <li>
                    <a href="/note?id=<?= $note['id'] ?>">
                        <?= htmlspecialchars($note['body']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="/notes/create" class="button">Create Note</a>

    </main>

<?php require base_path('views/partials/foot.php') ?>

