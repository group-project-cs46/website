<?php require base_path('views/partials/auth/auth.php') ?>
<link rel="stylesheet" href="/styles/company/dashboard.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-gauge" style="font-size: 40px;"></i>
                <h2>Dashboard</h2>
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
        <div class="content-title">
            <h2>Company Dashboard</h2>
        </div>
        <div class="content-boxes">
            <div class="box">
                <h3>Applied students</h3>
                <h3>50</h3>
            </div>
            <div class="box">
                <h3>Selected students</h3>
                <h3>20</h3>
            </div>

            <div class="box">
                <h3>Next Techtalk Date</h3>
                <h3>15.08.2024</h3>
                <h3>3.00 P.M</h3>
            </div>
        </div>
        <div class="table-title">
            <div class="table-title-txt">
                <h3>Applied students</h3>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <!-- Student rows will be dynamically populated here -->
                    </tbody>
                </table>
    </section>
</main>
<script>;
        
        // Sample student data
        const students = [
            { name: "Thathsara", index: "22001123", email: "thathsara@gmail.com", course:"CS" },
            { name: "Karunya", index: "22001124", email: "karunya@gmail.com", course:"IS"},
            { name: "Nivethan", index: "22001125", email: "nivethan@gmail.com" , course:"CS"},
            { name: "Pasindu", index: "22001126", email: "pasindu@gmail.com", course:"IS"},
            { name: "Sarma", index: "22020888", email: "sarma@gmail.com", course:"CS"}, 
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
                    <button class="view-btn" onclick="viewStudent(${index})">View</button>
                </div>
            </td>
        `;
        tableBody.appendChild(row);
    });
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