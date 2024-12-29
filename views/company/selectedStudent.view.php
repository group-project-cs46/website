<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/selectedStudent.css" />
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
                <h3>Selected Student List</h3>
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
            <tbody id="student-table-body">
                <!-- Dynamic student rows will be added here -->
            </tbody>
        </table>
    </section>
</main>

<script>
    // Sample student data
    const students = [
        { name: "Thathsara", index: "22001123", email: "thathsara@gmail.com", course:"CS" },
        { name: "Karunya", index: "22001124", email: "karunya@gmail.com", course:"IS"},
        { name: "Nivethan", index: "22001125", email: "nivethan@gmail.com" , course:"CS"},
        { name: "Pasindu", index: "22001126", email: "pasindu@gmail.com", course:"IS"},
        { name: "Sarma", index: "22020888", email: "sarma@gmail.com", course:"CS"}, 
    ];

    // Function to render the student list in the table
    function renderTable() {
        const tableBody = document.getElementById("student-table-body");
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
        const student = students[index];
        alert(`Student Details:\n\nName: ${student.name}\nIndex No: ${student.index}\nEmail: ${student.email}\nStatus: ${student.course}`);
    }

    // Initial render of the student table
    renderTable();
</script>
<?php require base_path('views/partials/auth/auth-close.php') ?>
