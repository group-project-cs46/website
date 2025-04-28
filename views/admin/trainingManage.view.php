<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/eventsManage.css" />
<div class="mmm">
    <main class="main-content">  
    <section class="content">

        <header class="header">
            <div class="above">
                <i class="fa-solid fa-calendar-check" style="font-size: 40px;"></i>
                <h2><b>Manage Training Sessions</b></h2>
            </div>
            <input type="text" placeholder="Search Training Session..." class="search-bar" id="searchInput" onkeyup="searchTable()">
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Manage Training Sessions</b></h3>
                    <p>Manage Training Sessions Records</p>
                </div>
                <a href="/trainingAdd">
                <button class="add-button" id="openFormButton">+ New</button>
                </a>
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Start Time</th>                       
                        <th>End Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">

                    <?php foreach ($TRAINING_SESSION as $training_session): ?>
                        <tr>       
                            <td><?= $training_session['name'] ?></td>
                            <td><?= $training_session['date'] ?></td>
                            <td><?= $training_session['venue'] ?></td>
                            <td><?= $training_session['start_time'] ?></td>
                            <td><?= $training_session['end_time'] ?></td>
                            <td class="actions">
                                <a href="/trainingView?id=<?= $training_session['id'] ?>" class="view-button">View</a>
                                <a href="/admin/training_sessions/qrcodes/show?id=<?= $training_session['qrcode_id'] ?>" class="view-button">Download QR</a>
                                <a href="/trainingEdit?id=<?=$training_session['id'] ?>" class="view-button">Edit</a>
                                <form action="/trainingDeletion" method="post" style="display:inline;" onsubmit="return confirmReject();">
                                    <input type="hidden" name="id" value="<?=$training_session['id'] ?>">
                                    <button type="submit" class="disable-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </section>
        </section>

    </main>

    <?php if (isset($_SESSION['success_message'])): ?>
    <div id="success-popup" style="display:block; position: fixed; top: 20%; left: 50%; transform: translateX(-50%); padding: 20px; background-color:#3498db; color: white; border-radius: 5px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);">
        <span><?= $_SESSION['success_message'] ?></span>
        <button onclick="closePopup()" style="background-color: transparent; color: white; border: none; font-size: 16px; margin-left: 10px; cursor: pointer;">×</button>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

    <script>

function closePopup() {
        document.getElementById('success-popup').style.display = 'none';
    }

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
        return confirm("Are you sure you want to delete this session?");
    }


    </script>
</div>

<?php require base_path('views/partials/auth/auth-close.php'); ?>
