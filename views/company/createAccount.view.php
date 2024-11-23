<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/createAccount.css" />


<body>
  <div class="container">
    <div class="form-container">
      <h2>Create Account</h2>
      <div class="icon-placeholder">👤</div>
      <form id="createAccountForm" onsubmit="return handleFormSubmit(event)">
        <input type="text" id="companyName" placeholder="Company Name" required />
        <div class="address">
          <div class="address-label">Company Address</div>
          <div class="address-container">
            <input type="text" id="buildingName" placeholder="Building Name" required />
            <input type="text" id="streetName" placeholder="Street Name" required />
          </div>
          <div class="address-container">
            <input type="text" id="city" placeholder="City" required />
            <input type="text" id="postalCode" placeholder="Postal Code" required />
          </div>
        </div>
        <input type="email" id="email" placeholder="Company's Email Address" required />
        <input type="url" id="website" placeholder="Company Website URL" required />
        <input type="text" id="contactNo" placeholder="Contact No." required />
        <div class="password-field">
          <input type="password" id="password" placeholder="Password" required minlength="6" />
          <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('password')"></i>
        </div>
        <div class="password-field">
          <input type="password" id="confirmPassword" placeholder="Confirm Password" required minlength="6" />
          <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('confirmPassword')"></i>
        </div>
        <button type="submit">Create Account</button>
      </form>
      <h2>👤CS46</h2>
      <p class="terms">Privacy Policy . User Notice</p>
      <p class="terms">
        This site is protected by reCAPTCHA and the Google
        <a href="#">Privacy Policy</a> and
        <a href="#">Terms of Service</a> apply.
      </p>
    </div>
  </div>

  <script>
    // Add event listeners for blur events to validate when the user leaves the field
    document.getElementById("companyName").addEventListener("blur", validateCompanyName);
    document.getElementById("postalCode").addEventListener("blur", validatePostalCode);
    document.getElementById("email").addEventListener("blur", validateEmail);
    document.getElementById("website").addEventListener("blur", validateWebsite);
    document.getElementById("contactNo").addEventListener("blur", validateContactNo);
    document.getElementById("confirmPassword").addEventListener("blur", validatePasswordMatch);

    function validateCompanyName() {
      const companyName = document.getElementById("companyName");
      if (companyName.value.trim() === "") {
        alert("Company Name cannot be empty.");
        companyName.value = ""; // Clear the incorrect input
      }
    }

    function validatePostalCode() {
      const postalCode = document.getElementById("postalCode");
      if (!/^\d+$/.test(postalCode.value)) {
        alert("Please enter a valid postal code containing only numbers.");
        postalCode.value = ""; // Clear the incorrect input
      }
    }

    function validateEmail() {
      const email = document.getElementById("email");
      if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email.value)) {
        alert("Please enter a valid email address.");
        email.value = ""; // Clear the incorrect input
      }
    }

    function validateWebsite() {
      const website = document.getElementById("website");
      if (!/^https?:\/\/.+\..+$/.test(website.value)) {
        alert("Please enter a valid URL starting with http:// or https://.");
        website.value = ""; // Clear the incorrect input
      }
    }

    function validateContactNo() {
      const contactNo = document.getElementById("contactNo");
      if (!/^0\d{9}$/.test(contactNo.value)) {
        alert("Contact number should start with 0 and be exactly 10 digits.");
        contactNo.value = ""; // Clear the incorrect input
      }
    }

    function validatePasswordMatch() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword");
      if (confirmPassword.value && password !== confirmPassword.value) {
        alert("Passwords do not match.");
        confirmPassword.value = ""; // Clear the incorrect input
      }
    }

    function togglePasswordVisibility(fieldId) {
      const field = document.getElementById(fieldId);
      const icon = field.nextElementSibling;

      if (field.type === "password") {
        field.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        field.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  </script>


</body>
<?php require base_path('views/partials/auth/auth-close.php') ?>