<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/ManageCompany.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-building" style="font-size: 40px;"></i>
            <h2><b>Manage Company</b></h2>
        </div>
        <input type="text" placeholder="Search Company..." class="search-bar" id="searchInput">
    </header>

    <section class="content">
        <div class="tabs">
            <button class="tab-button" id="currentCompaniesTab">Current Companies</button>
            <button class="tab-button" id="registeredCompaniesTab">Registered Companies</button>
        </div>

        <div id="currentCompaniesContent" class="tab-content">
            <h3><b>Current Companies</b></h3>
            <p>Manage Current Company accounts</p>
            <table class="company-table">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Contact person</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="currentCompanyTableBody">
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
        </div>

        <div id="registeredCompaniesContent" class="tab-content" style="display: none;">
            <h3><b>Registered Companies</b></h3>
            <p>Manage Registered Company accounts</p>
            <table class="company-table">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Contact person</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="registeredCompanyTableBody">
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // Get DOM elements
    const searchInput = document.getElementById('searchInput');
    const currentCompanyTableBody = document.getElementById('currentCompanyTableBody');
    const registeredCompanyTableBody = document.getElementById('registeredCompanyTableBody');
    const currentCompaniesTab = document.getElementById('currentCompaniesTab');
    const registeredCompaniesTab = document.getElementById('registeredCompaniesTab');
    const currentCompaniesContent = document.getElementById('currentCompaniesContent');
    const registeredCompaniesContent = document.getElementById('registeredCompaniesContent');

    // Sample data for companies (can be replaced with data from a database or API)
    const currentCompanies = [
        { name: 'WSO2', contactPerson: 'Nimal', contactNo: '0771234567', email: 'Hiring@gmail.com' },
        { name: 'Google', contactPerson: 'Sirius', contactNo: '0781234567', email: 'contact@google.com' },
        { name: 'Microsoft', contactPerson: 'Alex', contactNo: '0791234567', email: 'careers@microsoft.com' },
    ];

    const registeredCompanies = [
        { name: 'Amazon', contactPerson: 'John', contactNo: '0701234567', email: 'hr@amazon.com' },
        { name: 'Facebook', contactPerson: 'Mark', contactNo: '0772345678', email: 'hr@facebook.com' },
    ];

    // Function to render companies in the table
    function renderCompanies(data, tableBody, includeApproveButton = true) {
        tableBody.innerHTML = ''; // Clear existing rows
        data.forEach(company => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${company.name}</td>
                <td>${company.contactPerson}</td>
                <td>${company.contactNo}</td>
                <td>${company.email}</td>
                <td>${includeApproveButton ? '<button class="approve-button">Approve</button>' : ''}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Function to handle search functionality
    function handleSearch() {
        const query = searchInput.value.toLowerCase();
        const filteredCurrentCompanies = currentCompanies.filter(company => 
            company.name.toLowerCase().includes(query) || 
            company.contactPerson.toLowerCase().includes(query) ||
            company.contactNo.includes(query) ||
            company.email.toLowerCase().includes(query)
        );
        const filteredRegisteredCompanies = registeredCompanies.filter(company => 
            company.name.toLowerCase().includes(query) || 
            company.contactPerson.toLowerCase().includes(query) ||
            company.contactNo.includes(query) ||
            company.email.toLowerCase().includes(query)
        );

        renderCompanies(filteredCurrentCompanies, currentCompanyTableBody);
        renderCompanies(filteredRegisteredCompanies, registeredCompanyTableBody, false); // No "Approve" button for registered companies
    }

    // Function to handle tab switching
    function switchTab(event) {
        if (event.target === currentCompaniesTab) {
            currentCompaniesContent.style.display = 'block';
            registeredCompaniesContent.style.display = 'none';
            currentCompaniesTab.classList.add('active');
            registeredCompaniesTab.classList.remove('active');
            renderCompanies(currentCompanies, currentCompanyTableBody); // Re-render current companies
        } else if (event.target === registeredCompaniesTab) {
            currentCompaniesContent.style.display = 'none';
            registeredCompaniesContent.style.display = 'block';
            currentCompaniesTab.classList.remove('active');
            registeredCompaniesTab.classList.add('active');
            renderCompanies(registeredCompanies, registeredCompanyTableBody, false); // Re-render registered companies without approve button
        }
    }

    // Ensure the first tab (Current Companies) is visible and rendered by default
    window.addEventListener('DOMContentLoaded', () => {
        renderCompanies(currentCompanies, currentCompanyTableBody); // Initial render for current companies
        renderCompanies(registeredCompanies, registeredCompanyTableBody, false); // Initial render for registered companies
        currentCompaniesTab.classList.add('active'); // Set current companies tab as active by default
    });

    // Add event listener for search input
    searchInput.addEventListener('input', handleSearch);

    // Add event listeners for tab switching
    currentCompaniesTab.addEventListener('click', switchTab);
    registeredCompaniesTab.addEventListener('click', switchTab);
</script>
