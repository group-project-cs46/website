<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/company/account.css" />

<main class="main-content">
  <header class="header">
    <div class="above">
      <div class="above-left">
        <i class="fa-solid fa-user" style="font-size: 40px;"></i>
        <h2>Account</h2>
      </div>
      <div class="above-right">
        <div class="company-info">
          <i class="fa-regular fa-building" style="font-size: 40px;"></i>
          <div class="company-name">Creative<br />Software</div>
        </div>
        <div>
          <i class="fa-solid fa-bell" style="font-size: 40px;"></i>
        </div>
      </div>
    </div>
  </header>

  <section class="content">
    <div class="table-title">
      <div class="table-title-txt">
        <h3>Company Details</h3>
        <p>View and manage company information</p>
      </div>
    </div>

    <!-- Form container -->
    <div class="form-container">
      <div class="form-header">
        <h2 class="form-title">Details about the Company</h2>
        <i
          class="fa-regular fa-pen-to-square edit-icon"
          title="Edit Details"
          onclick="toggleEditMode()"
        ></i>
      </div>

      <form id="companyDetailsForm" onsubmit="handleSubmit(event)">
        <div class="form-content">
          <!-- Company Name -->
          <div class="form-field">
            <label for="companyName">Company Name:</label>
            <input
              type="text"
              id="companyName"
              value="Creative Software"
              disabled />
          </div>

          <!-- Company Address -->
          <div class="form-field">
            <label style="font-size: 16px;">Company Address:</label>
            <div class="address-group">
              <input
                type="text"
                id="buildingName"
                value="Building A"
                placeholder="Building Name"
                disabled />
              <input
                type="text"
                id="streetName"
                value="Main Street"
                placeholder="Street Name"
                disabled />
            </div>
            <div class="address-group">
              <input
                type="text"
                id="city"
                value="New York"
                placeholder="City"
                disabled />
              <input
                type="text"
                id="postalCode"
                value="10001"
                placeholder="Postal Code"
                disabled />
            </div>
          </div>

          <!-- Email Address -->
          <div class="form-field">
            <label for="email">Company Email Address:</label>
            <input
              type="email"
              id="email"
              value="info@creativesoftware.com"
              disabled />
          </div>

          <!-- Website URL -->
          <div class="form-field">
            <label for="website">Company Website URL:</label>
            <input
              type="url"
              id="website"
              value="https://www.creativesoftware.com"
              disabled />
          </div>

          <!-- Contact Number -->
          <div class="form-field">
            <label for="contact">Contact No.:</label>
            <input
              type="text"
              id="contact"
              value="+1 234 567 890"
              disabled />
          </div>

          <!-- Password -->
          <div class="form-field">
            <label for="password">Password:</label>
            <input
              type="password"
              id="password"
              value="password123"
              disabled />
          </div>

          <button
            type="submit"
            id="saveChangesBtn"
            class="submit-btn"
            style="display: none;">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </section>
</main>

<script>
  function toggleEditMode() {
    const formFields = document.querySelectorAll('#companyDetailsForm input');
    const saveButton = document.getElementById('saveChangesBtn');

    // Enable or disable all form fields for editing
    formFields.forEach((field) => {
      field.disabled = !field.disabled;
    });

    // Show or hide the Save button
    saveButton.style.display = formFields[0].disabled ? 'none' : 'block';
  }

  function handleSubmit(event) {
    event.preventDefault(); // Prevent default form submission behavior

    const formData = new FormData(document.getElementById('companyDetailsForm'));

    // Simulate saving changes and updating fields dynamically
    formData.forEach((value, key) => {
      const inputField = document.getElementById(key);
      if (inputField) {
        inputField.value = value; // Update values dynamically
      }
    });

    // Re-disable fields after saving changes
    toggleEditMode();
    alert('Changes saved successfully!');
  }
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
