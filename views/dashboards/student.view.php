<?php require base_path('views/partials/auth/auth.php') ?>

    <main style=" padding: 20px; display: flex; justify-content: center; align-items: flex-start;">
        <div style="width: 100%; max-width: 1500px; background: #ffffff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 30px; margin: 20px;">
            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1 style="font-size: 28px; color: #333; margin: 0; font-weight: 600;">Welcome to Your Internship
                    Dashboard</h1>
                <div style="display: flex; gap: 10px;">
                    <a href="/account" class="button">
                        <button>
                            View Profile
                        </button>
                    </a>

                    <form action="/sessions" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="button is-red">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <!-- Left Column: Internship Applications & Recent Activities -->
                <div>
                    <!-- Internship Applications -->
                    <div style="background: #f9f9f9; border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; color: #333; margin: 0 0 15px 0;">Your Internship Applications</h2>
                        <?php if (empty($applications)): ?>
                            <p style="font-size: 14px; color: #666; text-align: center">No applications found.</p>
                        <?php endif ?>
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            <?php foreach ($applications as $application): ?>
                                <div style="background: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <h3 style="font-size: 16px; color: #333; margin: 0;"><?= $application['internship_role'] ?></h3>
                                        <p style="font-size: 14px; color: #666; margin: 5px 0;"><?= $application['company_name'] ?>
                                            • Applied on <?= date('d-m-Y', strtotime($application['created_at'])) ?>
                                        </p>
                                    </div>
                                    <?php if ($application['selected']): ?>
                                        <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Selected</span>
                                    <?php elseif ($application['failed']): ?>
                                        <span style="background-color: var(--red-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Failed</span>
                                    <?php else: ?>
                                        <span style="background-color: var(--sky-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Pending</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <a href="/students/applications"
                           style="display: inline-block; margin-top: 15px; color: #4a90e2; font-size: 14px;">
                            View All Applications
                        </a>
                    </div>

                    <!-- Recent Activities -->
                    <div style="background: #f9f9f9; border-radius: 10px; padding: 20px;">
                        <h2 style="font-size: 20px; color: #333; margin: 0 0 15px 0;">Recent Activities</h2>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px; color: #333;">
                                Submitted application for Google Inc. • <span style="color: #666;">04/10/2025</span>
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px; color: #333;">
                                Scheduled interview with Microsoft • <span style="color: #666;">04/08/2025</span>
                            </li>
                            <li style="padding: 10px 0; font-size: 14px; color: #333;">
                                Updated profile information • <span style="color: #666;">04/01/2025</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Column: Profile & Deadlines -->
                <div>
                    <!-- Profile Overview -->
                    <div style="background: var(--color-primary); border-radius: 10px; padding: 20px; color: white; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; margin: 0 0 15px 0;">Profile Overview</h2>
                        <p style="font-size: 14px; margin: 5px 0;">Name: <?= $user['name'] ?></p>
                        <p style="font-size: 14px; margin: 5px 0;">Course: <?= ucwords($user['course']) ?></p>
                        <p style="font-size: 14px; margin: 5px 0;">Applications: <?= count($applications ?? 0) ?></p>
                        <a href="/account"
                           style="display: inline-block; margin-top: 15px; color: white; text-decoration: underline; font-size: 14px;">Edit
                            Profile</a>
                    </div>

                    <!-- Upcoming Deadlines -->
                    <div style="background: #f9f9f9; border-radius: 10px; padding: 20px;">
                        <h2 style="font-size: 20px; color: #333; margin: 0 0 15px 0;">Upcoming Training Sessions</h2>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <?php foreach ($training_sessions as $training_session): ?>
                                <div style="font-size: 14px; color: #333;">
                                    <a href="/students/training_sessions/show?id=<?= $training_session['id'] ?>">
                                        <?= $training_session['name'] ?>
                                    </a>
                                    •
                                    <span style="color: #e94e77;"><?= date('d-m-Y', strtotime($training_session['date'])) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>