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
      <h1>Dashboard</h1>
      <p>View current progress</p>
    </header>
    <div class="stats">
      <div class="stat">
        <h2>15</h2>
        <p>Companies Registered</p>
      </div>
      <div class="stat">
        <h2>320</h2>
        <p>Total No. of students</p>
      </div>
      <div class="stat">
        <h2>210</h2>
        <p>No. of students Got Intern</p>
      </div>
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
