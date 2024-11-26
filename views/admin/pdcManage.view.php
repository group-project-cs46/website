<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/pasindu/pdcManage.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-user-graduate" style="font-size: 40px;"></i>
            <h2><b>Manage PDC</b></h2>
        </div>
        <input type="text" placeholder="Search PDC Accounts..." class="search-bar" id="searchInput" onkeyup="searchTable()">
    </header>

    <section class="content">
        <div class="table-title">
            <div class="table-title-txt">
                <h3><b>Manage PDC</b></h3>
                <p>Manage PDC Accounts</p>
            </div>
            <button class="add-button" id="openFormButton"><a href="/pdcAdd">+ New</a></button>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <th>Employee No</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- Example Table Rows -->
                <tr>
                    <td>1001</td>
                    <td>Mr</td>
                    <td>Kasun Gunawardhana</td>
                    <td>0717248485</td>
                    <td>kasun@gmail.com</td>
                    <td>
                        <button class="Edit-button"><a href="/pdcEdit">Edit</a></button>
                        <button class="disable-button">Disable</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</main>



<?php require base_path('views/partials/auth/auth-close.php') ?>
