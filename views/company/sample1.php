<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/appliedStudent.css" />
<link rel="stylesheet" href="/styles/company/shortedStudent.css" />
<link rel="stylesheet" href="/styles/company/selectedStudent.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2>Student Management</h2>
            </div>

            <div class="above-right">
                <div class="company-info">
                    <i class="fa-regular fa-building" style="font-size: 40px;"></i>
                    <div class="company-name">Creative<br>Software</div>
                </div>

                <div>
                    <i class="fa-solid fa-bell" style="font-size: 40px;"></i>
                </div>
            </div>
        </div>
    </header>

    <section class="content">
        <div class="table-title">
            <div class="table-system-txt" id="appliedTab" onclick="toggleSection('applied')">
                <h3>Applied Student List</h3>
                <p>Manage student accounts</p>
            </div>

            <div class="divider"></div>

            <div class="table-student-txt" id="shortedTab" onclick="toggleSection('shorted')">
                <h3>Short Listed Student</h3>
                <p>Manage student accounts</p>
            </div>

            <div class="divider"></div>

            <div class="table-student-txt" id="selectedTab" onclick="toggleSection('selected')">
                <h3>Selected Student List</h3>
                <p>Manage student accounts</p>
            </div>
        </div>

        <!-- Applied Student Section -->
        <div class="table-box" id="appliedSection" style="display: none;">
            <!-- Display error message if no data -->
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <!-- Filter Dropdowns -->
            <div class="filter-container">
                <div class="filter-left">
                    <label for="applied-course-filter">Filter by Course:</label>
                    <select id="applied-course-filter" onchange="filterAppliedStudents()">
                        <option value="all">All</option>
                        <option value="CS">CS</option>
                        <option value="IS">IS</option>
                    </select>
                </div>
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
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No</th>
                        <th>Email</th>
                        <th>Job Role</th>
                        <th>Course</th>
                        <th>Current Job Status</th>
                        <th>View CV</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Table rows will be populated by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Short Listed Student Section -->
        <div class="table-box" id="shortedSection" style="display: none;">
            <!-- Filter Dropdowns -->
            <div class="filter-container">
                <div class="filter-right">
                    <label for="shorted-jobrole-filter">Filter by Job Role:</label>
                    <input list="shorted-jobrole-options" id="shorted-jobrole-filter" class="shorted-jobrole-input" oninput="filterShortedStudents()" placeholder="Type or select a job role">
                    <datalist id="shorted-jobrole-options">
                        <option value="Software Engineer">
                        <option value="Cybersecurity Analyst">
                        <option value="DevOps Engineer">
                        <option value="IT Support Specialist">
                        <option value="AI/ML Engineer">
                        <option value="Data Analyst">
                    </datalist>
                </div>
            </div>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Job Role</th>
                        <th>Current Job Status</th>
                        <th>View CV</th>
                        <th>Schedule Interview</th>
                    </tr>
                </thead>
                <tbody id="student-table-body">
                    <!-- Dynamic rows for shorted students -->
                </tbody>
            </table>
        </div>
        <!-- Modal Overlay for Add Interview Form -->
        <div id="addInterviewModal" class="modal-overlay">
            <div class="modal-content">
                <span class="close" onclick="closeAddInterviewModal()">×</span>
                <h1 class="interview-heading">Create Interview Schedule</h1>
                <form onsubmit="handleAddInterviewSubmit(event)">
                    <div class="form-row">
                        <label for="from-venue">Venue:</label>
                        <div class="input-with-icon">
                            <input type="venue" name="venue" id="venue" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="from-date">Date:</label>
                        <div class="input-with-icon">
                            <input type="date" name="date" id="from-date" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="from-time">From:</label>
                        <div class="input-with-icon">
                            <input type="time" name="from-time" id="from-time" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="to-time">To:</label>
                        <div class="input-with-icon">
                            <input type="time" name="to-time" id="to-time" required />
                        </div>
                    </div>

                    <div class="button-container">
                        <button type="submit" class="save-button">SAVE</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success Message Modal -->
        <div id="successModal" class="modal-success">
            <div class="modal-content">
                <span class="close" onclick="closeSuccessModal()">×</span>
                <h2>Interview scheduled successfully!</h2>
            </div>
        </div>

        <!-- Selected Student Section -->
        <div class="table-box" id="selectedSection" style="display: none;">
            <!-- Filter Dropdowns -->
            <div class="filter-container">
                <div class="filter-left">
                    <label for="selected-course-filter">Filter by Course:</label>
                    <select id="selected-course-filter" onchange="filterSelectedStudents()">
                        <option value="all">All</option>
                        <option value="CS">CS</option>
                        <option value="IS">IS</option>
                    </select>
                </div>
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
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No</th>
                        <th>Email</th>
                        <th>Job Role</th>
                        <th>Course</th>
                        <th>View CV</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="select-table-body">
                    <!-- Dynamic rows for selected students -->
                </tbody>
            </table>
        </div>
    </section>
</main>

<script>
// Pass PHP $appliedStudents array to JavaScript
const appliedStudents = <?php echo json_encode($appliedStudents); ?>;

