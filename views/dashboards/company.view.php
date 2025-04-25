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
                <?php if ($nextCompanyVisit): ?>
                    <?php
                        $visitDate = date('d.m.Y', strtotime($nextCompanyVisit['date']));
                        $visitTime = date('g.i A', strtotime($nextCompanyVisit['time']));
                    ?>
                    <h3>Date : <?php echo $visitDate; ?></h3>
                    <h3>Time : <?php echo $visitTime; ?></h3>
                <?php else: ?>
                    <h3>No upcoming company visits scheduled.</h3>
                <?php endif; ?>
            </div>
            <div class="box">
                <h2>Next Techtalk Date</h2>
                <?php if ($nextTechTalk): ?>
                    <?php
                        $techTalkDateTime = new DateTime($nextTechTalk['datetime']);
                        $techTalkDate = $techTalkDateTime->format('d.m.Y');
                        $techTalkTime = $techTalkDateTime->format('g.i A');
                    ?>
                    <h3>Date : <?php echo $techTalkDate; ?></h3>
                    <h3>Time : <?php echo $techTalkTime; ?></h3>
                <?php else: ?>
                    <h3>No upcoming tech talks scheduled.</h3>
                <?php endif; ?>
            </div>
        </div>
        <div class="table-title">
            <div class="table-title-txt">
                <h3>Selected Students List</h3>
            </div>
            <!-- Filter Dropdowns (Removed Filter by Course) -->
            <?php if ($selectedStudents): ?>
                <div class="filter-container">
                    <div class="filter-right">
                        <label for="selected-jobrole-filter">Filter by Job Role:</label>
                        <input list="selected-jobrole-options" id="selected-jobrole-filter" class="selected-jobrole-input" oninput="filterSelectedStudents()" placeholder="Type or select a job role">
                        <datalist id="selected-jobrole-options">
                            <option value="Software Engineer">
                            <option value="Cybersecurity Analyst">
                            <option value="DevOps Engineer">
                            <option value="IT Support Specialist">
                            <option value="AI/ML Engineer">
                            <option value="Data Analyst">
                        </datalist>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Display error message if no data -->
        <?php if ($errorSelected): ?>
            <p class="error"><?php echo $errorSelected; ?></p>
        <?php else: ?>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No</th>
                        <th>Email</th>
                        <th>Job Role</th>
                        <th>Course</th>
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
const selectedStudents = <?php echo json_encode($selectedStudents); ?>;

// Function to render the student table
function renderSelectedTable(students) {
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
        `;
        tableBody.appendChild(row);
    });
}

// Function to filter selected students by job role only
function filterSelectedStudents() {
    const jobRoleFilter = document.getElementById("selected-jobrole-filter").value.trim().toLowerCase();
    const rows = document.querySelectorAll("#studentTableBody tr");

    rows.forEach(row => {
        const jobrole = row.getAttribute("data-jobrole").toLowerCase();
        const matchesJobRole = !jobRoleFilter || jobrole.includes(jobRoleFilter);
        row.style.display = matchesJobRole ? "" : "none";
    });
}

// Initialize default render
document.addEventListener("DOMContentLoaded", () => {
    renderSelectedTable(selectedStudents); // Render all selected students by default
});
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>