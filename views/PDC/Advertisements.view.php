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

    <!-- Advertisement Sections -->
    <section id="advertisements-section" class="content">
       
    <!-- Tab Navigation -->
    <div class="tabs">
        <div class="company-add-active-tab" id="addvertistmenttab" onclick="toggleadvertistment('advertisements-section')">
            <h3>Company Advertisements</h3>
            <p>View Company advertisements</p>
        </div>

        <div class="divider"></div>

        <div class="approve-ad" id="approve-ad-tab" onclick="toggleadvertistment('approved-advertisements-section')">
            <h3>Approved Advertisement</h3>
            <p>View approved advertisements</p>
        </div>
    </div>

        <table class="advertistment-table">
            <thead>
                <tr>
                    <th>Advertisement</th>
                    <th>Status</th>
                    <th>No. of Students Applied</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="advertisement-list">
                <!-- Dynamic content will be injected here -->
            </tbody>
        </table>
    </section>

    <section id="approved-advertisements-section" class="content hidden">
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
            <p><b>No. of Students Applied:</b> <span id="popup-applied"></span></p>
            <p><b>Contact Email:</b> <a href="#" id="popup-email"></a></p>
            <button id="approve-btn" class="approve-btn">Approve</button>
            <p id="success-message" class="hidden success-message">Approved successfully!</p>
        </div>
    </div>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    const advertisements = [
        { title: "Software Engineer Intern (WSO2)", status: "Hiring", applied: 10, email: "hiring@gmail.com" },
        { title: "Data Analyst Intern (Virtusa)", status: "Closed", applied: 8, email: "apply@virtusa.com" },
        { title: "Frontend Developer Intern (99x)", status: "Hiring", applied: 15, email: "jobs@99x.com" },
        { title: "Backend Developer Intern (Sysco LABS)", status: "Hiring", applied: 12, email: "interns@syscolabs.com" },
        { title: "UI/UX Designer Intern (CreativeHub)", status: "Closed", applied: 5, email: "careers@creativehub.com" }
    ];

    const approvedAdvertisements = [];

    function renderAdvertisements(data) {
        const advertisementList = document.getElementById('advertisement-list');
        advertisementList.innerHTML = '';

        data.forEach((ad, index) => {
            const row = document.createElement('tr');
            row.innerHTML = 
                `<td>${ad.title}</td>
                <td style="color: ${ad.status === 'Hiring' ? '#28a745' : '#dc3545'}">${ad.status}</td>
                <td>${ad.applied}</td>
                <td><a href="mailto:${ad.email}" style="color: #007bff;">${ad.email}</a></td>
                <td><button class="view-btn" onclick="openPopup(${index})">View</button></td>`;
            advertisementList.appendChild(row);
        });
    }

    function renderApprovedAdvertisements() {
        const approvedAdvertisementList = document.getElementById('approved-advertisement-list');
        approvedAdvertisementList.innerHTML = '';

        approvedAdvertisements.forEach((ad, index) => {
            const row = document.createElement('tr');
            row.innerHTML = 
                `<td>${ad.title}</td>
                <td style="color: ${ad.status === 'Hiring' ? '#28a745' : '#dc3545'}">${ad.status}</td>
                <td>${ad.applied}</td>
                <td><a href="mailto:${ad.email}" style="color: #007bff;">${ad.email}</a></td>
                <td><button class="view-btn" onclick="openPopup(${index})">View</button></td>`;
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
            approveAdvertisement(ad, index);
        };
    }

    function approveAdvertisement(ad, index) {
        approvedAdvertisements.push(ad);
        advertisements.splice(index, 1);

        renderAdvertisements(advertisements);
        renderApprovedAdvertisements();
        document.getElementById('success-message').classList.remove('hidden');
        setTimeout(() => {
            document.getElementById('popup-modal').style.display = 'none';
            document.getElementById('success-message').classList.add('hidden');
        }, 2000);
    }

    function toggleadvertistment(sectionId) {
        document.getElementById('advertisements-section').classList.add('hidden');
        document.getElementById('approved-advertisements-section').classList.add('hidden');

        document.getElementById(sectionId).classList.remove('hidden');
    }

    document.getElementById('close-popup').onclick = function () {
        document.getElementById('popup-modal').style.display = 'none';
    };

    window.onclick = function (event) {
        const modal = document.getElementById('popup-modal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    renderAdvertisements(advertisements);
</script>

<style>
.hidden {
    display: none;
}

.success-message {
    color: green;
    font-weight: bold;
    margin-top: 10px;
}

#approved-advertisements-section {
    margin-top: 20px;
}

.tabs {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.company-add-active-tab,
.approve-ad {
    cursor: pointer;
    padding: 10px;
    flex: 1;
    text-align: center;
    background-color: #f8f9fa;
    border-radius: 5px;
}

.company-add-active-tab:hover,
.approve-ad:hover {
    background-color: #e2e6ea;
}

.divider {
    width: 2px;
    background-color: #dee2e6;
}

.advertistment-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.advertistment-table th,
.advertistment-table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.advertistment-table th {
    background-color: #f8f9fa;
}

.view-btn {
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
}

.view-btn:hover {
    background-color: #0056b3;
}

.popup-modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.popup-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    border-radius: 8px;
}

.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

#approve-btn {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}

#approve-btn:hover {
    background-color: #218838;
}
</style>
