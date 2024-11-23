<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/addAdvertisment.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <img src="report.svg" alt="Report Logo" width="40" height="40" />
                <h2>Student List</h2>
            </div>

            <div class="above-right">
                <div class="company-info">
                    <img
                        src="company.svg"
                        alt="manage Logo"
                        width="40"
                        height="40" />
                    <div class="company-name">Creative<br />Software</div>
                </div>

                <div>
                    <img src="bell.svg" alt="manage Logo" width="40" height="40" />
                </div>
            </div>
        </div>
    </header>

    <section class="content">
        <div class="table-title">
            <h3>Student's CV</h3>
            <p>Manage students CV</p>
        </div>
        <div class="form-container">

            <div class="button-container">
                <button class="submit-btn" type="submit">Select</button>
                <button class="submit-btn" type="submit">Pending</button>
                <button class="submit-btn" type="submit">Reject</button>
            </div>

        </div>
    </section>
</main>


<?php require base_path('views/partials/auth/auth-close.php') ?>