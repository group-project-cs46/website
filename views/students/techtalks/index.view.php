<?php
// Group techtalks by day
$techtalksByDay = [];
foreach ($techtalks as $techtalk) {
    $day = (int)date('j', strtotime($techtalk['datetime']));
    if (!isset($techtalksByDay[$day])) {
        $techtalksByDay[$day] = [];
    }
    $techtalksByDay[$day][] = $techtalk;
}

//dd($techtalksByDay);
?>

<?php require base_path('views/partials/auth/auth.php') ?>

    <main>
        <div class="container">

            <div class="calender">
                <!-- days sourced from: https://nationaldaycalendar.com/february/ -->
                <h1><?= $month_text ?> <?= $year ?></h1>
                <ul>
                    <p>
                        Monday
                    </p>
                    <p>
                        Tuesday
                    </p>
                    <p>
                        Wednesday
                    </p>
                    <p>
                        Thursday
                    </p>
                    <p>
                        Friday
                    </p>
                    <p>
                        Saturday
                    </p>
                    <p>
                        Sunday
                    </p>


                    <?php for ($i = 1; $i < $first_day; $i++): ?>
                        <p></p>
                    <?php endfor; ?>


                    <?php for ($i = 1; $i <= $days_in_month; $i++): ?>
                        <li>
                            <time datetime="<?= $year ?>-<?= $month_num ?>-<?= $i ?>">
                                <span style="font-weight: <?= ($i == $today) ? '600' : '' ?> ">
                                    <?= $i ?>
                                </span>
                            </time>
                            <?php if (isset($techtalksByDay[$i])): ?>
                                <?php foreach ($techtalksByDay[$i] as $techtalk): ?>
                                    <div style="display: flex; flex-direction: column; font-size: 0.7rem; gap: 0.5rem">
                                        <span><?= htmlspecialchars($techtalk['title']) ?></span>
                                        <span><?= htmlspecialchars(date('H:i', strtotime($techtalk['datetime']))) ?></span>
                                        <span><?= htmlspecialchars($techtalk['name'] ?? '') ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>

        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
    <link rel="stylesheet" href="/styles/students/calender.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>