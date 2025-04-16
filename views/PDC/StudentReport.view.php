<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/PDC/StudentReport.css" />


<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-comments" style="font-size: 40px;"></i>
            <h2><b>Student Report</b></h2>
        </div>
        <input type="text" placeholder="Search ..." class="search-bar" oninput="filterReports()">
    </header>

    <section class="content">
        <div class="table-title">
            <h3><b>Student Report</b></h3>
            <p>View Student Report provided by Company</p>
        </div>

        <table class="reports-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Index No.</th>
                    <th>Company</th>
                    <th>Report</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reportsTableBody">
            <?php foreach ($reports as $report): ?>
                <tr id="row-<?= $report['id'] ?>">
                    <td><?= htmlspecialchars($report['student_name']) ?></td>
                    <td><?= htmlspecialchars($report['index_number']) ?></td>
                    <td><?= htmlspecialchars($report['company_name']) ?></td>
                    <td><a href="/<?= htmlspecialchars($report['report1']) ?>" target="_blank">View Report</a></td>
                    <td>
                        <button class="view-button" onclick="viewReport(<?= $report['id'] ?>)">View</button>
                        <button class="delete-button" onclick="deleteReport(<?= $report['id'] ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
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
    let reports = <?= json_encode($reports) ?>;

    function viewReport(reportId) {
        const report = reports.find(r => r.id === reportId);
        if (!report) return;
        
        document.getElementById('reportDetails').innerHTML = `
            <p><strong>Name:</strong> ${report.student_name}</p>
            <p><strong>Index No:</strong> ${report.index_number}</p>
            <p><strong>Company:</strong> ${report.company_name}</p>
            <p><strong>Report:</strong> <a href="/${report.report1}" target="_blank">View Report</a></p>
        `;
        openPopup();
    }

    function deleteReport(reportId) {
        if (confirm("Are you sure you want to delete this report?")) {
            fetch('/PDC/deletestudentreport', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ delete_id: reportId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`row-${reportId}`).remove();
                    alert("Report deleted successfully!");
                } else {
                    alert("Error deleting report.");
                }
            })
            .catch(error => console.error('Error:', error));
        }
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
</script>
