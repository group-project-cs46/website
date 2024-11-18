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

<!-- Modal Overlay for Add Interview Form (from addInterview.php) -->
<div id="addInterviewModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close" onclick="closeAddInterviewModal()">&times;</span>
        <h1 class="interview-heading">Create Interview Schedule</h1>
        <form onsubmit="handleAddInterviewSubmit(event)">
            <div class="form-row">
                <label for="from-date">Date Period:</label>
                <div class="period">
                    <div class="date-picker">
                        <label>From:</label>
                        <div class="input-with-icon">
                            <input type="text" id="from-date" placeholder="mm/dd/yyyy" required />
                            <i class="fa-solid fa-calendar-days" style="font-size: 40px;"></i>
                        </div>
                    </div>
                    <div class="date-picker">
                        <label>To:</label>
                        <div class="input-with-icon">
                            <input type="text" id="to-date" placeholder="mm/dd/yyyy" required />
                            <i class="fa-solid fa-calendar-days" style="font-size: 40px;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <label for="duration">Interview Duration:</label>
                <select class="duration" required>
                    <option value="30">30 minutes</option>
                    <option value="60">60 minutes</option>
                    <option value="90">90 minutes</option>
                </select>
            </div>
            <div class="button-container">
                <button type="submit" class="save-button">SAVE</button>
            </div>
        </form>
    </div>
</div>

<!-- Success Message Modal -->
<div id="successModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close" onclick="closeSuccessModal()">&times;</span>
        <h1>Success</h1>
        <p>Interview saved successfully!</p>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", loadStudents);

    // Sample student data
    const students = [
        { name: "Thathsara", index: "22001123", email: "thathsara@gmail.com", status: "Pending" },
        { name: "Karunya", index: "22001124", email: "karunya@gmail.com", status: "Pending" },
        { name: "Nivethan", index: "22001125", email: "nivethan@gmail.com", status: "Pending" },
        { name: "Pasindu", index: "22001126", email: "pasindu@gmail.com", status: "Pending" },
        { name: "Sarma", index: "22020888", email: "sarma@gmail.com", status: "Pending" }
    ];

    // Function to load the student data into the table dynamically
    function loadStudents() {
        const tableBody = document.getElementById("student-table-body");
        tableBody.innerHTML = ""; // Clear existing rows

        students.forEach(student => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${student.name}</td>
                <td>${student.index}</td>
                <td>${student.email}</td>
                <td>
                    <div class="btn-container">
                        <button class="status-btn" onclick="toggleStatus(this)">${student.status}</button>
                        <button class="schedule-btn" onclick="openAddInterviewModal()">Schedule</button>
                        <button class="view-btn" onclick="viewStudent('${student.name}')">View</button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Function to toggle the status of the student
    function toggleStatus(button) {
        button.innerText = button.innerText === "Pending" ? "Hired" : button.innerText === "Hired" ? "Not Hired" : "Pending";
        button.className = button.innerText === "Hired" ? "status-btn hired" : button.innerText === "Not Hired" ? "status-btn not-hired" : "status-btn pending";
    }

    // Function to open the modal to schedule an interview
    function openAddInterviewModal() {
        document.getElementById("addInterviewModal").style.display = "flex";  // Display modal as flex to center it
    }

    // Function to close the interview scheduling modal
    function closeAddInterviewModal() {
        document.getElementById("addInterviewModal").style.display = "none";  // Hide modal
    }

    // Function to open the success message modal
    function openSuccessModal() {
        document.getElementById("successModal").style.display = "flex";  // Show success popup
    }

    // Function to close the success message modal
    function closeSuccessModal() {
        document.getElementById("successModal").style.display = "none";  // Hide success popup
    }

    // Function to handle form submission for scheduling an interview
    function handleAddInterviewSubmit(event) {
        event.preventDefault();  // Prevent default form submission behavior

        const fromDate = document.getElementById("from-date").value;
        const toDate = document.getElementById("to-date").value;
        const duration = document.getElementById("duration").value;

        // Validate date formats
        if (!isValidDate(fromDate)) {
            alert("Invalid From Date format. Please enter in mm/dd/yyyy format.");
            return;
        }

        if (!isValidDate(toDate)) {
            alert("Invalid To Date format. Please enter in mm/dd/yyyy format.");
            return;
        }

        // Convert dates to Date objects for comparison
        const fromDateObj = convertToDate(fromDate);
        const toDateObj = convertToDate(toDate);

        if (isNaN(fromDateObj.getTime()) || isNaN(toDateObj.getTime())) {
            alert("Invalid Date. Please enter a valid date.");
            return;
        }

        if (fromDateObj > toDateObj) {
            alert("From Date must be before To Date.");
            return;
        }

        // If all checks pass, show success message and close the modal
        openSuccessModal();
        closeAddInterviewModal();
    }

    // Helper function to validate date in mm/dd/yyyy format
    function isValidDate(dateStr) {
        const datePattern = /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/;
        return datePattern.test(dateStr);
    }

    // Helper function to convert mm/dd/yyyy string to a Date object
    function convertToDate(dateStr) {
        const [month, day, year] = dateStr.split('/');
        return new Date(`${year}-${month}-${day}`);
    }

    // Function to view student details
    function viewStudent(name) {
        alert("Viewing details for " + name);
    }

    // Event listener for the form submission
    document.getElementById("addInterviewModal").querySelector("form").addEventListener("submit", handleAddInterviewSubmit);
</script>


<?php require base_path('views/partials/auth/auth-close.php') ?>
