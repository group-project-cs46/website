<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/report.css" />

<main class="main-content">
  <header class="header">
    <div class="above">
      <div class="above-left">
        <i class="fa-solid fa-file-invoice" style="font-size: 40px;"></i>
        <h2>Report</h2>
      </div>
    </div>
  </header>

  <section class="content">
    <div class="table-title">
      <div id="reportTab" class="table-title-txt active" onclick="toggleSection('report')">
        <h3>Upload Report</h3>
        <p>Upload reports to PDC</p>
      </div>
      <div class="divider"></div>
      <div id="viewReportTab" class="report-view-txt" onclick="toggleSection('viewReport')">
        <h3>View Report</h3>
        <p>View Report Details</p>
      </div>
    </div>

    <div id="reportSection" class="report-section active">
      <div class="form-container">
        <div>
          <h2>Report Details</h2>
        </div>
        <form class="form-content" id="reportForm" method="POST" action="/company_report/store" enctype="multipart/form-data">
          <div class="form-field">
            <label for="studentName">Student Name :</label>
            <input type="text" id="studentName" name="student_name" placeholder="Enter Name Here" required />
          </div>
          <div class="form-field">
            <label for="indexNumber">Student Index No. :</label>
            <input type="text" id="indexNumber" name="index_number" placeholder="Enter Index No. Here" required />
          </div>
          <div class="form-field">
            <label for="studentEmail">Student E-Mail :</label>
            <input type="email" id="studentEmail" name="student_email" placeholder="Enter E-Mail Here" required />
          </div>
          <?php for ($i = 1; $i <= 6; $i++): ?>
            <div class="form-field">
              <label for="upload-report-<?php echo $i; ?>">Upload Report <?php echo $i; ?> (PDF Only):</label>
              <input type="file" id `"upload-report-<?php echo $i; ?>" name="report<?php echo $i; ?>" accept=".pdf" />
            </div>
          <?php endfor; ?>
          <button class="submit-btn" type="submit">Submit</button>
        </form>
      </div>
    </div>

    <div id="viewReportSection" class="report-section">
      <div class="view-report-container">
        <h2>View Reports</h2>
        <div id="reportList">
          <p>No reports available to display at the moment.</p>
        </div>
        <!-- Detailed Report View -->
        <div id="reportDetail" class="report-detail" style="display: none;">
          <h3>Report Details</h3>
          <div id="reportDetailContent"></div>
          <div class="report-actions">
            <button class="edit-btn" onclick="editReport()">Edit</button>
            <button class="delete-btn" onclick="deleteReport()">Delete</button>
            <button class="back-btn" onclick="hideReportDetail()">Back to List</button>
          </div>
        </div>
        <!-- Edit Report Form -->
        <div id="editReportForm" class="report-edit-form" style="display: none;">
          <h3>Edit Report</h3>
          <form id="editForm" method="POST" action="/company_report/edit">
            <input type="hidden" id="editReportId" name="id">
            <label for="editStudentName">Student Name :</label>
            <input type="text" id="editStudentName" name="student_name" placeholder="Enter Name Here" required />
            <label for="editIndexNumber">Student Index No. :</label>
            <input type="text" id="editIndexNumber" name="index_number" placeholder="Enter Index No. Here" required />
            <label for="editStudentEmail">Student E-Mail :</label>
            <input type="email" id="editStudentEmail" name="student_email" placeholder="Enter E-Mail Here" required />
            <button type="submit" class="submit-btn">Update</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Popup Overlay for Messages -->
    <div class="popup-overlay" id="popupOverlay" style="display: none;">
      <p id="popupMessage"></p>
    </div>
  </section>
</main>

<script>
let currentReport = null;

// Form validation for PDF uploads
document.getElementById('reportForm').addEventListener('submit', function(event) {
  let isValid = true;
  for (let i = 1; i <= 6; i++) {
    const fileInput = document.getElementById(`upload-report-${i}`);
    if (fileInput.files.length > 0) {
      const file = fileInput.files[0];
      if (file.type !== "application/pdf") {
        alert(`Report ${i} must be a PDF file.`);
        isValid = false;
        break;
      }
    }
  }
  if (!isValid) {
    event.preventDefault();
  }
});

// Static data for reports
const staticReports = [
  {
    id: 1,
    student_name: "John Doe",
    index_number: "123456",
    student_email: "john.doe@example.com",
    created_at: "2025-04-15T10:00:00Z",
    report1: "/path/to/report1.pdf"
  },
  {
    id: 2,
    student_name: "Jane Smith",
    index_number: "654321",
    student_email: "jane.smith@example.com",
    created_at: "2025-04-16T12:00:00Z",
    report1: "/path/to/report2.pdf"
  },
  {
    id: 3,
    student_name: "Alice Johnson",
    index_number: "789012",
    student_email: "alice.johnson@example.com",
    created_at: "2025-04-17T14:00:00Z",
    report1: "/path/to/report3.pdf"
  }
];

// Function to fetch and render reports from the backend
function fetchAndRenderReports() {
  fetch('/company/report/list', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => {
      const reportList = document.getElementById('reportList');
      // Check if the request failed
      if (!data.success) {
        // Use static data as a fallback if fetch fails
        renderReports(staticReports);
        return;
      }
      // Check if there are no reports
      if (data.reports.length === 0) {
        // Use static data as a fallback if no reports are returned
        renderReports(staticReports);
        return;
      }
      // Render fetched reports if they exist
      renderReports(data.reports);
    })
    .catch(error => {
      console.error('Error fetching reports:', error);
      // Use static data as a fallback if fetch fails
      renderReports(staticReports);
    });
}

// Function to render reports (either fetched or static)
function renderReports(reports) {
  const reportList = document.getElementById('reportList');
  if (reports.length === 0) {
    reportList.innerHTML = '<p>No reports available to display at the moment.</p>';
    return;
  }
  let html = '<ul class="report-items">';
  reports.forEach((report, index) => {
    html += `
      <li class="report-item">
        <strong>Report ${index + 1}</strong><br>
        <span><strong>Student Name:</strong> ${report.student_name}</span><br>
        <button class="view-btn" onclick='showReportDetail(${JSON.stringify(report)})'>View</button>
      </li>
    `;
  });
  html += '</ul>';
  reportList.innerHTML = html;
}

// Function to show detailed report view
function showReportDetail(report) {
  currentReport = report;
  const reportList = document.getElementById('reportList');
  const reportDetail = document.getElementById('reportDetail');
  const editReportForm = document.getElementById('editReportForm');
  const reportDetailContent = document.getElementById('reportDetailContent');

  reportList.style.display = 'none';
  editReportForm.style.display = 'none';
  reportDetail.style.display = 'block';

  const createdAt = new Date(report.created_at).toLocaleString('en-US', { timeZone: 'Asia/Colombo' });
  let html = `
    <p><strong>Student Name:</strong> ${report.student_name}</p>
    <p><strong>Index Number:</strong> ${report.index_number}</p>
    <p><strong>Email:</strong> ${report.student_email}</p>
    <p><strong>Created At:</strong> ${createdAt}</p>
  `;
  // Add links to uploaded reports if they exist
  for (let i = 1; i <= 6; i++) {
    if (report[`report${i}`]) {
      html += `<p><strong>Report ${i}:</strong> <a href="${report[`report${i}`]}" target="_blank">View Report ${i}</a></p>`;
    }
  }
  reportDetailContent.innerHTML = html;
}

// Function to show the edit form
function editReport() {
  const reportDetail = document.getElementById('reportDetail');
  const editReportForm = document.getElementById('editReportForm');

  reportDetail.style.display = 'none';
  editReportForm.style.display = 'block';

  document.getElementById('editReportId').value = currentReport.id;
  document.getElementById('editStudentName').value = currentReport.student_name;
  document.getElementById('editIndexNumber').value = currentReport.index_number;
  document.getElementById('editStudentEmail').value = currentReport.student_email;
}

// Function to delete a report
function deleteReport() {
  if (!confirm('Are you sure you want to delete this report?')) {
    return;
  }

  fetch('/company_report/delete', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id: currentReport.id })
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showPopup('Report deleted successfully');
        hideReportDetail();
        fetchAndRenderReports();
      } else {
        showPopup('Failed to delete report', true);
      }
    })
    .catch(error => {
      console.error('Error deleting report:', error);
      showPopup('Error deleting report', true);
    });
}

// Function to hide detailed report view and show the list
function hideReportDetail() {
  const reportList = document.getElementById('reportList');
  const reportDetail = document.getElementById('reportDetail');
  const editReportForm = document.getElementById('editReportForm');

  reportDetail.style.display = 'none';
  editReportForm.style.display = 'none';
  reportList.style.display = 'block';
}

// Toggle section function
function toggleSection(section) {
  const reportTab = document.getElementById('reportTab');
  const viewReportTab = document.getElementById('viewReportTab');
  const reportSection = document.getElementById('reportSection');
  const viewReportSection = document.getElementById('viewReportSection');

  if (section === 'report') {
    reportTab.classList.add('active');
    viewReportTab.classList.remove('active');
    viewReportSection.classList.remove('active');
    viewReportSection.style.display = 'none';
    reportSection.style.display = 'block';
    setTimeout(() => reportSection.classList.add('active'), 10);
  } else {
    viewReportTab.classList.add('active');
    reportTab.classList.remove('active');
    reportSection.classList.remove('active');
    reportSection.style.display = 'none';
    viewReportSection.style.display = 'block';
    setTimeout(() => viewReportSection.classList.add('active'), 10);
    fetchAndRenderReports();
  }
}

// Display popup for success or error messages
function showPopup(message, isError = false) {
  const popupOverlay = document.getElementById('popupOverlay');
  const popupMessage = document.getElementById('popupMessage');

  popupMessage.textContent = message;
  popupMessage.classList.toggle('error', isError);
  popupOverlay.style.display = 'flex';

  setTimeout(() => {
    popupOverlay.style.display = 'none';
    popupMessage.classList.remove('error');
  }, 3000);
}

// Initialize the default section
window.onload = () => {
  toggleSection('report');
  const urlParams = new URLSearchParams(window.location.search);
  const successMessage = urlParams.get('success');
  const errorMessage = urlParams.get('error');

  if (successMessage) {
    showPopup(decodeURIComponent(successMessage));
    toggleSection('viewReport');
  } else if (errorMessage) {
    showPopup(decodeURIComponent(errorMessage), true);
  }
};

// Handle edit form submission
document.getElementById('editForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  const data = Object.fromEntries(formData);

  fetch('/company_report/edit', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showPopup('Report updated successfully');
        fetchAndRenderReports();
        hideReportDetail();
      } else {
        showPopup(data.error || 'Failed to update report', true);
      }
    })
    .catch(error => {
      console.error('Error updating report:', error);
      showPopup('Error updating report', true);
    });
});
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>