<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Reports</title>
    <link rel="stylesheet" href="/styles/pasindu/submit.css">
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
        <div class="header">
            <h1>Submitted Reports</h1>
            <p class="subtitle">View Reports</p>
        </div>

        <div class="complaints-list">

            <div class="complaint-item">
                <span class="title">IFS Report</span>
                <div class="actions">
                    <button class="btn-view">View</button>
                </div>
                <span class="timestamp">Aug 20</span>
            </div>

            <div class="complaint-item">
                <span class="title">WSO2 Report</span>
                <div class="actions">
                    <button class="btn-view">View</button>
                </div>
                <span class="timestamp">Aug 19</span>
            </div>

            <div class="complaint-item">
                <span class="title">CISCO Report</span>
                <div class="actions">
                    <button class="btn-view">View</button>
                </div>
                <span class="timestamp">Aug 18</span>
            </div>

            <div class="complaint-item">
                <span class="title">99x Report</span>
                <div class="actions">
                    <button class="btn-view">View</button>
                </div>
                <span class="timestamp">Aug 10</span>
            </div>

            <div class="complaint-item">
                <span class="title">Virtusa Report</span>
                <div class="actions">
                    <button class="btn-view">View</button>
                </div>
                <span class="timestamp">July 28</span>
            </div>
        </div>

        <div class="pagination">
            <button class="btn-prev"><a href="reportMain">Previous Page</a></button>
            <button class="btn-prev">Prev</button>
            <div class="page-numbers">
                <span class="active">1</span>
                <span>2</span>
                <span>3</span>
                <span>...</span>
                <span>8</span>
                <span>9</span>
                <span>10</span>
            </div>
            <button class="btn-next">Next</button>
        </div>
    </div>

    <script src="/scripts/pasindu/submit.js"></script>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>
