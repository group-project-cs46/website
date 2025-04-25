<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f3f4f6;">
        <div style="margin-block: 2rem; background-color: #ffffff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px;">
            <form action="/companies/advertisements/store" method="post" enctype="multipart/form-data"
                  style="display: flex; flex-direction: column; gap: 1.5rem;">

<!--                Role-->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="color: #6b7280; font-weight: 500;">Role:</label>
                    <div class="select" style="width: 100%">
                        <select id="resume" name="internship_role_id" required class="select">
                            <?php foreach ($internship_roles as $item): ?>
                                <option value="<?= htmlspecialchars($item['id']) ?>">
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

<!--                Responsibilities:-->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="color: #6b7280; font-weight: 500;">Responsibilities:</label>
                    <textarea class="input" name="responsibilities" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748; min-height: 100px; resize: vertical;"
                    ><?= old('responsibilities') ?></textarea>
                    <?php if (isset($errors['responsibilities'])): ?>
                        <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['responsibilities'] ?></span>
                    <?php endif ?>
                </div>

<!--                Qualifications Skills:-->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="color: #6b7280; font-weight: 500;">Qualifications Skills:</label>
                    <textarea class="input" name="qualifications_skills" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748; min-height: 100px; resize: vertical;"
                    ><?= old('qualifications_skills') ?></textarea>
                    <?php if (isset($errors['qualifications_skills'])): ?>
                        <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['qualifications_skills'] ?></span>
                    <?php endif ?>
                </div>

<!--                Maximum Number of Resumes needed:-->
                <div>
                    <label style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="color: #6b7280; font-weight: 500;">Maximum Number of Resumes needed:
                        </label>
                        <input type="number" name="max_cvs" value="<?= old('max_cvs') ?>"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748;">
                        <?php if (isset($errors['max_cvs'])): ?>
                            <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['max_cvs'] ?></span>
                        <?php endif ?>
                    </label>
                </div>

<!--                Deadline:-->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="color: #6b7280; font-weight: 500;">Deadline:</label>
                    <div style="display: flex; gap: 1rem;">
                        <input type="date"
                               name="deadline"
                               value="<?= old('deadline') ?>"
                               style="padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';"
                        >
                    </div>
                    <?php if (isset($errors['deadline'])): ?>
                        <span style="color: #e11d48; font-size: 0.75rem;">
                        <?= $errors['deadline'] ?>
                    </span>
                    <?php endif ?>
                </div>

<!--                Vacancy Count:-->
                <div>
                    <label style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="color: #6b7280; font-weight: 500;">Number of vacancies:
                        </label>
                        <input type="number" name="vacancy_count" value="<?= old('vacancy_count') ?>"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e0; border-radius: 0.375rem; font-size: 1rem; color: #2d3748;">
                        <?php if (isset($errors['vacancy_count'])): ?>
                            <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['vacancy_count'] ?></span>
                        <?php endif ?>
                    </label>
                </div>

                <div>
                    <label style="color: #6b7280; font-weight: 500;">
                        Photo: <span style="font-weight: 400; font-size: 0.875rem; color: #9ca3af;">(Recommended 1000px * 1000px)</span>
                    </label>
                    <div style="display: flex; justify-content: center; position: relative">
                        <img src="/assets/placeholder.png"
                             alt="Profile Picture"
                             id="preview"
                             style="width: 400px; height: 400px; object-fit: cover; border-radius: 0.5rem; margin-top: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1)"
                        >
                        <label for="file" class="button" style="position: absolute; top: 2rem; left: 50%; transform: translateX(-50%)"
                        >Select</label>

                    </div>

                    <input id="file" type="file" name="file" accept="image/*" style="display: none">
                    <div style="margin-top: 1rem">
                        <?php if (isset($errors['file'])): ?>
                            <span style="color: #e11d48; font-size: 0.75rem; display: block; margin-top: 0.25rem;"><?= $errors['file'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

                <div style="display: flex; justify-content: end">
                    <button type="submit" class="button" style="width: 100%">
                        Create
                    </button>
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