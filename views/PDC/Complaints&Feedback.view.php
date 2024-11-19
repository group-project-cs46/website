<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Complaints&Feedback.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-comments" style="font-size: 40px;"></i>
            <h2><b>Complaints & Feedback</b></h2>
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
                    <th>Complaint ID</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="complaintsTableBody">
                <!-- Example complaint entries (to be replaced with dynamic data) -->
                <tr>
                    <td>1</td>
                    <td>Complaint about Service</td>
                    <td>
                        <button class="view-button" onclick="viewComplaint(1)">View</button>
                        <button class="delete-button" onclick="deleteComplaint(1)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Feedback on Website</td>
                    <td>
                        <button class="view-button" onclick="viewComplaint(2)">View</button>
                        <button class="delete-button" onclick="deleteComplaint(2)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<!-- Popup for Complaint Details -->
<div id="complaintPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h3>Complaint Details</h3>
        <div id="complaintDetails"></div>
    </div>
</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // Example data for complaints (you can replace this with real data from a database or API)
    const complaints = [
        { id: 1, title: 'Complaint about Service', details: 'Complaint details for service.' },
        { id: 2, title: 'Feedback on Website', details: 'Feedback details for website.' }
    ];

    // Function to render complaint details in the popup
    function viewComplaint(complaintId) {
        const complaint = complaints.find(c => c.id === complaintId);
        const complaintDetailsDiv = document.getElementById('complaintDetails');
        complaintDetailsDiv.innerHTML = `
            <p><strong>Title:</strong> ${complaint.title}</p>
            <p><strong>Details:</strong> ${complaint.details}</p>
        `;
        document.getElementById('complaintPopup').style.display = 'block';
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('complaintPopup').style.display = 'none';
    }

    // Function to delete a complaint
    function deleteComplaint(complaintId) {
        const confirmation = confirm('Are you sure you want to delete this complaint?');
        if (confirmation) {
            // Delete complaint from data (can be replaced with an API call to delete from the server)
            const complaintIndex = complaints.findIndex(c => c.id === complaintId);
            if (complaintIndex !== -1) {
                complaints.splice(complaintIndex, 1);
                alert('Complaint deleted successfully');
                location.reload();  // Reload the page to reflect the deletion
            }
        }
    }
</script>

