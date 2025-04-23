<?php require base_path('views/partials/auth/auth.php'); ?>

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
                <p>add students to the system</p>
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
                                <button class="Edit-button" onclick="openeditform('<?= $student['id'] ?>')">Edit</button>
                                <form action="/PDC/deletestudent" method="post" style="display: inline;">
                                    <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                                    <button type="submit" class="disable-button">Delete</button>
                                </form>
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
                        <!-- <th>Application Status</th> -->
                        <th>Course</th>
                        <th>Email</th>
                        <th>Index No.</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="viewStudentTableBody">
                    <?php foreach ($students as $student): ?>
                        <tr id="view-row-<?= $student['id'] ?>">
                            <td><?= htmlspecialchars($student['name']) ?></td>
                            <td><?= htmlspecialchars($student['registration_number']) ?></td>
                            
                            <td><?= htmlspecialchars($student['course']) ?></td>
                            <td><?= htmlspecialchars($student['email']) ?></td>
                            <td><?= htmlspecialchars($student['index_number']) ?></td>
                            <td>
                                <form action="/PDC/disablestudentaccount" method="post" style="display: inline;">
                                    <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                                    <button type="submit" class="disable-button">Disable</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
                        <th>Hired By</th>
                        <th>Job Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="hiredStudentTableBody">
                    <?php if (isset($hired_students)): ?>
                        <?php foreach ($hired_students as $hired): ?>
                            <tr id="hired-row-<?= $hired['id'] ?>">
                                <td><?= htmlspecialchars($hired['student_name']) ?></td>
                                <td><?= htmlspecialchars($hired['registration_number']) ?></td>
                                <td><?= htmlspecialchars($hired['course']) ?></td>
                                <td><?= htmlspecialchars($hired['company_name']) ?></td>
                                <td><?= htmlspecialchars($hired['job_role']) ?></td>
                                <td>
                                    <form action="/PDC/deletehired" method="post" style="display: inline;">
                                        <input type="hidden" name="hired_id" value="<?= $hired['id'] ?>">
                                        <button type="submit" class="disable-button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No hired students found.</td>
                        </tr>
                    <?php endif; ?>
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
        <form id="uploadCsvForm" method="post" action="/PDC/uploadCsv" enctype="multipart/form-data">
            <input type="file" id="csvFileInput" name="csvFile" accept=".csv">
            <button type="submit" id="uploadCsvButton">Upload CSV</button>
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
                <option value="computer science">computer science</option>
                <option value="information systems">information systems</option>
            </select>
            <div style="display: flex; justify-content: space-between;">
                <button type="submit" id="submitStudent">Add Student</button>
            </div>
        </form>

        <button id="closeFormButton">Close</button>
    </div>
</div>

