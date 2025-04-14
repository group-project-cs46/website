<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/track.css" />
<div class="mmm">
    <main class="main-content">  
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2><b>Manage PDC</b></h2>
            </div>
            <input type="text" placeholder="Search PDC Accounts..." class="search-bar" id="searchInput" onkeyup="searchTable()">
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage PDC</b></h3>
                    <p>Manage PDC Accounts</p>
                </div>
                <button class="trackR-button" id="openFormButton"><a href="/eventStudentsManage"> Attendance Track</a></button>
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th>Employee No</th>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Search & Check</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Example Table Rows -->
                    <tr>
                        <td>EMP001</td>
                        <td>Dr.</td>
                        <td>John Doe</td>
                        <td>0712345678</td>
                        <td>john.doe@example.com</td>
                        <td class="actions">
                            <input type="text" placeholder="Search..." class="row-search" />
                            <button class="check-button">Check</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EMP002</td>
                        <td>Ms.</td>
                        <td>Jane Smith</td>
                        <td>0723456789</td>
                        <td>jane.smith@example.com</td>
                        <td class="actions">
                            <input type="text" placeholder="Search..." class="row-search" />
                            <button class="check-button">Check</button>
                        </td>
                    </tr>

                    <?php foreach ($PDC_data as $pdcs): ?>
                        <tr>
                            <td><?= $pdcs['employee_id'] ?></td>
                            <td><?= $pdcs['title'] ?></td>
                            <td><?= $pdcs['name'] ?></td>
                            <td><?= $pdcs['mobile'] ?></td>
                            <td><?= $pdcs['email'] ?></td>
                            <td class="actions">
                                <input type="text" placeholder="Search..." class="row-search" />
                                <button class="check-button">Check</button>
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

    // Add event listeners for all row check buttons
    document.addEventListener("DOMContentLoaded", () => {
        const checkButtons = document.querySelectorAll(".check-button");

        checkButtons.forEach(button => {
            button.addEventListener("click", () => {
                const input = button.previousElementSibling;
                if (input.value.trim() !== "") {
                    button.textContent = "✔ Checked";
                    button.classList.add("checked");
                    button.disabled = true; // Optional: disable after checking
                } else {
                    alert("Please enter a value to check.");
                }
            });
        });
    });

    
    </script>
</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>
