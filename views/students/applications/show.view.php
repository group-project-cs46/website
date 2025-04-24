<?php require base_path('views/partials/auth/auth.php') ?>

    <main class="container">
        <div style="padding-bottom:10px">
            <div style="color: var(--gray-700)">
                <span style="font-size: 2rem">Application Overview</span>
            </div>
        </div>

        <div style="max-width: 1200px; margin: 2rem auto; padding: 0 1rem;">
            <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; justify-content: center;">
                <!-- Job Description Card -->
                <div style="flex: 1; min-width: 300px; max-width: 340px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 1.5rem; transition: transform 0.2s;">
                    <h2 style="color: #0ea5e9; font-size: 1.5rem; font-weight: 600; margin: 0 0 1rem 0;">Job Description</h2>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <p style="margin: 0; color: #6b7280; font-size: 1rem; line-height: 1.5;"><strong>Role:</strong> <?= htmlspecialchars($ad['internship_role']) ?></p>
                        <p style="margin: 0; color: #6b7280; font-size: 1rem; line-height: 1.5;"><strong>Responsibilities:</strong> <?= htmlspecialchars($ad['responsibilities']) ?></p>
                        <p style="margin: 0; color: #6b7280; font-size: 1rem; line-height: 1.5;"><strong>Qualifications:</strong> <?= htmlspecialchars($ad['qualifications_skills']) ?></p>
                    </div>
                </div>

                <!-- Company Details Card -->
                <div style="flex: 1; min-width: 300px; max-width: 340px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 1.5rem; transition: transform 0.2s;">
                    <h2 style="color: #0ea5e9; font-size: 1.5rem; font-weight: 600; margin: 0 0 1rem 0;">Company Details</h2>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <p style="margin: 0; color: #6b7280; font-size: 1rem; line-height: 1.5;"><strong>Website:</strong> <a href="<?= htmlspecialchars($company['website']) ?>" target="_blank" style="color: #0ea5e9; text-decoration: none;"><?= htmlspecialchars($company['website']) ?></a></p>
                        <p style="margin: 0; color: #6b7280; font-size: 1rem; line-height: 1.5;"><strong>Address:</strong></p>
                        <div style="margin-left: 1rem; color: #6b7280; font-size: 1rem; line-height: 1.5;">
                            <p style="margin: 0;"><?= htmlspecialchars($company['building']) ?></p>
                            <p style="margin: 0;"><?= htmlspecialchars($company['street_name']) ?></p>
                            <p style="margin: 0;"><?= htmlspecialchars($company['address_line_2'] ?? '') ?></p>
                            <p style="margin: 0;"><?= htmlspecialchars($company['city']) ?>, <?= htmlspecialchars($company['postal_code']) ?></p>
                        </div>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                        <a href="<?= htmlspecialchars($company['website']) ?>" target="_blank" style="display: block; width: 100%; padding: 0.75rem; background: #0ea5e9; color: white; text-align: center; border-radius: 6px; text-decoration: none; font-size: 1rem; font-weight: 500; transition: background 0.3s;">Visit Website</a>
                    </div>
                </div>

                <!-- Interview Details Card -->
                <div style="flex: 1; min-width: 300px; max-width: 340px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 1.5rem; transition: transform 0.2s;">
                    <h2 style="color: #0ea5e9; font-size: 1.5rem; font-weight: 600; margin: 0 0 1rem 0;">Interview Details</h2>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <p style="margin: 0; color: #6b7280; font-size: 1rem; line-height: 1.5;"><strong>Date:</strong>
                            <?php if ($interview && $interview['complete']): ?>
                                <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Completed</span>
                            <?php elseif (!empty($interview['date'])): ?>
                                <?php echo htmlspecialchars($interview['date']) ?>
                            <?php else: ?>
                                <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Soon</span>
                            <?php endif; ?>
                        </p>
                        <p style="margin: 0; color: #6b7280; font-size: 1rem; line-height: 1.5;"><strong>Time:</strong>
                            <?php if (!empty($interview['start_time'])): ?>
                                <?= htmlspecialchars(date('H:i', strtotime($interview['start_time']))) ?> to
                                <?= htmlspecialchars(date('H:i', strtotime($interview['end_time']))) ?>
                            <?php else: ?>
                                <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Soon</span>
                            <?php endif; ?>
                        </p>
                        <p style="margin: 0; color: #6b7280; font-size: 1rem; line-height: 1.5;"><strong>Status:</strong>
                            <?php if ($application['selected']): ?>
                                <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Selected</span>
                            <?php elseif ($application['failed']): ?>
                                <span style="background-color: var(--red-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Failed</span>
                            <?php else: ?>
                                <span style="background-color: #0ea5e9; color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Pending</span>
                            <?php endif; ?>
                        </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>