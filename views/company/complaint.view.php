<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/company/complaint.css" />

<main class="main-content">
  <header class="header">
    <div class="above">
      <div class="above-left">
        <i class="fa-brands fa-readme" style="font-size: 40px;"></i>
        <h2>Complaint Management</h2>
      </div>
    </div>
  </header>

  <section class="content">
    <div class="complaint-title">
      <div class="complaint-insert-txt active" id="complaintFormTab" onclick="toggleSection('complaintForm')">
        <h3>Complain Form</h3>
        <p>Details About Complaint</p>
      </div>

      <div class="divider"></div>

      <div class="complaint-view-txt" id="viewComplaintTab" onclick="toggleSection('viewComplaint')">
        <h3>View Complaint</h3>
        <p>View Complaint Details</p>
      </div>
    </div>

    <!-- Complaint Form Section -->
    <section class="complaint-section active" id="complaintFormSection">
      <form class="form-container show" id="complaintForm" method="POST" action="/company_complaint/store">
        <label for="complaintType">Complaint Type</label>
        <select id="complaintType" name="complaint_type" class="select-input" required>
          <option value="" disabled selected>Select complaint type</option>
          <option value="system">System Complaint</option>
          <option value="student">Student Complaint</option>
        </select>

        <div id="subjectField">
          <label for="complaintSubject">Subject of Complaint</label>
          <input type="text" id="complaintSubject" name="subject" placeholder="Enter subject of complaint" required>
        </div>

        <div id="indexField" style="display: none;">
          <label for="studentIndex">Student Index Number</label>
          <input type="text" id="studentIndex" name="index_no" placeholder="Enter student index number (e.g., 22001432)" required>
        </div>

        <div id="descriptionField">
          <label for="complaintDescription">Complaint Description</label>
          <textarea id="complaintDescription" name="complaint_description" placeholder="Enter complaint description here" required></textarea>
        </div>

        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </section>

    <!-- View Complaint Section -->
    <section class="complaint-section" id="viewComplaintSection">
      <div class="view-complaint-container">
        <h2>View Complaints</h2>
        <div id="complaintList">
          <p>No complaints available to display at the moment.</p>
        </div>
        <!-- Detailed Complaint View -->
        <div id="complaintDetail" class="complaint-detail" style="display: none;">
          <h3>Complaint Details</h3>
          <div id="complaintDetailContent"></div>
          <div class="complaint-actions">
            <button class="edit-btn" onclick="editComplaint()">Edit</button>
            <button class="delete-btn" onclick="deleteComplaint()">Delete</button>
            <button class="back-btn" onclick="hideComplaintDetail()">Back to List</button>
          </div>
        </div>
        <!-- Edit Complaint Form -->
        <div id="editComplaintForm" class="complaint-edit-form" style="display: none;">
          <h3>Edit Complaint</h3>
          <form id="editForm" method="POST" action="/company_complaint/edit">
            <input type="hidden" id="editComplaintId" name="id">
            <label for="editComplaintType">Complaint Type</label>
            <select id="editComplaintType" name="complaint_type" class="select-input" required>
              <option value="system">System Complaint</option>
              <option value="student">Student Complaint</option>
            </select>

            <div id="editSubjectField">
              <label for="editComplaintSubject">Subject of Complaint</label>
              <input type="text" id="editComplaintSubject" name="subject" placeholder="Enter subject of complaint" required>
            </div>

            <div id="editIndexField" style="display: none;">
              <label for="editStudentIndex">Student Index Number</label>
              <input type="text" id="editStudentIndex" name="index_no" placeholder="Enter student index number (e.g., 22001432)">
            </div>

            <div id="editDescriptionField">
              <label for="editComplaintDescription">Complaint Description</label>
              <textarea id="editComplaintDescription" name="complaint_description" placeholder="Enter complaint description here" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Update</button>
          </form>
        </div>
      </div>
    </section>

    <!-- Popup Overlay for Messages -->
    <div class="popup-overlay" id="popupOverlay" style="display: none;">
      <p id="popupMessage"></p>
    </div>
  </section>
</main>

<script>
let currentComplaint = null;

// Function to toggle form fields based on complaint type for edit form
function toggleEditFormFields() {
  const complaintType = document.getElementById('editComplaintType').value;
  const indexField = document.getElementById('editIndexField');
  const studentIndexInput = document.getElementById('editStudentIndex');

  if (complaintType === 'student') {
    indexField.style.display = 'block';
    studentIndexInput.setAttribute('required', 'required');
  } else {
    indexField.style.display = 'none';
    studentIndexInput.removeAttribute('required');
  }
}

// Function to toggle form fields based on complaint type for create form
function toggleFormFields() {
  const complaintType = document.getElementById('complaintType').value;
  const indexField = document.getElementById('indexField');
  const studentIndexInput = document.getElementById('studentIndex');

  if (complaintType === 'student') {
    indexField.style.display = 'block';
    studentIndexInput.setAttribute('required', 'required');
  } else {
    indexField.style.display = 'none';
    studentIndexInput.removeAttribute('required');
  }
}

// Function to fetch and render complaints from the backend
function fetchAndRenderComplaints() {
  fetch('/company/complaint/list', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => {
      const complaintList = document.getElementById('complaintList');
      // Check if the request failed
      if (!data.success) {
        complaintList.innerHTML = '<p>Failed to fetch complaints. Please try again later.</p>';
        return;
      }
      // Check if there are no complaints
      if (data.complaints.length === 0) {
        complaintList.innerHTML = '<p>No complaints available to display at the moment.</p>';
        return;
      }
      // Render complaints if they exist
      let html = '<ul class="complaint-items">';
      data.complaints.forEach((complaint, index) => {
        html += `
          <li class="complaint-item">
            <strong>Complaint ${index + 1}</strong><br>
            <span><strong>Subject:</strong> ${complaint.subject}</span><br>
            <button class="view-btn" onclick='showComplaintDetail(${JSON.stringify(complaint)})'>View</button>
          </li>
        `;
      });
      html += '</ul>';
      complaintList.innerHTML = html;
    })
    .catch(error => {
      console.error('Error fetching complaints:', error);
      document.getElementById('complaintList').innerHTML = '<p>Error loading complaints. Please try again later.</p>';
    });
}

