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
                <button class="add-button" onclick="addCompany()">+</button>
            </div>
        </div>

        <table class="blacklist-table">
            <thead>
                <tr>
                    <th>Blacklisted Companies</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody id="companyTableBody">
                <tr>
                    <td>Company1</td>
                    <td>company1@gmail.com</td>
                </tr>
                <tr>
                    <td>Company2</td>
                    <td>company2@gmail.com</td>
                </tr>
                <tr>
                    <td>Company3</td>
                    <td>company3@gmail.com</td>
                </tr>
                <tr>
                    <td>Company4</td>
                    <td>company4@gmail.com</td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<script>
    // Function to filter companies based on search input
    function filterCompanies() {
        const searchInput = document.querySelector('.search-bar').value.toLowerCase();
        const tableRows = document.querySelectorAll('#companyTableBody tr');

        tableRows.forEach(row => {
            const companyName = row.cells[0].textContent.toLowerCase();
            const email = row.cells[1].textContent.toLowerCase();
            if (companyName.includes(searchInput) || email.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Function to add a new company to the blacklist
    function addCompany() {
        const companyName = prompt("Enter the company name:");
        const email = prompt("Enter the company email:");

        if (companyName && email) {
            const tableBody = document.getElementById('companyTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${companyName}</td>
                <td>${email}</td>
            `;
            tableBody.appendChild(newRow);
        } else {
            alert("Please enter valid company details.");
        }
    }
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
