<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lecturer Schedule</title>
  <link rel="stylesheet" href="/styles/pasindu/calendar.css">
</head>
<body>
  <div class="calendar-container">
    
    <div class="calendar-header">
      <h1>Lecturer Schedule Company Visit</h1>
      <h3>Schedule company visits for Lectures</h3>
      <div class="navigation">
        <button id="prev-month">&lt;</button>
        <span id="month-year"></span>
        <button id="next-month">&gt;</button>
      </div>
    </div>
    <div class="calendar">
      <div class="days">
        <div>SUN</div>
        <div>MON</div>
        <div>TUE</div>
        <div>WED</div>
        <div>THU</div>
        <div>FRI</div>
        <div>SAT</div>
      </div>
      <div class="dates" id="dates"></div>
    </div>
  </div>

  <script src="/scripts/pasindu/calendar.js"></script>
  </body>
</html>

<?php require base_path('views/partials/auth/auth-close.php') ?>
