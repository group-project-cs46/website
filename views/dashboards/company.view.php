<?php require base_path('views/partials/auth/auth.php') ?>
<link rel="stylesheet" href="/styles/company/dashboard.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-gauge" style="font-size: 40px;"></i>
                <h2>Dashboard</h2>
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
        <div class="content-title">
            <h2>Company Dashboard</h2>
        </div>
        <div class="content-boxes">
            <div class="box">
                <h3>Applied students</h3>
                <h3>50</h3>
            </div>
            <div class="box">
                <h3>Selected students</h3>
                <h3>20</h3>
            </div>

            <div class="box">
                <h3>Next Techtalk Date</h3>
                <h3>15.08.2024</h3>
                <h3>3.00 P.M</h3>
            </div>
        </div>
        <div class="table-title">
            <div class="table-title-txt">
                <h3>Applied students</h3>
            </div>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Index No.</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Thathsara</td>
                    <td>200132444</td>
                    <td>company1@gmail.com</td>
                    <td><button class="view-button">View</button></td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>Thathsara</td>
                    <td>200132444</td>
                    <td>company1@gmail.com</td>
                    <td><button class="view-button">View</button></td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>Thathsara</td>
                    <td>200132444</td>
                    <td>company1@gmail.com</td>
                    <td><button class="view-button">View</button></td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>Thathsara</td>
                    <td>200132444</td>
                    <td>company1@gmail.com</td>
                    <td><button class="view-button">View</button></td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>