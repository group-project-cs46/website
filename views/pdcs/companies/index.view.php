<?php require base_path('views/partials/auth/auth.php') ?>

    <main>
        <div class="container">
            <div style="padding-bottom:10px">
                <div style="color: var(--gray-700)">
                    <span style="font-size: 2rem">Applications</span>
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr auto">
                <div class="grid-header">Name</div>
                <div class="grid-header">Address</div>
                <div class="grid-header">Email</div>
                <div class="grid-header">Mobile</div>
                <div class="grid-header">Website</div>
                <div class="grid-header">Approved</div>
                <?php foreach ($companies as $item): ?>
                    <div class="grid-item"><?php echo htmlspecialchars($item['company_name']); ?></div>
                    <div class="grid-item">
                        <?php echo htmlspecialchars($item['building']); ?>,
                        <?php echo htmlspecialchars($item['street_name']); ?>,
                        <?php if ($item['address_line_2']) : ?>
                            <?php echo htmlspecialchars($item['address_line_2']); ?>,
                        <?php endif; ?>
                        <?php echo htmlspecialchars($item['city']); ?>
                    </div>
                    <div class="grid-item"><?php echo htmlspecialchars($item['email']); ?></div>
                    <div class="grid-item"><?php echo htmlspecialchars($item['mobile'] ?? '-'); ?></div>
                    <div class="grid-item">
                        <?php if ($item['website']): ?>
                            <a href="<?php echo htmlspecialchars($item['website']); ?>" target="_blank">
                                <?php echo htmlspecialchars($item['website']); ?>
                            </a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>
                    <div class="grid-item" style="text-align: right">
                        <?php if ($item['approved']): ?>
                            <i class="fa-solid fa-check text-green-500"></i>
                        <?php else: ?>
                            <!--                            approve button-->
                            <form action="/pdcs/companies/approve" method="post">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="button">
                                    Approve
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
    <link rel="stylesheet" href="/styles/students/table.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>