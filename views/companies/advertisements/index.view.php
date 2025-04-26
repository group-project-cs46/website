<?php require base_path('views/partials/auth/auth.php') ?>

<main>
    <div style="padding-inline: 1rem; margin-top: 1rem">
        <div>
            <div style="font-size: 2rem; font-weight: bold">
                <span>Create Advertisements</span>
            </div>
            <span style="color: var(--gray-500)">
                Create and manage your advertisements here.
            </span>
        </div>

        <div style="display: flex; gap: 10px; justify-content: start; margin-top: 1rem">
            <a href="/companies/advertisements/create" class="button">
                <button>
                    Create
                </button>
            </a>
        </div>

        <div class="grid" style="grid-template-columns: auto 1fr 1fr 1fr 1fr 1fr auto;">
            <div class="grid-header">ID</div>
            <div class="grid-header">Role</div>
            <div class="grid-header">Deadline</div>
            <div class="grid-header">Maximum Resumes</div>
            <div class="grid-header">Vacancy Count</div>
            <div class="grid-header">Approved</div>
            <div class="grid-header"></div>
            <?php foreach ($advertisements as $item): ?>
                <div class="grid-item"><?= $item['id'] ?></div>
                <div class="grid-item">
                    <a href="/companies/advertisements/edit?id=<?= $item['id'] ?>">
                        <?= $item['internship_role'] ?>
                    </a>
                </div>
                <div class="grid-item"><?= $item['deadline'] ?></div>
                <div class="grid-item"><?= $item['max_cvs'] ?></div>
                <div class="grid-item"><?= $item['vacancy_count'] ?></div>
                <div class="grid-item"><?= $item['approved'] ? 'Yes' : 'No' ?></div>
                <div class="grid-item">
                    <form action="/companies/advertisements/delete" method="post" onsubmit="return confirmDeletion(<?= $item['id'] ?>, '<?= htmlspecialchars($item['internship_role']) ?>')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" class="button" style="background-color: var(--red-700);">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<script>
    function confirmDeletion(id, role) {
        return confirm(`Are you sure you want to delete the advertisement for "${role}"?.`);
    }
</script>

<link rel="stylesheet" href="/styles/select.css">
<link rel="stylesheet" href="/styles/table.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>