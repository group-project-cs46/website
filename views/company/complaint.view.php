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
    <section class="complaint-form-section active" id="complaintFormSection">
      <div class="form-container">
        <div>
          <h2>Upload Complaint</h2>
        </div>
        <form class="form-content" id="complaintForm" method="POST" action="/company_complaint/store">
          <div class="form-field">
            <label for="complaintType">Complaint Type:</label>
            <select id="complaintType" name="complaint_type" class="select-input" required>
              <option value="" disabled selected>Select complaint type</option>
              <option value="system">System Complaint</option>
              <option value="student">Student Complaint</option>
            </select>
          </div>

          <div class="form-field" id="subjectField">
            <label for="complaintSubject">Subject of Complaint:</label>
            <input type="text" id="complaintSubject" name="subject" placeholder="Enter subject of complaint" required>
          </div>

          <div class="form-field" id="indexField" style="display: none;">
            <label for="studentIndex">Student Index Number:</label>
            <input type="text" id="studentIndex" name="index_no" placeholder="Enter student index number (e.g., 22001432)">
          </div>

          <div class="form-field" id="descriptionField">
            <label for="complaintDescription">Complaint Description:</label>
            <textarea id="complaintDescription" name="complaint_description" placeholder="Enter complaint description here" required style="flex-grow: 1; min-width: 400px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;"></textarea>
          </div>

          <button type="submit" class="submit-btn">Submit</button>
        </form>
      </div>
    </section>

    <!-- View Complaint Section -->
    <section class="complaint-view-section" id="viewComplaintSection">
      <div class="view-complaint-container">
        <h2>View Complaints</h2>
        <table class="complaint-table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Subject</th>
              <th>Description</th>
              <th>Status</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody id="complaintTableBody">
            <tr>
              <td colspan="6" style="text-align: center; padding: 10px;">
                No complaints found.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Edit Complaint Modal -->
    <div class="modal-overlay" id="editModal" style="display: none;">
      <div class="modal-content">
        <h3>Edit Complaint</h3>
        <form id="editForm">
          <input type="hidden" id="editComplaintId" name="id">
          <label for="editComplaintType">Complaint Type:</label>
          <select id="editComplaintType" name="complaint_type" class="select-input" required>
            <option value="system">System Complaint</option>
            <option value="student">Student Complaint</option>
          </select>

          <div id="editSubjectField">
            <label for="editComplaintSubject">Subject of Complaint:</label>
            <input type="text" id="editComplaintSubject" name="subject" placeholder="Enter subject of complaint" required>
          </div>

          <div id="editIndexField" style="display: none;">
            <label for="editStudentIndex">Student Index Number:</label>
            <input type="text" id="editStudentIndex" name="index_no" placeholder="Enter student index number (e.g., 22001432)">
          </div>

          <div id="editDescriptionField">
            <label for="editComplaintDescription">Complaint Description:</label>
            <textarea id="editComplaintDescription" name="complaint_description" placeholder="Enter complaint description here" required style="width: 100%; min-height: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;"></textarea>
          </div>

          <div class="modal-actions">
            <button type="submit" class="submit-btn">Update</button>
            <!-- <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button> -->
          </div>
        </form>
      </div>
    </div>

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

// Function to fetch and render complaints in a table
function fetchAndRenderComplaints() {
  fetch('/company/complaint/list', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => {
      const complaintTableBody = document.getElementById('complaintTableBody');
      // Check if the request failed
      if (!data.success) {
        complaintTableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 10px;">Failed to fetch complaints. Please try again later.</td></tr>';
        return;
      }
      // Check if there are no complaints
      if (data.complaints.length === 0) {
        complaintTableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 10px;">No complaints found.</td></tr>';
        return;
      }
      // Render complaints in table
      let html = '';
      data.complaints.forEach(complaint => {
        html += `
          <tr>
            <td>${complaint.complaint_type === 'system' ? 'System Complaint' : 'Student Complaint'}</td>
            <td>${complaint.subject}</td>
            <td>${complaint.description}</td>
            <td>${complaint.status || 'Pending'}</td>
            <td>
              <button class="button" onclick='openEditModal(${JSON.stringify(complaint)})'>Edit</button>
            </td>
            <td>
              <button class="button is-red" onclick='deleteComplaint(${complaint.id})'>Delete</button>
            </td>
          </tr>
        `;
      });
      complaintTableBody.innerHTML = html;
    })
    .catch(error => {
      console.error('Error fetching complaints:', error);
      document.getElementById('complaintTableBody').innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 10px;">Error loading complaints. Please try again later.</td></tr>';
    });
}

// Function to open the edit modal
function openEditModal(complaint) {
  currentComplaint = complaint;
  const editModal = document.getElementById('editModal');

  document.getElementById('editComplaintId').value = complaint.id;
  document.getElementById('editComplaintType').value = complaint.complaint_type;
  document.getElementById('editComplaintSubject').value = complaint.subject;
  document.getElementById('editComplaintDescription').value = complaint.description;
  document.getElementById('editStudentIndex').value = complaint.index_number || '';

  toggleEditFormFields();
  editModal.style.display = 'flex';
}

// Function to close the edit modal
function closeEditModal() {
  const editModal = document.getElementById('editModal');
  editModal.style.display = 'none';
}

// Function to delete a complaint
function deleteComplaint(id) {
  if (!confirm('Are you sure you want to delete this complaint?')) {
    return;
  }

  fetch('/company_complaint/delete', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id: id })
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showPopup('Complaint deleted successfully');
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

// Handle edit form submission
document.getElementById('editForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  const data = Object.fromEntries(formData);

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
        closeEditModal();
        fetchAndRenderComplaints();
      } else {
        showPopup(data.error || 'Failed to update complaint', true);
      }
    })
    .catch(error => {
      console.error('Error updating complaint:', error);
      showPopup('Error updating complaint', true);
    });
});

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
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>