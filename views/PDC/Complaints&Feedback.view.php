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
                    <th>Complaint ID</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Submitted By</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="complaintsTableBody">
                <!-- Example complaint entries (to be replaced with dynamic data) -->
                <tr>
                    <td>1</td>
                    <td>System Complaint</td>
                    <td>Complaint about Service</td>
                    <td>John Doe</td>
                    <td>2024-12-22</td>
                    <td>
                        <button class="view-button" onclick="viewComplaint(1)">View</button>
                        <button class="delete-button" onclick="deleteComplaint(1)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Student Complaint</td>
                    <td>Feedback on Website</td>
                    <td>Jane Smith</td>
                    <td>2024-12-21</td>
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
        <h2>Complaint Details</h2>
        <div class="complaintdetails" id="complaintDetails"></div>
        <div id="additionalInfo" style="margin-top: 20px;"></div>
    </div>
</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // Example data for complaints (you can replace this with real data from a database or API)
    const complaints = [
        { 
            id: 1, 
            type: 'System Complaint',
            title: 'Complaint about Service', 
            details: 'Complaint details for service.',
            submittedBy: 'John Doe',
            date: '2024-12-22',
            //type: 'Student Complain', // Example: could be 'Student', 'Lecturer', etc.
            contact: 'john.doe@example.com',
           // status: 'Solved' // Example: could be 'Open', 'Closed', 'In Progress', etc.
        },
        { 
            id: 2, 
            title: 'Feedback on Website', 
            type: 'Student Complaint',
            details: 'Feedback details for website.',
            submittedBy: 'Jane Smith',
            date: '2024-12-21',
            //type: 'Lecturer Complain', // Example: could be 'Student', 'Lecturer', etc.
            contact: 'jane.smith@example.com',
            //status: '-' // Example: could be 'Open', 'Closed', 'In Progress', etc.
        }
    ];

    // Function to render complaint details in the popup
    function viewComplaint(complaintId) {
        const complaint = complaints.find(c => c.id === complaintId);
        const complaintDetailsDiv = document.getElementById('complaintDetails');
        const additionalInfoDiv = document.getElementById('additionalInfo');
        
        complaintDetailsDiv.innerHTML = `
            <p><strong>Title:</strong> ${complaint.title}</p>
            <p><strong>Details:</strong> ${complaint.details}</p>
            <p><strong>Submitted By:</strong> ${complaint.submittedBy}</p>
            <p><strong>Contact:</strong> ${complaint.contact}</p>
            <p><strong>Date Submitted:</strong> ${complaint.date}</p>
        `;
        
        additionalInfoDiv.innerHTML = `
            <p><strong>Type:</strong> ${complaint.type}</p>
            
        `;
        
        document.getElementById('complaintPopup').style.display = 'block';
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('complaintPopup').style.display = 'none';
    }
    function deleteComplaint(complaintId) {
    const confirmation = confirm('Are you sure you want to delete this complaint?');
    if (confirmation) {
        // Find the index of the complaint to be deleted
        const complaintIndex = complaints.findIndex(c => c.id === complaintId);
        if (complaintIndex !== -1) {
            // Remove the complaint from the data array
            complaints.splice(complaintIndex, 1);
            alert('Complaint deleted successfully');
            
            // Re-render the table
            renderTable();
        } else {
            alert('Complaint not found.');
        }
    }
}

// Function to dynamically render the complaints table
function renderTable(complaintsArray = complaints) {
    const tableBody = document.getElementById('complaintsTableBody');
    tableBody.innerHTML = '';
    complaintsArray.forEach(complaint => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${complaint.id}</td>
            <td>${complaint.type}</td>
            <td>${complaint.title}</td>
            <td>${complaint.submittedBy}</td>
            <td>${complaint.date}</td>
            <td>
                <button class="view-button" onclick="viewComplaint(${complaint.id})">View</button>
                <button class="delete-button" onclick="deleteComplaint(${complaint.id})">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function searchComplaints(searchTerm) {
    const filtered = complaints.filter(complaint => 
        complaint.type.toLowerCase().includes(searchTerm.toLowerCase()) ||
        complaint.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
        complaint.submittedBy.toLowerCase().includes(searchTerm.toLowerCase()) ||
        complaint.date.includes(searchTerm)
    );
    renderTable(filtered);
}

</script>
