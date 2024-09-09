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
        'text' => 'Dashboard',
        'href' => '/dashboard/Lecturer',
        'icon' => 'fa-dashboard',
        'only' => [Role::Lecturer],
    ],

    [
        'text' => 'Jobs',
        'href' => '/jobs',
        'icon' => 'fa-briefcase',
        'only' => [Role::Student],
    ],
    [
        'text' => "PDC Users",
        'href' => '/pdc-users',
        'icon' => 'fa-users',
        'only' => [Role::Admin],
    ],
    [
        'text' => 'Account',
        'href' => '/account',
        'icon' => 'fa-user',
        'only' => [Role::Student, Role::Admin, Role::Pdc, Role::Company, Role::Lecturer],
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
    <div style="height: 100vh; display: flex; flex-direction: column; justify-content: space-between"
         class="border-r p-1 py-2">
        <div style="display: flex; flex-direction: column;" class="gap-2">
            <?php foreach (filterNavItemsByRole($navItems, $_SESSION['user']['role']) as $item) : ?>
                <a href="<?= $item['href'] ?>"
                   class="tooltip text-center rounded-full py-2  <?= urlIs($item['href']) ? 'outline outline-1 text-sky-500 bg-white' : 'text-gray-700 hover:outline outline-1 outline-gray-200' ?>"
                >
                    <i class="fa-solid <?= $item['icon'] ?> fa-lg"></i>
                    <span class="tooltiptext">
                        <?= $item['text'] ?>
                    </span>
                </a>
            <?php endforeach ?>
        </div>


        <div style="display: flex; flex-direction: column">
            <form style="width: 100%; margin: 0" action="/sessions" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <button style="width: 100%; margin: 0" class="button text-rose-700">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i>
                </button>
            </form>
        </div>

    </div>
</nav>