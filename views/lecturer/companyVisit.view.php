<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/eventsManage.css" />
<div class="mmm">
    <main class="main-content">  
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-calendar-check" style="font-size: 40px;"></i>
                <h2><b>Manage Company Visit</b></h2>
            </div>
            <input type="text" placeholder="Search Company Visit..." class="search-bar" id="searchInput" onkeyup="searchTable()">
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Company Visit</b></h3>
                    <p>Manage Company Visit Schedule</p>
                </div>
                <!-- <button class="add-button" id="openFormButton"><a href="/trainingAdd">+ New</a></button> -->
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>                       
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">


                <?php
                // Dummy lecturer_visits data
                $lecturer_visits = [
                    [
                        'id' => 1,
                        'company_id' => 101,
                        'company_name' => 'ABC Tech Ltd',
                        'date' => '2025-05-01',
                        'time' => '10:00:00',
                        'status' => 'scheduled'
                    ],
                    [
                        'id' => 2,
                        'company_id' => 102,
                        'company_name' => 'Beta Innovations',
                        'date' => '2025-05-03',
                        'time' => '14:30:00',
                        'status' => 'visited'
                    ],
                    [
                        'id' => 3,
                        'company_id' => 103,
                        'company_name' => 'Creative Solutions',
                        'date' => '2025-05-05',
                        'time' => '09:00:00',
                        'status' => 'cancelled'
                    ],
                ];
                ?>

                    <?php foreach ($lecturer_visits as $item): ?>
                        <tr>       
                            <td><?= htmlspecialchars($item['company_name']) ?></td>
                            <td><?= date('d-m-Y', strtotime($item['date'])) ?></td>
                            <td><?= date('H:i', strtotime($item['time'])) ?></td>
                            <td><?= ucwords($item['status']) ?>  <a href="/trainingView?id=<?= $item['id'] ?>" class="view-button">Visit</a>
                            </td>
                            <td class="actions">
                                <!-- Visit Button -->
                                <!-- View Button (newly added) -->
                                <a href="/VisitView?id=<?= $item['id'] ?>" class="view-button">View</a>

                                <!-- Delete Button -->
                                <form action="/trainingView" method="post" style="display:inline;" onsubmit="return confirmReject();">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="disable-button">Reject</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
    function searchTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const rows = document.getElementById("studentTableBody").getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const rowText = rows[i].textContent.toLowerCase();
            rows[i].style.display = rowText.includes(filter) ? "" : "none";
        }
    }

    function confirmReject() {
        return confirm("Are you sure you want to delete this session?");
    }


    </script>
</div>

<?php require base_path('views/partials/auth/auth-close.php'); ?>
