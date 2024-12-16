<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Complaints</title>
    <link rel="stylesheet" href="/styles/pasindu/reportMain.css">
</head>
<body>
    <!-- <div class="sidebar">
        <div class="sidebar-item">
            <i class="icon">⊞</i>
        </div>
        <div class="sidebar-item">
            <i class="icon">👤</i>
        </div>
        <div class="sidebar-item">
            <i class="icon">▲</i>
        </div>
        <div class="sidebar-item active">
            <i class="icon">📝</i>
        </div>
        <div class="sidebar-item settings">
            <i class="icon">⚙</i>
        </div>
    </div> -->

    <div class="main-content">
        <div class="above">
        <i class="fa-solid fa-file-invoice" style="font-size: 40px;"></i>
        <h2><b>Manage Reports</b></h2></br>
            </div>

        <div class="complaints-list">
            <div class="complaint-item new">
                <span class="title">New Report</span>
                <div class="actions">
                    <button class="btn-view"><a href="report">Create</a></button>
                </div>
            </div>

            <div class="complaint-item new">
                <span class="title">Submitted Reports</span>
                <div class="actions">
                    <button class="btn-view"><a href="reportSubmitted">view</a></button>
                </div>
            </div>
    </div>

    <script src="/scripts/pasindu/complaints.js"></script>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>
