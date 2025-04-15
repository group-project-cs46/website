<?php require base_path('views/partials/auth/auth.php') ?>

    <main>
        <div class="container">
            <div style="padding-bottom:10px">
                <div style="color: var(--gray-700)">
                    <span style="font-size: 2rem">PDC accounts</span>
                </div>
            </div>

            <a href="/admins/pdcs/create">
                <button class="button">
                    Add New PDC Account
                </button>
            </a>

            <div class="grid">
                <div class="grid-header">ID</div>
                <div class="grid-header">Name</div>
                <div class="grid-header">Contact No.</div>
                <div class="grid-header">Email</div>
                <div class="grid-header"></div>
<<<<<<< HEAD:views/admins/pdcs/index.view.php
<!--                <div class="grid-header"></div>-->
=======
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c:views/admin/pdcs/index.view.php
                <?php foreach ($pdcs as $item): ?>
                    <div class="grid-item"><?php echo htmlspecialchars($item['id']); ?></div>
                    <div class="grid-item">
                        <?php echo htmlspecialchars($item['name']); ?>
                    </div>
                    <div class="grid-item">
                        <?php echo htmlspecialchars($item['mobile']); ?>
                    </div>
                    <div class="grid-item">
                        <?php echo htmlspecialchars($item['email'] ?? ''); ?>
                    </div>
                    <div class="grid-item">
                        <form action="/admins/pdcs/disable" method="post">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" class="button" style="background-color: var(--red-700);">Disable</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
    <link rel="stylesheet" href="/styles/admins/pdcs/table.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>