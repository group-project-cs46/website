<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/BlacklistedCompanies.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-ban" style="font-size: 40px;"></i>
            <h2><b>Company Blacklisting</b></h2>
        </div>
        <input type="text" placeholder="Search Company..." class="search-bar" oninput="filterCompanies()">
    </header>

    <section class="content">
        <div class="table-title">
            <div class="table-title-txt">
                <h3><b>Blacklisted Companies</b></h3>
                <p>View Blacklisted Companies</p>
            </div>
            <div class="right-buttons">
                <button class="add-button" onclick="showAddCompanyPopup()">+</button>
            </div>
        </div>

        <table class="blacklist-table">
            <thead>
                <tr>
                    <th>Blacklisted Companies</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="companyTableBody">
                <tr>
                    <td>Company1</td>
                    <td>company1@gmail.com</td>
                    <td><Button class="remove-button">Remove</Button></td>
                </tr>
                <tr>
                    <td>Company2</td>
                    <td>company2@gmail.com</td>
                    <td><Button class="remove-button">Remove</Button></td>
                </tr>
                <tr>
                    <td>Company3</td>
                    <td>company3@gmail.com</td>
                    <td><Button class="remove-button">Remove</Button></td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<!-- Popup Modal -->
<div id="addCompanyPopup" class="popup-modal">
    <div class="popup-content">
        <span class="close-btn" onclick="closeAddCompanyPopup()">&times;</span>
        <h2>Add Blacklisted Company</h2>
        <form id="addCompanyForm" onsubmit="submitAddCompany(event)">
            <label for="companyName">Company Name:</label>
            <input type="text" id="companyName" name="companyName" required />

            <label for="companyEmail">Company Email:</label>
            <input type="email" id="companyEmail" name="companyEmail" required />

            <button type="submit" class="submit-button">Add Company</button>
        </form>
    </div>
</div>

<script>
// Show the Add Company Popup
function showAddCompanyPopup() {
    document.getElementById('addCompanyPopup').style.display = 'flex';
}

// Close the Add Company Popup
function closeAddCompanyPopup() {
    document.getElementById('addCompanyPopup').style.display = 'none';
}

// Handle Add Company Form Submission
function submitAddCompany(event) {
    event.preventDefault();

    const companyName = document.getElementById('companyName').value;
    const companyEmail = document.getElementById('companyEmail').value;

    if (companyName && companyEmail) {
        const tableBody = document.getElementById('companyTableBody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${companyName}</td>
            <td>${companyEmail}</td>
        `;
        tableBody.appendChild(newRow);

        // Clear the form and close the popup
        document.getElementById('addCompanyForm').reset();
        closeAddCompanyPopup();

        alert('Company added to blacklist');
    } else {
        alert('Please fill out all fields.');
    }
}

// Function to filter companies based on search input
function filterCompanies() {
    const searchInput = document.querySelector('.search-bar').value.toLowerCase();
    const tableRows = document.querySelectorAll('#companyTableBody tr');
    
    tableRows.forEach(row => {
        const companyName = row.cells[0].textContent.toLowerCase();
        const companyEmail = row.cells[1].textContent.toLowerCase();

        // Check if the company name or email matches the search input
        if (companyName.includes(searchInput) || companyEmail.includes(searchInput)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Close popup when clicking outside of it
window.onclick = function (event) {
    const popup = document.getElementById('addCompanyPopup');
    if (event.target === popup) {
        closeAddCompanyPopup();
    }
};
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
