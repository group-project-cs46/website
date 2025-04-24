<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/eventsManage.css" />
<div class="mmm">
    <main class="main-content">
        <div style="width: 100%; max-width: 1500px; background: #ffffff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 30px; margin: 20px;">
            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1 style="font-size: 28px; color: #333; margin: 0; font-weight: 600;">Welcome to Your Internship Dashboard</h1>
                <div style="display: flex; gap: 10px;">
                    <a href="/account" class="button">
                        <button>
                            View Profile
                        </button>
                    </a>

                    <form action="/sessions" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="button is-red">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <!-- Left Column: Internship Applications & Recent Activities -->
                <div>
                    <!-- Internship Applications -->
                    <div style="background: #f9f9f9; border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; color: #333; margin: 0 0 15px 0;">Your Internship Applications</h2>
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="max-height: 300px; overflow-y: auto; display: flex; flex-direction: column; gap: 15px;">
    <?php foreach ($COMPLAINT_DATA as $complaint_data): ?>
        <div style="background: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 16px; color: #333; margin: 0;"><?= $complaint_data['complainant_name'] ?></h3>
                <p style="font-size: 14px; color: #666; margin: 5px 0;">
                    <?= date('Y-m-d H:i', strtotime($complaint_data['created_at'])) ?> • Status <?= $complaint_data['status'] ?>
                </p>
            </div>
        </div>
    <?php endforeach ?>
</div>


                        </div>
                        <!-- <a href="/students/applications" style="display: inline-block; margin-top: 15px; color: #4a90e2; font-size: 14px;">
                            View All Applications
                        </a> -->
                    </div>

                    <!-- Recent Activities -->
                    
                </div>

                <!-- Right Column: Profile & Deadlines -->
                <div>
                    <!-- Profile Overview -->
                    <div style="background: #4a90e2; border-radius: 10px; padding: 20px; color: white; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; margin: 0 0 15px 0;">Profile Overview</h2>
                        <p style="font-size: 14px; margin: 5px 0;">Name: <?= $complaint_data['complainant_name']  ?></p>
                        <p style="font-size: 14px; margin: 5px 0;">Course: <?= $complaint_data['complainant_name']  ?></p>
                        <p style="font-size: 14px; margin: 5px 0;">Applications: <?= $complaint_data['complainant_name']  ?></p>
                    </div>

                    <div style="background: #4a90e2; border-radius: 10px; padding: 20px; color: white; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; margin: 0 0 15px 0;">Profile Overview</h2>
                        <p style="font-size: 14px; margin: 5px 0;">Name: </p>
                        <p style="font-size: 14px; margin: 5px 0;">Course:</p>
                        <p style="font-size: 14px; margin: 5px 0;">Applications: </p>
                    </div>

                    <div style="background: #4a90e2; border-radius: 10px; padding: 20px; color: white; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; margin: 0 0 15px 0;">Profile Overview</h2>
                        <p style="font-size: 14px; margin: 5px 0;">Name: </p>
                        <p style="font-size: 14px; margin: 5px 0;">Course: </p>
                        <p style="font-size: 14px; margin: 5px 0;">Applications: </p>
                    </div>

                    <!-- Upcoming Deadlines -->
                    
                </div>
            </div>
        </div>
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
    </script>
</div>

<?php require base_path('views/partials/auth/auth-close.php'); ?>