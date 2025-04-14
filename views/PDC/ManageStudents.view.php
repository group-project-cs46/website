<?php require base_path('views/partials/auth/auth.php');
?>

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
                    <h3><b>Registered Students</b></h3>
                    <p>registered student accounts</p>
                </div>
                <button class="add-button" id="openFormButton">+</button>
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllCheckbox" /></th>
                        <th>Student Name</th>
                        <th>Registration No.</th>
                        <th>Course</th>
                        <th>Email</th>
                        <th>Index No.</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <?php foreach ($students as $student): ?>
                        <tr id="row-<?= $student['id'] ?>">
                            <td><input type="checkbox" class="rowCheckbox" data-id="<?= $student['id'] ?>" /></td>
                            <td><?= htmlspecialchars($student['name']) ?></td>
                            <td><?= htmlspecialchars($student['registration_number']) ?></td>
                            <td><?= htmlspecialchars($student['course']) ?></td>
                            <td><?= htmlspecialchars($student['email']) ?></td>
                            <td><?= htmlspecialchars($student['index_number']) ?></td>
                            <td>
                                <button class="Edit-button">Edit</button>
                                <button class="disable-button">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
                        <th>Application_Status</th>
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
                        <td>pending</td>
                        <td>CS</td>
                        <td>johndoe@example.com</td>
                        <td>22001417</td>
                        <td>
                            <!-- <button class="Edit-button">Edit</button> -->
                            <button class="disable-button">Disable</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>2024/IS/456</td>
                        <td>hired</td>
                        <td>IS</td>
                        <td>janesmith@example.com</td>
                        <td>22301213</td>
                        <td>
                            <!-- <button class="Edit-button">Edit</button> -->
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
                        <th>HiredBy</th>
                        <th>jobrole</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Example Table Rows -->
                    <tr>
                        <td>John Doe</td>
                        <td>2024/CS/123</td>
                        <td>CS</td>
                        <td>CISCO labs</td>
                        <td>Software Engineer</td>
                        <td>
                            <!-- <button class="Edit-button">Edit</button> -->
                            <button class="disable-button">Delete</button>
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

            <label for="index_number">Index No.:</label>
            <input type="text" id="index_number" name="index_number" required>


            <label for="registration_number">Register Number:</label>
            <input type="text" id="registration_number" name="registration_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="course">Course:</label>
            <select id="course" name="course">
                <option value="CS">CS</option>
                <option value="IS">IS</option>
            </select>
            <div style="display: flex; justify-content: space-between;">
                <button type="submit" id="submitStudent">Add Student</button>
                <button id="closeFormButton">Close</button>
            </div>

        </form>




    </div>
</div>



<div id="editForm" class="popup-form">
    <div class="form-container">
        <h2>Update Students</h2>
        <h3>Upload CSV File</h3>
       
        <form id="uploadCsvForm" method="post" action="/PDC/uploadCsv" enctype="multipart/form-data">
            <input type="file" id="csvFileInput" name="csvFile" accept=".csv" required>
            <button type="submit" id="uploadCsvButton">Upload CSV</button>
        </form>

        <hr>

        <h3>Update a student</h3>
        <form id="editstudentForm" method="post" action="/PDC/updatestudent">

            <input type="hidden" name="student_id" id="student_id" required>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="index_number">Index No.:</label>
            <input type="text" id="index_number" name="index_number" required>

            <label for="registration_number">Register Number:</label>
            <input type="text" id="registration_number" name="registration_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="course">Course:</label>
            <select id="course" name="course">
                <option value="CS">CS</option>
                <option value="IS">IS</option>
            </select>

            <button type="submit" id="submitStudent">Save changes</button>
            <button id="closeFormButton" onclick="closeeditform()">Close</button>
        </form>



        <!-- //<button id="closeFormButton" onclick="closeeditform()">Close</button> -->
    </div>
</div>

