<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/PDC/StudentReport.css" />


<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-comments" style="font-size: 40px;"></i>
            <h2><b>Student Report</b></h2>
        </div>
        <div class="filter-search-container">
            <select id="filterColumn" onchange="filterReports()">
                <option value="all">All Columns</option>
                <option value="sender_name">Sender Name</option>
                <option value="subject_name">Subject Name</option>
                <option value="file_name">File Name</option>
                <option value="created_at">Created At</option>
                <option value="description">Description</option>
                <option value="sender_type">Sender Type</option>
            </select>
            <input type="text" placeholder="Search ..." class="search-bar" oninput="filterReports()">
        </div>
    </header>

    <section class="content">
        <div class="table-title">
            <h3><b>Student Report</b></h3>
            <p>View Student Report provided by Company</p>
        </div>

        <table class="reports-table">
            <thead>
                <tr>
                    <th>Sender_Name</th>
                    <th>Subject_Name</th>
                    <th>File_Name</th>                    
                    <th>created_at</th>
                    <th>Description</th>
                    <th>Sender_type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reportsTableBody">
            <?php foreach ($reports as $report): ?>
                <tr id="row-<?= $report['id'] ?>">
                    <td><?= htmlspecialchars($report['sender_name']) ?></td>
                    <td><?= htmlspecialchars($report['subject_name']) ?></td>
                    <td><?= htmlspecialchars($report['original_name']) ?></td>
                    <td><?= htmlspecialchars($report['created_at']) ?></td>
                    <td><?= htmlspecialchars($report['description']) ?></td>
                    <td><?= htmlspecialchars($report['sender_role']) ?></td>
                    
                    <td>
                        <button class="download-button" onclick="downloadReport(<?= $report['id'] ?>)">Download</button>
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

    function downloadReport(id) {
        const url = `/PDC/downloadReport?id=${encodeURIComponent(id)}`;
        window.open(url, '_blank');
    }
//      function viewReport(reportId) {
//      const report = reports.find(r => r.id === reportId);
//      if (!report) return;

//      let reportLinks = '';
//      for (let i = 1; i <= 6; i++) {
//          const key = `report${i}`;
//          if (report[key]) {
//              const fileName = report[key].split('/').pop();
//             reportLinks += `<p><strong>Report ${i} -</strong> <a href="/${report[key]}" target="_blank">${fileName}</a></p>`;
//         }
//      }

//     document.getElementById('reportDetails').innerHTML = `
//         <p><strong>Sender:</strong> ${report.sender_name}</p>
//         <p><strong>Subject name:</strong> ${report.subject_name}</p>
//         <p><strong>File name:</strong> ${report.original_name}</p>
//         <p><strong>Created At:</strong> ${report.created_at}</p>
//         <p><strong>Description:</strong> ${report.description}</p>
//         <p><strong>Type:</strong> ${report.sender_role}</p>
//         ${reportLinks}
//     `;
//     openPopup();
// }


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


    function filterReports() {
        const searchTerm = document.querySelector('.search-bar').value.toLowerCase();
        const filterColumn = document.getElementById('filterColumn').value;
        const rows = document.querySelectorAll('.reports-table tbody tr');

        rows.forEach(row => {
            // Map column names to their indices in the table
            const columns = {
                'sender_name': 0,
                'subject_name': 1,
                'file_name': 2,
                'created_at': 3,
                'description': 4,
                'sender_type': 5
            };

            let shouldDisplay = false;

            if (filterColumn === 'all') {
                // Search across all columns
                const senderName = row.cells[0].textContent.toLowerCase();
                const subjectName = row.cells[1].textContent.toLowerCase();
                const fileName = row.cells[2].textContent.toLowerCase();
                const createdAt = row.cells[3].textContent.toLowerCase();
                const description = row.cells[4].textContent.toLowerCase();
                const senderType = row.cells[5].textContent.toLowerCase();

                shouldDisplay = senderName.includes(searchTerm) ||
                               subjectName.includes(searchTerm) ||
                               fileName.includes(searchTerm) ||
                               createdAt.includes(searchTerm) ||
                               description.includes(searchTerm) ||
                               senderType.includes(searchTerm);
            } else {
                // Search in the selected column only
                const columnIndex = columns[filterColumn];
                const cellText = row.cells[columnIndex].textContent.toLowerCase();
                shouldDisplay = cellText.includes(searchTerm);
            }

            row.style.display = shouldDisplay ? '' : 'none';
        });
    }
</script>
