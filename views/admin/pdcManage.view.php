<?php require base_path('views/partials/auth/auth.php'); ?>



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
                <?php foreach ($PDC_data as $pdc): ?>
                    <tr>
                        <td><?= $pdc['employee_id'] ?></td>
                        <td><?= $pdc['title'] ?></td>
                        <td><?= $pdc['name'] ?></td>
                        <td><?= $pdc['contact_no'] ?></td>
                        <td><?= $pdc['email'] ?></td>
                        <td class="actions">
                        <a href="/pdcEdit?id=<?= $pdc['employee_id'] ?>" class="view-button">Edit</a>
                        <form action="/pdcUpdationDisabletion" method="post">
                            <input type="hidden" name="id" value="<?= $pdc['employee_id'] ?>">
                            <input type="hidden" name="status" value="<?= $pdc['is_disabled'] ? 0 : 1 ?>">
                            <button type="submit" class="disable-button"><?= $pdc['is_disabled'] ? "Enable" : "Disable" ?></button>  
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </section>
</main>



<?php require base_path('views/partials/auth/auth-close.php') ?>