<?php require base_path('views/partials/auth/auth.php') ?>

    <main>
        <div class="container">
            <div class="job-details">
                <h1 class="job-title"><?= $ad['job_role'] ?></h1>
                <div style="margin-bottom: 2rem">
                    <span class="company-name"><?= $ad['company_name'] ?></span>
                    <br/>
                    <span style="font-size: 0.7rem; color: var(--gray-400)"><?= $ad['building'] ?>,
                                <?= $ad['street_name'] ?>,
                                <?= $ad['city'] ?>
                            </span>

                </div>
                <div class="section">
                    <h2 class="section-title">Key Responsibilities</h2>
                    <div class="section-content"><?= $ad['responsibilities'] ?></div>
                </div>

                <div class="section">
                    <h2 class="section-title">Required Qualifications & Skills</h2>
                    <div class="section-content"><?= $ad['qualifications_skills'] ?></div>
                </div>
            </div>

            <div class="apply-form">
                <h2>Apply for this job</h2>
                <form action="/applications" method="post">
                    <input type="hidden" name="ad_id" value="<?= $ad['id'] ?>">
                    <div class="form-group">
                        <label for="resume">Resume</label>
                        <select id="resume" name="cv_id" required>
                            <?php foreach ($userCvs as $cv): ?>
                                <option value="<?= $cv['id'] ?>"><?= $cv['original_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="button">Submit Application</button>
                </form>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
    <link rel="stylesheet" href="/styles/thathsara/thathsara6.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>