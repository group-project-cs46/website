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
      <div class="complaint-system-txt">
        <h3>Complain Form</h3>
        <p>Details About Complaint</p>
      </div>
    </div>

    <form class="form-container show" id="complaintForm">
      <h2>Complaint Details</h2>
      <label for="complaintType">Complaint Type</label>
      <select id="complaintType" class="select-input" required>
        <option value="" disabled selected>Select complaint type</option>
        <option value="system">System Complaint</option>
        <option value="student">Student Complaint</option>
      </select>

      <label for="complaintDescription">Complaint Description</label>
      <textarea id="complaintDescription" placeholder="Enter complaint description here" required></textarea>

      <button type="button" class="submit-btn" onclick="submitComplaint()">Submit</button>
    </form>
  </section>

  <!-- Popup Overlay for Success Message -->
  <div class="popup-overlay" id="popupOverlay">
    <p id="popupMessage">Your complaint has been submitted successfully.</p>
  </div>
</main>

<script>
  function submitComplaint() {
    const complaintType = document.getElementById('complaintType').value;
    const complaintDescription = document.getElementById('complaintDescription').value;

    if (!complaintType || complaintDescription.trim() === '') {
      alert('Please fill out all fields before submitting.');
      return;
    }

    // Simulate an AJAX request or server-side handling
    const responseMessage = `You ${complaintType} complaint has been submitted successfully.`;

    // Show success popup
    showPopup(responseMessage);

    // Clear form fields
    document.getElementById('complaintType').value = '';
    document.getElementById('complaintDescription').value = '';
  }

  function showPopup(message) {
    const popupOverlay = document.getElementById('popupOverlay');
    const popupMessage = document.getElementById('popupMessage');

    popupMessage.textContent = message;
    popupOverlay.style.display = 'flex';

    setTimeout(() => {
      popupOverlay.style.display = 'none';
    }, 3000);
  }
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
