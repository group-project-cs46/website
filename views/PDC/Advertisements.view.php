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
                        <th>Job Role</th>
                        <th>Company</th>
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

        <div class="container" id="approvedadd-section" style="display: none;">
            <div class="table-title">
                <h3><b>Approved Advertisements</b></h3>
                <p>View approved advertisements</p>
            </div>

            <table class="advertistment-table">
                <thead>
                    <tr>
                        <th>Job Role</th>
                        <th>Company</th>
                        <th>Vacancy Count</th>
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
            <p><b>Company: </b> <span id="popup-company"></span></p>
            <p><b>Job Role: </b> <span id="popup-jobrole"></span></p>
            <p><b>Responsibilities: </b> <span id="popup-responsibilities"></span></p>
            <p><b>Qualifications and Skills: </b> <span id="popup-qualifications"></span></p>
            <p><b>Vacancy Count: </b> <span id="popup-vacancy"></span></p>
            <p><b>Maximum CV Count: </b><span id="popup-cvcount"></span></p>
            <p><b>Contact Email: </b> <a href="#" id="popup-email"></a></p>
            <p><b>Deadline: </b> <span id="popup-deadline"></span></p>
            <button id="approve-btn" class="approve-btn">Approve</button>
            <button id="reject-btn" class="reject-btn">Reject</button>
            <p id="success-message" class="hidden success-message"></p>
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
                    <!-- Hardcoded content will be injected here -->
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
    let advertisements = [];
    let approvedAdvertisements = [];

    // Fetch advertisements from backend
    async function fetchAdvertisements() {
        try {
            const response = await fetch('/PDC/manageadvertisements');
            if (!response.ok) throw new Error('Failed to fetch advertisements');
            advertisements = await response.json();
            renderAdvertisements();
        } catch (error) {
            console.error('Error fetching advertisements:', error);
        }
    }

    // Fetch approved advertisements from backend
    async function fetchApprovedAdvertisements() {
        try {
            const response = await fetch('/PDC/manageadvertisements?action=approved');
            if (!response.ok) throw new Error('Failed to fetch approved advertisements');
            approvedAdvertisements = await response.json();
            renderApprovedAdvertisements();
        } catch (error) {
            console.error('Error fetching approved advertisements:', error);
        }
    }

    // Render advertisements
    function renderAdvertisements(data = advertisements) {
        const advertisementList = document.getElementById('advertisement-list');
        advertisementList.innerHTML = '';

        data.forEach((ad, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${ad.job_role}</td>
                <td>${ad.company_name}</td>
                <td>${ad.vacancy_count}</td>
                <td><a href="mailto:${ad.company_email}" style="color: #007bff;">${ad.company_email}</a></td>
                <td><button class="view-btn" onclick="openPopup(${index})">View</button></td>
            `;
            advertisementList.appendChild(row);
        });
    }

    // Render approved advertisements
    function renderApprovedAdvertisements(data = approvedAdvertisements) {
        const approvedAdvertisementList = document.getElementById('approved-advertisement-list');
        approvedAdvertisementList.innerHTML = '';

        data.forEach((ad, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${ad.job_role}</td>
                <td>${ad.company_name}</td>
                <td>${ad.vacancy_count}</td>
                <td><a href="mailto:${ad.company_email}" style="color: #007bff;">${ad.company_email}</a></td>
                <td><button class="view-btn" onclick="viewApprovedAdvertisement(${index})">View Students</button></td>
            `;
            approvedAdvertisementList.appendChild(row);
        });
    }

    // Open popup for advertisement details
    function openPopup(index) {
        const ad = advertisements[index];
        document.getElementById('popup-title').textContent = ad.job_role;
        document.getElementById('popup-company').textContent = ad.company_name;
        document.getElementById('popup-jobrole').textContent = ad.job_role;
        document.getElementById('popup-responsibilities').textContent = ad.responsibilities;
        document.getElementById('popup-qualifications').textContent = ad.qualifications_skills;
        document.getElementById('popup-vacancy').textContent = ad.vacancy_count;
        document.getElementById('popup-cvcount').textContent = ad.max_cvs;
        document.getElementById('popup-deadline').textContent = ad.deadline;
        
        const emailLink = document.getElementById('popup-email');
        emailLink.textContent = ad.company_email;
        emailLink.href = `mailto:${ad.company_email}`;

        document.getElementById('popup-modal').style.display = 'block';

        const approveBtn = document.getElementById('approve-btn');
        approveBtn.onclick = function() {
            approveAdvertisement(ad.id, index);
        };

        const rejectBtn = document.getElementById('reject-btn');
        rejectBtn.onclick = function() {
            openRejectReasonModal(ad.id, index);
        };
    }

    // Open rejection reason modal
    function openRejectReasonModal(adId, index) {
        document.getElementById('reject-reason-modal').style.display = 'block';
        const form = document.getElementById('reject-reason-form');
        form.onsubmit = async function(e) {
            e.preventDefault();
            const reason = document.getElementById('reject-reason').value.trim();
            if (reason) {
                await rejectAdvertisement(adId, index, reason);
            } else {
                alert('Please provide a reason for rejection.');
            }
        };
        document.getElementById('cancel-reject-btn').onclick = closeRejectReasonModal;
    }

    // Close rejection reason modal
    function closeRejectReasonModal() {
        document.getElementById('reject-reason-modal').style.display = 'none';
        document.getElementById('reject-reason').value = '';
    }

    // Approve advertisement
