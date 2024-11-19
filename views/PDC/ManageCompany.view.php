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
        <div class="table-title">
           <h3><b>Manage Company</b></h3>
            <p>Manage Company accounts</p>
        </div>

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
            <tbody id="companyTableBody">
                <!-- Example Table Rows -->
                <!-- <tr>
                    <td>WSO2</td>
                    <td>Nimal</td>
                    <td>0771234567</td>
                    <td>Hiring@gmail.com</td>
                    <td><button class="view-button">view</button></td>
                </tr> -->
            </tbody>
        </table>
    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // Get DOM elements
    const searchInput = document.getElementById('searchInput');
    const companyTableBody = document.getElementById('companyTableBody');

    // Sample data for companies (can be replaced with data from a database or API)
    const companies = [
        { name: 'WSO2', contactPerson: 'Nimal', contactNo: '0771234567', email: 'Hiring@gmail.com' },
        { name: 'Google', contactPerson: 'Sirius', contactNo: '0781234567', email: 'contact@google.com' },
        { name: 'Microsoft', contactPerson: 'Alex', contactNo: '0791234567', email: 'careers@microsoft.com' },
        { name: 'Amazon', contactPerson: 'John', contactNo: '0701234567', email: 'hr@amazon.com' },
        { name: 'Facebook', contactPerson: 'Mark', contactNo: '0772345678', email: 'hr@facebook.com' }
    ];

    // Function to render companies in the table
    function renderCompanies(data) {
        companyTableBody.innerHTML = ''; // Clear existing rows
        data.forEach(company => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${company.name}</td>
                <td>${company.contactPerson}</td>
                <td>${company.contactNo}</td>
                <td>${company.email}</td>
                <td><button class="view-button">View</button></td>
            `;
            companyTableBody.appendChild(row);
        });
    }

    // Function to handle search functionality
    function handleSearch() {
        const query = searchInput.value.toLowerCase();
        const filteredCompanies = companies.filter(company => 
            company.name.toLowerCase().includes(query) || 
            company.contactPerson.toLowerCase().includes(query) ||
            company.contactNo.includes(query) ||
            company.email.toLowerCase().includes(query)
        );
        renderCompanies(filteredCompanies);
    }

    // Initial rendering of companies
    renderCompanies(companies);

    // Add event listener for search input
    searchInput.addEventListener('input', handleSearch);
</script>

