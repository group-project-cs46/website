<?php require base_path('views/partials/auth/auth.php') ?>

<main>
    <div class="container">
        <div class="job-details">
            <h1 class="job-title"><?= $ad['job_role'] ?></h1>
            <p class="company-name"><?= $ad['company_name'] ?></p>
            <p class="job-description"><?= $ad['responsibilities'] ?></p>
            <p class="job-requirements"><?= $ad['qualifications_skills'] ?></p>
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

<?php require base_path('views/partials/auth/auth-close.php') ?>