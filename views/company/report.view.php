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

        <div class="form-field">
  <label for="upload-report">Upload Report :</label>
  <div class="custom-file-upload">
    <label for="upload-report">
      <span id="file-name">No file chosen</span>
      <i class="fa-solid fa-file-import upload-icon"></i>
    </label>
    <input type="file" id="upload-report" style="display: none;" />
  </div>
</div>
 

        <button class="submit-btn" type="submit">Submit</button>
      </form>
    </div>
  </section>
</main>

<script>
  document.getElementById("upload-report").addEventListener("change", function () {
    const fileInput = this;
    const fileNameDisplay = document.getElementById("file-name");

    if (fileInput.files.length > 0) {
      fileNameDisplay.textContent = fileInput.files[0].name; // Update with selected file name
    } else {
      fileNameDisplay.textContent = "No file chosen"; // Reset if no file is selected
    }
  });

  function handleSubmit(event) {
    event.preventDefault();
    const name = document.getElementById("name").value;
    const indexNo = document.getElementById("indexNo").value;
    const email = document.getElementById("email").value;
    const reportFile = document.getElementById("upload-report").files[0];

    if (name && indexNo && email && reportFile) {
      alert("Report submitted successfully!");
      console.log("Student Name:", name);
      console.log("Index No.:", indexNo);
      console.log("E-Mail:", email);
      console.log("Uploaded Report:", reportFile.name);

      document.querySelector(".form-content").reset();
      document.getElementById("file-name").textContent = "No file chosen"; // Reset file display
    } else {
      alert("Please fill out all fields and upload the report.");
    }
  }
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
