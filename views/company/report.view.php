<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/report.css" />

<main class="main-content">
  <header class="header">
    <div class="above">
      <div class="above-left">
        <i class="fa-solid fa-file-invoice" style="font-size: 40px;"></i>
        <h2>Report</h2>
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
        <h3>Report</h3>
        <p>Report to PDC about students</p>
      </div>
    </div>
    <div class="form-container">
      <div>
        <h2>Details about Report</h2>
      </div>
      <form class="form-content" onsubmit="handleSubmit(event)">
        <div class="form-field">
          <label for="name">Student Name :</label>
          <input type="text" id="name" placeholder="Enter Name Here" />
        </div>

        <div class="form-field">
          <label for="indexNo">Student Index No. :</label>
          <input type="text" id="indexNo" placeholder="Enter Index No. Here" />
        </div>

        <div class="form-field">
          <label for="email">Student E-Mail :</label>
          <input type="email" id="email" placeholder="Enter E-Mail Here" />
        </div>

        <!-- Unique upload fields -->
        <div class="form-field">
          <label for="upload-report-1">Upload Report 1:</label>
          <div class="custom-file-upload">
            <label for="upload-report-1">
              <span id="file-name-1">No file chosen</span>
              <i class="fa-solid fa-file-import upload-icon"></i>
            </label>
            <input type="file" id="upload-report-1" style="display: none;" />
          </div>
        </div>

        <div class="form-field">
          <label for="upload-report-2">Upload Report 2:</label>
          <div class="custom-file-upload">
            <label for="upload-report-2">
              <span id="file-name-2">No file chosen</span>
              <i class="fa-solid fa-file-import upload-icon"></i>
            </label>
            <input type="file" id="upload-report-2" style="display: none;" />
          </div>
        </div>

        <div class="form-field">
          <label for="upload-report-3">Upload Report 3:</label>
          <div class="custom-file-upload">
            <label for="upload-report-3">
              <span id="file-name-3">No file chosen</span>
              <i class="fa-solid fa-file-import upload-icon"></i>
            </label>
            <input type="file" id="upload-report-3" style="display: none;" />
          </div>
        </div>

        <div class="form-field">
          <label for="upload-report-4">Upload Report 4:</label>
          <div class="custom-file-upload">
            <label for="upload-report-4">
              <span id="file-name-4">No file chosen</span>
              <i class="fa-solid fa-file-import upload-icon"></i>
            </label>
            <input type="file" id="upload-report-4" style="display: none;" />
          </div>
        </div>

        <div class="form-field">
          <label for="upload-report-5">Upload Report 5:</label>
          <div class="custom-file-upload">
            <label for="upload-report-5">
              <span id="file-name-5">No file chosen</span>
              <i class="fa-solid fa-file-import upload-icon"></i>
            </label>
            <input type="file" id="upload-report-5" style="display: none;" />
          </div>
        </div>

        <div class="form-field">
          <label for="upload-report-6">Upload Report 6:</label>
          <div class="custom-file-upload">
            <label for="upload-report-6">
              <span id="file-name-6">No file chosen</span>
              <i class="fa-solid fa-file-import upload-icon"></i>
            </label>
            <input type="file" id="upload-report-6" style="display: none;" />
          </div>
        </div>

        <button class="submit-btn" type="submit">Submit</button>
      </form>
    </div>
  </section>
</main>

<script>
  // Function to handle file name display for all upload fields
  function setupFileUploadHandlers() {
    for (let i = 1; i <= 6; i++) {
      document.getElementById(`upload-report-${i}`).addEventListener("change", function() {
        const fileInput = this;
        const fileNameDisplay = document.getElementById(`file-name-${i}`);
        if (fileInput.files.length > 0) {
          fileNameDisplay.textContent = fileInput.files[0].name;
        } else {
          fileNameDisplay.textContent = "No file chosen";
        }
      });
    }
  }

  function handleSubmit(event) {
    event.preventDefault();

    // Get form values
    const name = document.getElementById("name").value.trim();
    const indexNo = document.getElementById("indexNo").value.trim();
    const email = document.getElementById("email").value.trim();
    const files = [];

    for (let i = 1; i <= 6; i++) {
      const fileInput = document.getElementById(`upload-report-${i}`).files[0];
      if (fileInput) {
        files.push(fileInput.name);
      }
    }

    if (!name || !indexNo || !email || files.length === 0) {
      alert("Please fill out all fields and upload at least one report.");
      return;
    }
    setTimeout(() => {
      window.location.reload();
    }, 500);
    alert(`Report submitted successfully`);
  }

  // Initialize file upload handlers
  setupFileUploadHandlers();
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>