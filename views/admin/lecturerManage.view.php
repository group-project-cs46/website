<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/lecturerManage.css" />
<div class=" mmm">
    <main class="main-content">  
    <section class="content">
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
                    <?php if (isset($_SESSION['success_message'])): ?>
    <div id="successNotification" class="notification">
        <div class="icon-container">
            <span class="icon">✔️</span>
        </div>
        <div class="message"><?= $_SESSION['success_message'] ?></div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const notification = document.getElementById('successNotification');
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        });
    </script>

    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ffffff; /* Sudu background */
            color: #3498db; /* Nil patai text */
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); /* Soft shadow */
            font-size: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 280px;
            max-width: 350px;
            border-left: 5px solid #3498db; /* Nil left border strip */
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
            z-index: 9999;
        }

        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }

        .icon-container {
            background-color: #3498db; /* Nil background */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification .icon {
            color: #ffffff; /* White tick inside */
            font-size: 18px;
        }

        .notification .message {
            flex-grow: 1;
            line-height: 1.4;
        }
    </style>

    <?php unset($_SESSION['success_message']); ?> <!-- Clear after showing -->
<?php endif; ?>
                </tbody>
            </table>
        </section>
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