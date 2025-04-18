<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="display: flex; justify-content: center; padding: 20px;">
        <div class="container" style="max-width: 900px; width: 100%;">
            <div style="background: #ffffff; border-radius: 16px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); padding: 32px; display: flex; gap: 40px; flex-wrap: wrap;">
                <!-- Left Section: User Info -->
                <div style="flex: 1; min-width: 300px;">
                    <h2 style="font-size: 24px; font-weight: 600; color: #1e293b; margin-bottom: 24px;">Company Details</h2>

                    <!-- Name -->
                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <label style="font-size: 14px; font-weight: 500; color: #64748b; width: 120px;">Name:</label>
                        <p style="font-size: 16px; color: #1e293b; margin: 0;"><?= htmlspecialchars($user['name']) ?></p>
                    </div>

                    <!-- Email -->
                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <label style="font-size: 14px; font-weight: 500; color: #64748b; width: 120px;">Email:</label>
                        <p style="font-size: 16px; color: #1e293b; margin: 0;"><?= htmlspecialchars($user['email']) ?></p>
                    </div>

                    <!-- Mobile -->
                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <label style="font-size: 14px; font-weight: 500; color: #64748b; width: 120px;">Mobile:</label>
                        <p style="font-size: 16px; color: #1e293b; margin: 0;"><?= htmlspecialchars($user['mobile'] ?? 'Not provided') ?></p>
                    </div>

                    <!-- Website -->
                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <label style="font-size: 14px; font-weight: 500; color: #64748b; width: 120px;">Website:</label>
                        <p style="font-size: 16px; margin: 0;">
                            <?php if (!empty($user['website'])): ?>
                                <a href="<?= htmlspecialchars($user['website']) ?>" target="_blank" style="color: #0ea5e9; text-decoration: none; transition: color 0.2s;"><?= htmlspecialchars($user['website']) ?></a>
                            <?php else: ?>
                                <span style="color: #64748b;">Not provided</span>
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- LinkedIn -->
                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <label style="font-size: 14px; font-weight: 500; color: #64748b; width: 120px;">LinkedIn:</label>
                        <p style="font-size: 16px; margin: 0;">
                            <?php if (isset($user['linkedin']) && !empty($user['linkedin'])): ?>
                                <a href="<?= htmlspecialchars($user['linkedin']) ?>" target="_blank" style="color: #0ea5e9; text-decoration: none; transition: color 0.2s;"><?= htmlspecialchars($user['linkedin']) ?></a>
                            <?php else: ?>
                                <span style="color: #64748b;">Not provided</span>
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- Address -->
                    <div style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                        <label style="font-size: 14px; font-weight: 500; color: #64748b; width: 120px;">Address:</label>
                        <p style="font-size: 16px; color: #1e293b; margin: 0;">
                            <?php
                            $addressParts = array_filter([
                                $user['building'] ?? null,
                                $user['street_name'] ?? null,
                                $user['city'] ?? null,
                                $user['postal_code'] ?? null,
                                $user['address_line_2'] ?? null
                            ]);
                            echo !empty($addressParts) ? htmlspecialchars(implode(', ', $addressParts)) : '<span style="color: #64748b;">Not provided</span>';
                            ?>
                        </p>
                    </div>

                    <!-- Index Number (Conditional) -->
                    <?php if (isset($user['index_number'])): ?>
                        <div style="display: flex; align-items: center; margin-bottom: 20px;">
                            <label style="font-size: 14px; font-weight: 500; color: #64748b; width: 120px;">Index Number:</label>
                            <p style="font-size: 16px; color: #1e293b; margin: 0;"><?= htmlspecialchars($user['index_number']) ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Registration Number (Conditional) -->
                    <?php if (isset($user['registration_number'])): ?>
                        <div style="display: flex; align-items: center; margin-bottom: 20px;">
                            <label style="font-size: 14px; font-weight: 500; color: #64748b; width: 120px;">Registration Number:</label>
                            <p style="font-size: 16px; color: #1e293b; margin: 0;"><?= htmlspecialchars($user['registration_number']) ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Section: Profile Picture -->
                <div style="display: flex; flex-direction: column; align-items: center; min-width: 200px;">
                    <img src="<?= htmlspecialchars($photo) ?>" alt="Profile Picture" id="profilePic"
                         style="width: 160px; height: 160px; border-radius: 50%; object-fit: cover; border: 4px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); margin-bottom: 16px; transition: transform 0.3s;"
                         onmouseover="this.style.transform='scale(1.05)'"
                         onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>