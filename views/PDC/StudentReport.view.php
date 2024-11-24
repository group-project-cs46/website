<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/StudentReport.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-comments" style="font-size: 40px;"></i>
            <h2><b>Student Report</b></h2>
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
                    <th>Student name</th>
                    <th>Registration No.</th>
                    <th>Company</th>
                    <th>Report</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reportsTableBody">
                <!-- Example entries (to be replaced with dynamic data) -->
                <tr>
                    <td>Nive</td>
                    <td>2022/CS/141</td>
                    <td>Wso2</td>
                    <td>report1.pdf</td>
                    <td>
                        <button class="view-button" onclick="viewReport(1)">View</button>
                        <button class="delete-button" onclick="deleteReport(1)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Karu</td>
                    <td>2022/CS/166</td>
                    <td>Wso2</td>
                    <td>report2.pdf</td>
                    <td>
                        <button class="view-button" onclick="viewReport(2)">View</button>
                        <button class="delete-button" onclick="deleteReport(2)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<!-- Popup for Report Details -->
<div id="reportPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h3>Report Details</h3>
        <div id="reportDetails"></div>
    </div>
</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>

    // Sample data structure for reports
let reports = [
    { 
        id: 1,
        name: 'Nive',
        regno: '2022/CS/141',
        company: 'Wso2',
        report: 'report1.pdf'
    },
    {
        id: 2,
        name: 'Karu',
        regno: '2022/CS/166',
        company: 'Wso2',
        report: 'report2.pdf'
    },
    {
        id: 3,
        name: 'Sarma',
        regno: '2022/IS/122',
        company: 'Wso2',
        report: 'report3.pdf'
    }
];

// Function to render all reports in the table
function renderReports() {
    const tableBody = document.getElementById('reportsTableBody');
    tableBody.innerHTML = ''; // Clear existing content

    reports.forEach((report, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${report.name}</td>
            <td>${report.regno}</td>
            <td>${report.company}</td>
            <td>${report.report}</td>
            <td>
                <button class="view-button" onclick="viewReport(${index})">View</button>
                <button class="delete-button" onclick="deleteReport(${index})">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Function to view report details in popup
function viewReport(index) {
    const report = reports[index];
    const reportDetailsDiv = document.getElementById('reportDetails');
    
    reportDetailsDiv.innerHTML = `
        <div class="report-detail-item">
            <p><strong>Name:</strong> ${report.name}</p>
            <p><strong>Registration Number:</strong> ${report.regno}</p>
            <p><strong>Company:</strong> ${report.company}</p>
            <p><strong>Report:</strong> <a href="/reports/${report.report}" target="_blank">${report.report}</a></p>
        </div>
    `;
    
    openPopup();
}

// Function to delete a report
function deleteReport(index) {
    const report = reports[index];
    const confirmation = confirm(`Are you sure you want to delete the report for ${report.name}?`);
    
    if (confirmation) {
        // Here you would typically make an API call to delete from the server
        reports.splice(index, 1);
        renderReports();
        alert('Report deleted successfully');
    }
}

// Function to open popup
function openPopup() {
    const popup = document.getElementById('reportPopup');
    popup.style.display = 'block';
    
    // Add event listener for clicking outside popup
    document.addEventListener('click', closePopupOnOutsideClick);
}

// Function to close popup
function closePopup() {
    const popup = document.getElementById('reportPopup');
    popup.style.display = 'none';
    
    // Remove event listener when popup is closed
    document.removeEventListener('click', closePopupOnOutsideClick);
}

// Function to close popup when clicking outside
function closePopupOnOutsideClick(event) {
    const popup = document.getElementById('reportPopup');
    const popupContent = popup.querySelector('.popup-content');
    
    if (event.target === popup && !popupContent.contains(event.target)) {
        closePopup();
    }
}

// Function to search/filter reports
function searchReports(searchTerm) {
    const filteredReports = reports.filter(report => 
        report.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        report.regno.toLowerCase().includes(searchTerm.toLowerCase()) ||
        report.company.toLowerCase().includes(searchTerm.toLowerCase())
    );
    
    renderFilteredReports(filteredReports);
}

// Function to render filtered reports
function renderFilteredReports(filteredReports) {
    const tableBody = document.getElementById('reportsTableBody');
    tableBody.innerHTML = '';

    filteredReports.forEach((report, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${report.name}</td>
            <td>${report.regno}</td>
            <td>${report.company}</td>
            <td>${report.report}</td>
            <td>
                <button class="view-button" onclick="viewReport(${reports.indexOf(report)})">View</button>
                <button class="delete-button" onclick="deleteReport(${reports.indexOf(report)})">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Initialize the page
document.addEventListener('DOMContentLoaded', () => {
    renderReports();
    
    // Add event listener for ESC key to close popup
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closePopup();
        }
    });
});

</script>


<!-- <script>
    // Example data for report (you can replace this with real data from a database or API)
    const reports = [
        { name: 'Sarma', regno: '2022/IS/122', company: 'Wso2' ,report: 'report3.pdf'},
        // { id: 2, title: 'Feedback on Website', details: 'Feedback details for website.' },

    ];

        // Function to render report details in the popup
        function viewReport(index) {
        const report = reports[index];
        const reportDetailsDiv = document.getElementById('reportDetails');
        reportDetailsDiv.innerHTML = `
            <p><strong>Name:</strong> ${report.name}</p>
            <p><strong>Registration Number:</strong> ${report.regno}</p>
            <p><strong>Company:</strong> ${report.company}</p>
            <p><strong>Report:</strong> <a href="${report.report}" target="_blank">${report.report}</a></p>
        `;
        document.getElementById('reportPopup').style.display = 'block';
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('reportPopup').style.display = 'none';
    }

    // Function to delete a report
    function deleteReport(index) {
        const confirmation = confirm('Are you sure you want to delete this report?');
        if (confirmation) {
            // Delete report from the array
            reports.splice(index, 1);
            alert('Report deleted successfully');
            renderReports(); // Re-render the report list
        }
    }

    // // Function to render report details in the popup
    // function viewReport(reportId) {
    //     const complaint = reports.find(c => c.id === reportId);
    //     const reportDetailsDiv = document.getElementById('reportDetails');
    //     reportDetailsDiv.innerHTML = `
    //         <p><strong>Title:</strong> ${complaint.title}</p>
    //         <p><strong>Details:</strong> ${complaint.details}</p>
    //     `;
    //     document.getElementById('reportPopup').style.display = 'block';
    // }

    // // Function to close the popup
    // function closePopup() {
    //     document.getElementById('reportPopup').style.display = 'none';
    // }

    // // Function to delete a complaint
    // function deleteReport(reportId) {
    //     const confirmation = confirm('Are you sure you want to delete this complaint?');
    //     if (confirmation) {
    //         // Delete complaint from data (can be replaced with an API call to delete from the server)
    //         const complaintIndex = reports.findIndex(c => c.id === reportId);
    //         if (complaintIndex !== -1) {
    //             reports.splice(complaintIndex, 1);
    //             alert('Complaint deleted successfully');
    //             location.reload();  // Reload the page to reflect the deletion
    //         }
    //     }
    // }
</script>
 -->
