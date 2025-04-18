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
        <p>Upload reports to PDC</p>
      </div>
    </div>

    <div class="form-container">
      <div>
        <h2>Report Details</h2>
      </div>

      <form class="form-content" id="reportForm" method="POST" action="/company_report/store" enctype="multipart/form-data">
        <div class="form-field">
          <label for="studentName">Student Name :</label>
          <input type="text" id="studentName" name="student_name" placeholder="Enter Name Here" required />
        </div>

        <div class="form-field">
          <label for="indexNumber">Student Index No. :</label>
          <input type="text" id="indexNumber" name="index_number" placeholder="Enter Index No. Here" required />
        </div>

        <div class="form-field">
          <label for="studentEmail">Student E-Mail :</label>
          <input type="email" id="studentEmail" name="student_email" placeholder="Enter E-Mail Here" required />
        </div>
        <!-- File Upload Fields for PDF Reports -->
        <?php for ($i = 1; $i <= 6; $i++): ?>
          <div class="form-field">
            <label for="upload-report-<?php echo $i; ?>">Upload Report <?php echo $i; ?> (PDF Only):</label>
            <input type="file" id="upload-report-<?php echo $i; ?>" name="report<?php echo $i; ?>" accept=".pdf" />
          </div>
        <?php endfor; ?>
        <button class="submit-btn" type="submit">Submit</button>
      </form>
    </div>
  </section>
</main>

<script>
  document.getElementById('reportForm').addEventListener('submit', function(event) {
    let isValid = true;

    // Validate file format
    for (let i = 1; i <= 6; i++) {
      const fileInput = document.getElementById(`upload-report-${i}`);
      if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        if (file.type !== "application/pdf") {
          alert(`Report ${i} must be a PDF file.`);
          isValid = false;
          break;
        }
      }
    }

    if (!isValid) {
      event.preventDefault(); // Stop form submission
    }
  });
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>