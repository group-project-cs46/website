<?php require base_path('views/partials/auth/auth.php') ?>


<link rel="stylesheet" href="/styles/PDC/ManageStudents.css" />

<main class="main-content">
            <header class="header">
                <div class="above">
                    <i class="fas fa-user-graduate" style="font-size: 40px;"></i>
                    <h2><b>Manage Student</b></h2>
                </div>
                <input type="text" placeholder="Search Student..." class="search-bar">
            </header>

            <section class="content">
                <div class="table-title">
                    <div class="table-title-txt">
                        <h3><b>Manage Student</b></h3>
                        <p>Manage student accounts</p>
                    </div>
                    <button class="add-button">+</button>
                </div>

                <table class="student-table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Registration No.</th>
                            <th>Course</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Thathsara</td>
                            <td>2022/CS/141</td>
                            <td>IS</td>
                            <td>thathsara@gmail.com</td>
                            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                        </tr>
                        <!-- Repeat table rows as needed -->
                    </tbody>
                    
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Nivethan</td>
                            <td>2022/IS/142</td>
                            <td>IS</td>
                            <td>nivethan@gmail.com</td>
                            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                        </tr>
                        <!-- Repeat table rows as needed -->
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Karunya</td>
                            <td>2022/IS/143</td>
                            <td>IS</td>
                            <td>karunya@gmail.com</td>
                            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                        </tr>
                        <!-- Repeat table rows as needed -->
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Pasindhu</td>
                            <td>2022/CS/144</td>
                            <td>CS</td>
                            <td>pasindhu@gmail.com</td>
                            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                        </tr>
                        <!-- Repeat table rows as needed -->
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Nimal</td>
                            <td>2022/CS/145</td>
                            <td>CS</td>
                            <td>nimal@gmail.com</td>
                            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                        </tr>
                        <!-- Repeat table rows as needed -->
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Sarma</td>
                            <td>2022/IS/146</td>
                            <td>IS</td>
                            <td>sarma@gmail.com</td>
                            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                        </tr>
                        <!-- Repeat table rows as needed -->
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Abi</td>
                            <td>2022/CS/141</td>
                            <td>CS</td>
                            <td>abi@gmail.com</td>
                            <td><button class="disable-button">Disable</button><button class="view-button">View</button></td>
                        </tr>
                        <!-- Repeat table rows as needed -->
                    </tbody>
                    
                </table>
            </section>
        </main>


<?php require base_path('views/partials/auth/auth-close.php') ?>