<!-- JavaScript -->
<script>
    // Toggle between Approve Section and Complaint Section
    const students = <?php echo json_encode($students); ?>


    const openFormButton = document.getElementById('openFormButton');
    const editformbutton = document.getElementById('editformbutton');
    const popupForm = document.getElementById('popupForm');
    const editform = document.getElementById('editForm');
    const closeFormButton = document.getElementById('closeFormButton');
    const viewstudentForm = document.getElementById('viewstudentForm');
    const studentTableBody = document.getElementById('studentTableBody');
    const uploadCsvForm = document.getElementById('uploadCsvForm');
    const studenteditform = document.getElementById('editstudentForm');


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

    function viewstudentRow(name, registration_number, course, email, index_number) {
        // Create a new object for the student
        const student = {
            name,
            registration_number,
            course,
            email,
            index_number
        };

        // Add the student object to the array
        student.push(students);

        // Render the table with updated data
        renderTable(students);
    }

    function openeditform(id) {
        console.log(id);
        const student = students.find(stu => stu.id == id);
        console.log(student);
        editform.style.display = 'flex';
        studenteditform.elements.student_id.value = student.id;
        studenteditform.elements.name.value = student.name;
        studenteditform.elements.registration_number.value = student.registration_number;
        studenteditform.elements.course.value = "CS";
        studenteditform.elements.email.value = student.email;
        studenteditform.elements.index_number.value = student.index_number;
    }

    function closeeditform() {
        editform.style.display = 'none';
    }

    // Function to render the table based on the provided data
    function renderTable(data) {

        // Clear the table body
        studentTableBody.innerHTML = '';

        // Populate the table with the data
        data.forEach((student) => {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td><input type="checkbox" class="rowCheckbox" data-id="${student.id}" /></td>
            <td>${student.name}</td>
            <td>${student.registration_number}</td>
            <td>${student.course}</td>
            <td>${student.email}</td>
            <td>${student.index_number}</td>
            <td>
                
                <button class="Edit-button" id ="editformbutton" onclick="openeditform('${student.id}')">Edit</button>
                <form id="deleteform" action="/PDC/deletestudent" method="post">
                    <input type="hidden" name="student_id" value="${student.id}">
                    
                <button type = 'submit' class="disable-button id ="deleteformbutton"">Delete</button>
                </form>
            </td>
        `;
            studentTableBody.appendChild(newRow);
        });
    }

    // Event listener for the search filter
    const searchInput = document.getElementById("searchInput");
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();

        // Filter the students array based on multiple fields
        const filteredStudents = students.filter((student) => {
            return (
                student.name.toLowerCase().includes(searchTerm) ||
                student.registration_number.toLowerCase().includes(searchTerm) ||
                student.course.toLowerCase().includes(searchTerm) ||
                student.email.toLowerCase().includes(searchTerm) ||
                student.index_number.toLowerCase().includes(searchTerm)
            );
        });

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
                const registration_number = columns[1].trim();
                const course = columns[2].trim();
                const email = columns[3].trim();
                const index_number = columns[4].trim();

                if (name && registration_number && course && email && index_number) {
                    viewstudentRow(name, registration_number, course, email, index_number);
                }
            }
        });

        alert("CSV file uploaded successfully.");
        document.getElementById('uploadCsvForm').reset();
    }

    // Open and Close Add Form
    // openFormButton.addEventListener('click', () => popupForm.style.display = 'flex');
    closeFormButton.addEventListener('click', () => popupForm.style.display = 'none');

    // Edit and Save Functionality
    studentTableBody.addEventListener('click', (event) => {
        if (event.target.classList.contains('Edit-button')) {
            const row = event.target.closest('tr');
            const rowIndex = Array.from(studentTableBody.children).indexOf(row);

            document.getElementById('editIndex').value = rowIndex;
            document.getElementById('editName').value = row.children[0].textContent;
            document.getElementById('editregistration_number').value = row.children[1].textContent;
            document.getElementById('editCourse').value = row.children[2].textContent;
            document.getElementById('editEmail').value = row.children[3].textContent;
            document.getElementById('editindex_number').value = row.children[4].textContent;

            document.getElementById('editPopupForm').style.display = 'flex';
        }
    });

    document.getElementById('submitEdit').addEventListener('click', () => {
        const index = document.getElementById('editIndex').value;
        const row = studentTableBody.children[index];

        row.children[0].textContent = document.getElementById('editName').value;
        row.children[1].textContent = document.getElementById('editregistration_number').value;
        row.children[2].textContent = document.getElementById('editCourse').value;
        row.children[3].textContent = document.getElementById('editEmail').value;
        row.children[4].textContent = document.getElementById('editindex_number').value;

        document.getElementById('editPopupForm').style.display = 'none';
    });

    document.getElementById('closeFormButton').addEventListener('click', () => {
        document.getElementById('editPopupForm').style.display = 'none';
    });

    // JavaScript for "Select All" functionality
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const rowCheckboxes = document.querySelectorAll('.rowCheckbox');

    selectAllCheckbox.addEventListener('change', () => {
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (!checkbox.checked) {
                selectAllCheckbox.checked = false;
            } else if (Array.from(rowCheckboxes).every(cb => cb.checked)) {
                selectAllCheckbox.checked = true;
            }
        });
    });
    
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>


