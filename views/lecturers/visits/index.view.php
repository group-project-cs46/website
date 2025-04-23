<?php require base_path('views/partials/auth/auth.php') ?>

<main>
    <div class="grid" style="grid-template-columns: auto 1fr 1fr 1fr 1fr;">
        <div class="grid-header">ID</div>
        <div class="grid-header">Company</div>
        <div class="grid-header">Date</div>
        <div class="grid-header">Time</div>
        <div class="grid-header">Status</div>
        <?php foreach ($lecturer_visits as $item): ?>
            <div class="grid-item"><?= $item['id'] ?></div>
            <div class="grid-item">
                <a href="/lecturers/visits/show?id=<?= $item['id'] ?>">
                    <?= htmlspecialchars($item['company_name']) ?>
                </a>
            </div>
            <div class="grid-item"><?= date('d-m-Y', strtotime($item['date'])) ?></div>
            <div class="grid-item"><?= date('H:i', strtotime($item['time'])) ?></div>
            <div class="grid-item"><?= ucwords($item['status']) ?></div>
        <?php endforeach; ?>
    </div>
</main>


<link rel="stylesheet" href="/styles/students/table.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>