<!-- Popup Form for Editing Student -->
<div id="editForm" class="popup-form">
    <div class="form-container">
        <h2>Update Students</h2>
        <h3>Upload CSV File</h3>
        <form id="uploadCsvFormEdit" method="post" action="/PDC/uploadCsv" enctype="multipart/form-data">
            <input type="file" id="csvFileInputEdit" name="csvFile" accept=".csv" required>
            <button type="submit" id="uploadCsvButtonEdit">Upload CSV</button>
        </form>

        <hr>

        <h3>Update a student</h3>
      
        <form id="editstudentForm" method="post" action="/PDC/updatestudent">
            <input type="hidden" name="student_id" id="student_id" required>
            <label for="edit_name">Name:</label>
            <input type="text" id="edit_name" name="name" required>

            <label for="edit_index_number">Index No.:</label>
            <input type="text" id="edit_index_number" name="index_number" required>

            <label for="edit_registration_number">Register Number:</label>
            <input type="text" id="edit_registration_number" name="registration_number" required>

            <label for="edit_email">Email:</label>
            <input type="email" id="edit_email" name="email" required>

            <label for="edit_course">Course:</label>
            <select id="edit_course" name="course">
                <option value="computer science">computer science</option>
                <option value="information systems">information systems</option>
            </select>

            <button type="submit" id="submitEditStudent">Save changes</button>
        </form>

        <button id="closeEditFormButton" onclick="closeeditform()">Close</button>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Data from PHP
    const students = <?php echo json_encode($students); ?>;
    const hiredStudents = <?php echo isset($hired_students) ? json_encode($hired_students) : '[]'; ?>;

    // DOM Elements
    const openFormButton = document.getElementById('openFormButton');
    const popupForm = document.getElementById('popupForm');
    const editForm = document.getElementById('editForm');
    const closeFormButton = document.getElementById('closeFormButton');
    const closeEditFormButton = document.getElementById('closeEditFormButton');
    const studentTableBody = document.getElementById('studentTableBody');
    const viewStudentTableBody = document.getElementById('viewStudentTableBody');
    const hiredStudentTableBody = document.getElementById('hiredStudentTableBody');
    const searchInput = document.getElementById('searchInput');
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');

    // Initialize tables
    renderTable('addstu', students);
    renderTable('viewstudent', students);
    renderTable('hire', hiredStudents);

    // Toggle Sections
    function toggleComplaint(section) {
        const addSection = document.getElementById('addSection');
        const trackingSection = document.getElementById('trackingsection');
        const hiredStudentSection = document.getElementById('hiredstudentsection');
        const addTab = document.getElementById('addtab');
        const viewStudentTab = document.getElementById('view-student-tab');
        const hiredStudentTab = document.getElementById('hired-student-tab');

        if (section === 'addstu') {
            addSection.style.display = 'block';
            trackingSection.style.display = 'none';
            hiredStudentSection.style.display = 'none';
            addTab.classList.add('active-tab');
            viewStudentTab.classList.remove('active-tab');
            hiredStudentTab.classList.remove('active-tab');
            renderTable('addstu', students);
        } else if (section === 'viewstudent') {
            addSection.style.display = 'none';
            trackingSection.style.display = 'block';
            hiredStudentSection.style.display = 'none';
            addTab.classList.remove('active-tab');
            viewStudentTab.classList.add('active-tab');
            hiredStudentTab.classList.remove('active-tab');
            renderTable('viewstudent', students);
        } else if (section === 'hire') {
            addSection.style.display = 'none';
            trackingSection.style.display = 'none';
            hiredStudentSection.style.display = 'block';
            addTab.classList.remove('active-tab');
            viewStudentTab.classList.remove('active-tab');
            hiredStudentTab.classList.add('active-tab');
            renderTable('hire', hiredStudents);
        }
    }

    // Render Table Based on Section
    function renderTable(section, data) {
        let tableBody;
        if (section === 'addstu') {
            tableBody = studentTableBody;
        } else if (section === 'viewstudent') {
            tableBody = viewStudentTableBody;
        } else if (section === 'hire') {
            tableBody = hiredStudentTableBody;
        }

        if (!tableBody) return;

        tableBody.innerHTML = '';

        if (section === 'addstu') {
            data.forEach(student => {
                const row = document.createElement('tr');
                row.id = `row-${student.id}`;
                row.innerHTML = `
                    <td><input type="checkbox" class="rowCheckbox" data-id="${student.id}" /></td>
                    <td>${student.name}</td>
                    <td>${student.registration_number}</td>
                    <td>${student.course}</td>
                    <td>${student.email}</td>
                    <td>${student.index_number}</td>
                    <td>
                        <button class="Edit-button" onclick="openeditform('${student.id}')">Edit</button>
                        <form action="/PDC/deletestudent" method="post" style="display: inline;">
                            <input type="hidden" name="student_id" value="${student.id}">
                            <button type="submit" class="disable-button">Delete</button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        } else if (section === 'viewstudent') {
            data.forEach(student => {
                const row = document.createElement('tr');
                row.id = `view-row-${student.id}`;
                row.innerHTML = `
                    <td>${student.name}</td>
                    <td>${student.registration_number}</td>
                    
                    <td>${student.course}</td>
                    <td>${student.email}</td>
                    <td>${student.index_number}</td>
                    <td>
                        <form action="/PDC/disablestudentaccount" method="post" style="display: inline;">
                            <input type="hidden" name="student_id" value="${student.id}">
                            <button type="submit" class="disable-button">Disable</button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        } else if (section === 'hire') {
            data.forEach(hired => {
                const row = document.createElement('tr');
                row.id = `hired-row-${hired.id}`;
                row.innerHTML = `
                    <td>${hired.student_name}</td>
                    <td>${hired.registration_number}</td>
                    <td>${hired.course}</td>
                    <td>${hired.company_name}</td>
                    <td>${hired.job_role}</td>
                    <td>
                        <form action="/PDC/deletehired" method="post" style="display: inline;">
                            <input type="hidden" name="hired_id" value="${hired.id}">
                            <button type="submit" class="disable-button">Delete</button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
    }

    // Search Functionality
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const activeSection = document.querySelector('.active-tab').id === 'addtab' ? 'addstu' :
                             document.querySelector('.active-tab').id === 'view-student-tab' ? 'viewstudent' : 'hire';

        if (activeSection === 'addstu') {
            const filteredStudents = students.filter(student =>
                student.name.toLowerCase().includes(searchTerm) ||
                student.registration_number.toLowerCase().includes(searchTerm) ||
                student.course.toLowerCase().includes(searchTerm) ||
                student.email.toLowerCase().includes(searchTerm) ||
                student.index_number.toLowerCase().includes(searchTerm)
            );
            renderTable('addstu', filteredStudents);
        } else if (activeSection === 'viewstudent') {
            const filteredStudents = students.filter(student =>
                student.name.toLowerCase().includes(searchTerm) ||
                student.registration_number.toLowerCase().includes(searchTerm) ||
                (student.application_status || '').toLowerCase().includes(searchTerm) ||
                student.course.toLowerCase().includes(searchTerm) ||
                student.email.toLowerCase().includes(searchTerm) ||
                student.index_number.toLowerCase().includes(searchTerm)
            );
            renderTable('viewstudent', filteredStudents);
        } else if (activeSection === 'hire') {
            const filteredHired = hiredStudents.filter(hired =>
                hired.student_name.toLowerCase().includes(searchTerm) ||
                hired.registration_number.toLowerCase().includes(searchTerm) ||
                hired.course.toLowerCase().includes(searchTerm) ||
                hired.company_name.toLowerCase().includes(searchTerm) ||
                hired.job_role.toLowerCase().includes(searchTerm)
            );
            renderTable('hire', filteredHired);
        }
    });

    // Edit Form Functionality
    function openeditform(id) {
        const student = students.find(stu => stu.id == id);
        if (student) {
            editForm.style.display = 'flex';
            document.getElementById('student_id').value = student.id;
            document.getElementById('edit_name').value = student.name;
            document.getElementById('edit_registration_number').value = student.registration_number;
            document.getElementById('edit_course').value = student.course;
            document.getElementById('edit_email').value = student.email;
            document.getElementById('edit_index_number').value = student.index_number;
        }
    }

    function closeeditform() {
        editForm.style.display = 'none';
    }

    // Open/Close Add Form
    openFormButton.addEventListener('click', () => popupForm.style.display = 'flex');
    closeFormButton.addEventListener('click', () => popupForm.style.display = 'none');
    closeEditFormButton.addEventListener('click', () => editForm.style.display = 'none');

    // Select All Checkbox
    selectAllCheckbox.addEventListener('change', () => {
        const rowCheckboxes = studentTableBody.querySelectorAll('.rowCheckbox');
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    studentTableBody.addEventListener('change', (e) => {
        if (e.target.classList.contains('rowCheckbox')) {
            const rowCheckboxes = studentTableBody.querySelectorAll('.rowCheckbox');
            if (!e.target.checked) {
                selectAllCheckbox.checked = false;
            } else if (Array.from(rowCheckboxes).every(cb => cb.checked)) {
                selectAllCheckbox.checked = true;
            }
        }
    });

  // CSV Upload Handler
document.getElementById('uploadCsvForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const csvFileInput = document.getElementById('csvFileInput');
    const file = csvFileInput.files[0];

    if (!file) {
        alert('Please select a CSV file to upload.');
        return;
    }

    if (!file.name.endsWith('.csv')) {
        alert('Please upload a valid CSV file.');
        return;
    }

    const formData = new FormData();
    formData.append('csvFile', file);

    try {
        const response = await fetch('/PDC/uploadCsv', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
        });

        const data = await response.json();

        if (data.success) {
            alert(data.message);
            document.getElementById('uploadCsvForm').reset();
            // Reload the page to reflect the new data
            window.location.reload();
        } else {
            alert('Error uploading CSV: ' + (data.message || 'Unknown error') + '\n' + (data.errors ? data.errors.join('\n') : ''));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while uploading the CSV.');
    }
});

</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>