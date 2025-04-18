<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/eventsManage.css" />
<div class=" mmm">
    <main class="main-content">  
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2><b>Manage Students</b></h2>
            </div>
            <input type="text" placeholder="Search Students Accounts..." class="search-bar" id="searchInput" onkeyup="searchTable()">
            
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Students</b></h3>
                    <p>Manage Students Accounts</p>
                </div>
                <div class="track-container">
                <!-- <input type="text" placeholder="Enter code..." class="track-input" /> -->
                <input type="text" placeholder="Enter code..." class="track-input" value="<?= $EVENT_NO ?>" readonly />

                <button class="track-button" id="openFormButton"><a href="/track">Attendance Track</a></button>
                <button class="add-button" id="openFormButton"><a href="/eventStudentsAdd">+ New</a></button>
            </div>
            </div>

           


            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student No</th>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Example Table Rows -->

                    
    <!-- <tr>
        <td>ST001</td>
        <td>Mr.</td>
        <td>Pasindu Perera</td>
        <td>CS</td>
        <td>0712345678</td>
        <td>pasindu@example.com</td>
        <td class="actions">
            <a href="/eventStudentsEdit?id=1" class="view-button">Edit</a>
            <form action="/pdcDeletion" method="post">
                <input type="hidden" name="id" value="1">
                <button type="submit" class="disable-button">Disable</button>
            </form>
        </td>
    </tr>
    <tr>
        <td>ST002</td>
        <td>Ms.</td>
        <td>Thearushi Silva</td>
        <td>IS</td>
        <td>0776543210</td>
        <td>thearushi@example.com</td>
        <td class="actions">
            <a href="/pdcEdit?id=2" class="view-button">Edit</a>
            <form action="/pdcDeletion" method="post">
                <input type="hidden" name="id" value="2">
                <button type="submit" class="disable-button">Disable</button>
            </form>
        </td>
    </tr> -->


                    <?php foreach ($STUDENT_data as $students): ?>
                        <tr>
                            <td><?= $students['student_id'] ?></td>
                            <td><?= $students['title'] ?></td>
                            <td><?= $students['name'] ?></td>
                            <td><?= $students['course'] ?></td>
                            <td><?= $students['mobile'] ?></td>
                            <td><?= $students['email'] ?></td>
                            <td class="actions">
                                <a href="/pdcEdit?id=<?= $students['id'] ?>" class="view-button">Edit</a>
                                <form action="/eventsStudentsDeletion" method="post">
                                    <input type="hidden" name="id" value="<?= $students['id'] ?>">
                                    <button type="submit" class="disable-button">Delete</button>
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