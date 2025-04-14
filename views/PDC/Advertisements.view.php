<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Advertisements.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-rectangle-ad" style="font-size: 40px;"></i>
            <h2><b>Manage Company Advertisements</b></h2>
        </div>
        <input type="text" id="search-bar" placeholder="Search Advertisement..." class="search-bar">
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
                        <th>Vacancy Count</th>
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
        </div>
    </section>

    <!-- Popup Modal for viewing advertisement details -->
    <div id="popup-modal" class="popup-modal">
        <div class="popup-content">
            <span id="close-popup" class="close-btn">×</span>
            <h2 id="popup-title"></h2>
            <p><b>Job_Role : </b> <span id="popup-jobrole"></span></p>
            <p><b>Responsibilities : </b> <span id="popup-responsibilities"></span></p>
            <p><b>Qualifications_and_Skills : </b> <span id="popup-qualifications"></span></p>
            <p><b>Status : </b> <span id="popup-status"></span></p>
            <p><b>Vacancy_Count : </b> <span id="popup-applied"></span></p>
            <p><b>Maximum_CV_count : </b><span id="popup-CVcount"></span></p>
            <p><b>Contact_Email : </b> <a href="#" id="popup-email"></a></p>
            <button id="approve-btn" class="approve-btn">Approve</button>
            <button id="reject-btn" class="reject-btn">Reject</button>
            <p id="success-message" class="hidden success-message">Approved successfully!</p>
        </div>
    </div>

    <!-- Popup Modal for viewing applied student details -->
    <div id="student-popup-modal" class="popup-modal">
        <div class="popup-content">
            <span id="close-student-popup" class="close-btn">×</span>
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

    <!-- Popup Modal for entering rejection reason -->
    <div id="reject-reason-modal" class="reject-reason-modal">
        <div class="reject-reason-content">
            <span id="close-reject-reason" class="reject-reason-close-btn">×</span>
            <h2>Reason for Rejection</h2>
            <form id="reject-reason-form" class="reject-reason-form">
                <label for="reject-reason">Please provide a reason for rejecting this advertisement:</label>
                <textarea id="reject-reason" name="reject-reason" class="reject-reason-textarea" rows="4" required placeholder="Enter your reason here..."></textarea>
                <button type="submit" class="reject-reason-submit-btn">Submit Rejection</button>
                <button type="button" id="cancel-reject-btn" class="reject-reason-cancel-btn">Cancel</button>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // Initialize data
    const advertisements = [{
            title: "Software Engineer Intern (WSO2)",
            Job_Role: "Software Engineer Intern",
            Responsibilities: "Developing software applications",
            Qualifications_and_Skills: "Java, Spring Boot, React",
            status: "Hiring",
            Vacancy_Count: 10,
            Maximum_CV_count: 50,
            email: "hiring@gmail.com"
        },
        {
            title: "Data Analyst Intern (Virtusa)",
            Job_Role: "Data Analyst Intern",
            Responsibilities: "Analyze data and generate reports",
            Qualifications_and_Skills: "SQL, Python, Data Visualization",
            status: "Closed",
            Vacancy_Count: 10,
            Maximum_CV_count: 25,
            email: "apply@virtusa.com"
        },
        {
            title: "Frontend Developer Intern (99x)",
            Job_Role: "Frontend Developer Intern",
            Responsibilities: "Developing user interfaces",
            Qualifications_and_Skills: "React, JavaScript, HTML, CSS",
            status: "Hiring",
            Vacancy_Count: 15,
            Maximum_CV_count: 30,
            email: "jobs@99x.com"
        },
        {
            title: "Backend Developer Intern (Sysco LABS)",
            Job_Role: "Backend Developer Intern",
            Responsibilities: "Developing server-side applications",
            Qualifications_and_Skills: "Java, Spring Boot, MySQL",
            status: "Hiring",
            Vacancy_Count: 12,
            Maximum_CV_count: 20,
            email: "interns@syscolabs.com"
        },
        {
            title: "UI/UX Designer Intern (CreativeHub)",
            Job_Role: "UI/UX Designer Intern",
            Responsibilities: "Designing user interfaces",
            Qualifications_and_Skills: "Figma, Adobe XD, Sketch",
            status: "Closed",
            Vacancy_Count: 20,
            Maximum_CV_count: 40,
            email: "careers@creativehub.com"
        }
    ];

    const approvedAdvertisements = [{
            title: "Frontend Developer Intern (99x)",
            status: "Hiring",
            applied: 3,
            Vacancy_Count: 20,
            email: "jobs@99x.com"
        },
        {
            title: "UI/UX Designer Intern (CreativeHub)",
            status: "Closed",
            applied: 20,
            Vacancy_Count: 20,
            email: "careers@creativehub.com"
        }
    ];

    // Render advertisements
    function renderAdvertisements(data = advertisements) {
        const advertisementList = document.getElementById('advertisement-list');
        advertisementList.innerHTML = '';

        data.forEach((ad, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${ad.title}</td>
                <td style="color: ${ad.status === 'Hiring' ? '#28a745' : '#dc3545'}">${ad.status}</td>
                <td>${ad.Vacancy_Count}</td>
                <td><a href="mailto:${ad.email}" style="color: #007bff;">${ad.email}</a></td>
                <td><button class="view-btn" onclick="openPopup(${advertisements.indexOf(ad)})">View</button></td>
            `;
            advertisementList.appendChild(row);
        });
    }

    function renderApprovedAdvertisements(data = approvedAdvertisements) {
        const approvedAdvertisementList = document.getElementById('approved-advertisement-list');
        approvedAdvertisementList.innerHTML = '';

        data.forEach((ad, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${ad.title}</td>
                <td style="color: ${ad.status === 'Hiring' ? '#28a745' : '#dc3545'}">${ad.status}</td>
                <td>${ad.applied}</td>
                <td>${ad.Vacancy_Count}</td>
                <td><a href="mailto:${ad.email}" style="color: #007bff;">${ad.email}</a></td>
                <td><button class="view-btn" onclick="viewApprovedAdvertisement(${approvedAdvertisements.indexOf(ad)})">View</button></td>
            `;
            approvedAdvertisementList.appendChild(row);
        });
    }

    function openPopup(index) {
        const ad = advertisements[index];
        document.getElementById('popup-title').textContent = ad.title;
        document.getElementById('popup-jobrole').textContent = ad.Job_Role;
        document.getElementById('popup-responsibilities').textContent = ad.Responsibilities;
        document.getElementById('popup-qualifications').textContent = ad.Qualifications_and_Skills;
        document.getElementById('popup-status').textContent = ad.status;
        document.getElementById('popup-applied').textContent = ad.Vacancy_Count;
        document.getElementById('popup-CVcount').textContent = ad.Maximum_CV_count;
        
        const emailLink = document.getElementById('popup-email');
        emailLink.textContent = ad.email;
        emailLink.href = `mailto:${ad.email}`;

        document.getElementById('popup-modal').style.display = 'block';

        const approveBtn = document.getElementById('approve-btn');
        approveBtn.onclick = function() {
            approveAdvertisement(index);
        };

        const rejectBtn = document.getElementById('reject-btn');
        rejectBtn.onclick = function() {
            openRejectReasonModal(index);
        };
    }

    // Function to open rejection reason modal
    function openRejectReasonModal(index) {
        console.log('Opening reject reason modal for index:', index);
        document.getElementById('reject-reason-modal').style.display = 'block';
        const form = document.getElementById('reject-reason-form');
        form.onsubmit = function(e) {
            e.preventDefault();
            const reason = document.getElementById('reject-reason').value.trim();
            if (reason) {
                rejectAdvertisement(index, reason);
            } else {
                alert('Please provide a reason for rejection.');
            }
        };
        document.getElementById('cancel-reject-btn').onclick = function() {
            closeRejectReasonModal();
        };
    }

    // Updated rejectAdvertisement function with reason
    function rejectAdvertisement(index, reason) {
        const ad = advertisements[index];
        const companyEmail = ad.email;

        console.log(`Sending rejection email to ${companyEmail}: "Your advertisement '${ad.title}' was rejected for the following reason: ${reason}"`);

        advertisements.splice(index, 1);
        renderAdvertisements();

        closeRejectReasonModal();
        document.getElementById('popup-modal').style.display = 'none';
    }

    // Function to close rejection reason modal
    function closeRejectReasonModal() {
        document.getElementById('reject-reason-modal').style.display = 'none';
        document.getElementById('reject-reason').value = '';
    }

    // Function for viewing student popup
    function viewApprovedAdvertisement(index) {
        const studentApplications = [{
                name: "John Doe",
                regNo: "2022/CS/001",
                email: "john.doe@example.com"
            },
            {
                name: "Jane Smith",
                regNo: "2022/CS/002",
                email: "jane.smith@example.com"
            },
            {
                name: "Sam Wilson",
                regNo: "2022/CS/003",
                email: "sam.wilson@example.com"
            }
        ];

        const studentList = document.getElementById('student-list');
        studentList.innerHTML = '';

        studentApplications.forEach(student => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${student.name}</td>
                <td>${student.regNo}</td>
                <td><a href="mailto:${student.email}" style="color: #007bff;">${student.email}</a></td>
            `;
            studentList.appendChild(row);
        });

        document.getElementById('student-popup-modal').style.display = 'block';
    }

    // Approve Advertisement
    function approveAdvertisement(index) {
        const ad = advertisements[index];
        approvedAdvertisements.push({
            ...ad,
            applied: 0
        });
        advertisements.splice(index, 1);

        renderAdvertisements();
        renderApprovedAdvertisements();

        const successMessage = document.getElementById('success-message');
        successMessage.classList.remove('hidden');

        setTimeout(() => {
            successMessage.classList.add('hidden');
            document.getElementById('popup-modal').style.display = 'none';
        }, 2000);
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

    // Close popup handlers
    document.getElementById('close-popup').onclick = function() {
        document.getElementById('popup-modal').style.display = 'none';
    };

    document.getElementById('close-student-popup').onclick = function() {
        document.getElementById('student-popup-modal').style.display = 'none';
    };

    document.getElementById('close-reject-reason').onclick = function() {
        closeRejectReasonModal();
    };

    window.onclick = function(event) {
        const popupModal = document.getElementById('popup-modal');
        const studentModal = document.getElementById('student-popup-modal');
        const rejectModal = document.getElementById('reject-reason-modal');
        if (event.target === popupModal) {
            popupModal.style.display = 'none';
        }
        if (event.target === studentModal) {
            studentModal.style.display = 'none';
        }
        if (event.target === rejectModal) {
            closeRejectReasonModal();
        }
    };

    // Search functionality
    function setupSearch() {
        const searchBar = document.getElementById('search-bar');
        
        searchBar.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            
            const filteredAds = advertisements.filter(ad => {
                return (
                    ad.title.toLowerCase().includes(searchTerm) ||
                    ad.Job_Role.toLowerCase().includes(searchTerm) ||
                    ad.email.toLowerCase().includes(searchTerm) ||
                    ad.status.toLowerCase().includes(searchTerm)
                );
            });
            
            const filteredApprovedAds = approvedAdvertisements.filter(ad => {
                return (
                    ad.title.toLowerCase().includes(searchTerm) ||
                    ad.email.toLowerCase().includes(searchTerm) ||
                    ad.status.toLowerCase().includes(searchTerm)
                );
            });
            
            renderAdvertisements(filteredAds);
            renderApprovedAdvertisements(filteredApprovedAds);
        });
    }

    // Initialize rendering and ensure modals are hidden on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Hide all modals on page load
        document.getElementById('popup-modal').style.display = 'none';
        document.getElementById('student-popup-modal').style.display = 'none';
        document.getElementById('reject-reason-modal').style.display = 'none';

        renderAdvertisements();
        renderApprovedAdvertisements();
        document.getElementById('approveadd-section').style.display = 'block';
        document.getElementById('approvedadd-section').style.display = 'none';
        setupSearch();
    });
</script>