<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="background-color: #f4f7fc; min-height: 100vh; padding: 40px 20px;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 30px;">
            <!-- Job Details Section -->
            <div style="flex: 2; min-width: 300px; background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <h1 style="font-size: 2.2rem; color: #1a202c; margin: 0 0 10px; font-weight: 700;"><?= htmlspecialchars($ad['job_role']) ?></h1>
                <div style="margin-bottom: 25px;">
                    <span style="font-size: 1.25rem; color: #2d3748; font-weight: 600;"><?= htmlspecialchars($ad['name']) ?></span>
                    <br/>
                    <span style="font-size: 0.9rem; color: #718096; line-height: 1.5;">
                    <?= htmlspecialchars($ad['building']) ?>,
                    <?= htmlspecialchars($ad['street_name']) ?>,
                    <?= htmlspecialchars($ad['city']) ?>
                </span>
                    <br/>
                    <span style="font-size: 0.9rem; color: #4a5568; font-weight: 500; margin-top: 8px; display: block;">
                    Number of Vacancies: <strong><?= isset($ad['vacancy_count']) ? htmlspecialchars($ad['vacancy_count']) : 'N/A' ?></strong>
                </span>
                </div>

                <div style="margin-bottom: 30px;">
                    <h2 style="font-size: 1.5rem; color: #2d3748; margin: 0 0 15px; font-weight: 600;">Key Responsibilities</h2>
                    <div style="font-size: 1rem; color: #4a5568; line-height: 1.8; background: #f7fafc; padding: 20px; border-radius: 8px;">
                        <?= nl2br(htmlspecialchars($ad['responsibilities'])) ?>
                    </div>
                </div>

                <div>
                    <h2 style="font-size: 1.5rem; color: #2d3748; margin: 0 0 15px; font-weight: 600;">Required Qualifications & Skills</h2>
                    <div style="font-size: 1rem; color: #4a5568; line-height: 1.8; background: #f7fafc; padding: 20px; border-radius: 8px;">
                        <?= nl2br(htmlspecialchars($ad['qualifications_skills'])) ?>
                    </div>
                </div>
            </div>

            <!-- Apply Form Section -->
            <div style="flex: 1; min-width: 300px; background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <h2 style="font-size: 1.5rem; color: #2d3748; margin: 0 0 20px; font-weight: 600;">Apply for this Job</h2>
                <form action="/students/applications" method="post" style="display: flex; flex-direction: column; gap: 20px;">
                    <input type="hidden" name="ad_id" value="<?= htmlspecialchars($ad['id']) ?>">
                    <div>
                        <label for="resume" style="font-size: 1rem; color: #2d3748; font-weight: 500; display: block; margin-bottom: 8px;">Resume</label>
                        <select id="resume" name="cv_id" required style="width: 100%; padding: 12px; font-size: 1rem; color: #4a5568; border: 1px solid #e2e8f0; border-radius: 8px; background: #f7fafc; outline: none; transition: border-color 0.3s;">
                            <?php foreach ($userCvs as $cv): ?>
                                <option value="<?= htmlspecialchars($cv['id']) ?>"><?= htmlspecialchars($cv['original_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="button">
                        Submit Application
                    </button>
                </form>
            </div>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>