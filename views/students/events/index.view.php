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
                <div style="display: flex; align-items: center; gap: 4rem">
                    <a href="/students/events?month=<?= $month_num - 1 ?>&year=<?= $year ?>">
                        <i class="fa-solid fa-circle-left fa-2xl" style="color: var(--color-primary);"></i>
                    </a>
                    <h1><?= $month_text ?> <?= $year ?></h1>
                    <a href="/students/events?month=<?= $month_num + 1 ?>&year=<?= $year ?>">
                        <i class="fa-solid fa-circle-right fa-2xl" style="color: var(--color-primary);"></i>
                    </a>
                </div>
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
                                <?php foreach ($techtalksByDay[$i] as $event): ?>
                                    <div style="display: flex; flex-direction: column; font-size: 0.7rem; gap: 0.5rem">
                                        <button class="open-button" onclick="openModal('modal<?= $event['id'] ?>')">
                                            <?= htmlspecialchars($event['name'] ?? '') ?>
                                        </button>

                                        <dialog class="modal" id="modal<?= $event['id'] ?>">
                                            <div class="modal-content"
                                                 style="padding: 2rem; display: flex; flex-direction: column; gap: 1rem;">
                                                <h2 class="modal-title"
                                                    style="font-size: 1.75rem; font-weight: 600; color: #1a1a1a; margin: 0; line-height: 1.2;">
                                                    <?= htmlspecialchars($event['title'] ?? 'Event Details') ?>
                                                </h2>
                                                <p class="modal-description"
                                                   style="font-size: 1rem; color: #4a4a4a; line-height: 1.6; margin: 0;">
                                                    <?= htmlspecialchars($event['description']) ?>
                                                </p>
                                                <div style="display: flex; flex-direction: column; gap: 0.75rem; color: #6b7280; font-size: 0.95rem;">
                                                <span class="modal-time" style="display: flex; align-items: center; gap: 0.5rem;">
                                                    <i class="fa-solid fa-clock fa-lg" style="color: #6b7280; width: 1.25rem; text-align: center;"></i>
                                                    <?= htmlspecialchars(date('H:i', strtotime($event['datetime']))) ?>
                                                </span>
                                                    <span class="modal-conductor" style="display: flex; align-items: center; gap: 0.5rem;">
                                                    <i class="fa-solid fa-user fa-lg" style="color: #6b7280; width: 1.25rem; text-align: center;"></i>
                                                    <?= htmlspecialchars($event['conductor_name'] ?? 'Conductor Name') ?>
                                                </span>
                                                    <span class="modal-email" style="display: flex; align-items: center; gap: 0.5rem;">
                                                    <i class="fa-solid fa-envelope fa-lg" style="color: #6b7280; width: 1.25rem; text-align: center;"></i>
                                                    <a href="mailto:<?= htmlspecialchars($event['email'] ?? 'email@example.com') ?>" style="color: #3b82f6; text-decoration: none; transition: color 0.2s ease;">
                                                        <?= htmlspecialchars($event['email'] ?? 'email@example.com') ?>
                                                    </a>
                                                </span>
                                                    <span class="modal-company" style="display: flex; align-items: center; gap: 0.5rem;">
                                                    <i class="fa-solid fa-building fa-lg" style="color: #6b7280; width: 1.25rem; text-align: center;"></i>
                                                    <?= htmlspecialchars($event['name'] ?? 'Company Name') ?>
                                                </span>
                                                </div>
                                                <form method="dialog" class="modal-actions"
                                                      style="display: flex; justify-content: flex-end; margin-top: 1rem;">
                                                    <button type="submit" class="button">
                                                        Close
                                                    </button>
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

    <style>
        .open-button {
            color: var(--color-primary);
        }

        .open-button:hover {
            text-decoration: underline;
        }
    </style>

    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
    <link rel="stylesheet" href="/styles/students/calender.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>