<?php require base_path('views/partials/auth/auth.php') ?>



<main>
    <div class="container">
        <div style="padding-bottom:10px">
            <div style="color: var(--gray-700)">
                <span style="font-size: 2rem">Applications</span>
            </div>
        </div>

        <div class="grid">
            <div class="grid-header">ID</div>
            <div class="grid-header">Role</div>
            <div class="grid-header">Interview</div>
            <div class="grid-header">Company</div>
            <div class="grid-header"></div>
            <div class="grid-header"></div>
            <?php foreach ($applications as $application): ?>
                <div class="grid-item"><?php echo htmlspecialchars($application['id']); ?></div>
                <div class="grid-item"><?php echo htmlspecialchars($application['job_role']); ?>
                </div>
                <div class="grid-item">
                    <?php
                    if (!empty($application['interview_date'])) {
                        echo htmlspecialchars($application['interview_date']);
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </div>
                <div class="grid-item">
                    <?php echo htmlspecialchars($application['name'] ?? ''); ?>
                </div>
                <div class="grid-item">
                    <a href="/students/applications/edit?id=<?= $application['id'] ?>"
                        style="color: var(--sky-700);">Edit</a>
                </div>
                <div class="grid-item">
                    <form action="/students/applications/delete" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $application['id'] ?>">
                        <button type="submit" class="button" style="background-color: var(--red-700);">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
<link rel="stylesheet" href="/styles/students/applications/table.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>