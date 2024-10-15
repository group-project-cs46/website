<?php require base_path('views/partials/auth/auth.php') ?>

<?php
$jobs = [
    [
        'logo' => '/companies/wso2-logo.svg',
        'title' => 'Junior Software Engineer',
        'description' => 'Kickstart your career with hands-on experience in software engineering.',
        'height' => 'height-12'
    ],
    [
        'logo' => '/companies/99x.png',
        'title' => 'Backend Developer Intern',
        'description' => 'Work on backend systems and gain practical experience in server-side development.',
        'height' => 'height-7'
    ],
    [
        'logo' => '/companies/ifs.png',
        'title' => 'Frontend Developer Intern',
        'description' => 'Develop user interfaces and enhance your skills in frontend technologies.',
        'height' => 'height-8'
    ],
    [
        'logo' => '/companies/virtusa.svg',
        'title' => 'Full Stack Developer Intern',
        'description' => 'Get involved in both frontend and backend development projects.',
        'height' => 'height-7'
    ],
    [
        'logo' => '/companies/cisco.svg',
        'title' => 'DevOps Engineer Intern',
        'description' => 'Learn about deployment, automation, and infrastructure management.',
        'height' => 'height-8'
    ]
];
?>

<main>
    <div class="container">
        <div class="header">
            <div class="title">
                <i class="icon-briefcase"></i>
                <span>Jobs</span>
            </div>
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search Jobs">
            </div>
        </div>

        <div class="job-grid">
            <?php foreach ($jobs as $job): ?>
                <div class="job-card">
                    <div class="job-header">
                        <div class="job-logo">
                            <img class="<?= $job['height'] ?>" src="<?= $job['logo'] ?>" alt="job logo">
                        </div>
                        <button type="button" class="apply-button">Apply</button>
                    </div>

                    <div class="job-details">
                        <h1 class="job-title"><?= $job['title'] ?></h1>
                        <p class="job-description"><?= $job['description'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>
