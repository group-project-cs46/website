<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/ManageStudents.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-user-graduate" style="font-size: 40px;"></i>
            <h2><b>Manage Student</b></h2>
        </div>
        <input type="text" placeholder="Search Student..." class="search-bar" id="searchInput">
    </header>

    <section class="content">
        <div class="tabs">
            <div class="add-student active-tab" id="addtab" onclick="toggleComplaint('addstu')">
                <h3>Add student accounts</h3>
                <p> add students to the system</p>
            </div>

            <div class="divider"></div>

            <div class="view-student" id="view-student-tab" onclick="toggleComplaint('viewstudent')">
                <h3>View Students</h3>
                <p>tracking student progress</p>
            </div>

            <div class="divider"></div>

            <div class="hired-students" id="hired-student-tab" onclick="toggleComplaint('hire')">
                <h3>Hired Students</h3>
                <p>view the status of Hired students</p>
            </div>

        </div>

        <div class="container" id="addSection">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Add Student</b></h3>
                    <p>add student accounts</p>
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
                        <th>Index No.</th>
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
                            <button class="disable-button">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container" id="trackingsection" style="display: none;">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>View Registered Students</b></h3>
                    <p>track the student applications</p>
                </div>
            </div>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Registration No.</th>
                        <th>Course</th>
                        <th>Email</th>
                        <th>Index No.</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Example Table Rows -->
                    <tr>
                        <td>John Doe</td>
                        <td>2024/CS/123</td>
                        <td>CS</td>
                        <td>johndoe@example.com</td>
                        <td>22001417</td>
                        <td>
                            <button class="Edit-button">Edit</button>
                            <button class="disable-button">Disable</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>2024/IS/456</td>
                        <td>IS</td>
                        <td>janesmith@example.com</td>
                        <td>22301213</td>
                        <td>
                            <button class="Edit-button">Edit</button>
                            <button class="disable-button">Disable</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    

    <div class="container" id="hiredstudentsection" style="display: none;">
        <div class="table-title">
            <div class="table-title-txt">
                <h3><b>Hired Students</b></h3>
                <p>view hired students list</p>
            </div>
        </div>
        <table class="student-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Registration No.</th>
                    <th>Course</th>
                    <th>Email</th>
                    <th>Index No.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- Example Table Rows -->
                <tr>
                    <td>John Doe</td>
                    <td>2024/CS/123</td>
                    <td>CS</td>
                    <td>johndoe@example.com</td>
                    <td>256336566</td>
                    <td>
                        <button class="Edit-button">Edit</button>
                        <button class="disable-button">Disable</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>


</main>

