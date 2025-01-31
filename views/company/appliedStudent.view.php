<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/appliedStudent.css" />


<main class="main-content">
            <header class="header">
                <div class="above">
                    <div class="above-left">
                    <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                        <h2>Student List</h2>
                    </div>
                    
                    <div class="above-right">
                        <div class="company-info">
                        <i class="fa-regular fa-building" style="font-size: 40px;"></i>
                            <div class="company-name">
                                Creative<br>Software
                            </div>
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
                        <h3>Applied Student List</h3>
                        <p>Manage student accounts</p>
                    </div>
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
                    <tbody id="studentTableBody">
                        <!-- Student rows will be dynamically populated here -->
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>;
        
        // Sample student data
        const students = [
            { name: "Thathsara", index: "22001123", email: "thathsara@gmail.com", course:"CS", status: "Hired" },
            { name: "Karunya", index: "22001124", email: "karunya@gmail.com", course:"IS",status: "Not Hired"},
            { name: "Nivethan", index: "22001125", email: "nivethan@gmail.com" , course:"CS",status: "Not Hired"},
            { name: "Pasindu", index: "22001126", email: "pasindu@gmail.com", course:"IS",status: "Hired"},
            { name: "Sarma", index: "22020888", email: "sarma@gmail.com", course:"CS",status: "Not Hired" }, 
        ];

     // Function to render the student table
function renderTable() {
    const tableBody = document.getElementById("studentTableBody");
    tableBody.innerHTML = ""; // Clear existing rows

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

// Function to handle View button click
function viewStudent(index) {
    const student = students[index];
    alert(`Viewing details for:\n\nName: ${student.name}\nIndex: ${student.index}\nEmail: ${student.email}\nCourse: ${student.course}`);
}

// Initial render of the student table
renderTable();

    </script>
<?php require base_path('views/partials/auth/auth-close.php') ?>