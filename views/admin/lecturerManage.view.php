<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/lecturerManage.css" />
<div class=" mmm">
    <main class="main-content">  
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2><b>Manage Lecturer</b></h2>
            </div>
            <input type="text" placeholder="Search Lecturer Accounts..." class="search-bar" id="searchInput" onkeyup="searchTable()">
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Lecturer</b></h3>
                    <p>Manage Lecturer Accounts</p>
                </div>
                <button class="add-button" id="openFormButton"><a href="/lecturerAdd">+ New</a></button>
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th>Employee No</th>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Example Table Rows -->
                    <?php foreach ($LECTURER_data as $lecturers): ?>
                        <tr>
                            <td><?= $lecturers['employee_id'] ?></td>
                            <td><?= $lecturers['title'] ?></td>
                            <td><?= $lecturers['name'] ?></td>
                            <td><?= $lecturers['mobile'] ?></td>
                            <td><?= $lecturers['email'] ?></td>
                            <td class="actions">
                                <a href="/lecturerEdit?id=<?= $lecturers['id'] ?>" class="view-button">Edit</a>

                                <!-- <form action="/lecturerDeletion" method="post">
                                    <input type="hidden" name="id" value="<?= $lecturers['id'] ?>">
                                    <button type="submit" class="disable-button">Disable</button>
                                </form> -->

                                <form action="/lecturerToggleStatus" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $lecturers['id'] ?>">
                                    <?php if ($lecturers['approved']): ?>
                                        <button type="submit" class="disable-button">Disable</button>
                                    <?php else: ?>
                                        <button type="submit" class="enable-button">Enable</button>
                                    <?php endif; ?>
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