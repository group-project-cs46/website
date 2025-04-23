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
                            <th></th>
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
                <form id="addInterviewForm" class="addInterviewForm" method="POST" action="/company_student/store_schedule" onsubmit="return handleAddInterviewSubmit(event);">
                    <input type="text" name="application_id" id="application_id" hidden/>
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
                            <input type="time" name="from_time" id="from-time" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="to-time">To:</label>
                        <div class="input-with-icon">
                            <input type="time" name="to_time" id="to-time" required />
                        </div>
                    </div>

                    <div class="button-container">
                        <button type="submit" class="save-button">SAVE</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Overlay for View/Edit Interview Details -->
        <div id="viewInterviewModal" class="modal-overlay">
            <div class="modal-content">
                <span class="close" onclick="closeViewInterviewModal()">×</span>
                <h1 class="interview-heading">Interview Details</h1>
                <form id="editInterviewForm" class="addInterviewForm" method="POST" action="/company_student/update_interview" onsubmit="return handleEditInterviewSubmit();">
                    <input type="text" name="application_id" id="edit_application_id" hidden/>
                    <input type="text" name="interview_id" id="edit_interview_id" hidden/>
                    <div class="form-row">
                        <label for="edit-venue">Venue:</label>
                        <div class="input-with-icon">
                            <input type="text" name="venue" id="edit-venue" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="edit-from-date">Date:</label>
                        <div class="input-with-icon">
                            <input type="date" name="date" id="edit-from-date" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="edit-from-time">From:</label>
                        <div class="input-with-icon">
                            <input type="time" name="from_time" id="edit-from-time" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="edit-to-time">To:</label>
                        <div class="input-with-icon">
                            <input type="time" name="to_time" id="edit-to-time" required />
                        </div>
                    </div>

                    <div class="button-container">
                        <button type="submit" class="save-button">UPDATE</button>
                        <button type="button" class="delete-button" onclick="deleteInterview()">DELETE</button>
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
            <div id="selected-error" class="error" style="display: <?php echo $errorSelected ? 'block' : 'none'; ?>;">
                <?php echo $errorSelected ?: 'No selected students found.'; ?>
            </div>
            <table class="student-table" id="selected-table" style="display: <?php echo $errorSelected ? 'none' : 'table'; ?>;">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No</th>
                        <th>Email</th>
                        <th>Job Role</th>
                        <th>Course</th>
                        <th>View CV</th>
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
                <span class="applied-status-btn ${student.status === "Hired" ? "hired" : "not-hired"}">${student.status}</span>
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
        const isScheduled = scheduledStudents[index] || student.interview_id; // Check if interview is scheduled
        row.setAttribute("data-index", index);
        row.setAttribute("data-email", student.email);
        row.setAttribute("data-jobrole", student.job_role);
        row.setAttribute("data-application-id", student.application_id);
        row.setAttribute("data-interview-id", student.interview_id || '');

        row.innerHTML = `
            <td>${student.student_name}</td>
            <td>${student.email}</td>
            <td>${student.job_role}</td>
            <td>
                <span class="short-status-btn ${student.status === "Hired" ? "hired" : "not-hired"}">${student.status}</span>
            </td>
            <td>
                ${student.cv_filename ? 
                    `<a href="/cvs/${student.cv_filename}" target="_blank" class="short-view-btn">View (${student.cv_original_name})</a>` : 
                    `<button class="short-view-btn" disabled>No CV</button>`
                }
            </td>
            <td>
                <button class="short-schedule-btn" data-student-index="${index}" data-application-id="${student.application_id}" data-interview-id="${student.interview_id || ''}" onclick="${isScheduled ? 'viewInterviewDetails(this)' : 'openAddInterviewModal(this)'}">
                    ${isScheduled ? 'Interview Scheduled' : 'Schedule Interview'}
                </button>
            </td>
            <td>
                <button class="short-btn short-select-btn" onclick="selectShortlistedStudent(${index})">Select</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Function to render selected student table
function renderSelectedTable(students) {
    const tableBody = document.getElementById("select-table-body");
    const errorDiv = document.getElementById("selected-error");
    const table = document.getElementById("selected-table");

    tableBody.innerHTML = ""; // Clear existing rows

    if (students.length === 0) {
        errorDiv.style.display = "block";
        errorDiv.textContent = "No selected students found.";
        table.style.display = "none";
        return;
    }

    errorDiv.style.display = "none";
    table.style.display = "table";

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

// Function to refresh all student lists
function refreshAllLists() {
    // Fetch updated applied students
    fetch('/company_student/applied')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                appliedStudents.length = 0;
                data.students.forEach(student => appliedStudents.push(student));
                renderAppliedTable(appliedStudents);
                filterAppliedStudents();
            }
        })
        .catch(error => console.error('Error refreshing applied students:', error));

    // Fetch updated shortlisted students
    fetch('/company_student/shortlisted')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                shortlistedStudents.length = 0;
                scheduledStudents.length = 0;
                data.students.forEach(student => {
                    shortlistedStudents.push(student);
                    scheduledStudents.push(!!student.interview_id);
                });
                renderShortlistedTable(shortlistedStudents);
                filterShortedStudents();
            }
        })
        .catch(error => console.error('Error refreshing shortlisted students:', error));

    // Fetch updated selected students
    fetch('/company_student/selected')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                selectedStudents.length = 0;
                data.students.forEach(student => selectedStudents.push(student));
                renderSelectedTable(selectedStudents);
                filterSelectedStudents();
            }
        })
        .catch(error => console.error('Error refreshing selected students:', error));
}

// Function to handle selecting a student from Applied list
function selectStudent(index) {
    const student = appliedStudents[index];

    // Check if the student is already hired for this application
    if (student.status === "Hired") {
        alert("This application has already been hired by another company.");
        return;
    }

    // Update the backend to mark as shortlisted
    fetch('/company_student/shortlisted', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ application_id: student.application_id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove from applied students
            appliedStudents.splice(index, 1);
            // Refresh all lists
            refreshAllLists();
            alert(`${student.student_name}'s application for ${student.job_role} has been added to the Shortlisted Student List.`);
        } else {
            alert('Failed to shortlist student: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while shortlisting the student.');
    });
}

