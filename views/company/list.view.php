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
                <h3>Shorted Student List</h3>
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
            <!-- Filter Dropdown -->
            <div class="filter-container">
                <label for="applied-course-filter">Filter by Course:</label>
                <select id="applied-course-filter" onchange="filterAppliedStudents()">
                    <option value="all">All</option>
                    <option value="CS">CS</option>
                    <option value="IS">IS</option>
                </select>
            </div>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Student rows will be dynamically populated here -->
                </tbody>
            </table>
        </div>

        <!-- Shorted Student Section -->
        <div class="table-box" id="shortedSection" style="display: none;">
            <!-- Filter Dropdown -->
            <div class="filter-container">
                <label for="shorted-course-filter">Filter by Course:</label>
                <select id="shorted-course-filter" onchange="filterShortedStudents()">
                    <option value="all">All</option>
                    <option value="CS">CS</option>
                    <option value="IS">IS</option>
                </select>
            </div>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th></th>
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
                        <label for="from-date">Date:</label>
                        <div class="input-with-icon">
                            <input type="date" id="from-date" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="from-time">From:</label>
                        <div class="input-with-icon">
                            <input type="time" id="from-time" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="to-time">To:</label>
                        <div class="input-with-icon">
                            <input type="time" id="to-time" required />
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
            <!-- Filter Dropdown -->
            <div class="filter-container">
                <label for="selected-course-filter">Filter by Course:</label>
                <select id="selected-course-filter" onchange="filterSelectedStudents()">
                    <option value="all">All</option>
                    <option value="CS">CS</option>
                    <option value="IS">IS</option>
                </select>
            </div>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No</th>
                        <th>Email</th>
                        <th>Course</th>
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
    // Function to filter applied students by course
    function filterAppliedStudents() {
        const courseFilter = document.getElementById("applied-course-filter").value;
        const filteredStudents = courseFilter === "all" ? appliedStudents : appliedStudents.filter(student => student.course === courseFilter);
        renderAppliedTable(filteredStudents);
    }

    // Function to filter shorted students by course
    function filterShortedStudents() {
        const courseFilter = document.getElementById("shorted-course-filter").value;
        const filteredStudents = courseFilter === "all" ? shortedStudents : shortedStudents.filter(student => student.course === courseFilter);
        loadStudents(filteredStudents);
    }

    // Function to filter selected students by course
    function filterSelectedStudents() {
        const courseFilter = document.getElementById("selected-course-filter").value;
        const filteredStudents = courseFilter === "all" ? selectedStudents : selectedStudents.filter(student => student.course === courseFilter);
        renderSelectedTable(filteredStudents);
    }

    // Function to toggle sections
    function toggleSection(section) {
        const sections = ["applied", "shorted", "selected"];
        sections.forEach((sec) => {
            document.getElementById(`${sec}Section`).style.display = sec === section ? "block" : "none";
            document.getElementById(`${sec}Tab`).classList.toggle("active", sec === section);
        });

        if (section === "applied") renderAppliedTable(appliedStudents);
        if (section === "shorted") loadStudents(shortedStudents);
        if (section === "selected") renderSelectedTable(selectedStudents);
    }


    // Sample student data
    const appliedStudents = [{
            name: "Thathsara",
            index: "22001123",
            email: "thathsara@gmail.com",
            course: "CS"
        },
        {
            name: "Karunya",
            index: "22001124",
            email: "karunya@gmail.com",
            course: "IS"
        },
        {
            name: "Nivethan",
            index: "22001125",
            email: "nivethan@gmail.com",
            course: "CS"
        },
        {
            name: "Pasindu",
            index: "22001126",
            email: "pasindu@gmail.com",
            course: "IS"
        },
        {
            name: "Sarma",
            index: "22020888",
            email: "sarma@gmail.com",
            course: "CS"
        }
    ];




    // Function to render applied student table
    function renderAppliedTable(students) {
        const tableBody = document.getElementById("studentTableBody");
        tableBody.innerHTML = "";
        students.forEach((student, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${student.name}</td>
                <td>${student.index}</td>
                <td>${student.email}</td>
                <td>${student.course}</td>
                <td>
                    <button class="view-btn" onclick="viewAppliedStudent(${index})">View</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }
    // View applied student details
    function viewAppliedStudent(index) {
        const student = appliedStudents[index];
        //alert(`Student Details:\n\nStudent Name: ${student.name}\nIndex No: ${student.index}\nEmail: ${student.email}\nCourse: ${student.course}`);
        window.location.href = "/company/cv";
    }

    const shortedStudents = [{
            name: "Thathsara",
            index: "22001123",
            email: "thathsara@gmail.com",
            course: "CS",
            status: "Hired"
        },
        {
            name: "Karunya",
            index: "22001124",
            email: "karunya@gmail.com",
            course: "IS",
            status: "Not Hired"
        },
        {
            name: "Nivethan",
            index: "22001125",
            email: "nivethan@gmail.com",
            course: "CS",
            status: "Not Hired"
        },
        {
            name: "Pasindu",
            index: "22001126",
            email: "pasindu@gmail.com",
            course: "IS",
            status: "Hired"
        },
        {
            name: "Sarma",
            index: "22020888",
            email: "sarma@gmail.com",
            course: "IS",
            status: "Not Hired"
        }
    ];


    let scheduledStudents = []; // Track scheduled students

    // Function to load the student data into the table dynamically
    function loadStudents(students) {
        const tableBody = document.getElementById("student-table-body");
        tableBody.innerHTML = ""; // Clear table body

        students.forEach((student, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${student.name}</td>
            <td>${student.index}</td>
            <td>${student.email}</td>
             <td>${student.course}</td>
            <td>
                <div class="btn-container">
                    <button class="status-btn ${student.status === "Hired" ? "hired" : "not-hired"}" onclick="toggleStatus(this, ${index})">${student.status}</button>
                    <button class="view-btn" onclick="viewStudent(${index})">View</button>
                    <button class="schedule-btn" 
                        data-student-index="${index}" 
                        onclick="openAddInterviewModal(this)">
                        ${scheduledStudents[index] ? "Scheduled" : "Schedule"}
                    </button>
                </div>
            </td>
        `;
            tableBody.appendChild(row);
        });
    }

    // Function to toggle the status of a student
    function toggleStatus(button, index) {
        const student = shortedStudents[index];
        if (student.status === "Hired") {
            alert("The status is already 'Hired' and cannot be changed.");
            return;
        }

        student.status = "Hired"; // Update status
        button.innerText = "Hired";
        button.className = "status-btn hired"; // Update button class
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
            course: "CS"
        },
        {
            name: "Karunya",
            index: "22001124",
            email: "karunya@gmail.com",
            course: "IS"
        },
        {
            name: "Nivethan",
            index: "22001125",
            email: "nivethan@gmail.com",
            course: "CS"
        },
        {
            name: "Pasindu",
            index: "22001126",
            email: "pasindu@gmail.com",
            course: "IS"
        },
        {
            name: "Sarma",
            index: "22020888",
            email: "sarma@gmail.com",
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
                <td>${student.course}</td>
                <td>
                    <button class="view-btn" onclick="viewStudent(${index})">View</button>
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