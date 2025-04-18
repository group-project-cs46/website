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

<!-- Modal for Rejection Reason -->
<div id="rejectModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 5px; width: 400px;">
        <h3>Reject Company</h3>
        <p>Provide a reason for rejecting <span id="companyName"></span>:</p>
        <textarea id="rejectReason" rows="4" style="width: 100%;"></textarea>
        <div style="margin-top: 10px;">
            <button id="submitReject" style="background: #dc3545; color: white; padding: 8px 16px; border: none; cursor: pointer;">Submit</button>
            <button id="cancelReject" style="background: #6c757d; color: white; padding: 8px 16px; border: none; cursor: pointer; margin-left: 10px;">Cancel</button>
        </div>
    </div>
</div>

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
    const rejectModal = document.getElementById('rejectModal');
    const companyNameSpan = document.getElementById('companyName');
    const rejectReasonInput = document.getElementById('rejectReason');
    const submitReject = document.getElementById('submitReject');
    const cancelReject = document.getElementById('cancelReject');

    // Sample data for companies (can be replaced with data from a database or API)
    let currentCompanies = [
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
        data.forEach((company, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${company.name}</td>
                <td>${company.contactPerson}</td>
                <td>${company.contactNo}</td>
                <td>${company.email}</td>
                <td>
                    ${includeApproveButton ? '<button class="approve-button">Approve</button>' : ''}
                    ${includeApproveButton ? `<button class="reject-button" data-index="${index}" data-email="${company.email}" data-name="${company.name}">Reject</button>` : ''}
                </td>
            `;
            tableBody.appendChild(row);
        });

        // Add event listeners for reject buttons
        if (includeApproveButton) {
            document.querySelectorAll('.reject-button').forEach(button => {
                button.addEventListener('click', (e) => {
                    const index = e.target.getAttribute('data-index');
                    const email = e.target.getAttribute('data-email');
                    const name = e.target.getAttribute('data-name');
                    showRejectModal(index, email, name);
                });
            });
        }
    }

    // Function to show the reject modal
    function showRejectModal(index, email, name) {
        companyNameSpan.textContent = name;
        rejectModal.style.display = 'flex';
        submitReject.onclick = () => submitRejection(index, email);
        cancelReject.onclick = () => {
            rejectModal.style.display = 'none';
            rejectReasonInput.value = '';
        };
    }

    // Function to handle rejection submission
    function submitRejection(index, email) {
        const reason = rejectReasonInput.value.trim();
        if (!reason) {
            alert('Please provide a reason for rejection.');
            return;
        }

        // Send rejection reason to the backend
        fetch('/reject-company.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email, reason }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove company from currentCompanies
                currentCompanies.splice(index, 1);
                renderCompanies(currentCompanies, currentCompanyTableBody);
                rejectModal.style.display = 'none';
                rejectReasonInput.value = '';
                alert('Rejection email sent successfully.');
            } else {
                alert('Failed to send rejection email: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending the rejection email.');
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
        renderCompanies(filteredRegisteredCompanies, registeredCompanyTableBody, false);
    }

    // Function to handle tab switching
    function switchTab(event) {
        if (event.target === currentCompaniesTab) {
            currentCompaniesContent.style.display = 'block';
            registeredCompaniesContent.style.display = 'none';
            currentCompaniesTab.classList.add('active');
            registeredCompaniesTab.classList.remove('active');
            renderCompanies(currentCompanies, currentCompanyTableBody);
        } else if (event.target === registeredCompaniesTab) {
            currentCompaniesContent.style.display = 'none';
            registeredCompaniesContent.style.display = 'block';
            currentCompaniesTab.classList.remove('active');
            registeredCompaniesTab.classList.add('active');
            renderCompanies(registeredCompanies, registeredCompanyTableBody, false);
        }
    }

    // Ensure the first tab (Current Companies) is visible and rendered by default
    window.addEventListener('DOMContentLoaded', () => {
        renderCompanies(currentCompanies, currentCompanyTableBody);
        renderCompanies(registeredCompanies, registeredCompanyTableBody, false);
        currentCompaniesTab.classList.add('active');
    });

    // Add event listener for search input
    searchInput.addEventListener('input', handleSearch);

    // Add event listeners for tab switching
    currentCompaniesTab.addEventListener('click', switchTab);
    registeredCompaniesTab.addEventListener('click', switchTab);
</script>