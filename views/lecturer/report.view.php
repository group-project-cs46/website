<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/report.css" />

<div class="mmm">
    <main class="main-content">
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-file-lines" style="font-size: 40px;"></i>
                <h2><b>Create Report</b></h2>
            </div>
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Create Company Report</b></h3>
                    <p>Fill out the report details below</p>
                </div>
            </div>

            <form class="report-form" method="post" action="/reportStore" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="companyName">Company Name</label>
                    <input type="text" id="companyName" name="companyName" placeholder="Enter company name" required>
                </div>

                <div class="form-group">
                    <label for="companyID">Company ID No</label>
                    <input type="text" id="companyID" name="companyID" placeholder="Enter company ID" required>
                </div>

                <div class="form-group">
                    <label for="internStudents">Intern Students</label>
                    <input type="number" id="internStudents" name="internStudents" placeholder="Enter number of intern students" required>
                </div>

                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea id="note" name="note" placeholder="Enter any additional notes" required></textarea>
                </div>

                <div class="form-group">
                    <label for="imageUpload">Upload File</label>
                    <input type="file" id="imageUpload" name="imageUpload" accept="image/*">
                </div>

                <div class="form-buttons">
                    <button type="button" class="disable-button" onclick="window.location='/reportMain'">Close</button>
                    <button type="submit" class="enable-button">Submit</button>
                </div>
            </form>
        </section>
    </main>
</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>
