<?php require base_path('views/partials/head.php') ?>

    <div class="flex justify-end">
        <?php if ($_SESSION['user'] ?? false) : ?>
        <?php else : ?>
            <a href="/register" class="button is-primary">
                <strong>Sign up</strong>
            </a>
            <a href="/login" class="button is-light">
                Log in
            </a>
        <?php endif; ?>
    </div>

    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec est nisl. Integer euismod efficitur
    ipsum,
    sed mattis eros sodales at. Vestibulum lobortis id nunc et consectetur. Duis sit amet accumsan mauris, ut
    tincidunt purus. Nulla pulvinar gravida nunc ac dictum. Ut bibendum nisl et velit suscipit lacinia. Fusce
    hendrerit nisl justo, ut ultricies arcu consectetur a.

    Ut maximus tincidunt nisi a porttitor. Sed imperdiet quis diam a condimentum. Praesent at nisi sit amet leo
    bibendum semper. Curabitur placerat consequat dignissim. Donec fermentum aliquet felis, vitae sollicitudin
    felis
    pulvinar vitae. Maecenas malesuada interdum lacinia. Aliquam sagittis, quam nec volutpat facilisis, enim
    nisi
    pretium enim, a porta dui dolor non turpis.


    <div class="tooltip">Hover over me
        <span class="tooltiptext">Tooltip text</span>
    </div>


<?php require base_path('views/partials/foot.php') ?>