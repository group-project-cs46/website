<?php

enum Role: int
{
    case Admin = 1;
    case Student = 2;
}

$navItems = [
    [
        'text' => 'Dashboard',
        'href' => '/dashboard',
        'icon' => 'fa-dashboard',
        'only' => [Role::Admin, Role::Student],
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
    ]
//    [
//        'text' => 'Contact',
//        'href' => '/contact',
//        'icon' => 'fa-envelope',
//    ],
//    [
//        'text' => 'Notes',
//        'href' => '/notes',
//        'icon' => 'fa-sticky-note',
//    ],
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
            <!--                        --><?php //if($_SESSION['user'] ?? false) : ?>
            <!--                        --><?php //else : ?>
            <!--                            <a href="/register" class="button is-primary">-->
            <!--                                <strong>Sign up</strong>-->
            <!--                            </a>-->
            <!--                            <a href="/login" class="button is-light">-->
            <!--                                Log in-->
            <!--                            </a>-->
            <!--                        --><?php //endif; ?>


            <!--                        --><?php //if($_SESSION['user'] ?? false) : ?>
            <form style="width: 100%; margin: 0" action="/sessions" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <button style="width: 100%; margin: 0" class="button text-rose-700">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i>
                </button>
            </form>
            <!--            --><?php //endif ?>
        </div>

    </div>
</nav>