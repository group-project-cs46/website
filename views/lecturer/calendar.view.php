<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/calendar.css" />
<div class=" mmm">
    <main class="main-content">  
        <header class="header">
            <div class="above">
                <i class="fa-solid fa-user-shield" style="font-size: 40px;"></i>
                <h2><b>Schedule Visit</b></h2>
            </div>
            <input type="text" placeholder="Search Dates ..." class="search-bar" id="searchInput" onkeyup="searchDates()">
            
        </header>

        <section class="content">
            <div class="table-title">
                <div class="table-title-txt">
                    <h3><b>Schedule Company Visits</b></h3>
                    <p>Manage and View Lecturer Visit Calendars</p>
                </div>
            </div>

            <div class="calendar-wrapper">
                <div class="calendar-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <button id="prev-month" class="btn-nav">&lt;</button>
                    <span id="month-year" style="font-weight: bold; font-size: 18px;"></span>
                    <button id="next-month" class="btn-nav">&gt;</button>
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

        </section>
    </main>
    <script src="/scripts/pasindu/calendar.js"></script>

    <script>
        function searchDates() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const dates = document.querySelectorAll("#dates > div");

            dates.forEach(date => {
                date.style.display = date.textContent.toLowerCase().includes(input) ? "" : "none";
            });
        }
    </script>

</div>

<?php require base_path('views/partials/auth/auth-close.php') ?>