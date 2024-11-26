<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/shortedStudent.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2>Student list</h2>
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
            <div class="table-title-txt">
                <h3>Shorted Student List</h3>
                <p>Manage student accounts</p>
            </div>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Index No</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="student-table-body">
                <!-- Dynamic rows will be inserted here -->
            </tbody>
        </table>
    </section>
</main>

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

<script>
// Sample student data
const students = [
    { name: "Thathsara", index: "22001123", email: "thathsara@gmail.com", status: "Hired" },
    { name: "Karunya", index: "22001124", email: "karunya@gmail.com", status: "Not Hired" },
    { name: "Nivethan", index: "22001125", email: "nivethan@gmail.com", status: "Not Hired" },
    { name: "Pasindu", index: "22001126", email: "pasindu@gmail.com", status: "Hired" },
    { name: "Sarma", index: "22020888", email: "sarma@gmail.com", status: "Not Hired" }
];

let scheduledStudents = []; // Track scheduled students

// Function to load the student data into the table dynamically
function loadStudents() {
    const tableBody = document.getElementById("student-table-body");
    tableBody.innerHTML = ""; // Clear table body

    students.forEach((student, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${student.name}</td>
            <td>${student.index}</td>
            <td>${student.email}</td>
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
    const student = students[index];
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

// Function to view student details
function viewStudent(index) {
    const student = students[index];
    alert(`
        Viewing details:
        Name: ${student.name}
        Index No: ${student.index}
        Email: ${student.email}
        Status: ${student.status}
    `);
}

// Load students on page load
document.addEventListener("DOMContentLoaded", loadStudents);
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