<!-- Popup Form for Adding Student -->
<div id="popupForm" class="popup-form">
    <div class="form-container">
        <h2>Add Students</h2>
        <h3>Upload CSV File</h3>
        <form id="uploadCsvForm">
            <input type="file" id="csvFileInput" accept=".csv">
            <button type="button" id="uploadCsvButton">Upload CSV</button>
        </form>

        <hr>

        <h3>Add a student</h3>
        <form id="viewstudentForm" method="post" action="/PDC/addstudent">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="indexno">Index No.:</label>
            <input type="text" id="indexno" name="indexno" required>

            <label for="regNo">Register Number:</label>
            <input type="text" id="regNo" name="regNo" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="course">Course:</label>
            <select id="course" name="course">
                <option value="CS">CS</option>
                <option value="IS">IS</option>
            </select>

            <button type="submit" id="submitStudent">Add Student</button>
        </form>

        <button id="closeFormButton">Close</button>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Toggle between Approve Section and Complaint Section
    let students = [{
            name: "John Doe",
            regNo: "2024/CS/123",
            course: "CS",
            email: "johndoe@example.com",
            indexno: "200023220"
        },
        {
            name: "Jane Smith",
            regNo: "2024/IS/456",
            course: "IS",
            email: "janesmith@example.com",
            indexno: "200023220"
        },
        {
            name: "Emily Johnson",
            regNo: "2024/CS/789",
            course: "CS",
            email: "emilyjohnson@example.com",
            indexno: "200023220"
        },
        {
            name: "Michael Brown",
            regNo: "2024/IS/101",
            course: "IS",
            email: "michaelbrown@example.com",
            indexno: "200023220"
        },
        {
            name: "Sarah Wilson",
            regNo: "2024/CS/112",
            course: "CS",
            email: "sarahwilson@example.com",
            indexno: "200023220"
        }

    ];

    const openFormButton = document.getElementById('openFormButton');
    const popupForm = document.getElementById('popupForm');
    const closeFormButton = document.getElementById('closeFormButton');
    const viewstudentForm = document.getElementById('viewstudentForm');
    const studentTableBody = document.getElementById('studentTableBody');
    const uploadCsvForm = document.getElementById('uploadCsvForm');

    
    renderTable(students)


    function toggleComplaint(section) {
        const addSection = document.getElementById('addSection');
        const trackingsection = document.getElementById('trackingsection');
        const hiredStudentsection = document.getElementById('hiredstudentsection');
        const addtab = document.getElementById('addtab');
        const viewstudentTab = document.getElementById('view-student-tab');
        const hiredStudentTab = document.getElementById('hired-student-tab');


        if (section === 'addstu') {
            addSection.style.display = 'block';
            trackingsection.style.display = 'none';
            hiredStudentsection.style.display = 'none';
            addtab.classList.add('active-tab');
            viewstudentTab.classList.remove('active-tab');
            hiredStudentTab.classList.remove('active-tab');
        } else if (section === 'viewstudent') {
            addSection.style.display = 'none';
            trackingsection.style.display = 'block';
            hiredStudentsection.style.display = 'none';
            addtab.classList.remove('active-tab');
            viewstudentTab.classList.add('active-tab');
            hiredStudentTab.classList.remove('active-tab');
        } else if (section === 'hire') {
            addSection.style.display = 'none';
            trackingsection.style.display = 'none';
            hiredStudentsection.style.display = 'block';
            addtab.classList.remove('active-tab');
            viewstudentTab.classList.remove('active-tab');
            hiredStudentTab.classList.add('active-tab');
        }
    }

    // Add Student Functionality


    openFormButton.addEventListener('click', () => popupForm.style.display = 'flex');
    closeFormButton.addEventListener('click', () => popupForm.style.display = 'none');

    // document.getElementById('submitStudent').addEventListener('click', () => {
    //     const name = document.getElementById('name').value;
    //     const regNo = document.getElementById('regNo').value;
    //     const email = document.getElementById('email').value;
    //     const course = document.getElementById('course').value;

    //     viewstudentRow(name, regNo, course, email);
    //     viewstudentForm.reset();
    //     popupForm.style.display = 'none';
    // });

    // Initialize an empty array to store student data



    // Initialize an empty array to store student data


    // Function to add a student row and store it as an object in the array
    function viewstudentRow(name, regNo, course, email) {
        // Create a new object for the student
        const student = {
            name,
            regNo,
            course,
            email
        };

        // Add the student object to the array
        students.push(student);

        // Render the table with updated data
        renderTable(students);
    }

    // Function to render the table based on the provided data
    function renderTable(data) {
        // Clear the table body
        studentTableBody.innerHTML = '';

        // Populate the table with the data
        data.forEach((student) => {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td>${student.name}</td>
            <td>${student.regNo}</td>
            <td>${student.course}</td>
            <td>${student.email}</td>
            <td>${student.indexno}</td>
            <td>
                <button class="Edit-button">Edit</button>
                <button class="disable-button">Delete</button>
            </td>
        `;
            studentTableBody.appendChild(newRow);
        });
    }

    // Event listener for the search filter
    const search_filter = document.getElementById("searchInput");
    search_filter.addEventListener('input', (e) => {
        const search_data = e.target.value.toLowerCase();

        // Filter the students array by name
        const filteredStudents = students.filter((student) =>
            student.name.toLowerCase().includes(search_data)
        );

        // Render the table with the filtered data
        renderTable(filteredStudents);
    });





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
                    viewstudentRow(name, regNo, course, email);
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
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>