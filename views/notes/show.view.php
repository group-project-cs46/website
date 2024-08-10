<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main>
    <a href="/notes" class="button">Back</a>
    <?= htmlspecialchars($note['body']) ?>
    <a href="/note/edit?id=<?= $note['id'] ?>" class="button">Edit</a>
</main>

<?php require base_path('views/partials/foot.php') ?>

