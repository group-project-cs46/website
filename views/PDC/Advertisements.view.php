<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Advertisements.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-rectangle-ad" style="font-size: 40px;"></i>
            <h2><b>Manage Company Advertisements</b></h2>
        </div>
        <input type="text" id="search-bar" placeholder="Search Company..." class="search-bar">
    </header>

    <section class="content">
    <div class="tabs">
        <div class="company-add active-tab" id="addvertistmenttab" onclick="toggleadvertistment('advertisements-section')">
            <h3>Company Advertisements</h3>
            <p>View Company advertisements</p>
        </div>

        <div class="divider"></div>

        <div class="approve-ad" id="approve-ad-tab" onclick="toggleadvertistment('approved-advertisements-section')">
            <h3>Approved Advertisement</h3>
            <p>View approved advertisements</p>
        </div>
    </div>

    <div class="container" id="approveadd-section">
        <div class="table-title">
            <h3><b>Posted Advertisements</b></h3>
            <p>View posted advertisements</p>
        </div>
        <table class="advertistment-table">
            <thead>
                <tr>
                    <th>Advertisement</th>
                    <th>Status</th>
                    <th>No. of required Applications</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="advertisement-list">
                <!-- Dynamic content will be injected here -->
            </tbody>
        </table>
    </div>

    <div class="container" id="approvedadd-section">
        <div class="table-title">
            <h3><b>Approved Advertisements</b></h3>
            <p>View approved advertisements</p>
        </div>

        <!-- Approved Advertisements Table -->
        <table class="advertistment-table">
            <thead>
                <tr>
                    <th>Advertisement</th>
                    <th>Status</th>
                    <th>No. of Students Applied</th>
                    <th>No. of required Applications</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="approved-advertisement-list">
                <!-- Approved advertisements will be displayed here -->
            </tbody>
        </table>
    </section>

    <!-- Popup Modal for viewing advertisement details -->
    <div id="popup-modal" class="popup-modal">
        <div class="popup-content">
            <span id="close-popup" class="close-btn">&times;</span>
            <h2 id="popup-title"></h2>
            <p><b>Status:</b> <span id="popup-status"></span></p>
            <p><b>No. of required Applications:</b> <span id="popup-applied"></span></p>
            <p><b>Contact Email:</b> <a href="#" id="popup-email"></a></p>
            <button id="approve-btn" class="approve-btn">Approve</button>
            <button id="reject-btn" class="reject-btn">Reject</button>
            <p id="success-message" class="hidden success-message">Approved successfully!</p>
        </div>
    </div>

    <!-- Popup Modal for viewing applied student details -->
    <div id="student-popup-modal" class="popup-modal">
    <div class="popup-content">
        <span id="close-student-popup" class="close-btn">&times;</span>
        <h2>Student Applications</h2>
        <table class="student-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Registration Number</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody id="student-list">
                <!-- Dynamic content will be injected here -->
            </tbody>
        </table>
    </div>
    </div>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
   // Initialize data
const advertisements = [
    { title: "Software Engineer Intern (WSO2)", status: "Hiring", required: 10, email: "hiring@gmail.com" },
    { title: "Data Analyst Intern (Virtusa)", status: "Closed", required: 10, email: "apply@virtusa.com" },
    { title: "Frontend Developer Intern (99x)", status: "Hiring", required: 15, email: "jobs@99x.com" },
    { title: "Backend Developer Intern (Sysco LABS)", status: "Hiring", required: 12, email: "interns@syscolabs.com" },
    { title: "UI/UX Designer Intern (CreativeHub)", status: "Closed", required: 20, email: "careers@creativehub.com" }
];

const approvedAdvertisements = [
    { title: "Frontend Developer Intern (99x)", status: "Hiring", applied: 15, required:20, email: "jobs@99x.com" },
    { title: "UI/UX Designer Intern (CreativeHub)", status: "Closed", applied: 20, required:20, email: "careers@creativehub.com" }
];

// Render advertisements
function renderAdvertisements() {
    const advertisementList = document.getElementById('advertisement-list');
    advertisementList.innerHTML = '';

    advertisements.forEach((ad, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${ad.title}</td>
            <td style="color: ${ad.status === 'Hiring' ? '#28a745' : '#dc3545'}">${ad.status}</td>
            <td>${ad.required}</td>
            <td><a href="mailto:${ad.email}" style="color: #007bff;">${ad.email}</a></td>
            <td><button class="view-btn" onclick="openPopup(${index})">View</button></td>
        `;
        advertisementList.appendChild(row);
    });
}

function renderApprovedAdvertisements() {
    const approvedAdvertisementList = document.getElementById('approved-advertisement-list');
    approvedAdvertisementList.innerHTML = '';

    approvedAdvertisements.forEach((ad, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${ad.title}</td>
            <td style="color: ${ad.status === 'Hiring' ? '#28a745' : '#dc3545'}">${ad.status}</td>
            <td>${ad.applied}</td>
            <td>${ad.required}</td>
            <td><a href="mailto:${ad.email}" style="color: #007bff;">${ad.email}</a></td>
            <td><button class="view-btn" onclick="viewApprovedAdvertisement(${index})">View</button></td>
        `;
        approvedAdvertisementList.appendChild(row);
    });
}

