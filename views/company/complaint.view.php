<?php require base_path('views/partials/auth/auth.php') ; ?>

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

    <!-- Complaint Form (POST method to send data to storeComplaint.php) -->
    <form class="form-container show" id="complaintForm" method="POST" action="/company_complaint/store">
      <?php if (isset($_GET['error'])): ?>
        <div class="error-message">
          <p>Error: Please fill out all fields correctly.</p>
        </div>
      <?php endif; ?>

      <h2>Complaint Details</h2>

      <label for="complaintType">Complaint Type</label>
      <select id="complaintType" name="complaint_type" class="select-input" required>
        <option value="" disabled selected>Select complaint type</option>
        <option value="system">System Complaint</option>
        <option value="student">Student Complaint</option>
      </select>

      <label for="complaintDescription">Complaint Description</label>
      <textarea id="complaintDescription" name="complaint_description" placeholder="Enter complaint description here" required></textarea>

      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </section>

  <!-- Popup Overlay for Success Message -->
  <div class="popup-overlay" id="popupOverlay" style="display: none;">
    <p id="popupMessage">Your complaint has been submitted successfully.</p>
  </div>
</main>

<script>

  // Display success popup
  function showPopup(message) {
    const popupOverlay = document.getElementById('popupOverlay');
    const popupMessage = document.getElementById('popupMessage');

    popupMessage.textContent = message;
    popupOverlay.style.display = 'flex';

    setTimeout(() => {
      popupOverlay.style.display = 'none';
    }, 3000);
  }


   // Handle form submission and show success message
   //const form = document.getElementById('complaintForm');
  //form.addEventListener('submit', function(event) {
    //event.preventDefault(); // Prevent default form submission

    //const complaintType = document.getElementById('complaintType').value;
    //const complaintDescription = document.getElementById('complaintDescription').value;

    //if (!complaintType || complaintDescription.trim() === '') {
      // Do not submit the form, display an error message
      //window.location.href = '/complaint/form?error=true';
      //return;
    //}

    // Simulate form submission (can replace with an actual AJAX request or server-side handling)
   // const responseMessage = `Your ${complaintType} complaint has been submitted successfully.`;
    
    // Show success message
    //showPopup(responseMessage);

    // Optionally clear form
    //document.getElementById('complaintType').value = '';
    //document.getElementById('complaintDescription').value = '';
  //});

</script>
<?php require base_path('views/partials/auth/auth-close.php') ?>