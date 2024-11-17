<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Dashboard.css" />

    <main class="main-content">
            <header class="header">
                <div class="above">
                    <div class="above-left">
                        <i class="fa fa-dashboard" style="font-size: 40px;"></i>
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </header>

            <section class="content">
                <div class="content-title">
                    <h2>PDC Dashboard</h2>
                </div>
                <div class="content-boxes">
                    <div class="box"><h3>Companies Registered</h3><h2>20</h2></div>
                    <div class="box"><h3>Blacklisted Companies</h3><h2>50</h2></div>
                    <div class="box"><h3>Number of Students Registered</h3><h2>15.08.2024</h2><p>3.00 P.M</p></div>
                </div>
                <div class="table-title">
                    <div class="table-title-txt">
                        <h3>Advertistments</h3>
                    </div>
                    <button class="view-button">View</button>
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