// Function to show detailed complaint view
function showComplaintDetail(complaint) {
  currentComplaint = complaint;
  const complaintList = document.getElementById('complaintList');
  const complaintDetail = document.getElementById('complaintDetail');
  const editComplaintForm = document.getElementById('editComplaintForm');
  const complaintDetailContent = document.getElementById('complaintDetailContent');

  complaintList.style.display = 'none';
  editComplaintForm.style.display = 'none';
  complaintDetail.style.display = 'block';

  const createdAt = new Date(complaint.created_at).toLocaleString('en-US', { timeZone: 'Asia/Colombo' });
  let html = `
    <p><strong>Type:</strong> ${complaint.complaint_type === 'system' ? 'System Complaint' : 'Student Complaint'}</p>
    <p><strong>Subject:</strong> ${complaint.subject}</p>
    ${complaint.accused_id !== 1 ? `<p><strong>Student Index:</strong> ${complaint.index_number}</p>` : ''}
    <p><strong>Description:</strong> ${complaint.description}</p>
    <p><strong>Status:</strong> ${complaint.status || 'Pending'}</p>
    <p><strong>Created At:</strong> ${createdAt}</p>
  `;
  complaintDetailContent.innerHTML = html;
}

// Function to show the edit form
function editComplaint() {
  const complaintDetail = document.getElementById('complaintDetail');
  const editComplaintForm = document.getElementById('editComplaintForm');

  complaintDetail.style.display = 'none';
  editComplaintForm.style.display = 'block';

  console.log('Current complaint:', currentComplaint); // Debug log
  document.getElementById('editComplaintId').value = currentComplaint.id;
  document.getElementById('editComplaintType').value = currentComplaint.complaint_type;
  document.getElementById('editComplaintSubject').value = currentComplaint.subject;
  document.getElementById('editComplaintDescription').value = currentComplaint.description;
  document.getElementById('editStudentIndex').value = currentComplaint.index_number || '';

  toggleEditFormFields();
}



// Function to delete a complaint
function deleteComplaint() {
  if (!confirm('Are you sure you want to delete this complaint?')) {
    return;
  }

  fetch('/company_complaint/delete', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id: currentComplaint.id })
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showPopup('Complaint deleted successfully');
        hideComplaintDetail();
        fetchAndRenderComplaints();
      } else {
        showPopup('Failed to delete complaint', true);
      }
    })
    .catch(error => {
      console.error('Error deleting complaint:', error);
      showPopup('Error deleting complaint', true);
    });
}

// Function to hide detailed complaint view and show the list
function hideComplaintDetail() {
  const complaintList = document.getElementById('complaintList');
  const complaintDetail = document.getElementById('complaintDetail');
  const editComplaintForm = document.getElementById('editComplaintForm');

  complaintDetail.style.display = 'none';
  editComplaintForm.style.display = 'none';
  complaintList.style.display = 'block';
}

// Toggle between Complaint Form and View Complaint sections
function toggleSection(section) {
  const complaintFormTab = document.getElementById('complaintFormTab');
  const viewComplaintTab = document.getElementById('viewComplaintTab');
  const complaintFormSection = document.getElementById('complaintFormSection');
  const viewComplaintSection = document.getElementById('viewComplaintSection');

  if (section === 'complaintForm') {
    complaintFormTab.classList.add('active');
    viewComplaintTab.classList.remove('active');
    viewComplaintSection.classList.remove('active');
    viewComplaintSection.style.display = 'none';
    complaintFormSection.style.display = 'block';
    setTimeout(() => complaintFormSection.classList.add('active'), 10);
  } else {
    viewComplaintTab.classList.add('active');
    complaintFormTab.classList.remove('active');
    complaintFormSection.classList.remove('active');
    complaintFormSection.style.display = 'none';
    viewComplaintSection.style.display = 'block';
    setTimeout(() => viewComplaintSection.classList.add('active'), 10);
    fetchAndRenderComplaints();
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

// Handle complaint type change for create form
document.getElementById('complaintType').addEventListener('change', toggleFormFields);

// Handle complaint type change for edit form
document.getElementById('editComplaintType').addEventListener('change', toggleEditFormFields);

// Check for success or error message on page load
window.onload = () => {
  toggleSection('complaintForm');
  const urlParams = new URLSearchParams(window.location.search);
  const successMessage = urlParams.get('success');
  const errorMessage = urlParams.get('error');

  if (successMessage) {
    showPopup(decodeURIComponent(successMessage));
    toggleSection('viewComplaint');
  } else if (errorMessage) {
    showPopup(decodeURIComponent(errorMessage), true);
  }
};

// Handle edit form submission
document.getElementById('editForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  const data = Object.fromEntries(formData);
  console.log('Form data:', data); // Log the data being sent

  fetch('/company_complaint/edit', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showPopup('Complaint updated successfully');
        fetchAndRenderComplaints();
        hideComplaintDetail();
      } else {
        showPopup(data.error || 'Failed to update complaint', true);
      }
    })
    .catch(error => {
      console.error('Error updating complaint:', error);
      showPopup('Error updating complaint', true);
    });
});
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>