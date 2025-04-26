<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/eventsManage.css" />
<div class="mmm">
    <main class="main-content">
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-calendar-check" style="font-size: 40px;"></i>
                <h2><b>Manage Complaints</b></h2>
            </div>
            <input type="text" placeholder="Search Complaints..." class="search-bar" id="searchInput" onkeyup="searchTable()">
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Complaints</b></h3>
                    <p>Manage Complaints Records</p>
                </div>
            </div>




            <table class="student-table">
                <thead>
                    <tr>
                        <th>Complainant</th>
                        <th>Accused</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- <tbody id="studentTableBody">

                 Sample Row -->
                <!-- <tr>
                    <td>John Doe</td>
                    <td>System not responding</td>
                    <td>2025-04-10 14:30</td>
                    <td>
                        Pending
                    </td>
                    <td class="actions">
                        <a href="/complaint?id=23" class="view-button">View</a>
                        <form action="/eventsDeletion" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="23">
                            <button type="submit" class="disable-button">Reject</button>
                        </form>
                    </td>
                </tr> -->

                <!-- Dynamic Rows -->
                <tbody id="studentTableBody">
                    <?php foreach ($COMPLAINT_DATA as $complaint_data): ?>
                        <tr>
                            <td><?= $complaint_data['complainant_name'] ?></td>
                            <td><?= $complaint_data['accused_name'] ?></td>
                            <td><?= date('Y-m-d H:i', strtotime($complaint_data['created_at'])) ?></td>
                            <td><?= $complaint_data['status'] ?></td>
                            <td class="actions">
                                <a href="/complaintView?id=<?= $complaint_data['id'] ?>" class="view-button">View</a>
                               
                                <form action="/complaintResolve" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $complaint_data['id'] ?>">
                                    <button type="submit" class="enable-button">Resolve</button>
                                </form>

                                <!-- <form action="/complaintDeletion" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $complaint_data['id'] ?>">
                                    <button type="submit" class="disable-button">Reject</button>
                                </form> -->

                                <form action="/complaintDeletion" method="post" style="display:inline;" onsubmit="return confirmReject();">
                                    <input type="hidden" name="id" value="<?= $complaint_data['id'] ?>">
                                    <button type="submit" class="disable-button">Reject</button>
                                </form>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <!-- </tbody> -->
            </table>
        </section>
    </main>

    <script>
        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const rows = document.getElementById("studentTableBody").getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const rowText = rows[i].textContent.toLowerCase();
                rows[i].style.display = rowText.includes(filter) ? "" : "none";
            }
        }

        
    function confirmReject() {
        return confirm("Are you sure you want to reject this complaint?");
    }


    </script>
</div>

<?php require base_path('views/partials/auth/auth-close.php'); ?>