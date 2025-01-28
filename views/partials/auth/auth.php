<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div style="display: grid; grid-template-columns: 50px 1fr; grid-template-rows: 50px 1fr">
    <div></div>
    <div style="border-bottom: 1px solid #d1d5db; display: flex; justify-content: end; align-items: center">
        <div style="display: flex; align-items: center; gap: 0.5rem; padding-right: 1rem">
            <div><?php echo $_SESSION['user']['name'] ?></div>
                <img src="https://picsum.photos/200/200" style="width: 2.5rem; height: auto; border-radius: 100%; border: 2px solid var(--color-primary)" alt="">
        </div>
    </div>
    <div></div>

    <div style="padding-inline: 0.5rem">