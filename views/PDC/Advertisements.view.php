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
        <div class="table-title">
            <h3><b>Company Advertisements</b></h3>
            <p>View Company advertisements</p>
        </div>

        <table class="advertistment-table">
            <thead>
                <tr>
                    <th>Advertisement</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>No. of Students Applied</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="advertisement-list">
                <!-- Dynamic content will be injected here -->
            </tbody>
        </table>

            <!-- Popup Modal for viewing advertisement details -->
        <div id="popup-modal" class="popup-modal">
            <div class="popup-content">
                <span id="close-popup" class="close-btn">&times;</span>
                <h2 id="popup-title"></h2>
                <p><b>Status:</b> <span id="popup-status"></span></p>
                <p><b>Role:</b> <span id="popup-role"></span></p>
                <p><b>No. of Students Applied:</b> <span id="popup-applied"></span></p>
                <p><b>Contact Email:</b> <a href="#" id="popup-email"></a></p>
            </div>
        </div>
    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // Sample data for demonstration. You can replace this with an API call if needed.
    const advertisements = [
        { title: "Software Engineer Intern (WSO2)", status: "Hiring", role: "Intern", applied: 10, email: "hiring@gmail.com" },
        { title: "Data Analyst Intern (Virtusa)", status: "Closed", role: "Intern", applied: 8, email: "apply@virtusa.com" },
        { title: "Frontend Developer Intern (99x)", status: "Hiring", role: "Intern", applied: 15, email: "jobs@99x.com" },
        { title: "Backend Developer Intern (Sysco LABS)", status: "Hiring", role: "Intern", applied: 12, email: "interns@syscolabs.com" },
        { title: "UI/UX Designer Intern (CreativeHub)", status: "Closed", role: "Intern", applied: 5, email: "careers@creativehub.com" }
    ];

    // Function to render advertisements
    function renderAdvertisements(data) {
        const advertisementList = document.getElementById('advertisement-list');
        advertisementList.innerHTML = ''; // Clear existing content

        data.forEach((ad, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${ad.title}</td>
                <td style="color: ${ad.status === 'Hiring' ? '#28a745' : '#dc3545'}">${ad.status}</td>
                <td>${ad.role}</td>
                <td>${ad.applied}</td>
                <td><a href="mailto:${ad.email}" style="color: #007bff;">${ad.email}</a></td>
                <td><button class="view-btn" onclick="openPopup(${index})">View</button><button class="approve-btn")">Approve</button></td>
            `;
            advertisementList.appendChild(row);
        });
    }

    // Function to open the popup with details
    function openPopup(index) {
        const ad = advertisements[index];
        document.getElementById('popup-title').textContent = ad.title;
        document.getElementById('popup-status').textContent = ad.status;
        document.getElementById('popup-role').textContent = ad.role;
        document.getElementById('popup-applied').textContent = ad.applied;
        const emailLink = document.getElementById('popup-email');
        emailLink.textContent = ad.email;
        emailLink.href = `mailto:${ad.email}`;

        // Display the popup
        const modal = document.getElementById('popup-modal');
        modal.style.display = 'block';
    }

    // Function to close the popup
    document.getElementById('close-popup').onclick = function() {
        document.getElementById('popup-modal').style.display = 'none';
    };

    // Close the popup when clicking outside the content
    window.onclick = function(event) {
        const modal = document.getElementById('popup-modal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // Function to filter advertisements based on search input
    function filterAdvertisements() {
        const searchBar = document.getElementById('search-bar');
        const searchText = searchBar.value.toLowerCase();

        const filteredAds = advertisements.filter(ad =>
            ad.title.toLowerCase().includes(searchText) ||
            ad.status.toLowerCase().includes(searchText) ||
            ad.role.toLowerCase().includes(searchText) ||
            ad.email.toLowerCase().includes(searchText)
        );

        renderAdvertisements(filteredAds);
    }

    // Event listener for the search bar
    document.getElementById('search-bar').addEventListener('input', filterAdvertisements);

    // Initial rendering of advertisements
    renderAdvertisements(advertisements);
</script>