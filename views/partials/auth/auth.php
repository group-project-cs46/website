<?php require base_path('views/partials/head.php') ?>

<?php

use Models\Application;

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
//    [
//        'text' => "PDCs",
//        'href' => '/admins/pdcs',
//        'icon' => 'fa-solid fa-user-shield',
//        'only' => [Role::Admin],
//    ],
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
        'text' => 'Events',
        'href' => '/events',
        'icon' => 'fa-solid fa-calendar-days',
        'only' => [Role::Admin],
    ],
    [

        'text' => 'Calendar',
        'href' => '/calendar',
        'icon' => 'fa-solid fa-calendar-days',
        'only' => [Role::Lecturer],
    ],
    [
        'text' => 'Report',
        'href' => '/reportMain',
        'icon' => 'fa-sheet-plastic',
        'only' => [Role::Lecturer],
    ],
    [
        'text' => 'Advertisements',
        'href' => '/students/advertisements',
        'icon' => 'fa-briefcase',
        'only' => [Role::Student],
        'filter' => function () {
            $currentRound = \Models\Round::currentRound();
            return $currentRound && !$currentRound['restricted'];
        }
    ],
    [

        'text' => "Applications",
        'href' => '/students/applications',
        'icon' => 'fa-file-invoice',
        'only' => [Role::Student],
    ],
    [
        'text' => "Second Round",
        'href' => '/students/second_round',
        'icon' => 'fa-solid fa-2',
        'only' => [Role::Student],
        'filter' => function () {
            $currentRound = \Models\Round::currentRound();
            $isSecondRound = $currentRound && $currentRound['restricted'];
            $isSelected = !empty(Application::isSelectedByStudentId(auth_user()['id']));
            return $isSecondRound && !$isSelected;
        }
    ],
    [
        'text' => "Cvs",
        'href' => '/students/cvs',
        'icon' => 'fa-user-pen',
        'only' => [Role::Student],
    ],
    [
        'text' => "Calendar",
        'href' => '/students/events',
        'icon' => 'fa-calendar',
        'only' => [Role::Student],
    ],
    [
        'text' => "Internship Reports",
        'href' => '/students/internship_reports',
        'icon' => 'fa-file-pdf',
        'only' => [Role::Student],
        'filter' => function () {
            return !empty(Application::isSelectedByStudentId(auth_user()['id']));
        }
    ],
    [
        'text' => "Complaints",
        'href' => '/students/complaints',
        'icon' => 'fa-face-frown',
        'only' => [Role::Student],
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

function filter($navItems)
{
    $navItems = filterNavItemsByRole($navItems, $_SESSION['user']['role']);
    return array_filter($navItems, function ($item) {
        return !isset($item['filter']) || $item['filter']();
    });
}

?>


<div style="display: grid; grid-template-columns: 50px 1fr; grid-template-rows: 50px 1fr">
<!--    left bar -->
    <div
        style="z-index: 20; grid-row: span 2; position: sticky; top:0; height: 100vh; display: flex; flex-direction: column; justify-content: space-between; border-right: 1px solid #d1d5db; padding-inline: 5px">
        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.5rem">
            <?php foreach (filter($navItems) as $item): ?>
                <a href="<?= $item['href'] ?>" class="tooltip"
                    style="border-radius: 9999px; padding-block: 0.6rem; text-align: center; <?= urlIs($item['href']) ? 'outline: 1px solid; color: #0ea5e9; background-color: white;' : 'color: #4b5563; outline: 1px solid #e5e7eb;' ?>">
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

    <!-- top bar -->
    <div style="position: sticky; top: 0; background-color: #fff; border-bottom: 1px solid #d1d5db; display: flex; justify-content: end; align-items: center; z-index: 10;">
        <div style="display: flex; align-items: center; gap: 0.5rem; padding-right: 1rem">
            <div class="bell-container" style="position: relative;">
            <span class="bell-icon" style="cursor: pointer;">
                <i class="fa-solid fa-bell fa-xl"></i>
                <?php if (count($_SESSION['user']['notifications']) > 0): ?>
                    <span style="position: absolute; top: -5px; right: -5px; background-color: #ef4444; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem;">
                        <?= count($_SESSION['user']['notifications']) ?>
                    </span>
                <?php endif; ?>
            </span>
                <div class="notifications-dropdown" style="position: absolute; top: 100%; right: 0; background-color: white; border: 1px solid #d1d5db; border-radius: 0.5rem; width: 300px; max-height: 400px; overflow-y: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 100;">
                    <div style="padding: 0.5rem; border-bottom: 1px solid #e5e7eb; font-weight: 500; display: flex; justify-content: space-between; align-items: center;">
                        <span>Notifications</span>
                        <a href="#" style="font-size: 0.7rem">Read All</a>
                    </div>
                    <?php if (empty($_SESSION['user']['notifications'])): ?>
                        <div style="padding: 1rem; text-align: center; color: #6b7280;">No notifications</div>
                    <?php else: ?>
                        <?php foreach ($_SESSION['user']['notifications'] as $notification): ?>
                            <a href="/notifications/resolve?id=<?= $notification['id'] ?>" style="text-decoration: none">
                                <div class="notification-item">
                                    <p style="margin: 0; color: #1f2937;"><?= htmlspecialchars($notification['message']) ?></p>
                                    <small style="color: #6b7280;"><?= date('Y-m-d H:i:s', strtotime($notification['created_at'])) ?></small>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div style="font-weight: 500"><?php echo $_SESSION['user']['name'] ?></div>
            <a href="/account" style="display: flex; align-items: center">
                <img
                    src="<?= $_SESSION['user']['photo'] ?>"
                    style="width: 2.5rem; height: 2.5rem; object-fit: cover; border-radius: 100%; border: 1px solid var(--color-primary)"
                    alt=""
                >
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM fully loaded and parsed');
            const bellIcon = document.querySelector('.bell-icon');
            const dropdown = document.querySelector('.notifications-dropdown');

            bellIcon.addEventListener('click', (e) => {
                console.log('Bell icon clicked');
                e.stopPropagation();
                dropdown.classList.toggle('show');
            });

            document.addEventListener('click', (e) => {
                if (!bellIcon.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });
        });
    </script>

<!--    content -->
    <div style="padding-inline: 0.5rem; background-color: #f4f7fc">