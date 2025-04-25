<?php require base_path('views/partials/auth/auth.php') ?>

    <script>
        function openModal(id) {
            const modal = document.getElementById(id)
            modal.showModal();
        }
    </script>

    <style>
        .open-button {
            color: var(--color-primary);
            font-weight: 500
        }

        .open-button:hover {
            text-decoration: underline;
        }
    </style>

    <main>
        <div class="container">
            <div style="padding-bottom:10px">
                <div style="color: var(--gray-700)">
                    <span style="font-size: 2rem">Applications</span>
                </div>
            </div>

            <div class="grid" style="grid-template-columns: auto 1fr 1fr 1fr 1fr 1fr 1fr auto auto">
                <div class="grid-header">ID</div>
                <div class="grid-header">Role</div>
                <div class="grid-header">Interview</div>
                <div class="grid-header">Company</div>
                <div class="grid-header">Status</div>
                <div class="grid-header">Round</div>
                <div class="grid-header">Cv Sent</div>
                <div class="grid-header"></div>
                <div class="grid-header"></div>
                <?php foreach ($applications as $application): ?>
                    <div class="grid-item"><?php echo htmlspecialchars($application['id']); ?></div>
                    <div class="grid-item">
                        <a href="/students/applications/show?id=<?= $application['id'] ?>">
                            <?php echo htmlspecialchars($application['internship_role']); ?>
                        </a>
                    </div>
                    <div class="grid-item">
                        <?php if (!empty($application['interview_date'])): ?>
                            <?= htmlspecialchars(date('d M Y', strtotime($application['interview_date']))) ?> @
                            <?= htmlspecialchars(date('H:i', strtotime($application['interview_start_time']))) ?> to
                            <?= htmlspecialchars(date('H:i', strtotime($application['interview_end_time']))) ?>
                        <?php else: ?>
                            <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Soon</span>
                        <?php endif; ?>
                    </div>
                    <div class="grid-item">
                        <?php echo htmlspecialchars($application['name'] ?? ''); ?>
                    </div>
                    <div class="grid-item">
                        <?php if ($application['selected']): ?>
                            <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Selected</span>
                        <?php elseif ($application['failed']): ?>
                            <span style="background-color: var(--red-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Failed</span>
                        <?php else: ?>
                            <span style="background-color: var(--sky-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Pending</span>
                        <?php endif; ?>
                    </div>
                    <div class="grid-item">
                        <?= $application['is_second_round'] ? "Second" : "First" ?>
                    </div>
                    <div class="grid-item">
                        <?= htmlspecialchars($application['cv_name'] ?? ''); ?>
                    </div>
                    <div class="grid-item">
                        <!--                        <a href="/students/applications/edit?id=-->
                        <?php //= $application['id'] ?><!--"-->
                        <!--                           style="color: var(--sky-700);">-->
                        <button class="open-button"
                                style="color: <?= $event['type'] === 'interview' ? "var(--emerald-600)" : "" ?>"
                                onclick="openModal('modal<?= $application['id'] ?>')">
                            Edit
                        </button>

                        <!--                        </a>-->
                        <dialog class="modal" id="modal<?= $application['id'] ?>"
                                style="border: none; border-radius: 8px; box-shadow: 0 4px 24px rgba(0,0,0,0.1); background: #ffffff; max-width: 480px; width: 90%; margin: auto;">
                            <div class="modal-content"
                                 style="padding: 2rem; display: flex; flex-direction: column; gap: 1.5rem;">
                                <h2 class="modal-title"
                                    style="font-size: 1.75rem; font-weight: 700; color: #1a1a1a; margin: 0; line-height: 1.3;">
                                    Edit Application
                                </h2>
                                <p class="modal-description"
                                   style="font-size: 1rem; color: #6b7280; line-height: 1.6; margin: 0; text-align: left;">
                                    Update your application details below.
                                </p>

                                <form action="/students/applications/update" method="post"
                                      style="display: flex; flex-direction: column; gap: 1rem;">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="id" value="<?= $application['id'] ?>">
                                    <div class="form-group" style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        <label for="resume"
                                               style="font-size: 0.875rem; font-weight: 500; color: #1a1a1a;">Resume</label>
                                        <div class="select" style="width: 100%">
                                            <select class="select" id="resume" name="cv_id" required>
                                                <?php foreach ($userCvs as $cv): ?>
                                                    <option <?php echo $application['cv_id'] == $cv['id'] ? "selected" : "" ?>
                                                            value="<?= $cv['id'] ?>"
                                                            style="color: #1a1a1a;"><?= $cv['original_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="down_note"></div>
                                    </div>
                                    <button type="submit" class="button">
                                        Update
                                    </button>
                                </form>

                                <form method="dialog" class="modal-actions"
                                      style="display: flex; justify-content: flex-end; margin-top: 1rem;">
                                    <button type="submit" class="button"
                                            style="padding: 0.75rem 1.5rem; background: #e5e7eb; color: #1a1a1a; border: none; border-radius: 6px; font-size: 1rem; font-weight: 500; cursor: pointer; transition: background 0.2s; text-align: center;">
                                        Close
                                    </button>
                                </form>
                            </div>
                        </dialog>

                    </div>
                    <div class="grid-item">
                        <form action="/students/applications/delete" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $application['id'] ?>">
                            <button type="submit" class="button" style="background-color: var(--red-700);">Delete
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
    <link rel="stylesheet" href="/styles/students/table.css">
    <link rel="stylesheet" href="/styles/students/modal.css">
    <link rel="stylesheet" href="/styles/select.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>