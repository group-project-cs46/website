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

    <script>
        function openModal(id) {
            const modal = document.getElementById(id)
            modal.showModal();
        }
    </script>

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
                                        <button class="open-button" onclick="openModal('modal<?= $techtalk['id'] ?>')">
                                            <?= htmlspecialchars($techtalk['name'] ?? '') ?>
                                        </button>

                                        <dialog class="modal" id="modal<?= $techtalk['id'] ?>">
                                            <div class="modal-content">
                                                <h2 class="modal-title"><?= htmlspecialchars($techtalk['title'] ?? 'Event Details') ?></h2>
                                                <p class="modal-description"><?= htmlspecialchars($techtalk['description']) ?></p>
                                                <div class="modal-meta">
                                                <span class="modal-time">
                                                    <i class="fa-solid fa-clock fa-lg"></i>
                                                    <?= htmlspecialchars(date('H:i', strtotime($techtalk['datetime']))) ?>
                                                </span>
                                                                                        <span class="modal-conductor">
                                                    <i class="fa-solid fa-user fa-lg"></i>
                                                    <?= htmlspecialchars($techtalk['conductor_name'] ?? 'Conductor Name') ?>
                                                </span>
                                                                                        <span class="modal-email">
                                                    <i class="fa-solid fa-envelope fa-lg"></i>
                                                    <a href="mailto:<?= htmlspecialchars($techtalk['email'] ?? 'email@example.com') ?>">
                                                        <?= htmlspecialchars($techtalk['email'] ?? 'email@example.com') ?>
                                                    </a>
                                                </span>
                                                                                        <span class="modal-company">
                                                    <i class="fa-solid fa-building fa-lg"></i>
                                                    <?= htmlspecialchars($techtalk['name'] ?? 'Company Name') ?>
                                                </span>
                                                </div>
                                                <form method="dialog" class="modal-actions">
                                                    <button type="submit" class="confirm-button">Close</button>
                                                </form>
                                            </div>
                                        </dialog>
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