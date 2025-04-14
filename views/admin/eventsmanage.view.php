<?php require base_path('views/partials/auth/auth.php'); ?>



<link rel="stylesheet" href="/styles/pasindu/eventsManage.css" />
<div class=" mmm">
    <main class="main-content">  
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2><b>Manage Events</b></h2>
            </div>
            <input type="text" placeholder="Search Events..." class="search-bar" id="searchInput" onkeyup="searchTable()">
            
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Events</b></h3>
                    <p>Manage Events Accounts</p>
                </div>
                <button class="add-button" id="openFormButton"><a href="/eventsAdd">+ New</a></button>
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th>Event No</th>
                        <th>Competition Name</th>
                        <th>Date</th>
                        <th>time</th>
                        <th>Deadline Date</th>
                        <th>Deadline Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Example Table Rows -->

                    <tr>
        <td>001</td>
        <td>Hour of Code</td>
        <td>2025-03-10</td>
        <td>10:00</td>
        <td>2025-04-10</td>
        <td>10:00</td>
        <td class="actions">
        <a href="/eventsView?id=example" class="view-button">View</a>
            <a href="/eventsEdit?id=example" class="view-button">Edit</a>
            <form action="/eventsDeletion" method="post">
                <input type="hidden" name="id" value="example">
                <button type="submit" class="disable-button">Disable</button>
            </form>
        </td>
    </tr>

    <tr>
        <td>002</td>
        <td>Revelux</td>
        <td>2025-03-10</td>
        <td>10:00</td>
        <td>2025-04-10</td>
        <td>10:00</td>
        <td class="actions">
        <a href="/eventsView?id=example" class="view-button">View</a>
            <a href="/eventsEdit?id=example" class="view-button">Edit</a>
            <form action="/eventsDeletion" method="post">
                <input type="hidden" name="id" value="example">
                <button type="submit" class="disable-button">Disable</button>
            </form>
        </td>
    </tr>
                    <?php foreach ($EVENTS_data as $events): ?>
                        <tr>
                            <td><?= $events['events_no'] ?></td>
                            <td><?= $events['name'] ?></td>
                            <td><?= $events['date'] ?></td>
                            <td><?= $events['time'] ?></td>
                            <td><?= $events['deadline_date'] ?></td>
                            <td><?= $events['deadine_time'] ?></td>
                            <td class="actions">
                                <a href="/eventsEdit?id=<?= $events['id'] ?>" class="view-button">Edit</a>
                                <form action="/eventsDeletion" method="post">
                                    <input type="hidden" name="id" value="<?= $events['id'] ?>">
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
        const table = document.getElementById("studentTableBody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            let rowText = rows[i].textContent.toLowerCase();
            rows[i].style.display = rowText.includes(filter) ? "" : "none";
        }
    }
</script>

</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>