// Function to render applied student table
function renderAppliedTable(students) {
    const tableBody = document.getElementById("studentTableBody");
    tableBody.innerHTML = ""; // Clear existing rows

    students.forEach((student, index) => {
        const row = document.createElement("tr");
        row.setAttribute("data-index", index);
        row.setAttribute("data-email", student.email);
        row.setAttribute("data-course", student.course);
        row.setAttribute("data-jobrole", student.job_role);
        row.setAttribute("data-application-id", student.application_id);
        row.innerHTML = `
            <td>${student.student_name}</td>
            <td>${student.index_no}</td>
            <td>${student.email}</td>
            <td>${student.job_role}</td>
            <td>${student.course}</td>
            <td>
                <button class="applied-status-btn ${student.status === "Hired" ? "hired" : "not-hired"}" onclick="toggleStatus(this, ${index}, 'applied')">${student.status}</button>
            </td>
            <td>
                ${student.cv_filename ? 
                    `<a href="/cvs/${student.cv_filename}" target="_blank" class="applied-view-btn">View (${student.cv_original_name})</a>` : 
                    `<button class="applied-view-btn" disabled>No CV</button>`
                }
            </td>
            <td>
                <button class="applied-btn applied-select-btn" onclick="selectStudent(${index})">Select</button>
            </td>
            <td>
                <button class="applied-btn applied-reject-btn" onclick="rejectStudent(${index})">Reject</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Function to filter applied students by course and job role (DOM-based filtering)
function filterAppliedStudents() {
    const courseFilter = document.getElementById("applied-course-filter").value;
    const jobRoleFilter = document.getElementById("applied-jobrole-filter").value.trim().toLowerCase();
    const rows = document.querySelectorAll("#studentTableBody tr");

    rows.forEach(row => {
        const course = row.getAttribute("data-course");
        const jobrole = row.getAttribute("data-jobrole").toLowerCase();

        const matchesCourse = courseFilter === "all" || course === courseFilter;
        const matchesJobRole = !jobRoleFilter || jobrole.includes(jobRoleFilter);

        row.style.display = matchesCourse && matchesJobRole ? "" : "none";
    });
}

// Function to handle selecting a student
function selectStudent(index) {
    const student = appliedStudents[index];
    
    // Check if the student is already hired
    if (student.status === "Hired") {
        alert("This student has already been hired by another company.");
        return;
    }

    const alreadyShorted = shortedStudents.some(s => s.email === student.email && s.job_role === student.job_role);

    if (!alreadyShorted) {
        shortedStudents.push({
            name: student.student_name,
            email: student.email,
            jobrole: student.job_role,
            status: "Not Hired",
            course: student.course,
            index: student.index_no,
            application_id: student.application_id
        });

        // Update the backend to mark as selected (sets selected = TRUE)
        fetch('/company/select-student', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ application_id: student.application_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                student.status = "Hired"; // Reflect selected = TRUE
                renderAppliedTable(appliedStudents);
                alert(`${student.student_name} has been added to the Shorted Student List.`);
            } else {
                alert('Failed to select student.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while selecting the student.');
        });
    } else {
        alert(`${student.student_name} is already in the Shorted Student List for ${student.job_role}.`);
    }
}

// Function to handle rejecting a student
function rejectStudent(index) {
    const student = appliedStudents[index];

    if (confirm(`Are you sure you want to reject ${student.student_name}?`)) {
        // Update the backend to mark as rejected
        fetch('/company/reject-student', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ application_id: student.application_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the student from the appliedStudents array
                appliedStudents.splice(index, 1);
                renderAppliedTable(appliedStudents);
                alert(`${student.student_name} has been rejected.`);
            } else {
                alert('Failed to reject student.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while rejecting the student.');
        });
    }
}

// Unified toggleStatus function for both applied and shorted students
function toggleStatus(button, index, section) {
    if (section === "applied") {
        const student = appliedStudents[index];
        if (student.status === "Hired") {
            alert("This student has already been hired by another company.");
            return;
        }

        // Update the backend to mark as selected (sets selected = TRUE)
        fetch('/company/select-student', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ application_id: student.application_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                student.status = "Hired"; // Reflect selected = TRUE
                renderAppliedTable(appliedStudents);
            } else {
                alert('Failed to update status.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the status.');
        });
    } else if (section === "shorted") {
        const student = shortedStudents[index];
        if (student.status === "Hired") {
            alert("This student has already been hired by another company.");
            return;
        }
        student.status = "Hired";
        button.textContent = "Hired";
        button.className = "short-status-btn hired";
        loadStudents(shortedStudents);
    }
}

// Function to toggle sections
function toggleSection(section) {
    const sections = ["applied", "shorted", "selected"];
    sections.forEach((sec) => {
        document.getElementById(`${sec}Section`).style.display = sec === section ? "block" : "none";
        document.getElementById(`${sec}Tab`).classList.toggle("active", sec === section);
    });

    // Reset filters for the selected section
    if (section === "applied") {
        document.getElementById("applied-course-filter").value = "all";
        document.getElementById("applied-jobrole-filter").value = "";
        renderAppliedTable(appliedStudents); // Render the table when the section is selected
        filterAppliedStudents(); // Apply filters
    }
    if (section === "shorted") {
        document.getElementById("shorted-jobrole-filter").value = "";
        loadStudents(shortedStudents);
    }
    if (section === "selected") {
        document.getElementById("selected-course-filter").value = "all";
        document.getElementById("selected-jobrole-filter").value = "";
        renderSelectedTable(selectedStudents);
    }
}

// Function to filter shorted students by job role
function filterShortedStudents() {
    const jobRoleFilter = document.getElementById("shorted-jobrole-filter").value.trim().toLowerCase();
    let filteredStudents = shortedStudents;

    if (jobRoleFilter) {
        filteredStudents = filteredStudents.filter(student =>
            student.jobrole && student.jobrole.toLowerCase().includes(jobRoleFilter)
        );
    }

    loadStudents(filteredStudents);
}

// Function to filter selected students by course and job role
function filterSelectedStudents() {
    const courseFilter = document.getElementById("selected-course-filter").value;
    const jobRoleFilter = document.getElementById("selected-jobrole-filter").value.trim().toLowerCase();
    let filteredStudents = selectedStudents;

    if (courseFilter !== "all") {
        filteredStudents = filteredStudents.filter(student => student.course === courseFilter);
    }

    if (jobRoleFilter) {
        filteredStudents = filteredStudents.filter(student =>
            student.jobrole && student.jobrole.toLowerCase().includes(jobRoleFilter)
        );
    }

    renderSelectedTable(filteredStudents);
}

// Function to open the modal to schedule an interview
function openAddInterviewModal(button) {
    const studentIndex = button.getAttribute("data-student-index");
    document.getElementById("addInterviewModal").style.display = "flex";
    document.getElementById("addInterviewModal").setAttribute("data-student-index", studentIndex);
}

// Function to close the modal
function closeAddInterviewModal() {
    document.getElementById("addInterviewModal").style.display = "none";
}

// Function to show success modal
function openSuccessModal() {
    const successModal = document.getElementById("successModal");
    successModal.style.display = "flex";
    setTimeout(() => successModal.style.display = "none", 2000);
}

// Function to close success modal
function closeSuccessModal() {
    document.getElementById("successModal").style.display = "none";
}

// Function to handle form submission
function handleAddInterviewSubmit(event) {
    event.preventDefault();
    const date = document.getElementById("from-date").value;
    const fromTime = document.getElementById("from-time").value;
    const toTime = document.getElementById("to-time").value;

    if (!date || !fromTime || !toTime || fromTime >= toTime) {
        alert("Please enter a valid date and time range.");
        return;
    }

    const studentIndex = document.getElementById("addInterviewModal").getAttribute("data-student-index");
    scheduledStudents[studentIndex] = true;
    loadStudents(shortedStudents);

    closeAddInterviewModal();
    openSuccessModal();
}

// Function to view student details (updated for shorted and selected sections)
function viewStudent(index, section) {
    let student;
    if (section === "shorted") {
        student = shortedStudents[index];
        alert(`
            Viewing details:
            Name: ${student.name}
            Email: ${student.email}
            Job Role: ${student.jobrole}
            Status: ${student.status}
        `);
    } else if (section === "selected") {
        student = selectedStudents[index];
        window.location.href = "/company/onlycv";
    }
}

// Initialize default render
document.addEventListener("DOMContentLoaded", () => {
    toggleSection("applied"); // Show the applied students tab by default
    renderAppliedTable(appliedStudents); // Render the applied students table on page load
    loadStudents(shortedStudents); // Load shorted students
    renderSelectedTable(selectedStudents); // Render selected students
});
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>

this is my php code 


<?php

namespace Models;

use Core\App;
use Core\Database;

class companyStudent
{
    public static function fetchAllStudents()
    {
        // Resolve database connection
        $db = App::resolve(Database::class);

        // Query to fetch applied students with their job roles, CVs, and shortlisted status
        $students = $db->query('
            SELECT 
                u.name AS student_name,
                s.index_number AS index_no,
                u.email,
                s.course,
                a.job_role,
                c.filename AS cv_filename,
                c.original_name AS cv_original_name,
                app.selected,
                app.shortlisted,
                app.id AS application_id
            FROM users u
            INNER JOIN students s ON u.id = s.id
            INNER JOIN applications app ON s.id = app.student_id
            INNER JOIN advertisements a ON app.ad_id = a.id
            LEFT JOIN cvs c ON app.cv_id = c.id
            WHERE u.role = 2;
        ', [])->get();

        // Add a status field based on the 'selected' column
        foreach ($students as &$student) {
            // Handle different possible representations of TRUE/FALSE for selected
            $isSelected = filter_var($student['selected'], FILTER_VALIDATE_BOOLEAN);
            $student['status'] = $isSelected ? 'Hired' : 'Not Hired';
        }
        unset($student);

        return $students;
    }

}
this is my model

also i am add my table photo

when i click applied student select button( <td>
                <button class="applied-btn applied-select-btn" onclick="selectStudent(${index})">Select</button>
            </td>)  that time store

in backend application table shortlisted column value as TRUE  

create new controller also