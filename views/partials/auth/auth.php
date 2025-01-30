<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div style="display: grid; grid-template-columns: 50px 1fr; grid-template-rows: 50px 1fr">
    <div></div>
    <div style="border-bottom: 1px solid #d1d5db; display: flex; justify-content: end; align-items: center">
        <div style="display: flex; align-items: center; gap: 0.5rem; padding-right: 1rem">
            <span class="bell-icon">
                <i class="fa-solid fa-bell fa-xl"></i>
            </span>
            <div style="font-weight: 500"><?php echo $_SESSION['user']['name'] ?></div>
            <a href="/account">
                <img src="<?= $_SESSION['user']['photo'] ?>" style="width: 2.5rem; height: 2.5rem; object-fit: cover; border-radius: 100%; border: 1px solid var(--color-primary)" alt="">

            </a>
        </div>
    </div>
    <div></div>

    <div style="padding-inline: 0.5rem">