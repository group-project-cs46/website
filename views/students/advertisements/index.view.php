<?php require base_path('views/partials/auth/auth.php') ?>


<main>
    <div class="container">
        <div style="margin-top: 1rem">
            <div style="display: flex; gap: 10px; justify-content: space-between">
                <span style="font-size: 2rem">Advertisements</span>

                <?php if (isset($companies)): ?>
                    <form action="/students/advertisements" method="get" style="display: flex; gap: 0.5rem">
                        <div>
                            <div class="select">
                                <select name="company_id" class="select">
                                    <option value="">Select Company</option>
                                    <?php foreach ($companies as $company): ?>
                                        <option value="<?= $company['id'] ?>">
                                            <?= $company['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="down_note"></div>
                        </div>

                        <button type="submit" class="button">Filter</button>
                        <a href="/students/advertisements" style="display: flex">
                            <button type="button" class="button">Clear</button>
                        </a>
                    </form>
                <?php endif; ?>
            </div>

        </div>

        <?php if (!$currentRound): ?>
            <div style="margin-top: 10rem; display: flex; justify-content: center; width: 100%;">
                <h1>A round has not started yet</h1>
            </div>
        <?php endif; ?>


        <?php if (isset($ads)): ?>
            <div class="job-grid">
                <?php foreach ($ads as $item): ?>
                    <div class="job-card">
                        <div class="job-header">
                            <div>
                                <a href="/students/companies/show?id=<?= $item['user_id'] ?>">
                                    <span><?= $item['name'] ?></span>
                                </a>
                                <br />
                                <span style="font-size: 0.7rem; color: var(--gray-400)"><?= $item['building'] ?>,
                                    <?= $item['street_name'] ?>,
                                    <?= $item['city'] ?>
                                </span>
                            </div>
                            <a href="/students/advertisements/show?id=<?= $item['id'] ?>">
                                <button type="button" class="button">Apply</button>
                            </a>
                        </div>

                        <div class="job-details">
                            <h1 class="job-title"><?= $item['job_role'] ?></h1>
                            <p class="job-description"><?= $item['responsibilities'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
<link rel="stylesheet" href="/styles/select.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>