async function approveAdvertisement(adId, index) {
    try {
        const response = await fetch('/PDC/manageadvertisements', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ approve_id: adId })
        });
        const result = await response.json();
        if (result.success) {
            advertisements.splice(index, 1);
            await fetchApprovedAdvertisements();
            renderAdvertisements();
            const successMessage = document.getElementById('success-message');
            successMessage.textContent = result.message;
            successMessage.classList.remove('hidden');
            setTimeout(() => {
                successMessage.classList.add('hidden');
                document.getElementById('popup-modal').style.display = 'none';
            }, 2000);
        } else {
            console.error('Approve failed:', result.message);
            alert('Failed to approve advertisement: ' + result.message);
        }
    } catch (error) {
        console.error('Error approving advertisement:', error);
        alert('Error approving advertisement');
    }
}

    // Reject advertisement
async function rejectAdvertisement(adId, index, reason) {
    try {
        const response = await fetch('/PDC/manageadvertisements', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ reject_id: adId, reason })
        });
        const result = await response.json();
        if (result.success) {
            advertisements.splice(index, 1);
            renderAdvertisements();
            closeRejectReasonModal();
            document.getElementById('popup-modal').style.display = 'none';
            const successMessage = document.getElementById('success-message');
            successMessage.textContent = result.message;
            successMessage.classList.remove('hidden');
            setTimeout(() => successMessage.classList.add('hidden'), 2000);
        } else {
            console.error('Reject failed:', result.message);
            alert('Failed to reject advertisement: ' + result.message);
        }
    } catch (error) {
        console.error('Error rejecting advertisement:', error);
        alert('Error rejecting advertisement');
    }
}

    // View approved advertisement (hardcoded student data)
    function viewApprovedAdvertisement(index) {
        const studentApplications = [
            { name: "John Doe", regNo: "2022/CS/001", email: "john.doe@example.com" },
            { name: "Jane Smith", regNo: "2022/CS/002", email: "jane.smith@example.com" },
            { name: "Sam Wilson", regNo: "2022/CS/003", email: "sam.wilson@example.com" }
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

    // Toggle between sections
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
        } else if (sectionId === 'approved-advertisements-section') {
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

    document.getElementById('close-reject-reason').onclick = closeRejectReasonModal;

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
            
            const filteredAds = advertisements.filter(ad => 
                ad.company_name.toLowerCase().includes(searchTerm) ||
                ad.job_role.toLowerCase().includes(searchTerm) ||
                ad.company_email.toLowerCase().includes(searchTerm)
            );
            
            const filteredApprovedAds = approvedAdvertisements.filter(ad => 
                ad.company_name.toLowerCase().includes(searchTerm) ||
                ad.job_role.toLowerCase().includes(searchTerm) ||
                ad.company_email.toLowerCase().includes(searchTerm)
            );
            
            renderAdvertisements(filteredAds);
            renderApprovedAdvertisements(filteredApprovedAds);
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', async function() {
        document.getElementById('popup-modal').style.display = 'none';
        document.getElementById('student-popup-modal').style.display = 'none';
        document.getElementById('reject-reason-modal').style.display = 'none';
        await fetchAdvertisements();
        await fetchApprovedAdvertisements();
        setupSearch();
    });
</script>