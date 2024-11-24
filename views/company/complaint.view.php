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
<!-- 
  <section class="content">
    <div class="complaint-title">
      <div class="complaint-system-txt" id="systemTab">
        <h3>Complain Form</h3>
        <p>Complaint description</p>
      </div>

      <div class="complaint-box" id="systemComplaintContent">
        <h2>Complaint Details</h2>
        <textarea id="systemComplaintText" placeholder="Describe the system issue"></textarea>
        <button class="submit-btn" onclick="submitComplaint('system')">Submit</button>
      </div>


  </section> -->
  <section class="content">
          <div class="complaint-title">
            <div class="complaint-system-txt">
              <h3>Complain Form</h3>
              <p>Complaint description</p>
            </div>>
          </div>

          <div class="complaint-box">
            <div>
              <h2>Complaint Details</h2>
            </div>
            <textarea placeholder="Description"></textarea>
            <button class="submit-btn">Submit</button>
          </div>
        </section>

  <!-- Popup Overlay for Success Message -->
  <div class="popup-overlay" id="popupOverlay">
    <p id="popupMessage">Your complaint has been submitted successfully.</p>
  </div>
</main>

<script>
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
    const responseMessage = ' complaint has been submitted successfully.';

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