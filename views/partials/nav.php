<?php

enum Role: int
{
    case Admin = 1;
    case Student = 2;
    case Pdc = 3;
    case Company = 4;
    case Lecturer = 5;
}

$navItems = [
    [
        'text' => 'Dashboard',
        'href' => '/dashboard/admin',
        'icon' => 'fa-dashboard',
        'only' => [Role::Admin],
    ],
    [
        'text' => 'Dashboard',
        'href' => '/dashboard/student',
        'icon' => 'fa-dashboard',
        'only' => [Role::Student],
    ],
    [
        'text' => 'Dashboard',
        'href' => '/dashboard/pdc',
        'icon' => 'fa-dashboard',
        'only' => [Role::Pdc],
    ],
    [
        'text' => 'Dashboard',
        'href' => '/dashboard/company',
        'icon' => 'fa-dashboard',
        'only' => [Role::Company],
    ],
    [
        'text' => 'Advertisment',
        'href' => '/company/advertisment',
        'icon' => 'fa-regular fa-rectangle-ad',
        'only' => [Role::Company],
    ],
    [
        'text' => 'Student List',
        'href' => '/company/list',
        'icon' => 'fa-solid fa-user-shield',
        'only' => [Role::Company],
    ],
    [
        'text' => 'Schedule',
        'href' => '/company/schedule',
        'icon' => 'fa-solid fa-calendar-days',
        'only' => [Role::Company],
    ],
    [
        'text' => 'Complaint',
        'href' => '/company/complaint',
        'icon' => 'fa-brands fa-readme',
        'only' => [Role::Company],
    ],
    [
        'text' => 'Report',
        'href' => '/company/report',
        'icon' => 'fa-solid fa-file-invoice',
        'only' => [Role::Company],
    ],
    [
        'text' => 'Account',
        'href' => '/company/account',
        'icon' => 'fa-user',
        'only' => [Role::Company],
    ],

    [
        'text' => 'Dashboard',
        'href' => '/dashboard/lecturer',
        'icon' => 'fa-dashboard',
        'only' => [Role::Lecturer],
    ],
    [
        'text' => 'Manage Student',
        'href' => '/PDC/managestudents',
        'icon' => 'fa-user-graduate',
        'only' => [Role::Pdc]
    ],
    [
        'text' => "Advertisements",
        'href' => '/PDC/advertisements',
        'icon' => 'fa-rectangle-ad',
        'only' => [Role::Pdc]
    ],
    [
        'text' => "ManageCompany",
        'href' => '/pdcs/companies',
        'icon' => 'fa-building',
        'only' => [Role::Pdc]
    ],
    [
        'text' => "Schedule",
        'href' => '/PDC/schedule',
        'icon' => 'fa-calendar-days',
        'only' => [Role::Pdc]
    ],
    [
        'text' => "Complaints&Feedback",
        'href' => '/PDC/complaints&feedback',
        'icon' => 'fa-comments',
        'only' => [Role::Pdc]
    ],
    [
        'text' => "StudentReport",
        'href' => '/PDC/studentreport',
        'icon' => 'fa-address-book',
        'only' => [Role::Pdc]
    ],
    [
        'text' => "BlacklistedCompanies",
        'href' => '/PDC/blacklistedcompanies',
        'icon' => 'fa-ban',
        'only' => [Role::Pdc]
    ],
    [
        'text' => 'Advertisements',
        'href' => '/advertisements',
        'icon' => 'fa-briefcase',
        'only' => [Role::Student],
    ],
    [
        'text' => "Managec PDC",
        'href' => '/pdcManage',
        'icon' => 'fa-solid fa-user-shield',
        'only' => [Role::Admin],
    ],
    [
        'text' => "Managec Lecturer",
        'href' => '/lecturerManage',
        'icon' => 'fa-user-graduate',
        'only' => [Role::Admin],
    ],
    [
        'text' => "Complaints",
        'href' => '/complaints',
        'icon' => 'fa-comments',
        'only' => [Role::Admin],
    ],
    [

        'text' => 'Calendar',
        'href' => '/calendar',
        'icon' => 'fa-fire-flame-curved',
        'only' => [Role::Lecturer],
    ],
    [
        'text' => 'Report',
        'href' => '/reportMain',
        'icon' => 'fa-sheet-plastic',
        'only' => [Role::Lecturer],
    ],
    // [
    //     'text' => 'Profile',
    //     'href' => '/profilelec',
    //     'icon' => 'fa-user',
    //     'only' => [Role::Lecturer],
    // ],
    // [
    //     'text' => 'Profile',
    //     'href' => '/profile',
    //     'icon' => 'fa-user',
    //     'only' => [Role::Admin],
    // ],
    [

        'text' => "Applications",
        'href' => '/students/applications',
        'icon' => 'fa-file-invoice',
        'only' => [Role::Student],
    ],
    [
        'text' => "Cvs",
        'href' => '/students/cvs',
        'icon' => 'fa-user-pen',
        'only' => [Role::Student],
    ],
    [
        'text' => 'Account',
        'href' => '/account',
        'icon' => 'fa-user',
        'only' => [Role::Student, Role::Admin, Role::Pdc, Role::Lecturer],
    ],

];

function filterNavItemsByRole($navItems, $userRole)
{
    return array_filter($navItems, function ($item) use ($userRole) {

        return !isset($item['only']) || in_array(
                $userRole,
                array_map(fn($role) => $role->value, $item['only'])
            );
    });
}

?>

<nav role="navigation" aria-label="main navigation"
     style="position: fixed; left: 0; top: 0; height: 100vh; width: 50px;">
    <div style="height: 100vh; display: flex; flex-direction: column; justify-content: space-between; border-right: 1px solid #d1d5db; padding-inline: 5px">
        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.5rem">
            <?php foreach (filterNavItemsByRole($navItems, $_SESSION['user']['role']) as $item) : ?>
                <a href="<?= $item['href'] ?>"
                   class="tooltip"
                   style="border-radius: 9999px; padding-block: 0.6rem; text-align: center; <?= urlIs($item['href']) ? 'outline: 1px solid; color: #0ea5e9; background-color: white;' : 'color: #4b5563; outline: 1px solid #e5e7eb;' ?>"
                >
                    <i class="fa-solid <?= $item['icon'] ?> fa-lg"></i>
                    <span class="tooltiptext">
                        <?= $item['text'] ?>
                    </span>
                </a>
            <?php endforeach ?>
        </div>

        <div style="display: flex; flex-direction: column; margin-bottom: 0.5rem">
            <form style="width: 100%; margin: 0;" action="/sessions" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <button style="width: 100%; margin: 0; color: #be123c;" class="astext">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i>
                </button>
            </form>
        </div>
    </div>
</nav>