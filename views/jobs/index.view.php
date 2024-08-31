<?php require base_path('views/partials/auth/auth.php') ?>

<?php
$jobs = [
    [
        'logo' => '/companies/wso2-logo.svg',
        'title' => 'Junior Software Engineer',
        'description' => 'Kickstart your career with hands-on experience in software engineering.',
        'height' => 'h-12'
    ],
    [
        'logo' => '/companies/99x.png',
        'title' => 'Backend Developer Intern',
        'description' => 'Work on backend systems and gain practical experience in server-side development.',
        'height' => 'h-7'
    ],
    [
        'logo' => '/companies/ifs.png',
        'title' => 'Frontend Developer Intern',
        'description' => 'Develop user interfaces and enhance your skills in frontend technologies.',
        'height' => 'h-8'
    ],
    [
        'logo' => '/companies/virtusa.svg',
        'title' => 'Full Stack Developer Intern',
        'description' => 'Get involved in both frontend and backend development projects.',
        'height' => 'h-7'
    ],
    [
        'logo' => '/companies/cisco.svg',
        'title' => 'DevOps Engineer Intern',
        'description' => 'Learn about deployment, automation, and infrastructure management.',
        'height' => 'h-8'
    ]
    // Add more jobs here
];

?>

    <main>
        <div class="mt-2 mx-2">
            <div class="flex justify-between items-center">
                <div class="text-gray-700 flex gap-2 items-center">
                    <i class="fa-solid fa-xl fa-briefcase fa-lg"></i>
                    <span class="text-xl">Jobs</span>
                </div>
                <div class="space-y-3">
                    <input type="text"
                           class="shadow w-96 py-3 px-4 block border-gray-200 rounded-lg text-sm focus:border-sky-500 focus:ring-sky-500 disabled:opacity-50 disabled:pointer-events-none"
                           placeholder="Search Jobs"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-4 gap-2">
                <?php foreach ($jobs as $job): ?>
                    <div class="w-full bg-white border shadow-sm rounded-xl px-3 py-5 flex flex-col justify-between gap-3">
                        <div class="flex justify-between items-center">
                            <div>
                                <img class="<?= $job['height'] ?>" src="<?= $job['logo'] ?>" alt="job logo">
                            </div>
                            <div>
                                <button type="button"
                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-sky-500 text-white hover:bg-sky-600 focus:outline-none focus:bg-sky-600 disabled:opacity-50 disabled:pointer-events-none">
                                    Apply
                                </button>
                            </div>
                        </div>

                        <div class="">
                            <h1 class="text-lg"><?= $job['title'] ?></h1>
                            <p class="text-sm"><?= $job['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>