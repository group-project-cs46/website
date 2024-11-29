<?php require base_path('views/partials/auth/auth.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="/styles/pasindu/dashboardlec.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="dashboard">
    <header>
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
          <p>Applied Students</p>
        </div>
      </a>
    </div>

    <div class="charts">
      <div class="chart-container">
        <h3>Companies</h3>
        <canvas id="barChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Calendar</h3>
        <div class="calendar">
          <div id="calendar-header">
            <button id="prev-month">&lt;</button>
            <h4 id="month-year"></h4>
            <button id="next-month">&gt;</button>
          </div>
          <div id="dates" class="calendar-dates"></div>
        </div>
      </div>
    </div>
  </div>
  <script src="/scripts/pasindu/dashboardlec.js"></script>
</body>
</html>

<?php require base_path('views/partials/auth/auth-close.php'); ?>



