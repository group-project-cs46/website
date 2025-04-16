<?php require base_path('views/partials/auth/auth.php') ?>

    <main>
        <div class="container">
        <div>
            <div class="title">
                <span>Select Roles</span>
            </div>
            <span style="color: var(--gray-500)">Select three roles you like for the second round</span>
        </div>


            <form action="/students/second_round" method="POST" class="upload-form"
                  style="margin-top: 1rem; display: flex; align-items: center; gap: 1rem">
                <div>
                    <label>
                        <select name="cv">
                            <option value="">Select CV</option>
                            <?php foreach ($userCvs as $cv): ?>
                                <option value="<?= $cv['id'] ?>" <?php echo old('cv') ? 'selected' : '' ?>><?= htmlspecialchars($cv['original_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <?php if (isset($errors['cv'])): ?>
                        <p class="error"><?= $errors['cv'] ?></p>
                    <?php endif ?>
                </div>

                <div>
                    <label>
                        <select name="role">
                            <option value="">Select a role</option>
                            <?php foreach ($available_roles as $item): ?>
                                <option value="<?= $item['id'] ?>" <?php echo old('role') ? 'selected' : '' ?>><?= htmlspecialchars($item['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <?php if (isset($errors['role'])): ?>
                        <p class="error"><?= $errors['role'] ?></p>
                    <?php endif ?>
                </div>
                <div>
                    <button type="submit" class="button">
                        Add
                    </button>
                </div>
            </form>

            <div class="grid">
                <div class="grid-header">Role</div>
                <div class="grid-header">Cv</div>
                <div class="grid-header"></div>
                <?php foreach ($chosen_roles as $item): ?>
                    <div class="grid-item"><?php echo htmlspecialchars($item['name']); ?></div>

                    <div class="grid-item" style="text-align: right">
                        <a href="/cv/show?id=<?= $item['cv_id'] ?>" target="_blank" class="button">
                            Download
                        </a>
                    </div>
                    <div class="grid-item" style="text-align: right">
                        <form action="/cv/delete" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" class="button is-red">
                                Delete
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/students/second_round/table.css">
    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
    <link rel="stylesheet" href="/styles/form.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>