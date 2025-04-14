<?php require base_path('views/partials/auth/auth.php'); ?>

<main>
    <div class="container">

        <header class="header">
            <div class="above">
                <i class="fas fa-building" style="font-size: 40px;"></i>
                <h2><b>Manage Company</b></h2>
            </div>
            <input type="text" id="search-bar" placeholder="Search Company..." class="search-bar">
        </header>

        <section class="content">

            <div class="tabs">
                <div class="company-application active-tab" id="companyapplication-tab" onclick="togglecompany('company-application-section')">
                    <h3>Company Applications</h3>
                    <p>View company applications</p>
                </div>

                <div class="divider"></div>

                <div class="approved-companies" id="approvedcompanies-tab" onclick="togglecompany('approved-companies-section')">
                    <h3>Approved Companies</h3>
                    <p>View Approved Companies</p>
                </div>
            </div>

            <div class="container2" id="company-application-section">
                <div class="table-title">
                    <h3><b>Company Applications</b></h3>
                    <p>View company applications</p>
                </div>
                <div class="grid" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr auto auto">
                    <div class="grid-header">Name</div>
                    <div class="grid-header">Address</div>
                    <div class="grid-header">Email</div>
                    <div class="grid-header">Mobile</div>
                    <div class="grid-header">Website</div>
                    <div class="grid-header">Approve</div>
                    <div class="grid-header">Reject</div>

                    <?php foreach ($companies as $item): ?>
                        <div class="grid-item"><?php echo htmlspecialchars($item['name']); ?></div>
                        <div class="grid-item">
                            <?php echo htmlspecialchars($item['building']); ?>,
                            <?php echo htmlspecialchars($item['street_name']); ?>,
                            <?php if ($item['address_line_2']) : ?>
                                <?php echo htmlspecialchars($item['address_line_2']); ?>,
                            <?php endif; ?>
                            <?php echo htmlspecialchars($item['city']); ?>
                        </div>
                        <div class="grid-item"><?php echo htmlspecialchars($item['email']); ?></div>
                        <div class="grid-item"><?php echo htmlspecialchars($item['mobile'] ?? '-'); ?></div>
                        <div class="grid-item">
                            <?php if ($item['website']): ?>
                                <a href="<?php echo htmlspecialchars($item['website']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($item['website']); ?>
                                </a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </div>
                        <div class="grid-item" style="text-align: right">
                            <?php if ($item['approved']): ?>
                                <i class="fa-solid fa-check text-green-500"></i>
                            
                            <?php else: ?>
                                <form action="/pdcs/companies/approve" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="button approve-button">Approve</button>
                                </form>

                               
                            <?php endif; ?>
                        </div>
                        <div class="grid-item" style="text-align: right">
                            <?php if ($item['rejected']): ?>
                                <span class="text-red-500">Rejected</span>
                                <?php elseif (!$item['approved']): ?>
                                <div class="grid-item" style="text-align: right">
                                <form action="/pdcs/companies/reject" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <button type= "submit" class="button reject-button" onclick="confirmReject(this)">Reject</button>
                                </form>
                                    
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="container2" id="approved-company-section">
                <div class="table-title">
                    <h3><b>Approved Companies</b></h3>
                    <p>View Approved Companies</p>
                </div>
                <table class="company-table">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Contact Person</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Website</th>
                        </tr>
                    </thead>
                    <tbody id="registeredCompanyTableBody">
                        <tr>
                            <td>Wso2</td>
                            <td>Nimal</td>
                            <td>0779657883</td>
                            <td>Wso2@gmail.com</td>
                            <td><a href="https://wso2.com/">https://wso2.com/</a></td>
                        </tr>
                        <!-- Dynamic rows will be inserted here -->
                    </tbody>
                </table>
            </div>

        </section>
    </div>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
<link rel="stylesheet" href="/styles/students/table.css">
<link rel="stylesheet" href="/styles/PDC/ManageCompany.css">

<script>
    function togglecompany(sectionId) {
        const applicationsSection = document.getElementById('company-application-section');
        const approvedCompaniesSection = document.getElementById('approved-company-section');
        const applicationTab = document.getElementById('companyapplication-tab');
        const approvedCompaniesTab = document.getElementById('approvedcompanies-tab');

        if (sectionId === 'company-application-section') {
            applicationsSection.style.display = 'block';
            approvedCompaniesSection.style.display = 'none';
            applicationTab.classList.add('active-tab');
            approvedCompaniesTab.classList.remove('active-tab');
        } else if (sectionId === 'approved-companies-section') {
            applicationsSection.style.display = 'none';
            approvedCompaniesSection.style.display = 'block';
            applicationTab.classList.remove('active-tab');
            approvedCompaniesTab.classList.add('active-tab');
        }
    }

    // Set initial visibility
    document.getElementById('company-application-section').style.display = 'block';
    document.getElementById('approved-company-section').style.display = 'none';

    function confirmReject(button) {
    if (confirm('Are you sure you want to reject this company?')) {
        const gridItem = button.closest('.grid-item');
        button.parentElement.innerHTML = '<span class="text-red-500">Rejected</span>';
        const approveButton = document.querySelector('.approve-button');
        if (approveButton) {
            approveButton.style.display='none';
        }
    }
}

</script>

<?php require base_path('views/partials/auth/auth-close.php'); ?>