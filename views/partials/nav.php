<?php

$navItems = [
    [
        'dashboard' => 'Dashboard',
        'href' => '/dashboard',
        'icon' => 'fa-dashboard',
    ],
    [
        'text' => 'About',
        'href' => '/about',
        'icon' => 'fa-lightbulb',
    ],
    [
        'text' => 'Contact',
        'href' => '/contact',
        'icon' => 'fa-envelope',
    ],
    [
        'text' => 'Notes',
        'href' => '/notes',
        'icon' => 'fa-sticky-note',
    ],
];

?>

<nav role="navigation" aria-label="main navigation"
     style="position: fixed; left: 0; top: 0; height: 100vh; width: 50px;">
    <div style="height: 100vh; display: flex; flex-direction: column; justify-content: space-between"
         class="border-r p-1 py-2">
        <div style="display: flex; flex-direction: column;" class="gap-1">
            <?php foreach ($navItems as $item) : ?>
                <a href="<?= $item['href'] ?>"
                   class="text-center rounded-full py-2  <?= urlIs($item['href']) ? 'border text-sky-500' : 'text-gray-700 hover:outline outline-1 outline-gray-200' ?>">
                    <i class="fa-solid <?= $item['icon'] ?> fa-lg"></i>
                    <!--                    --><?php //= $item['text'] ?>
                </a>
            <?php endforeach ?>
        </div>


        <div style="display: flex; flex-direction: column">
            <!--            --><?php //if($_SESSION['user'] ?? false) : ?>
            <!--            --><?php //else : ?>
            <!--                <a href="/register" class="button is-primary">-->
            <!--                    <strong>Sign up</strong>-->
            <!--                </a>-->
            <!--                <a href="/login" class="button is-light">-->
            <!--                    Log in-->
            <!--                </a>-->
            <!--            --><?php //endif; ?>


            <!--            --><?php //if($_SESSION['user'] ?? false) : ?>
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