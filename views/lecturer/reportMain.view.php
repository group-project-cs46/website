<?php require base_path('views/partials/auth/auth.php'); ?>



<link rel="stylesheet" href="/styles/pasindu/reportMain.css" />
<div class=" mmm">
    <main class="main-content">  
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2><b>Manage Reports</b></h2>
            </div>
            <input type="text" placeholder="Search Complaints..." class="search-bar" id="searchInput" onkeyup="searchTable()">
            
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Reports</b></h3>
                    <p>Manage Company Reports</p>
                </div>
                <button class="add-button" id="openFormButton"><a href="/report">Create New</a></button>
            </div>
            
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    
                    <?php foreach ($LECTURER_VISIT as $lecturer_visit): ?>
                        <tr>
                            <td><?= $lecturer_visit['employee_id'] ?></td>            
                            <td class="actions">
                                <a href="/reportView?id=<?= $lecturer_visit['id'] ?>" class="view-button">Edit</a>
                                <form action="/reportDeletion" method="post">
                                    <input type="hidden" name="id" value="<?= $lecturer['id'] ?>">
                                    <button type="submit" class="disable-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?> 

                </tbody>
            </table>
        </section>
    </main>

    <script>
    function searchTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const table = document.getElementById("studentTableBody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            let rowText = rows[i].textContent.toLowerCase();
            rows[i].style.display = rowText.includes(filter) ? "" : "none";
        }
    }
</script>

</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>