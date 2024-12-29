<?php require base_path('views/partials/auth/auth.php') ?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="/styles/pasindu/dashboard.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Dashboard</h1>
            <p>View current progress</p>
        </header>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="icon-container">
                        <i class="fas fa-building"></i>
                    </div>
                    <h2 class="stat-number" data-target="15">0</h2>
                </div>
                <p class="stat-title">Companies Registered</p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="icon-container">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2 class="stat-number" data-target="3">0</h2>
                </div>
                <p class="stat-title">Blacklisted Companies</p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="icon-container">
                        <i class="fas fa-users"></i>
                    </div>
                    <h2 class="stat-number" data-target="200">0</h2>
                </div>
                <p class="stat-title">No.of students Registered</p>
            </div>
        </div>
    </div>
    <script src="/scripts/pasindu/dashboard.js"></script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="/styles/pasindu/dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="dashboard">
    <header>
      <!-- <div>
    <i class="fas fa-user-graduate" style="font-size: 40px;"></i>

      <h1>Dashboard</h1>
      <p>View current progress</p>
      </div> -->
      <div class="above">
            <i class="fa-solid fa-gauge" style="font-size: 40px;"></i>
            <h2><b>Dashboard</b></h2>
        </div>
    </header>
    <div class="stats">
    <a href="/PDC/ManageCompany">
      <div class="stat">
        <h2>15</h2>
        <p>Companies Registered</p>
      </div>
    </a>
    <a href="/company/appliedStudent">
      <div class="stat">
        <h2>320</h2>
        <p>Applied students</p>
      </div>
    </a>
    <a href="/PDC/Advertisements">
      <div class="stat">
        <h2>20</h2>
        <p>Advertisments</p>
      </div>
    </a>
    </div>
    <div class="charts">
      <div class="chart-container">
        <h3>Internship Placements</h3>
        <canvas id="barChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Job Roles</h3>
        <canvas id="donutChart"></canvas>
      </div>
    </div>
  </div>
  <script src="/scripts/pasindu/dashboard.js"></script>
  </body>
</html>

  


<?php require base_path('views/partials/auth/auth-close.php') ?>
