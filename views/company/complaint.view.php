<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/complaint.css" />
<main class="main-content">
  <header class="header">
    <div class="above">
      <div class="above-left">
        <i class="fa-brands fa-readme" style="font-size: 40px;"></i>
        <h2>Complaint Management</h2>
      </div>

      <div class="above-right">
        <div class="company-info">
          <i class="fa-regular fa-building" style="font-size: 40px;"></i>
          <div class="company-name">
            Creative<br>Software
          </div>
        </div>

        <div>
          <i class="fa-solid fa-bell" style="font-size: 40px;"></i>
        </div>
      </div>
    </div>
  </header>

  <section class="content">
    <div class="complaint-title">
      <div class="complaint-system-txt" id="systemTab" onclick="toggleComplaint('system')">
        <h3>System Complaint</h3>
        <p>Complaint about System</p>
      </div>

      <div class="divider"></div>

      <div class="complaint-student-txt" id="studentTab" onclick="toggleComplaint('student')">
        <h3>Student Complaint</h3>
        <p>Complaint from students</p>
      </div>
    </div>

    <!-- System Complaint Form -->
    <div class="complaint-box" id="systemComplaintContent" style="display: none;">
      <h2>System Complaint Details</h2>
      <textarea id="systemComplaintText" placeholder="Describe the system issue"></textarea>
      <button class="submit-btn" onclick="submitComplaint('system')">Submit</button>
    </div>

    <!-- Student Complaint Form -->
    <div class="complaint-box" id="studentComplaintContent" style="display: none;">
      <h2>Student Complaint Details</h2>
      <textarea id="studentComplaintText" placeholder="Describe the student issue"></textarea>
      <button class="submit-btn" onclick="submitComplaint('student')">Submit</button>
    </div>
  </section>

  <!-- Popup Overlay for Success Message -->
  <div class="popup-overlay" id="popupOverlay">
    <p id="popupMessage">Your complaint has been submitted successfully.</p>
  </div>
</main>

<script>
  // Toggle complaint forms
  function toggleComplaint(complaintType) {
    const systemComplaintContent = document.getElementById('systemComplaintContent');
    const studentComplaintContent = document.getElementById('studentComplaintContent');

    // Hide both complaint boxes initially
    systemComplaintContent.style.display = 'none';
    studentComplaintContent.style.display = 'none';
    systemComplaintContent.classList.remove('show');
    studentComplaintContent.classList.remove('show');

    // Show and animate the selected complaint box
    if (complaintType === 'system') {
      systemComplaintContent.style.display = 'block';
      setTimeout(() => systemComplaintContent.classList.add('show'), 10);
    } else if (complaintType === 'student') {
      studentComplaintContent.style.display = 'block';
      setTimeout(() => studentComplaintContent.classList.add('show'), 10);
    }

    // Update active tab styles
    document.getElementById('systemTab').classList.toggle('active', complaintType === 'system');
    document.getElementById('studentTab').classList.toggle('active', complaintType === 'student');
  }

  // Initialize with system complaint tab selected
  window.onload = function() {
    toggleComplaint('system');
  };

  // Show popup overlay on submission
  function showPopup(message) {
    const popupOverlay = document.getElementById('popupOverlay');
    const popupMessage = document.getElementById('popupMessage');
    popupMessage.innerText = message;
    popupOverlay.style.display = 'flex';

    // Hide popup after 3 seconds
    setTimeout(() => {
      popupOverlay.style.display = 'none';
    }, 3000);
  }

  // Submit complaint dynamically
  function submitComplaint(complaintType) {
    let complaintText = '';

    // Get complaint text based on the selected type
    if (complaintType === 'system') {
      complaintText = document.getElementById('systemComplaintText').value;
    } else if (complaintType === 'student') {
      complaintText = document.getElementById('studentComplaintText').value;
    }

    // Validate if the complaint text is not empty
    if (complaintText.trim() === '') {
      alert('Please enter a complaint before submitting.');
      return;
    }

    // Simulate an AJAX request (no page reload)
    const responseMessage = 'Your ' + complaintType + ' complaint has been submitted successfully.';

    // Display the popup overlay message
    showPopup(responseMessage);

    // Clear the textarea
    if (complaintType === 'system') {
      document.getElementById('systemComplaintText').value = '';
    } else if (complaintType === 'student') {
      document.getElementById('studentComplaintText').value = '';
    }
  }
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
