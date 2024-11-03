<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/BlacklistedCompanies.css" />

<main class="main-content">
            <header class="header">
                <div class="above">
                <i class="fas fa-ban" style="font-size: 40px;"></i>
                <h2><b>Company Blacklisting</b></h2>
                </div>
                <input type="text" placeholder="Search Company..." class="search-bar">
            </header>

            <section class="content">
                <div class="table-title">
                    <div class="table-title-txt">
                        <h3><b>Blacklisted Companies</b></h3>
                        <p>View Blacklisted Companies</p>
                    </div>
                    <div class="right-buttons">
                    <button class="add-button">+</button>
                    </div>
                </div>

                <table class="blacklist-table">
                    <thead>
                        <tr>
                            <th>Blacklisted Companies</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Company1</td>
                            <td>company1@gmail.com</td>
                        </tr>
                    </tbody>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Company2</td>
                            <td>company2@gmail.com</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Company3</td>
                            <td>company3@gmail.com</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Company4</td>
                            <td>company4@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>

        <?php require base_path('views/partials/auth/auth-close.php') ?>
