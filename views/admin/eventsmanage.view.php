<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/eventsManage.css" />
<div class="mmm">
    <main class="main-content">  
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-calendar-check" style="font-size: 40px;"></i>
                <h2><b>Manage Events</b></h2>
            </div>
            <input type="text" placeholder="Search Events..." class="search-bar" id="searchInput" onkeyup="searchTable()">
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Events</b></h3>
                    <p>Manage Events Records</p>
                </div>
                <button class="add-button" id="openFormButton"><a href="/eventsAdd">+ New</a></button>
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th>Event No</th>
                        <th>Competition Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Deadline Date</th>
                        <th>Deadline Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <?php foreach ($EVENTS_data as $event): ?>
                        <tr>
                            <td><?= $event['events_no'] ?></td>
                            <td><?= $event['name'] ?></td>
                            <td><?= $event['date'] ?></td>
                            <td><?= $event['time'] ?></td>
                            <td><?= $event['deadline_date'] ?></td>
                            <td><?= $event['deadline_time'] ?></td>
                            <td class="actions">
                                <a href="/eventsView?id=<?= $event['events_no'] ?>" class="view-button">View</a>
                                <a href="/eventsEdit?id=<?=$event['events_no'] ?>" class="view-button">Edit</a>
                                <form action="/eventsDeletion" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?=$event['events_no'] ?>">
                                    <button type="submit" class="disable-button">Disable</button>
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
    </script>
</div>

<?php require base_path('views/partials/auth/auth-close.php'); ?>
