<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/PDC/StudentReport.css" />


<main class="main-content">
    <div class="container">
        <header class="header">
            <div class="above">
                <i class="fas fa-comments" style="font-size: 40px;"></i>
                <h2><b>Reports</b></h2>
            </div>
            <div class="filter-search-container">
                <select id="filterColumn" onchange="filterReports()">
                    <option value="all">All Columns</option>
                    <option value="sender_name">Sender Name</option>
                    <option value="file_name">File Name</option>
                    <option value="created_at">Created Date</option>
                    <option value="description">Description</option>
                </select>
                <input type="text" placeholder="Search ..." class="search-bar" oninput="filterReports()">
            </div>
        </header>

        <section class="content">
            
            <div class="tabs">
                <div class="student-report active-tab" id="studentreport-tab" onclick="togglecompany('student-report-section')">
                    <h3>Student Reports</h3>
                    <p>View Reports provided by students</p>
                </div>

                <div class="divider"></div>

                <div class="company-reports" id="companyreport-tab" onclick="togglecompany('company-reports-section')">
                    <h3>Company Reports</h3>
                    <p>View student Reports provided by companies</p>
                </div>
            </div>
            <div class="container2" id="student-report-section">
                <div class="table-title">
                    <h3><b>Student Report</b></h3>
                    <p>Reports submited by students</p>
                </div>
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>Student_Name</th> 
                            <th>index_number</th>                          
                            <th>File_Name</th>
                            <th>Created_date</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="reportsTableBody">
                        <?php foreach ($reports as $report): ?>
                            <tr id="row-<?= $report['id'] ?>">
                                <td><?= htmlspecialchars($report['sender_name']) ?></td> 
                                <td><?= htmlspecialchars($report['index_number']) ?></td>                              
                                <td><?= htmlspecialchars($report['original_name']) ?></td>
                                <td><?= htmlspecialchars($report['created_date']) ?></td>
                                <td><?= htmlspecialchars($report['description']) ?></td>
                                <td>
                                    <button class="download-button" onclick="downloadReport(<?= $report['id'] ?>)">Download</button>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="container2" id="company-reports-section" style="display: none;">
                <div class="table-title">
                    <h3><b>Company student Reports</b></h3>
                    <p>Reports submited by companies</p>
                </div>
                <table class="reports-table">
                    <thead>
                    <tr>
                            <th>Company_Name</th>                           
                            <th>File_Name</th>
                            <th>created_date</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="companyreportsTableBody">
                    <?php foreach ($companyreports as $companyreport): ?>
                            <tr id="row-<?= $companyreport['id'] ?>">
                                <td><?= htmlspecialchars($companyreport['sender_name']) ?></td>                               
                                <td><?= htmlspecialchars($companyreport['original_name']) ?></td>
                                <td><?= htmlspecialchars($companyreport['created_date']) ?></td>
                                <td><?= htmlspecialchars($companyreport['description']) ?></td>

                                <td>
                                    <button class="download-button" onclick="downloadReport(<?= $companyreport['id'] ?>)">Download</button>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                       
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<!-- Popup for Report Details -->
<div id="reportPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2>Report Details</h2>
        <div id="reportDetails"></div>
    </div>
</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    function togglecompany(sectionId) {
        const studentreportsSection = document.getElementById('student-report-section');
        const companyreportSection = document.getElementById('company-reports-section');
        const studentreportTab = document.getElementById('studentreport-tab');
        const companyreportTab = document.getElementById('companyreport-tab');

        if (sectionId === 'student-report-section') {
            studentreportsSection.style.display = 'block';
            companyreportSection.style.display = 'none';
            studentreportTab.classList.add('active-tab');
            companyreportTab.classList.remove('active-tab');
        } else if (sectionId === 'company-reports-section') {
            studentreportsSection.style.display = 'none';
            companyreportSection.style.display = 'block';
            studentreportTab.classList.remove('active-tab');
            companyreportTab.classList.add('active-tab');
        }
    }

    // Set initial visibility
    document.getElementById('student-report-section').style.display = 'block';
    document.getElementById('company-reports-section').style.display = 'none';


    let reports = <?= json_encode($reports) ?>;

    function downloadReport(id) {
        const url = `/PDC/downloadReport?id=${encodeURIComponent(id)}`;
        window.open(url, '_blank');
    }
   


    function openPopup() {
        document.getElementById('reportPopup').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('reportPopup').style.display = 'none';
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closePopup();
        }
    });


    function filterReports() {
    const searchTerm = document.querySelector('.search-bar').value.toLowerCase();
    const filterColumn = document.getElementById('filterColumn').value;
    const isStudentTabActive = document.getElementById('student-report-section').style.display === 'block';

    if (isStudentTabActive) {
        // Filter Student Reports
        const rows = document.querySelectorAll('#student-report-section .reports-table tbody tr');
        const columns = {
            'sender_name': 0,    
            'index_number': 1,   
            'file_name': 2,      
            'created_at': 3,     
            'description': 4     
        };

        rows.forEach(row => {
            let shouldDisplay = false;

            if (filterColumn === 'all') {
                // Check all columns
                for (let i = 0; i < 5; i++) {
                    const cellText = row.cells[i].textContent.toLowerCase();
                    if (cellText.includes(searchTerm)) {
                        shouldDisplay = true;
                        break;
                    }
                }
            } else {
                // Check specific column
                const columnIndex = columns[filterColumn];
                const cellText = row.cells[columnIndex].textContent.toLowerCase();
                shouldDisplay = cellText.includes(searchTerm);
            }

            row.style.display = shouldDisplay ? '' : 'none';
        });
    } else {
        // Filter Company Reports
        const rows = document.querySelectorAll('#company-reports-section .reports-table tbody tr');
        const columns = {
            'sender_name': 0,    
            'file_name': 1,      
            'created_at': 2,     
            'description': 3     
        };

        rows.forEach(row => {
            let shouldDisplay = false;

            if (filterColumn === 'all') {
                // Check all columns
                for (let i = 0; i < 4; i++) {
                    const cellText = row.cells[i].textContent.toLowerCase();
                    if (cellText.includes(searchTerm)) {
                        shouldDisplay = true;
                        break;
                    }
                }
            } else if (filterColumn !== 'index_number') {
                // Check specific column (skip index_number for company reports)
                const columnIndex = columns[filterColumn];
                const cellText = row.cells[columnIndex].textContent.toLowerCase();
                shouldDisplay = cellText.includes(searchTerm);
            }

            row.style.display = shouldDisplay ? '' : 'none';
        });
    }
}
</script>


