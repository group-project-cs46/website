<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="display: flex; justify-content: center; align-items: center; padding: 20px;">
        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); padding: 40px; max-width: 900px; width: 100%; margin: 0 auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;">
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: #1a1a1a; font-size: 28px; font-weight: 600; margin: 0; line-height: 1.3;">Edit
                    Internship Advertisement #<?= $advertisement['id'] ?></h2>
            </div>
            <form action="/companies/advertisements/update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $advertisement['id'] ?>">
                <input type="hidden" name="_method" value="PUT">
                <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: flex-start;">
                    <!-- Form Fields Section -->
                    <div style="flex: 1; min-width: 300px;">
                        <div style="margin-bottom: 20px;">
                            <label for="max_cvs"
                                   style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;"
                            >Role:</label>
                            <div class="select" style="width: 100%">
                                <select id="resume" name="internship_role_id" required class="select">
                                    <?php foreach ($internship_roles as $item): ?>
                                        <option value="<?= htmlspecialchars($item['id']) ?>" <?= $item['id'] == $advertisement['internship_role_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($item['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="down_note"></div>

                            <div style="margin-top: 8px">
                                <?php if (isset($errors['internship_role_id'])): ?>
                                    <div class="error">
                                        <?= htmlspecialchars($errors['internship_role_id']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label for="max_cvs"
                                   style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Maximum
                                CVs:</label>
                            <input type="number" id="max_cvs" name="max_cvs" value="<?= $advertisement['max_cvs'] ?>"
                                   required min="1"
                                   style="width: 100%; padding: 10px; border: 1px solid #d1d1d1; border-radius: 6px; font-size: 16px; color: #2a2a2a;">
                            <?php if (isset($errors['max_cvs'])): ?>
                                <span style="color: #dc2626; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['max_cvs'] ?></span>
                            <?php endif ?>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label for="responsibilities"
                                   style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Responsibilities:</label>
                            <textarea id="responsibilities" name="responsibilities" required
                                      style="width: 100%; padding: 10px; border: 1px solid #d1d1d1; border-radius: 6px; font-size: 16px; color: #2a2a2a; min-height: 100px; resize: vertical;"><?= htmlspecialchars($advertisement['responsibilities']) ?></textarea>
                            <?php if (isset($errors['responsibilities'])): ?>
                                <span style="color: #dc2626; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['responsibilities'] ?></span>
                            <?php endif ?>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label for="qualifications_skills"
                                   style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Qualifications
                                & Skills:</label>
                            <textarea id="qualifications_skills" name="qualifications_skills" required
                                      style="width: 100%; padding: 10px; border: 1px solid #d1d1d1; border-radius: 6px; font-size: 16px; color: #2a2a2a; min-height: 100px; resize: vertical;"><?= htmlspecialchars($advertisement['qualifications_skills']) ?></textarea>
                            <?php if (isset($errors['qualifications_skills'])): ?>
                                <span style="color: #dc2626; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['qualifications_skills'] ?></span>
                            <?php endif ?>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label for="deadline"
                                   style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Deadline:</label>
                            <input type="date" id="deadline" name="deadline" value="<?= $advertisement['deadline'] ?>"
                                   required
                                   style="width: 100%; padding: 10px; border: 1px solid #d1d1d1; border-radius: 6px; font-size: 16px; color: #2a2a2a;">
                            <?php if (isset($errors['deadline'])): ?>
                                <span style="color: #dc2626; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['deadline'] ?></span>
                            <?php endif ?>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label for="vacancy_count"
                                   style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Vacancy
                                Count:</label>
                            <input type="number" id="vacancy_count" name="vacancy_count"
                                   value="<?= $advertisement['vacancy_count'] ?>" required min="1"
                                   style="width: 100%; padding: 10px; border: 1px solid #d1d1d1; border-radius: 6px; font-size: 16px; color: #2a2a2a;">
                            <?php if (isset($errors['vacancy_count'])): ?>
                                <span style="color: #dc2626; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['vacancy_count'] ?></span>
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- Image Upload Section -->
                    <div style="flex: 1; min-width: 300px; text-align: center;">
                        <div style="margin-bottom: 20px;">
                            <label style="color: #6b7280; font-weight: 500;">
                                Advertisement Image: <span
                                        style="font-weight: 400; font-size: 0.875rem; color: #9ca3af;">(Recommended 1000px * 1000px)</span>
                            </label>
                            <div style="display: flex; justify-content: center; position: relative">
                                <img src="/files?id=<?= $advertisement['photo_id'] ?>"
                                     alt="Current Advertisement Image"
                                     id="preview"
                                     style="width: 400px; height: 400px; object-fit: cover; border-radius: 0.5rem; margin-top: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1)"
                                >
                                <label for="file" class="button"
                                       style="position: absolute; top: 2rem; left: 50%; transform: translateX(-50%)">Select</label>
                            </div>
                            <input id="file" type="file" name="file" accept="image/*" style="display: none">
                            <div style="margin-top: 1rem">
                                <?php if (isset($errors['photo'])): ?>
                                    <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['photo'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 30px;">
                    <button type="submit" class="button">Save Changes</button>
                    <a href="/companies/advertisements/show?id=<?= $advertisement['id'] ?>"
                       style="display: inline-block; margin-left: 15px; color: #6a6a6a; font-size: 16px; text-decoration: none;">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        const fileInput = document.getElementById('file');
        const preview = document.getElementById('preview');

        console.log(fileInput)

        fileInput.addEventListener('change', function () {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result; // Set the image src to the file content
                };

                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });
    </script>

    <link rel="stylesheet" href="/styles/select.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>