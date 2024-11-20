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
                    <td>thathsara@gmail.com</td>
                    <td>
                        <button class="Edit-button">Edit</button>
                        <button class="disable-button">Disable</button>
                    </td>
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
            <input type="text" id="name" required>

            <label for="regNo">Register Number:</label>
            <input type="text" id="regNo" required>

            <label for="email">Email:</label>
            <input type="email" id="email" required>

            <label for="course">Course:</label>
            <select id="course">
                <option value="CS">CS</option>
                <option value="IS">IS</option>
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

<!-- Edit Student Popup Form -->
<div id="editPopupForm" class="popup-form">
    <div class="form-container">
        <h2>Edit Student Details</h2>
        <form id="editStudentForm">
            <input type="hidden" id="editIndex" />
            <label for="editName">Name:</label>
            <input type="text" id="editName" required />

            <label for="editRegNo">Registration No:</label>
            <input type="text" id="editRegNo" disabled />

            <label for="editCourse">Course:</label>
            <input type="text" id="editCourse" required />

            <label for="editEmail">Email:</label>
            <input type="email" id="editEmail" required />

            <button type="button" id="submitEdit">Save Changes</button>
            <button type="button" id="closeEditFormButton">Close</button>
        </form>
    </div>
</div>

<script>
    const openFormButton = document.getElementById('openFormButton');
    const popupForm = document.getElementById('popupForm');
    const closeFormButton = document.getElementById('closeFormButton');
    const addStudentForm = document.getElementById('addStudentForm');
    const studentTableBody = document.getElementById('studentTableBody');
    const uploadCsvForm = document.getElementById('uploadCsvForm');
    const searchInput = document.getElementById('searchInput'); // Reference to the search input


    // Add Student
    document.getElementById('submitStudent').addEventListener('click', () => {
        const name = document.getElementById('name').value;
        const regNo = document.getElementById('regNo').value;
        const email = document.getElementById('email').value;
        const course = document.getElementById('course').value;

        addStudentRow(name, regNo, course, email);
        addStudentForm.reset();
        popupForm.style.display = 'none';
    });

    function addStudentRow(name, regNo, course, email) {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${name}</td>
            <td>${regNo}</td>
            <td>${course}</td>
            <td>${email}</td>
            <td>
                <button class="Edit-button">Edit</button>
                <button class="disable-button">Disable</button>
            </td>
        `;
        studentTableBody.appendChild(newRow);
    }

    // CSV Upload Handler
    document.getElementById('uploadCsvButton').addEventListener('click', () => {
        const csvFileInput = document.getElementById('csvFileInput');
        const file = csvFileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const csvData = event.target.result;
                processCsvData(csvData);
            };
            reader.readAsText(file);
        } else {
            alert("Please select a CSV file to upload.");
        }
    });

    // Function to Process CSV Data
    function processCsvData(csvData) {
        const rows = csvData.split('\n');
        rows.forEach((row, index) => {
            if (index === 0) return;

            const columns = row.split(',');
            if (columns.length >= 4) {
                const name = columns[0].trim();
                const regNo = columns[1].trim();
                const course = columns[2].trim();
                const email = columns[3].trim();

                if (name && regNo && course && email) {
                    addStudentRow(name, regNo, course, email);
                }
            }
        });

        alert("CSV file uploaded successfully.");
        document.getElementById('uploadCsvForm').reset();
    }

    // Open and Close Add Form
    openFormButton.addEventListener('click', () => popupForm.style.display = 'flex');
    closeFormButton.addEventListener('click', () => popupForm.style.display = 'none');

    // Edit and Save Functionality
    studentTableBody.addEventListener('click', (event) => {
        if (event.target.classList.contains('Edit-button')) {
            const row = event.target.closest('tr');
            const rowIndex = Array.from(studentTableBody.children).indexOf(row);

            document.getElementById('editIndex').value = rowIndex;
            document.getElementById('editName').value = row.children[0].textContent;
            document.getElementById('editRegNo').value = row.children[1].textContent;
            document.getElementById('editCourse').value = row.children[2].textContent;
            document.getElementById('editEmail').value = row.children[3].textContent;

            document.getElementById('editPopupForm').style.display = 'flex';
        }
    });

    document.getElementById('submitEdit').addEventListener('click', () => {
        const index = document.getElementById('editIndex').value;
        const row = studentTableBody.children[index];

        row.children[0].textContent = document.getElementById('editName').value;
        row.children[2].textContent = document.getElementById('editCourse').value;
        row.children[3].textContent = document.getElementById('editEmail').value;

        document.getElementById('editPopupForm').style.display = 'none';
    });

    document.getElementById('closeEditFormButton').addEventListener('click', () => {
        document.getElementById('editPopupForm').style.display = 'none';
    });

// Search Functionality
function searchTable() {
        const filter = searchInput.value.toLowerCase();
        const rows = studentTableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length - 1; j++) { // Exclude the "Actions" column
                if (cells[j].textContent.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    }

</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
