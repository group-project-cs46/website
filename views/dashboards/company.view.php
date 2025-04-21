<?php require base_path('views/partials/auth/auth.php') ?>
<link rel="stylesheet" href="/styles/company/dashboard.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-gauge" style="font-size: 40px;"></i>
                <h2>Dashboard</h2>
            </div>
        </div>
    </header>

    <section class="content">
        <div class="content-title">
            <h2>Company Dashboard</h2>
        </div>
        <div class="content-boxes">
            <div class="box">
                <h2>Next Company Visit</h2>
                <h3>15.08.2024</h3>
                <h3>3.00 P.M</h3>
            </div>
            <div class="box">
                <h2>Next Techtalk Date</h2>
                <h3>15.08.2024</h3>
                <h3>3.00 P.M</h3>
            </div>
            <div class="box">
                <h2>Selected students</h2>
                <h3>50</h3>
            </div>
        </div>
        <div class="table-title">
            <div class="table-title-txt">
                <h3>Applied students</h3>
                <p>Manage student accounts</p>
            </div>
            <!-- Filter Dropdowns (Removed Filter by Course) -->
            <div class="filter-container">
                <div class="filter-right">
                    <label for="applied-jobrole-filter">Filter by Job Role:</label>
                    <input list="applied-jobrole-options" id="applied-jobrole-filter" class="applied-jobrole-input" oninput="filterAppliedStudents()" placeholder="Type or select a job role">
                    <datalist id="applied-jobrole-options">
                        <option value="Software Engineer">
                        <option value="Cybersecurity Analyst">
                        <option value="DevOps Engineer">
                        <option value="IT Support Specialist">
                        <option value="AI/ML Engineer">
                        <option value="Data Analyst">
                    </datalist>
                </div>
            </div>
        </div>

        <!-- Display error message if no data -->
        <?php if ($errorApplied): ?>
            <p class="error"><?php echo $errorApplied; ?></p>
        <?php else: ?>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No</th>
                        <th>Email</th>
                        <th>Job Role</th>
                        <th>Course</th>
                        <th>Current Job Status</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Student rows will be dynamically populated here -->
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>

<script>
    // Pass PHP array to JavaScript
    const appliedStudents = <?php echo json_encode($appliedStudents); ?>;

    // Function to render the student table
    function renderAppliedTable(students) {
        const tableBody = document.getElementById("studentTableBody");
        tableBody.innerHTML = ""; // Clear existing table rows
        students.forEach(student => {
            const row = document.createElement("tr");
            row.setAttribute("data-jobrole", student.job_role);
            row.innerHTML = `
                <td>${student.student_name}</td>
                <td>${student.index_no}</td>
                <td>${student.email}</td>
                <td>${student.job_role}</td>
                <td>${student.course}</td>
                <td>
                    <button class="status-btn ${student.status === 'Hired' ? 'hired' : 'not-hired'}" disabled>${student.status}</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Function to filter applied students by job role only
    function filterAppliedStudents() {
        const jobRoleFilter = document.getElementById("applied-jobrole-filter").value.trim().toLowerCase();
        const rows = document.querySelectorAll("#studentTableBody tr");

        rows.forEach(row => {
            const jobrole = row.getAttribute("data-jobrole").toLowerCase();
            const matchesJobRole = !jobRoleFilter || jobrole.includes(jobRoleFilter);
            row.style.display = matchesJobRole ? "" : "none";
        });
    }

    // Initialize default render
    document.addEventListener("DOMContentLoaded", () => {
        renderAppliedTable(appliedStudents); // Render all applied students by default
    });
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>