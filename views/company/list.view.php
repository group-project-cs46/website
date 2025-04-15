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
            <?php if ($errorApplied): ?>
                <p class="error"><?php echo $errorApplied; ?></p>
            <?php else: ?>
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
            <?php endif; ?>
        </div>

        <!-- Short Listed Student Section -->
        <div class="table-box" id="shortedSection" style="display: none;">
            <!-- Display error message if no data -->
            <?php if ($errorShortlisted): ?>
                <p class="error"><?php echo $errorShortlisted; ?></p>
            <?php else: ?>
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
                        <!-- Dynamic rows for shortlisted students -->
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- Modal Overlay for Add Interview Form -->
        <div id="addInterviewModal" class="modal-overlay">
            <div class="modal-content">
                <span class="close" onclick="closeAddInterviewModal()">×</span>
                <h1 class="interview-heading">Create Interview Schedule</h1>
                <form onsubmit="handleAddInterviewSubmit(event)">
                    <div class="form-row">
                        <label for="venue">Venue:</label>
                        <div class="input-with-icon">
                            <input type="text" name="venue" id="venue" required />
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
            <!-- Display error message if no data -->
            <?php if ($errorSelected): ?>
                <p class="error"><?php echo $errorSelected; ?></p>
            <?php else: ?>
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
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
// Pass PHP arrays to JavaScript
const appliedStudents = <?php echo json_encode($appliedStudents); ?>;
const shortlistedStudents = <?php echo json_encode($shortlistedStudents); ?>;
const selectedStudents = <?php echo json_encode($selectedStudents); ?>;

// Track scheduled interviews
const scheduledStudents = Array(shortlistedStudents.length).fill(false);

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

// Function to render shortlisted student table
function renderShortlistedTable(students) {
    const tableBody = document.getElementById("student-table-body");
    tableBody.innerHTML = ""; // Clear existing rows

    students.forEach((student, index) => {
        const row = document.createElement("tr");
        row.setAttribute("data-index", index);
        row.setAttribute("data-email", student.email);
        row.setAttribute("data-jobrole", student.job_role);
        row.setAttribute("data-application-id", student.application_id);

        row.innerHTML = `
            <td>${student.student_name}</td>
            <td>${student.email}</td>
            <td>${student.job_role}</td>
            <td>
                <button class="short-status-btn ${student.status === "Hired" ? "hired" : "not-hired"}" onclick="toggleStatus(this, ${index}, 'shorted')">${student.status}</button>
            </td>
            <td>
                ${student.cv_filename ? 
                    `<a href="/cvs/${student.cv_filename}" target="_blank" class="short-view-btn">View (${student.cv_original_name})</a>` : 
                    `<button class="short-view-btn" disabled>No CV</button>`
                }
            </td>
            <td>
                <button class="short-schedule-btn" data-student-index="${index}" onclick="openAddInterviewModal(this)" ${scheduledStudents[index] ? 'disabled' : ''}>
                    ${scheduledStudents[index] ? 'Scheduled' : 'Schedule Interview'}
                </button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Function to render selected students table
function renderSelectedTable(students) {
    const tableBody = document.getElementById("select-table-body");
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
                ${student.cv_filename ? 
                    `<a href="/cvs/${student.cv_filename}" target="_blank" class="selected-view-btn">View (${student.cv_original_name})</a>` : 
                    `<button class="selected-view-btn" disabled>No CV</button>`
                }
            </td>
         
        `;
        tableBody.appendChild(row);
    });
}

// Function to filter applied students by course and job role
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

// Function to filter shortlisted students by job role
function filterShortedStudents() {
    const jobRoleFilter = document.getElementById("shorted-jobrole-filter").value.trim().toLowerCase();
    let filteredStudents = shortlistedStudents;

    if (jobRoleFilter) {
        filteredStudents = filteredStudents.filter(student =>
            student.job_role && student.job_role.toLowerCase().includes(jobRoleFilter)
        );
    }

    renderShortlistedTable(filteredStudents);
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
            student.job_role && student.job_role.toLowerCase().includes(jobRoleFilter)
        );
    }

    renderSelectedTable(filteredStudents);
}

