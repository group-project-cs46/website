<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/pdcManage.css" />
<div class="mmm">
    <main class="main-content"> 
    <section class="content">
 
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2><b>Manage Students Attendance</b></h2>
            </div>
            <input type="text" placeholder="Search Students Accounts..." class="search-bar" id="searchInput" onkeyup="searchTable()">
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Students Attendance</b></h3>
                    <p>Manage Students Accounts</p>
                </div>
            </div>

            <div class="table-container">
                <table class="student-table">
                <thead>
                    <tr>
                        <th>Student No</th>
                        <th>Name</th>
                        <th>Index Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Display registered students -->
                    <?php foreach ($TRAINING as $attendance): ?>
                        <tr>
                            <td><?= $attendance['re_no'] ?></td>
                            <td><?= $attendance['sname'] ?></td>
                            <td><?= $attendance['index_no'] ?></td>
                            <td><?= $attendance['semail'] ?></td>
                            <td class="actions">
                                <form action="/trainingSession" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $attendance['id'] ?>">
                                    <?php if ($attendance['attended']): ?>
                                        <button type="submit" class="enable-button">Attended</button>
                                    <?php else: ?>
                                        <button type="submit" class="disable-button">Not Attend</button>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
            </div>
        </section>
        <section class="content">

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
