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
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Student rows will be dynamically populated here -->
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
                <span class="close" onclick="closeAddInterviewModal()">&times;</span>
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
                <span class="close" onclick="closeSuccessModal()">&times;</span>
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
                    <!-- Dynamic rows for shorted students -->
                </tbody>
            </table>
        </div>
    </section>
</main>

<script>
    // Function to filter applied students by course and job role
    function filterAppliedStudents() {
        const courseFilter = document.getElementById("applied-course-filter").value;
        const jobRoleFilter = document.getElementById("applied-jobrole-filter").value.trim().toLowerCase();

        let filteredStudents = appliedStudents;

        // Filter by course
        if (courseFilter !== "all") {
            filteredStudents = filteredStudents.filter(student => student.course === courseFilter);
        }

        // Filter by job role (case-insensitive partial match)
        if (jobRoleFilter) {
            filteredStudents = filteredStudents.filter(student =>
                student.jobrole && student.jobrole.toLowerCase().includes(jobRoleFilter)
            );
        }

        renderAppliedTable(filteredStudents);
    }

    // Function to filter shorted students by job role
    function filterShortedStudents() {
        const jobRoleFilter = document.getElementById("shorted-jobrole-filter").value.trim().toLowerCase();

        let filteredStudents = shortedStudents;

        // Filter by job role (case-insensitive partial match)
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

        // Filter by course
        if (courseFilter !== "all") {
            filteredStudents = filteredStudents.filter(student => student.course === courseFilter);
        }

        // Filter by job role (case-insensitive partial match)
        if (jobRoleFilter) {
            filteredStudents = filteredStudents.filter(student =>
                student.jobrole && student.jobrole.toLowerCase().includes(jobRoleFilter)
            );
        }

        renderSelectedTable(filteredStudents);
    }

    // Function to toggle sections
    function toggleSection(section) {
        const sections = ["applied", "shorted", "selected"];
        sections.forEach((sec) => {
            document.getElementById(`${sec}Section`).style.display = sec === section ? "block" : "none";
            document.getElementById(`${sec}Tab`).classList.toggle("active", sec === section);
        });

        // Reset filters and render the full list for the selected section
        if (section === "applied") {
            document.getElementById("applied-course-filter").value = "all";
            document.getElementById("applied-jobrole-filter").value = "";
            renderAppliedTable(appliedStudents);
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




    // Sample student data
    const appliedStudents = [{
            name: "Thathsara",
            index: "22001123",
            email: "thathsara@gmail.com",
            jobrole: "Software Engineer",
            course: "CS",
            status: "Hired"
        },
        {
            name: "Karunya",
            index: "22001124",
            email: "karunya@gmail.com",
            jobrole: "Cybersecurity Analyst",
            course: "IS",
            status: "Not Hired"
        },
        {
            name: "Nivethan",
            index: "22001125",
            email: "nivethan@gmail.com",
            jobrole: "Software Engineer",
            course: "CS",
            status: "Not Hired"
        },
        {
            name: "Pasindu",
            index: "22001126",
            email: "pasindu@gmail.com",
            jobrole: "DevOps Engineer",
            course: "IS",
            status: "Hired"
        },
        {
            name: "Sarma",
            index: "22020888",
            email: "sarma@gmail.com",
            jobrole: "Cybersecurity Analyst",
            course: "CS",
            status: "Not Hired"
        }
    ];



    // Function to render applied student table with correctly aligned buttons
    function renderAppliedTable(students) {
        const tableBody = document.getElementById("studentTableBody");
        tableBody.innerHTML = "";
        students.forEach((student, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${student.name}</td>
            <td>${student.index}</td>
            <td>${student.email}</td>
            <td>${student.jobrole}</td>
            <td>${student.course}</td>
            <td>
                <button class="applied-status-btn ${student.status === "Hired" ? "hired" : "not-hired"}" onclick="toggleStatus(this, ${index}, 'applied')">${student.status}</button>
            </td>
            <td>
                <button class="applied-view-btn" onclick="viewStudent(${index})">View</button>
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

    // Function to handle selecting a student
    function selectStudent(index) {
        const student = appliedStudents[index];

        // Add student to shorted list if not already there
        const alreadyShorted = shortedStudents.some(s => s.email === student.email);

        if (!alreadyShorted) {
            shortedStudents.push({
                name: student.name,
                email: student.email,
                status: "Not Hired",
                course: student.course,
                index: student.index
            });

            alert(`${student.name} has been added to the Shorted Student List.`);
        } else {
            alert(`${student.name} is already in the Shorted Student List.`);
        }
    }

    // Function to handle rejecting a student
    function rejectStudent(index) {
        const student = appliedStudents[index];

        if (confirm(`Are you sure you want to reject ${student.name}?`)) {
            // You might want to add additional functionality here
            // such as marking the student as rejected in the database

            alert(`${student.name} has been rejected.`);
        }
    }





    const shortedStudents = [{
            name: "Thathsara",
            email: "thathsara@gmail.com",
            jobrole: "Software Engineer",
            status: "Hired"
        },
        {
            name: "Karunya",
            email: "karunya@gmail.com",
            jobrole: "DevOps Engineer",
            status: "Not Hired"
        },
        {
            name: "Nivethan",
            email: "nivethan@gmail.com",
            jobrole: "Software Engineer",
            status: "Not Hired"
        },
        {
            name: "Pasindu",
            email: "pasindu@gmail.com",
            jobrole: "DevOps Engineer",
            status: "Hired"
        },
        {
            name: "Sarma",
            email: "sarma@gmail.com",
            jobrole: "Cybersecurity Analyst",
            status: "Not Hired"
        }
    ];


    let scheduledStudents = []; // Track scheduled students

    // Function short student data into the table dynamically
    function loadStudents(students) {
        const tableBody = document.getElementById("student-table-body");
        tableBody.innerHTML = ""; // Clear table body

        students.forEach((student, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${student.name}</td>
            <td>${student.email}</td>
            <td>${student.jobrole}</td>
            <td>
                <button class="short-status-btn ${student.status === "Hired" ? "hired" : "not-hired"}" onclick="toggleStatus(this, ${index}, 'shorted')">${student.status}</button>
            </td>
            <td>
                <button class="short-view-btn" onclick="viewStudent(${index})">View</button>
            </td>
            <td>
                <button class="short-schedule-btn" 
                    data-student-index="${index}" 
                    onclick="openAddInterviewModal(this)">
                    ${scheduledStudents[index] ? "Scheduled" : "Schedule"}
                </button>
            </td>
        `;
            tableBody.appendChild(row);
        });
    }


    // Unified toggleStatus function for both applied and shorted students
    function toggleStatus(button, index, section) {
        let student;

        // Determine which student array to use based on the section
        if (section === "applied") {
            student = appliedStudents[index];
        } else if (section === "shorted") {
            student = shortedStudents[index];
        } else {
            return; // Invalid section, do nothing
        }

        // Check if the status is already "Hired"
        if (student.status === "Hired") {
            alert("The status is already 'Hired' and cannot be changed.");
            return;
        }

        // Update status to "Hired"
        student.status = "Hired";
        button.innerText = "Hired";
        button.className = `${section}-status-btn hired`; // Update button class based on section

        if (section === "applied") {
            renderAppliedTable(appliedStudents); // Re-render for Applied Student section
        } else if (section === "shorted") {
            loadStudents(shortedStudents); // Re-render for Short Listed Student section
        }
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
        scheduledStudents[studentIndex] = true; // Mark the student as scheduled
        loadStudents(); // Refresh table

        closeAddInterviewModal();
        openSuccessModal();
    }

    // Function to view shorted student details
    function viewStudent(index) {
        const student = shortedStudents[index]; // Use shortedStudents array
        alert(`
        Viewing details:
        Name: ${student.name}
        Index No: ${student.index}
        Email: ${student.email}
        Course: ${student.course}
        Status: ${student.status}
    `);
    }

    // Load students on page load
    document.addEventListener("DOMContentLoaded", loadStudents);



    // Initialize default section
    window.onload = function() {
        toggleSection("applied");
    };

    const selectedStudents = [{
            name: "Thathsara",
            index: "22001123",
            email: "thathsara@gmail.com",
            jobrole: "Software Engineer",
            course: "CS"
        },
        {
            name: "Karunya",
            index: "22001124",
            email: "karunya@gmail.com",
            jobrole: "Cybersecurity Analyst",
            course: "IS"
        },
        {
            name: "Nivethan",
            index: "22001125",
            email: "nivethan@gmail.com",
            jobrole: "Software Engineer",
            course: "CS"
        },
        {
            name: "Pasindu",
            index: "22001126",
            email: "pasindu@gmail.com",
            jobrole: "DevOps Engineer",
            course: "IS"
        },
        {
            name: "Sarma",
            index: "22020888",
            email: "sarma@gmail.com",
            jobrole: "DevOps Engineer",
            course: "CS"
        }
    ];


    // Function to render the student list in the table
    function renderSelectedTable(students) {
        const tableBody = document.getElementById("select-table-body");
        tableBody.innerHTML = ""; // Clear existing rows

        students.forEach((student, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${student.name}</td>
                <td>${student.index}</td>
                <td>${student.email}</td>
                <td>${student.jobrole}</td>
                <td>${student.course}</td>
                <td>
                    <button class="select-view-btn" onclick="viewStudent(${index})">View</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Function to view student details
    function viewStudent(index) {
        const student = selectedStudents[index];
        //alert(`Student Details:\n\nName: ${student.name}\nIndex No: ${student.index}\nEmail: ${student.email}\nCourse: ${student.course}`);
        window.location.href = "/company/onlycv";
    }
    // Initialize default render
    document.addEventListener("DOMContentLoaded", () => {
        toggleSection("applied"); // Show the applied students tab by default
        renderAppliedTable(appliedStudents); // Render all applied students by default
        loadStudents(shortedStudents); // Load shorted students
        renderSelectedTable(selectedStudents); // Render selected students
    });
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>