function openPopup(index) {
    const ad = advertisements[index];
    document.getElementById('popup-title').textContent = ad.title;
    document.getElementById('popup-status').textContent = ad.status;
    document.getElementById('popup-applied').textContent = ad.applied;

    const emailLink = document.getElementById('popup-email');
    emailLink.textContent = ad.email;
    emailLink.href = `mailto:${ad.email}`;

    document.getElementById('popup-modal').style.display = 'block';

    const approveBtn = document.getElementById('approve-btn');
    approveBtn.onclick = function () {
        approveAdvertisement(index);
    };

    const rejectBtn = document.getElementById('reject-btn');
    rejectBtn.onclick = function () {
        rejectAdvertisement(index);
    };
}

// function for viewstudent popup

function viewApprovedAdvertisement(index) {
    // Placeholder student list data for demonstration
    const studentApplications = [
        { name: "John Doe", regNo: "UCSC20231001", email: "john.doe@example.com" },
        { name: "Jane Smith", regNo: "UCSC20231002", email: "jane.smith@example.com" },
        { name: "Sam Wilson", regNo: "UCSC20231003", email: "sam.wilson@example.com" }
    ];

    // Populate student list table
    const studentList = document.getElementById('student-list');
    studentList.innerHTML = ''; // Clear previous data

    studentApplications.forEach(student => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${student.name}</td>
            <td>${student.regNo}</td>
            <td><a href="mailto:${student.email}" style="color: #007bff;">${student.email}</a></td>
        `;
        studentList.appendChild(row);
    });

    // Show the popup
    document.getElementById('student-popup-modal').style.display = 'block';
}

// Close the student popup modal
document.getElementById('close-student-popup').onclick = function () {
    document.getElementById('student-popup-modal').style.display = 'none';
};

// Close popup when clicking outside
window.onclick = function (event) {
    const modal = document.getElementById('student-popup-modal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};

function rejectAdvertisement(index) {
    // Remove the advertisement from the list
    advertisements.splice(index, 1);

    // Re-render the advertisements table
    renderAdvertisements();

    // Hide the popup modal
    document.getElementById('popup-modal').style.display = 'none';
}

// Approve Advertisement
function approveAdvertisement(index) {
    const ad = advertisements[index];
    // Add the advertisement to the approved advertisements list with applied set to 0
    approvedAdvertisements.push({ ...ad, applied: 0 });
    advertisements.splice(index, 1); // Remove from advertisements list

    renderAdvertisements(); // Re-render advertisements
    renderApprovedAdvertisements(); // Re-render approved advertisements

    const successMessage = document.getElementById('success-message');
    successMessage.classList.remove('hidden');

    setTimeout(() => {
        successMessage.classList.add('hidden');
        document.getElementById('popup-modal').style.display = 'none';
    }, 2000);
}

// Simulate student application process
function applyForAdvertisement(approvedAdIndex) {
    const approvedAd = approvedAdvertisements[approvedAdIndex];
    approvedAd.applied += 1; // Increment applied students count
    renderApprovedAdvertisements(); // Re-render to update UI
}

function toggleadvertistment(sectionId) {
    const advertisementsSection = document.getElementById('approveadd-section');
    const approvedAdvertisementsSection = document.getElementById('approvedadd-section');
    const advertisementTab = document.getElementById('addvertistmenttab');
    const approveAdTab = document.getElementById('approve-ad-tab');

    if (sectionId === 'advertisements-section') {
        advertisementsSection.style.display = 'block';
        approvedAdvertisementsSection.style.display = 'none';
        advertisementTab.classList.add('active-tab');
        approveAdTab.classList.remove('active-tab');
    } else if (sectionId == 'approved-advertisements-section') {
        advertisementsSection.style.display = 'none';
        approvedAdvertisementsSection.style.display = 'block';
        advertisementTab.classList.remove('active-tab');
        approveAdTab.classList.add('active-tab');
    }
}

// Close popup modal
document.getElementById('close-popup').onclick = function () {
    document.getElementById('popup-modal').style.display = 'none';
};

window.onclick = function (event) {
    const modal = document.getElementById('popup-modal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};

// Initialize rendering
renderAdvertisements();
renderApprovedAdvertisements();

// Set initial visibility
document.getElementById('approveadd-section').style.display = 'block'; // Show advertisements section
document.getElementById('approvedadd-section').style.display = 'none'; // Hide approved advertisements section


</script>

