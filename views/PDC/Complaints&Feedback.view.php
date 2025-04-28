<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Complaints&Feedback.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-comments" style="font-size: 40px;"></i>
            <h2><b>Complaints & Feedback</b></h2>
        </div>
        <div class="filter-search-container">
            <select id="filterColumn" onchange="searchComplaints(document.getElementById('searchComplaints').value)">
                <option value="all">All Columns</option>
                <option value="complainant_name">Submitted By</option>
                <option value="subject">Title</option>
                <option value="accused_name">Complaint Against</option>
                <option value="complaint_type">Complaint Type</option>
                <option value="created_at">Date</option>
            </select>
            <input type="text" id="searchComplaints" placeholder="Search..." class="search-bar" onkeyup="searchComplaints(this.value)">
        </div>
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
                    <th>Complaint_type</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="complaintsTableBody">
                <?php foreach ($complaints as $complaint): ?>
                    <tr id="row-<?= $complaint['id'] ?>" class="<?= $complaint['status'] === 'rejected' ? 'disabled' : '' ?>">
                        <td><?= htmlspecialchars($complaint['complainant_name'] ?? 'Unknown') ?></td>
                        <td><?= htmlspecialchars($complaint['subject']) ?></td>
                        <td><?= htmlspecialchars($complaint['accused_name'] ?? 'Unknown') ?></td>
                        <td><?= htmlspecialchars($complaint['complaint_type']) ?></td>
                        <td><?= htmlspecialchars($complaint['created_date']) ?></td>
                        <?php
                        $status = $complaint['status'];
                        $statusClass = 'status-' . strtolower(str_replace(' ', '_', $status));
                        ?>
                        <td class="<?= $statusClass ?>"><?= htmlspecialchars(str_replace('_', ' ', $status)) ?></td>
                        <td>
                            <button class="view-button" onclick="viewComplaint(<?= $complaint['id'] ?>)">View</button>
                            <button class="reject-button <?= in_array($complaint['status'], ['rejected', 'resolved']) ? 'button-disabled' : '' ?>"
                                onclick="rejectComplaint(<?= $complaint['id'] ?>)"
                                <?= in_array($complaint['status'], ['rejected', 'resolved']) ? 'disabled' : '' ?>>Reject</button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>


<div id="complaintPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">×</span>
        <h2>Complaint Details</h2>
        <div class="complaintdetails" id="complaintDetails"></div>
        <div id="additionalInfo" style="margin-top: 20px;"></div>
        <div id="complaintActions"></div>
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
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            
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
                <p><strong>Complaint Type:</strong> ${complaint.complaint_type || 'N/A'}</p>
                <p><strong>Contact:</strong> ${complaint.contact || 'N/A'}</p>
                <p><strong>Date Submitted:</strong> ${complaint.created_date || 'N/A'}</p>
            `;

            additionalInfoDiv.innerHTML = `
                <p><strong>Status:</strong> ${(complaint.status || 'N/A').replace('_', ' ')}</p>
            `;

            // Add "Complaint Solved" button dynamically based on status
            const actionsDiv = document.getElementById('complaintActions');
            actionsDiv.innerHTML = ''; // Clear previous button

            if (complaint.status !== 'rejected' && complaint.status !== 'resolved') {
                const solvedButton = document.createElement('button');
                solvedButton.textContent = 'Complaint Solved';
                solvedButton.className = 'solved-button';
                solvedButton.onclick = () => complaintsolved(complaint.id);
                actionsDiv.appendChild(solvedButton);
            } else {
                const solvedButton = document.createElement('button');
                solvedButton.textContent = 'Complaint Solved';
                solvedButton.className = 'solved-button button-disabled';
                solvedButton.disabled = true;
                actionsDiv.appendChild(solvedButton);
            }


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
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    csrf_token: csrfToken
                })
            });
            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.error || 'Failed to reject complaint');
            }

            alert('Complaint rejected successfully');
            location.reload(); 
            // Disable the row instead of removing it
            const row = document.getElementById(`row-${id}`);
            if (row) {
                // Add a 'disabled' class to the row
                row.classList.add('disabled');
                // Update the status column to "rejected"
                row.cells[5].textContent = 'rejected'; 
                // Disable the action buttons
                const buttons = row.querySelectorAll('button');
                buttons.forEach(button => {
                    button.disabled = true;
                    button.classList.add('button-disabled');
                });
            }
        } catch (error) {
            alert('Error rejecting complaint: ' + error.message);
        }
    }

    
    async function complaintsolved(id) {
        if (!confirm('Are you sure you want to mark this complaint as solved?')) {
            return;
        }

        try {
            const response = await fetch('/PDC/markcomplaintsolved', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    csrf_token: csrfToken
                })
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.error || 'Failed to mark complaint as solved');
            }

            alert('Complaint marked as solved successfully');
            location.reload();

            
            const row = document.getElementById(`row-${id}`);
            if (row) {
                row.classList.add('disabled');
                row.cells[5].textContent = 'solved';
                const buttons = row.querySelectorAll('button');
                buttons.forEach(button => {
                    button.disabled = true;
                    button.classList.add('button-disabled');
                });
            }
        } catch (error) {
            alert('Error marking complaint as solved: ' + error.message);
        }
    }


    
    function searchComplaints(searchTerm) {
        const filterColumn = document.getElementById('filterColumn').value;
        const rows = document.querySelectorAll('#complaintsTableBody tr');
        searchTerm = searchTerm.toLowerCase();

        rows.forEach(row => {
            // Map column names to their indices in the table
            const columns = {
                'complainant_name': 0,
                'subject': 1,
                'accused_name': 2,
                'complaint_type': 3,
                'created_date': 4
            };

            let matches = false;

            if (filterColumn === 'all') {
                // Search across all columns
                const complainant = row.cells[0].textContent.toLowerCase();
                const subject = row.cells[1].textContent.toLowerCase();
                const accused = row.cells[2].textContent.toLowerCase();
                const complaintType = row.cells[3].textContent.toLowerCase();
                const date = row.cells[4].textContent.toLowerCase();

                matches = complainant.includes(searchTerm) ||
                    subject.includes(searchTerm) ||
                    accused.includes(searchTerm) ||
                    complaintType.includes(searchTerm) ||
                    date.includes(searchTerm);
            } else {
                // Search in the selected column only
                const columnIndex = columns[filterColumn];
                const cellText = row.cells[columnIndex].textContent.toLowerCase();
                matches = cellText.includes(searchTerm);
            }

            row.style.display = matches ? '' : 'none';
        });
    }
</script>