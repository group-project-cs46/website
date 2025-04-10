<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/pasindu/lecturerManage.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fa-user-graduate" style="font-size: 40px;"></i>
            <h2><b>Manage Lecturer</b></h2>
        </div>
        <input type="text" placeholder="Search Lecturer Accounts..." class="search-bar" id="searchInput" onkeyup="searchTable()">
    </header>

    <section class="content">
        <div class="table-title">
            <div class="table-title-txt">
                <h3><b>Manage Lecturer</b></h3>
                <p>Manage Lecturer Accounts</p>
            </div>
            <button class="add-button" id="openFormButton"><a href="lecturerAdd">+ New</a></button>
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
                <!-- <tr>
                    <td>2020/UCSC/001</td>
                    <td>Mr</td>
                    <td>Kasun Gunawardhana</td>
                    <td>0717248485</td>
                    <td>kasun@gmail.com</td>
                    <td>
                        <button class="Edit-button"><a href="lecturerEdit">Edit</a></button>
                        <button class="disable-button">Disable</button>
                    </td>
                </tr>
                <tr>
                    <td>2020/UCSC/002</td>
                    <td>Mrs</td>
                    <td>Dinuni</td>
                    <td>0717248439</td>
                    <td>dinuni@gmail.com</td>
                    <td>
                        <button class="Edit-button"><a href="lecturerEdit">Edit</a></button>
                        <button class="disable-button">Disable</button>
                    </td>
                </tr>
                <tr>
                    <td>2020/UCSC/003</td>
                    <td>Mr</td>
                    <td>Manju</td>
                    <td>0717248987</td>
                    <td>manju@gmail.com</td>
                    <td>
                        <button class="Edit-button"><a href="lecturerEdit">Edit</a></button>
                        <button class="disable-button">Disable</button>
                    </td>
                </tr>
                <tr>
                    <td>2020/UCSC/004</td>
                    <td>Mrs</td>
                    <td>Lasanthi</td>
                    <td>0717248000</td>
                    <td>lasanthi@gmail.com</td>
                    <td>
                        <button class="Edit-button"><a href="lecturerEdit">Edit</a></button>
                        <button class="disable-button">Disable</button>
                    </td>
                </tr>
                <tr>
                    <td>2020/UCSC/005</td>
                    <td>Mr</td>
                    <td>Kasun De Soyza</td>
                    <td>0717248083</td>
                    <td>kasunde@gmail.com</td>
                    <td>
                        <button class="Edit-button"><a href="lecturerEdit">Edit</a></button>
                        <button class="disable-button">Disable</button>
                    </td>
                </tr>
                <tr>
                    <td>2020/UCSC/00</td>
                    <td>Mr</td>
                    <td>Keneth</td>
                    <td>0717248290</td>
                    <td>keneth@gmail.com</td>
                    <td>
                        <button class="Edit-button"><a href="lecturerEdit">Edit</a></button>
                        <button class="disable-button">Disable</button>
                    </td>
                </tr> -->
                <?php foreach ($LECTURER_data as $lecturer): ?>
                    <tr>
                        <td><?= $lecturer['employee_id'] ?></td>
                        <td><?= $lecturer['title'] ?></td>
                        <td><?= $lecturer['name'] ?></td>
                        <td><?= $lecturer['contact_no'] ?></td>
                        <td><?= $lecturer['email'] ?></td>
                        <td class="actions">
                        <a href="/lecturerEdit?id=<?= $lecturer['employee_id'] ?>" class="view-button">Edit</a>
                        <form action="/lecturerDeletion" method="post">
                            <input type="hidden" name="id" value="<?= $lecturer['employee_id'] ?>">
                            <button type="submit" class="disable-button">Disable</button>  
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>



<?php require base_path('views/partials/auth/auth-close.php') ?>
