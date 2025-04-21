<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Complaints&Feedback.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-comments" style="font-size: 40px;"></i>
            <h2><b>Complaints & Feedback</b></h2>
        </div>
        <input type="text" id="searchComplaints" placeholder="Search..." class="search-bar" onkeyup="searchComplaints(this.value)">
    </header>

    <section class="content">
        <div class="table-title">
            <h3><b>Complaints & Feedback</b></h3>
            <p>View Complaints & Feedback</p>
        </div>

        

        <table class="complaints-table">
            <thead>
                <tr>
                    <th>Submitted By</th>
                    <th>Title</th>
                    <th>Complaint Against</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="complaintsTableBody">
                <?php foreach ($complaints as $complaint): ?>
                <tr id="row-<?= $complaint['id'] ?>">
                    <td><?= htmlspecialchars($complaint['complainant_name'] ?? 'Unknown') ?></td>
                    <td><?= htmlspecialchars($complaint['subject']) ?></td>
                    <td><?= htmlspecialchars($complaint['accused_name'] ?? 'Unknown') ?></td>
                    <td><?= htmlspecialchars($complaint['created_at']) ?></td>
                    <td><?= htmlspecialchars(str_replace('_', ' ', $complaint['status'])) ?></td>
                    <td>
                        <button class="view-button" onclick="viewComplaint(<?= $complaint['id'] ?>)">View</button>
                        <button class="reject-button" onclick="rejectComplaint(<?= $complaint['id'] ?>)">Reject</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<!-- Popup for Complaint Details -->
<div id="complaintPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">×</span>
        <h2>Complaint Details</h2>
        <div class="complaintdetails" id="complaintDetails"></div>
        <div id="additionalInfo" style="margin-top: 20px;"></div>
    </div>
</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // CSRF token from PHP
    const csrfToken = '<?= htmlspecialchars($csrf_token) ?>';

    // Function to fetch and display complaint details
    async function viewComplaint(id) {
        try {
            const response = await fetch(`/PDC/managecomplaints?id=${id}`, {
                method: 'GET',
                headers: { 'Content-Type': 'application/json' }
            });

            // Check if the response is okay
            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }

            const data = await response.json();

            // Check if the response indicates an error
            if (data.success === false) {
                throw new Error(data.error || 'Failed to fetch complaint');
            }

            // If successful, 'data' is the complaint object
            const complaint = data;

            const complaintDetailsDiv = document.getElementById('complaintDetails');
            const additionalInfoDiv = document.getElementById('additionalInfo');

            complaintDetailsDiv.innerHTML = `
                <p><strong>Title:</strong> ${complaint.subject || 'N/A'}</p>
                <p><strong>Details:</strong> ${complaint.description || 'N/A'}</p>
                <p><strong>Submitted By:</strong> ${complaint.complainant_name || 'Unknown'}</p>
                <p><strong>Complaint Against:</strong> ${complaint.accused_name || 'Unknown'}</p>
                <p><strong>Contact:</strong> ${complaint.contact || 'N/A'}</p>
                <p><strong>Date Submitted:</strong> ${complaint.created_at || 'N/A'}</p>
            `;

            additionalInfoDiv.innerHTML = `
                <p><strong>Status:</strong> ${(complaint.status || 'N/A').replace('_', ' ')}</p>
            `;

            document.getElementById('complaintPopup').style.display = 'block';
        } catch (error) {
            alert('Error fetching complaint details: ' + error.message);
        }
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('complaintPopup').style.display = 'none';
    }

    // Function to reject a complaint
    async function rejectComplaint(id) {
        if (!confirm('Are you sure you want to reject this complaint?')) {
            return;
        }

        try {
            const response = await fetch('/PDC/managecomplaints', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, csrf_token: csrfToken })
            });
            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.error || 'Failed to reject complaint');
            }

            alert('Complaint rejected successfully');
            // Remove the row from the table
            const row = document.getElementById(`row-${id}`);
            if (row) {
                row.remove();
            }
        } catch (error) {
            alert('Error rejecting complaint: ' + error.message);
        }
    }

    // Function to search complaints (client-side filtering)
    function searchComplaints(searchTerm) {
        const rows = document.querySelectorAll('#complaintsTableBody tr');
        searchTerm = searchTerm.toLowerCase();

        rows.forEach(row => {
            const complainant = row.cells[0].textContent.toLowerCase();
            const subject = row.cells[1].textContent.toLowerCase();
            const accused = row.cells[2].textContent.toLowerCase();
            const date = row.cells[3].textContent.toLowerCase();

            const matches = complainant.includes(searchTerm) ||
                           subject.includes(searchTerm) ||
                           accused.includes(searchTerm) ||
                           date.includes(searchTerm);

            row.style.display = matches ? '' : 'none';
        });
    }
</script>