// Function to handle selecting a student
function selectStudent(index) {
    const student = appliedStudents[index];

    // Check if the student is already hired
    if (student.status === "Hired") {
        alert("This student has already been hired by another company.");
        return;
    }

    const alreadyShorted = shortlistedStudents.some(s => s.email === student.email && s.job_role === student.job_role);

    if (!alreadyShorted) {
        shortlistedStudents.push(student);
        scheduledStudents.push(false); // Add a new entry for this student in scheduledStudents

        // Update the backend to mark as shortlisted
        fetch('http://localhost:8000/company_student/shortlisted', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ application_id: student.application_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`${student.student_name} has been added to the Shortlisted Student List.`);
            } else {
                alert('Failed to shortlist student.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while shortlisting the student.');
        });
    } else {
        alert(`${student.student_name} is already in the Shortlisted Student List for ${student.job_role}.`);
    }
}

// Function to handle rejecting a student
function rejectStudent(index) {
    const student = appliedStudents[index];

    if (confirm(`Are you sure you want to reject ${student.student_name}?`)) {
        // Update the backend to mark as rejected
        fetch('http://localhost:8000/company_student/nonShortlisted', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ application_id: student.application_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
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

// Unified toggleStatus function for all sections
function toggleStatus(button, index, section) {
    let student;
    let studentList;

    if (section === "applied") {
        studentList = appliedStudents;
        student = appliedStudents[index];
    } else if (section === "shorted") {
        studentList = shortlistedStudents;
        student = shortlistedStudents[index];
    }

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
            if (section === "applied") {
                renderAppliedTable(appliedStudents);
            } else if (section === "shorted") {
                // Move to selected students
                selectedStudents.push(student);
                shortlistedStudents.splice(index, 1);
                scheduledStudents.splice(index, 1); // Remove from scheduledStudents
                renderShortlistedTable(shortlistedStudents);
                renderSelectedTable(selectedStudents);
            }
        } else {
            alert('Failed to update status.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the status.');
    });
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
    renderShortlistedTable(shortlistedStudents);

    closeAddInterviewModal();
    openSuccessModal();
}

// Function to toggle sections
function toggleSection(section) {
    const sections = ["applied", "shorted", "selected"];
    sections.forEach((sec) => {
        document.getElementById(`${sec}Section`).style.display = sec === section ? "block" : "none";
        document.getElementById(`${sec}Tab`).classList.toggle("active", sec === section);
    });

    // Reset filters and render for the selected section
    if (section === "applied") {
        document.getElementById("applied-course-filter").value = "all";
        document.getElementById("applied-jobrole-filter").value = "";
        renderAppliedTable(appliedStudents);
        filterAppliedStudents();
    } else if (section === "shorted") {
        document.getElementById("shorted-jobrole-filter").value = "";
        renderShortlistedTable(shortlistedStudents);
        filterShortedStudents();
    } else if (section === "selected") {
        document.getElementById("selected-course-filter").value = "all";
        document.getElementById("selected-jobrole-filter").value = "";
        renderSelectedTable(selectedStudents);
        filterSelectedStudents();
    }
}

// Function to remove a selected student
function removeSelectedStudent(index) {
    const student = selectedStudents[index];
    if (confirm(`Are you sure you want to remove ${student.student_name} from selected students?`)) {
        // Update the backend to mark as not selected (sets selected = FALSE)
        fetch('/company/remove-selected-student', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ application_id: student.application_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                selectedStudents.splice(index, 1);
                renderSelectedTable(selectedStudents);
                alert(`${student.student_name} has been removed from selected students.`);
            } else {
                alert('Failed to remove student.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing the student.');
        });
    }
}

// Initialize default render
document.addEventListener("DOMContentLoaded", () => {
    toggleSection("applied"); // Show the applied students tab by default
});
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>