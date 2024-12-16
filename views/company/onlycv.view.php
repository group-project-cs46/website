<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/cv.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-file-invoice" style="font-size: 40px;"></i>
                <h2>Student's CV</h2>
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
                <h3>Student's CV</h3>
                <p>Manage students CV</p>
            </div>
        </div>
        <div class="form-container">
            <img src="/assests/CV.png" alt="Student CV">
            <div class="button-container">
                <!-- Back button stays as it is -->
                <button class="submit-btn" type="button" onclick="window.location.href = '/company/list';">Back</button>


            </div>
        </div>
    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>


