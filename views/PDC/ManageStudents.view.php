<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/ManageStudents.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-user-graduate" style="font-size: 40px;"></i>
            <h2><b>Manage Student</b></h2>
        </div>
        <input type="text" placeholder="Search Student..." class="search-bar" id="searchInput" onkeyup="searchTable()">
    </header>

    <section class="content">
        <div class="table-title">
            <div class="table-title-txt">
                <h3><b>Manage Student</b></h3>
                <p>Manage student accounts</p>
            </div>
            <button class="add-button" id="openFormButton">+</button>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Registration No.</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- Example Table Rows -->
                <tr>
                    <td>Thathsara</td>
                    <td>2022/CS/141</td>
                    <td>CS</td>
                    <td>2</td>
                    <td>thathsara@gmail.com</td>
                    <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<!-- Popup Form for Adding Student -->
<div id="popupForm" class="popup-form">
    <div class="form-container">
        <h2>Add Student</h2>
        <form id="addStudentForm">
            <label for="name">Name:</label>
            <input type="text" id="name" placeholder="Enter Student Name" required>

            <label for="regNo">Register Number:</label>
            <input type="text" id="regNo" placeholder="Enter Register Number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter Email Address" required>

            <label for="course">Course:</label>
            <select id="course">
                <option value="CS">CS</option>
                <option value="IS">IS</option>
            </select>

            <label for="year">Year of Study:</label>
            <select id="year">
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>

            <button type="button" id="submitStudent">Add Student</button>
        </form>

        <hr>
        <h3>Upload CSV File</h3>
        <form id="uploadCsvForm">
            <input type="file" id="csvFileInput" accept=".csv">
            <button type="button" id="uploadCsvButton">Upload CSV</button>
        </form>

        <button id="closeFormButton">Close</button>
    </div>
</div>

<script>
    const openFormButton = document.getElementById('openFormButton');
    const popupForm = document.getElementById('popupForm');
    const closeFormButton = document.getElementById('closeFormButton');
    const addStudentForm = document.getElementById('addStudentForm');
    const uploadCsvForm = document.getElementById('uploadCsvForm');
    const studentTableBody = document.getElementById('studentTableBody');
    
    openFormButton.addEventListener('click', () => {
        popupForm.style.display = 'flex';
    });

    closeFormButton.addEventListener('click', () => {
        popupForm.style.display = 'none';
    });

    function searchTable() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const tableRows = document.querySelectorAll('#studentTableBody tr');

    tableRows.forEach((row) => {
        // Get the text content from specific columns (excluding the Actions column)
        const studentName = row.children[0].textContent.toLowerCase(); // Column 1: Student Name
        const regNo = row.children[1].textContent.toLowerCase();       // Column 2: Registration No.
        const course = row.children[2].textContent.toLowerCase();      // Column 3: Course
        const year = row.children[3].textContent.toLowerCase();       // Column 4: Year
        const email = row.children[4].textContent.toLowerCase();       // Column 5: Email

        // Combine the values to perform the search only on specific columns
        const rowData = `${studentName} ${regNo} ${course} ${year} ${email}`;

        // Check if the combined data includes the search input value
        if (rowData.includes(searchInput)) {
            row.style.display = ''; // Show row if it matches
        } else {
            row.style.display = 'none'; // Hide row if it doesn't match
        }
        });
    }

    // Handle Add Student Form Submission
    document.getElementById('submitStudent').addEventListener('click', () => {
        const name = document.getElementById('name').value;
        const regNo = document.getElementById('regNo').value;
        const email = document.getElementById('email').value;
        const course = document.getElementById('course').value;
        const year = document.getElementById('year').value;

        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${name}</td>
            <td>${regNo}</td>
            <td>${course}</td>
            <td>${year}</td>
            <td>${email}</td>
            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
        `;
        studentTableBody.appendChild(newRow);

        // Clear Form Inputs
        addStudentForm.reset();
        popupForm.style.display = 'none';
    });

    // Handle CSV Upload
    document.getElementById('uploadCsvButton').addEventListener('click', () => {
        const fileInput = document.getElementById('csvFileInput');
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const rows = e.target.result.split("\n");
                rows.forEach(row => {
                    const cells = row.split(",");
                    if (cells.length === 5) {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${cells[0]}</td>
                            <td>${cells[1]}</td>
                            <td>${cells[2]}</td>
                            <td>${cells[3]}</td>
                            <td>${cells[4]}</td>
                            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                        `;
                        studentTableBody.appendChild(newRow);
                    }
                });
            };
            reader.readAsText(file);
        }
    });
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
