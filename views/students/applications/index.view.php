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
<<<<<<< HEAD
=======
            <div class="grid-header">Status</div>
            <div class="grid-header">Cv Sent</div>
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
            <div class="grid-header"></div>
            <div class="grid-header"></div>
            <?php foreach ($applications as $application): ?>
                <div class="grid-item"><?php echo htmlspecialchars($application['id']); ?></div>
<<<<<<< HEAD
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
=======
                <div class="grid-item">
                    <a href="/students/applications/show?id=<?= $application['id'] ?>">
                        <?php echo htmlspecialchars($application['job_role']); ?>
                    </a>
                </div>
                <div class="grid-item">
                    <?php if ($application['interview_complete']): ?>
                        <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Completed</span>
                    <?php elseif (!empty($application['interview_date'])): ?>
                        <?php echo htmlspecialchars($application['interview_date']) ?>
                    <?php else: ?>
                        <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Soon</span>
                    <?php endif; ?>
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
                </div>
                <div class="grid-item">
                    <?php echo htmlspecialchars($application['name'] ?? ''); ?>
                </div>
                <div class="grid-item">
<<<<<<< HEAD
=======
                    <?php if ($application['selected']): ?>
                        <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Selected</span>
                    <?php elseif ($application['failed']): ?>
                        <span style="background-color: var(--red-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Failed</span>
                    <?php else: ?>
                        <span style="background-color: var(--sky-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Pending</span>
                    <?php endif; ?>
                </div>
                <div class="grid-item">
                    <?= htmlspecialchars($application['cv_name'] ?? ''); ?>
                </div>
                <div class="grid-item">
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
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