// Function to handle rejecting a student from Applied list
function rejectStudent(index) {
    const student = appliedStudents[index];

    if (confirm(`Are you sure you want to reject ${student.student_name}'s application for ${student.job_role}?`)) {
        // Update the backend to mark as rejected
        fetch('/company_student/nonShortlisted', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ application_id: student.application_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove from applied students
                appliedStudents.splice(index, 1);
                // Refresh all lists
                refreshAllLists();
                alert(`${student.student_name}'s application for ${student.job_role} has been rejected.`);
            } else {
                alert('Failed to reject student: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while rejecting the student.');
        });
    }
}

// Function to handle selecting a student from Shortlisted list
function selectShortlistedStudent(index) {
    const student = shortlistedStudents[index];

    // Check if the student is already hired for this application
    if (student.status === "Hired") {
        alert("This application has already been hired by another company.");
        return;
    }

    // Update the backend to mark as selected
    fetch('/company_student/select', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ application_id: student.application_id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove from shortlisted students
            shortlistedStudents.splice(index, 1);
            scheduledStudents.splice(index, 1);
            // Refresh all lists
            refreshAllLists();
            alert(`${student.student_name}'s application for ${student.job_role} has been added to the Selected Student List.`);
            // Switch to the Selected tab
            toggleSection('selected');
        } else {
            alert('Failed to select student: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while selecting the student.');
    });
}

// Function to open the modal to schedule an interview
function openAddInterviewModal(button) {
    const studentIndex = button.getAttribute("data-student-index");
    const applicationId = button.getAttribute("data-application-id");
    document.getElementById("addInterviewModal").style.display = "flex";
    document.getElementById("addInterviewModal").setAttribute("data-student-index", studentIndex);
    document.getElementById("application_id").value = applicationId;
}

