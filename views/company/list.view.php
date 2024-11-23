<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/list.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
            <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2 id="header-title">Lists</h2>
            </div>
            <div class="above-right">
                <div class="company-info">
                <i class="fa-regular fa-building" style="font-size: 40px;"></i>
                    <div class="company-name">Creative<br />Software</div>
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
            <h3>Student Lists</h3>
            <p>View current lists</p>
        </div>
        </div>

        <div class="form-container">
            <div class="card" onclick="showStudentList('applied')">
                <span>Applied <br>Students</span>
                <button>Select</button>
            </div>
            <div class="card" onclick="showStudentList('shortlisted')">
                <span>Shortlisted<br> Students</span>
                <button>Select</button>
            </div>
            <div class="card" onclick="showStudentList('selected')">
                <span>Selected <br>Students</span>
                <button>Select</button>
            </div>
        </div>

        <!-- Section for dynamically loaded student data -->
        <div id="student-list-section" style="display: none;">
            <h3 id="list-title"></h3>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Index No.</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="student-table-body">
                    <!-- Dynamic student rows will be added here -->
                </tbody>
            </table>
        </div>
    </section>
</main>


<script>
    // Sample student data
    const studentData = {
        applied: [{
                name: 'Thathsara',
                index: '200132444',
                email: 'applied1@example.com',
                status: 'Applied'
            },
            {
                name: 'Kasun',
                index: '200132445',
                email: 'applied2@example.com',
                status: 'Applied'
            },
        ],
        shortlisted: [{
                name: 'Nimal',
                index: '200132446',
                email: 'shortlisted1@example.com',
                status: 'Shortlisted'
            },
            {
                name: 'Sunil',
                index: '200132447',
                email: 'shortlisted2@example.com',
                status: 'Shortlisted'
            },
        ],
        selected: [{
                name: 'Amara',
                index: '200132448',
                email: 'selected1@example.com',
                status: 'Selected'
            },
            {
                name: 'Kamal',
                index: '200132449',
                email: 'selected2@example.com',
                status: 'Selected'
            },
        ]
    };

    // Function to display student list based on selected type
    function showStudentList(type) {
        const studentListSection = document.getElementById('student-list-section');
        const studentTableBody = document.getElementById('student-table-body');
        const listTitle = document.getElementById('list-title');

        // Update list title
        listTitle.innerText = `${type.charAt(0).toUpperCase() + type.slice(1)} Students`;

        // Clear existing rows
        studentTableBody.innerHTML = '';

        // Populate table with student data based on type
        studentData[type].forEach(student => {
            const row = document.createElement('tr');
            row.innerHTML = `
                    <td>${student.name}</td>
                    <td>${student.index}</td>
                    <td>${student.email}</td>
                    <td>${student.status}</td>
                `;
            studentTableBody.appendChild(row);
        });

        // Show the student list section
        studentListSection.style.display = 'block';
    }
</script>


<?php require base_path('views/partials/auth/auth-close.php') ?>