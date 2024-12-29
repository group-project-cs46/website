<?php require base_path('views/partials/auth/auth.php') ?>

    <main>
        <div class="container">
            <div class="apply-form">
                <h2>Edit Application</h2>
                <form action="/students/applications/update" method="post">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= $application['id'] ?>">
                    <div class="form-group">
                        <label for="resume">Resume</label>
                        <select id="resume" name="cv_id" required>
                            <?php foreach ($userCvs as $cv): ?>
                                <option <?php echo $application['cv_id'] == $cv['id'] ? "selected": "" ?> value="<?= $cv['id'] ?>"><?= $cv['original_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="button">Update</button>
                </form>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>