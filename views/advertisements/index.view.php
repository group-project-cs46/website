<?php require base_path('views/partials/auth/auth.php') ?>


<main>
    <div class="container">
        <div class="header" style="padding-bottom:10px">
            <div class="title">
                <i class="icon-briefcase"></i>
                <span>Advertisements</span>
            </div>
            <div class="search-bar">
                <!-- <input type="text" class="search-input" placeholder="Search Jobs"> -->
            </div>
        </div>

        <div>
            <form action="/advertisements" method="get">
                <select name="company_id">
                    <option value="">Select Company</option>
                    <?php foreach ($companies as $company): ?>
                        <option value="<?= $company['id'] ?>">
                            <?=
                                $company['company_name']
                                ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Filter</button>
                <a href="/advertisements">
                    <button type="button">Clear</button>
                </a>
            </form>
        </div>

        <div class="job-grid">
            <?php foreach ($ads as $item): ?>
                <div class="job-card">
                    <div class="job-header">
                        <p><?= $item['company_name'] ?></p>
                        <a href="/advertisements/show?id=<?= $item['id'] ?>">
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
    </div>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>