// Function to view interview details
function viewInterviewDetails(button) {
    const interviewId = button.getAttribute("data-interview-id");
    const applicationId = button.getAttribute("data-application-id");
    const studentIndex = button.getAttribute("data-student-index");

    fetch(`/company_student/interview_details?interview_id=${interviewId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const interview = data.interview;
                document.getElementById("edit_application_id").value = applicationId;
                document.getElementById("edit_interview_id").value = interviewId;
                document.getElementById("edit-venue").value = interview.venue;
                document.getElementById("edit-from-date").value = interview.date;

                // Extract time directly from start_time and end_time (format: HH:mm:ss)
                document.getElementById("edit-from-time").value = interview.start_time.slice(0, 5); // "08:30:00" -> "08:30"
                document.getElementById("edit-to-time").value = interview.end_time.slice(0, 5); // "09:30:00" -> "09:30"

                document.getElementById("viewInterviewModal").style.display = "flex";
                document.getElementById("viewInterviewModal").setAttribute("data-student-index", studentIndex);
            } else {
                alert('Failed to fetch interview details: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while fetching interview details.');
        });
}

// Function to close the add interview modal
function closeAddInterviewModal() {
    document.getElementById("addInterviewModal").style.display = "none";
}

// Function to close the view/edit interview modal
function closeViewInterviewModal() {
    document.getElementById("viewInterviewModal").style.display = "none";
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

// Function to handle add interview form submission
function handleAddInterviewSubmit(event) {
    event.preventDefault(); // Prevent default form submission

    const date = document.getElementById("from-date").value;
    const fromTime = document.getElementById("from-time").value;
    const toTime = document.getElementById("to-time").value;

    if (!date || !fromTime || !toTime) {
        alert("Please fill in all required fields.");
        return false;
    }

    // Combine date and times for comparison
    const fromDateTime = new Date(`${date}T${fromTime}:00`);
    const toDateTime = new Date(`${date}T${toTime}:00`);

    if (fromDateTime >= toDateTime) {
        alert("End time must be after start time.");
        return false;
    }

    const studentIndex = document.getElementById("addInterviewModal").getAttribute("data-student-index");
    const form = document.getElementById("addInterviewForm");
    const formData = new FormData(form);

    fetch('/company_student/store_schedule', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            scheduledStudents[studentIndex] = true;
            shortlistedStudents[studentIndex].interview_id = data.interview_id;
            renderShortlistedTable(shortlistedStudents);
            closeAddInterviewModal();
            openSuccessModal();
        } else {
            alert('Failed to schedule interview: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while scheduling the interview.');
    });

    return false; // Prevent form submission
}

// Function to handle edit interview form submission
function handleEditInterviewSubmit() {
    const date = document.getElementById("edit-from-date").value;
    const fromTime = document.getElementById("edit-from-time").value;
    const toTime = document.getElementById("edit-to-time").value;

    if (!date || !fromTime || !toTime) {
        alert("Please fill in all required fields.");
        return false;
    }

    // Combine date and times for comparison
    const fromDateTime = new Date(`${date}T${fromTime}:00`);
    const toDateTime = new Date(`${date}T${toTime}:00`);

    if (fromDateTime >= toDateTime) {
        alert("End time must be after start time.");
        return false;
    }

    // Collect form data
    const interviewId = document.getElementById("edit_interview_id").value;
    const applicationId = document.getElementById("edit_application_id").value;
    const venue = document.getElementById("edit-venue").value;

    // Create JSON payload
    const formData = {
        interview_id: interviewId,
        application_id: applicationId,
        venue: venue,
        date: date,
        from_time: fromTime,
        to_time: toTime
    };

    // Send the data as JSON via fetch
    fetch('/company_student/update_interview', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeViewInterviewModal();
            openSuccessModal();
            // Update the shortlisted students table to reflect the changes
            renderShortlistedTable(shortlistedStudents);
        } else {
            alert('Failed to update interview: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the interview.');
    });

    return false; // Prevent the default form submission
}

// Function to delete an interview
function deleteInterview() {
    const applicationId = document.getElementById("edit_application_id").value;
    const interviewId = document.getElementById("edit_interview_id").value;
    const studentIndex = document.getElementById("viewInterviewModal").getAttribute("data-student-index");

    if (confirm('Are you sure you want to delete this interview?')) {
        fetch('/company_student/delete_interview', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ application_id: applicationId, interview_id: interviewId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                scheduledStudents[studentIndex] = false;
                shortlistedStudents[studentIndex].interview_id = null;
                renderShortlistedTable(shortlistedStudents);
                closeViewInterviewModal();
                alert('Interview deleted successfully.');
            } else {
                alert('Failed to delete interview: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the interview.');
        });
    }
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

// Initialize default render
document.addEventListener("DOMContentLoaded", () => {
    toggleSection("applied"); // Show the applied students tab by default
});
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>