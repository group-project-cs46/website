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
                <!-- <button class="add-button" onclick="showAddCompanyPopup()">+</button> -->
            </div>
        </div>

        <table class="blacklist-table">
            <thead>
                <tr>
                    <th>Blacklisted Companies</th>
                    <th>Email</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="companyTableBody">
                <!-- Dynamic Rows -->
                <?php foreach ($blacklistedcompanies as $blacklisted): ?>
                    <tr id="row-<?= $blacklisted['company_id'] ?>">
                        <td><?= htmlspecialchars($blacklisted['name']) ?></td>
                        <td><?= htmlspecialchars($blacklisted['email']) ?></td>
                        <td><?= htmlspecialchars($blacklisted['reason']) ?></td>
                        <td>
                            <button class="view-button" onclick="RemoveBlacklist(<?= $blacklisted['company_id'] ?>)">remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
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

            <label for="blacklistReason">Reason for Blacklisting:</label>
            <textarea id="blacklistReason" name="blacklistReason" required></textarea>

            <button type="submit" class="submit-button">Add Company</button>
        </form>
    </div>
</div>

<script>
    function showAddCompanyPopup() {
        document.getElementById('addCompanyPopup').style.display = 'flex';
    }

    function closeAddCompanyPopup() {
        document.getElementById('addCompanyPopup').style.display = 'none';
    }

    function submitAddCompany(event) {
        event.preventDefault();

        const companyName = document.getElementById('companyName').value;
        const companyEmail = document.getElementById('companyEmail').value;
        const blacklistReason = document.getElementById('blacklistReason').value;

        if (companyName && companyEmail && blacklistReason) {
            const tableBody = document.getElementById('companyTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${companyName}</td>
                <td>${companyEmail}</td>
                <td>${blacklistReason}</td>
                <td><button class="remove-button" onclick="removeCompany(this)">Remove</button></td>
            `;
            tableBody.appendChild(newRow);

            // Simulate email sending
            sendBlacklistEmail(companyEmail, companyName, blacklistReason);

            document.getElementById('addCompanyForm').reset();
            closeAddCompanyPopup();
            alert('Successfully added to blacklist and reason message was sent');
        } else {
            alert('Please fill out all fields.');
        }
    }

    function sendBlacklistEmail(email, company, reason) {
        console.log(`Sending email to ${email}\nSubject: Blacklisting Notice\nMessage: Your company "${company}" has been blacklisted due to: ${reason}`);
    }

    function RemoveBlacklist(company_id) {
        if (!confirm("Are you sure you want to remove this company from the blacklist?")) {
            return;
        }

        fetch('/PDC/removeblacklist', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                company_id: company_id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                const row = document.getElementById(`row-${company_id}`);
                if (row) {
                    const button = row.querySelector('.view-button');
                    if (button) {
                        button.textContent = 'removed'; // Change button text to "removed"
                        button.disabled = true; // Disable the button
                        button.classList.add('status-removed'); // Add a class for styling
                    }
                    // Optionally, add a class to the row to indicate it's unblacklisted
                    row.classList.add('unblacklisted-row');
                }
            } else {
                alert('Failed to remove from blacklist: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing the request.');
        });
    }

    function filterCompanies() {
        const searchInput = document.querySelector('.search-bar').value.toLowerCase();
        const tableRows = document.querySelectorAll('#companyTableBody tr');

        tableRows.forEach(row => {
            const companyName = row.cells[0].textContent.toLowerCase();
            const companyEmail = row.cells[1].textContent.toLowerCase();
            if (companyName.includes(searchInput) || companyEmail.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    window.onclick = function(event) {
        const popup = document.getElementById('addCompanyPopup');
        if (event.target === popup) {
            closeAddCompanyPopup();
        }
    };
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>