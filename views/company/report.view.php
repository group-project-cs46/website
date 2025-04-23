<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/report.css" />

<main class="main-content">
  <header class="header">
    <div class="above">
      <div class="above-left">
        <i class="fa-solid fa-file-invoice" style="font-size: 40px;"></i>
        <h2>Reports</h2>
      </div>
    </div>
  </header>

  <section class="content">
    <div class="table-title">
      <div id="reportTab" class="table-title-txt active" onclick="toggleSection('report')">
        <h3>Upload Reports</h3>
        <p>Upload reports to PDC</p>
      </div>
      <div class="divider"></div>
      <div id="viewReportTab" class="report-view-txt" onclick="toggleSection('viewReport')">
        <h3>View Reports</h3>
        <p>View Report Details</p>
      </div>
    </div>

    <div id="reportSection" class="report-section active">
      <div class="form-container">
        <div>
          <h2>Upload Reports</h2>
        </div>
        <form class="form-content" id="reportForm" method="POST" action="/company_report/store" enctype="multipart/form-data">
          <div class="form-field">
            <label for="indexNumber">Student Index No.:</label>
            <input type="text" id="indexNumber" name="index_number" placeholder="Enter Index No. Here" required />
            <?php if (isset($errors['index_number'])): ?>
              <p class="error"><?= $errors['index_number'] ?></p>
            <?php endif; ?>
          </div>
          <?php for ($i = 1; $i <= 6; $i++): ?>
            <div class="form-field">
              <label for="upload-report-<?php echo $i; ?>">Upload Report <?php echo $i; ?> (PDF Only):</label>
              <input type="file" id="upload-report-<?php echo $i; ?>" name="report<?php echo $i; ?>" accept=".pdf" required />
              <?php if (isset($errors["report{$i}"])): ?>
                <p class="error"><?= $errors["report{$i}"] ?></p>
              <?php endif; ?>
            </div>
          <?php endfor; ?>
          <button class="submit-btn" type="submit">Submit</button>
        </form>
      </div>
    </div>

    <!-- Updated View Reports Section -->
    <div id="viewReportSection" class="report-section">
      <div class="view-report-container">
        <table class="report-table">
          <thead>
            <tr>
              <th>Student Index No.</th>
              <th>Download</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Group reports by student index number
            $grouped_reports = [];
            if (isset($reports) && !empty($reports)) {
              foreach ($reports as $report) {
                $index_number = $report['index_number'] ?? 'N/A';
                $grouped_reports[$index_number][] = $report;
              }
            }

            if (empty($grouped_reports)): ?>
              <tr>
                <td colspan="3" style="text-align: center; padding: 10px;">
                  No reports found.
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($grouped_reports as $index_number => $student_reports): ?>
                <tr>
                  <td><?php echo htmlspecialchars($index_number); ?></td>
                  <td>
                    <a href="/company_report/download_all?index_number=<?= urlencode($index_number) ?>" target="_blank" class="button">Download</a>
                  </td>
                  <td>
                    <form action="/company_report/delete_all" method="POST" onsubmit="return confirmDelete('<?php echo htmlspecialchars($index_number); ?>');">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="index_number" value="<?= htmlspecialchars($index_number) ?>">
                      <button type="submit" class="button is-red">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="popup-overlay" id="popupOverlay" style="display: none;">
      <p id="popupMessage"></p>
    </div>
  </section>
</main>

<script>
  document.getElementById('reportForm').addEventListener('submit', function(event) {
    let isValid = true;
    for (let i = 1; i <= 6; i++) {
      const fileInput = document.getElementById(`upload-report-${i}`);
      if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        if (file.type !== "application/pdf") {
          alert(`Report ${i} must be a PDF file.`);
          isValid = false;
          break;
        }
      } else {
        alert(`Report ${i} is required.`);
        isValid = false;
        break;
      }
    }
    if (!isValid) {
      event.preventDefault();
    }
  });

  function toggleSection(section) {
    const reportTab = document.getElementById('reportTab');
    const viewReportTab = document.getElementById('viewReportTab');
    const reportSection = document.getElementById('reportSection');
    const viewReportSection = document.getElementById('viewReportSection');

    if (section === 'report') {
      reportTab.classList.add('active');
      viewReportTab.classList.remove('active');
      viewReportSection.classList.remove('active');
      viewReportSection.style.display = 'none';
      reportSection.style.display = 'block';
      setTimeout(() => reportSection.classList.add('active'), 10);
    } else {
      viewReportTab.classList.add('active');
      reportTab.classList.remove('active');
      reportSection.classList.remove('active');
      reportSection.style.display = 'none';
      viewReportSection.style.display = 'block';
      setTimeout(() => viewReportSection.classList.add('active'), 10);
    }
  }

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

  // Add confirmation dialog for delete action
  function confirmDelete(indexNumber) {
    return confirm(`Are you sure you want to delete all reports for student ${indexNumber}?`);
  }

  window.onload = () => {
    toggleSection('report');
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('success');
    const errorMessage = urlParams.get('error');

    if (successMessage) {
      showPopup(decodeURIComponent(successMessage));
      toggleSection('viewReport');
    } else if (errorMessage) {
      showPopup(decodeURIComponent(errorMessage), true);
    }
  };
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>