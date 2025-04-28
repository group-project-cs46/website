<?php require base_path('views/partials/auth/auth.php') ?>


<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-calendar-plus" style="font-size: 40px;"></i>
            <h2><b>Round Management</b></h2>
        </div>
    </header>

    <div class="content" style="padding-inline: 1rem; margin-top: 1rem">
        <div style="display: flex; gap: 10px; justify-content: end">

            
                <button>
                <a href="/pdcs/batches/create" class="button">
                    Start A New Internship Process
                    </a>
                </button>
            
        </div>

        <div class="grid" style="grid-template-columns: auto 1fr 1fr 1fr 1fr 1fr auto auto;">
            <div class="grid-header">ID</div>
            <div class="grid-header">First Round Start Time</div>
            <div class="grid-header">First Round End Time</div>
            <div class="grid-header">Second Round Start Time</div>
            <div class="grid-header">Second Round End Time</div>
            <div class="grid-header">Description</div>
            <div class="grid-header"></div>
            <div class="grid-header"></div>
            <?php foreach ($batches as $item): ?>
                <div class="grid-item"><?php echo htmlspecialchars($item['id']); ?></div>
                <div class="grid-item"><?php echo htmlspecialchars($item['first_round_start_time']); ?></div>
                <div class="grid-item"><?php echo htmlspecialchars($item['first_round_end_time'] ?? 'Not Set'); ?></div>
                <div class="grid-item"><?php echo htmlspecialchars($item['second_round_start_time'] ?? 'Not Set'); ?></div>
                <div class="grid-item"><?php echo htmlspecialchars($item['second_round_end_time'] ?? 'Not Set'); ?></div>
                <div class="grid-item"><?php echo htmlspecialchars($item['description'] ?? 'Not Set'); ?></div>
                <div class="grid-item">
                    <a href="/pdcs/batches/edit?id=<?= $item['id'] ?>"
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
<link rel="stylesheet" href="/styles/PDC/Rounds.css">


<?php require base_path('views/partials/auth/auth-close.php') ?>
