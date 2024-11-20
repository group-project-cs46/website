<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/selectedStudent.css" />
<main class="main-content">
            <header class="header">
                <div class="above">
                    <div class="above-left">
                    <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                        <h2>Student list</h2>
                    </div>
                    
                    <div class="above-right">
                        <div  class="company-info">
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
                    <!-- <button class="add-button" onclick="addStudent()">+</button> -->
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
                        <!-- Dynamic student rows will be added here -->
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>
        // Sample student data
        const students = [
            { name: 'Thathsara', index: '22001123', email: 'thathsara@gmail.com', status: 'Hired' },
            { name: 'Karunya', index: '22001124', email: 'karunya@gmail.com', status: 'Hired' },
            { name: 'Nivethan', index: '22001125', email: 'nivethan@gmail.com', status: 'Hired' },
            { name: 'Pasindu', index: '22001126', email: 'pasindu@gmail.com', status: 'Hired' },
            { name: 'Sarma', index: '22020888', email: 'sarma@gmail.com', status: 'Hired' },
        ];

        // Function to render the student list in the table
        function renderStudentTable() {
            const studentTableBody = document.getElementById('student-table-body');
            studentTableBody.innerHTML = ''; // Clear existing rows
            students.forEach((student, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.name}</td>
                    <td>${student.index}</td>
                    <td>${student.email}</td>
                    <td>
                        <div class="btn-container">
                            <button class="status-btn">${student.status}</button>
                            <button class="view-btn" onclick="viewStudent(${index})">View</button>
                        </div>
                    </td>
                `;
                studentTableBody.appendChild(row);
            });
        }

        // Function to add a new student (simulated dynamically)
        function addStudent() {
            const newStudent = {
                name: 'New Student',
                index: '2200XXXX',
                email: 'newstudent@example.com',
                status: 'Pending'
            };
            students.push(newStudent); // Add to the student array
            renderStudentTable(); // Re-render the table
        }

        // Function to view student details (you can replace this with more complex behavior)
        function viewStudent(index) {
            alert(`Viewing details for ${students[index].name}`);
        }

        // Initial render of the student table
        renderStudentTable();
    </script>
<?php require base_path('views/partials/auth/auth-close.php') ?>