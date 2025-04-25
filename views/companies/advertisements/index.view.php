<?php require base_path('views/partials/auth/auth.php') ?>


<main>
    <div style="padding-inline: 1rem; margin-top: 1rem">
        <div style="display: flex; gap: 10px; justify-content: end">

            <a href="/companies/advertisements/create" class="button">
                <button>
                    Create
                </button>
            </a>
        </div>

        <div class="grid" style="grid-template-columns: auto 1fr 1fr 1fr 1fr 1fr auto auto;">
            <div class="grid-header">ID</div>
            <div class="grid-header">Role</div>
            <div class="grid-header">Deadline</div>
            <div class="grid-header">Maximum Resumes</div>
            <div class="grid-header">Vacancy Count</div>
            <div class="grid-header">Approved</div>
            <div class="grid-header"></div>
            <div class="grid-header"></div>
            <?php foreach ($advertisements as $item): ?>
                <div class="grid-item"><?= $item['id'] ?></div>
                <div class="grid-item">
                    <a href="/companies/advertisements/show?id=<?= $item['id'] ?>">
                        <?= $item['internship_role'] ?>
                    </a>
                </div>
                <div class="grid-item"><?= $item['deadline'] ?></div>
                <div class="grid-item"><?= $item['max_cvs'] ?></div>
                <div class="grid-item"><?= $item['vacancy_count'] ?></div>
                <div class="grid-item"><?= $item['approved'] ? 'Yes' : 'No' ?></div>
                <div class="grid-item">
                    <a href="/companies/advertisements/edit?id=<?= $item['id'] ?>"
                       style="color: var(--sky-700);">Edit</a>
                </div>
                <div class="grid-item">
                    <form action="/pdcs/batches/delete" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" class="button" style="background-color: var(--red-700);">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<link rel="stylesheet" href="/styles/select.css">
<link rel="stylesheet" href="/styles/table.css">


<?php require base_path('views/partials/auth/auth-close.php') ?>
