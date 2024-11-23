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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <!-- Student rows will be dynamically populated here -->
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>
        // Define the possible statuses in an array
        const statuses = ["Hired", "Pending", "Not Hired"];
        
        // Sample student data
        const students = [
            { name: "Thathsara", index: "22001123", email: "thathsara@gmail.com", status: "Hired" },
            { name: "Karunya", index: "22001124", email: "karunya@gmail.com", status: "Pending" },
            { name: "Nivethan", index: "22001125", email: "nivethan@gmail.com", status: "Not Hired" },
            { name: "Pasindu", index: "22001126", email: "pasindu@gmail.com", status: "Pending" },
            { name: "Sarma", index: "22020888", email: "sarma@gmail.com", status: "Not Hired" }
        ];

        // Function to render the student table
        function renderTable() {
            const tableBody = document.getElementById("studentTableBody");
            tableBody.innerHTML = ""; // Clear existing rows

            students.forEach(student => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${student.name}</td>
                    <td>${student.index}</td>
                    <td>${student.email}</td>
                    <td>
                        <div class="btn-container">
                            <button class="status-btn" onclick="toggleStatus('${student.index}')">${student.status}</button>
                            <button class="view-btn">View</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Function to toggle the status of a student
        function toggleStatus(index) {
            const student = students.find(student => student.index === index);
            if (student) {
                // Cycle through the statuses
                const currentStatusIndex = statuses.indexOf(student.status);
                const nextStatusIndex = (currentStatusIndex + 1) % statuses.length;
                student.status = statuses[nextStatusIndex];
                renderTable();
            }
        }

        // Initial render of the student table
        renderTable();
    </script>
<?php require base_path('views/partials/auth/auth-close.php') ?>