<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Schedule.css" />

<main class="main-content">
    
        <div class="above">
            <i class="fas fa-calendar-days" style="font-size: 40px;"></i>
            <h2><b>Schedule</b></h2>
        </div>
    
<div class="schedule-wrapper">
    <section class="content">
        <div class="title">
            <div class="table-title">
                <h3><b>Schedule Techtalks</b></h3>
                <p>Schedule Techtalks for students</p>
            </div>
            <button id="add-event-btn" onclick="openModal()">Add New Schedule</button>
        </div>

        <div class="calendar-header">
            <div class="right"><a href="#" onclick="changeMonth(-1)">&#60;</a></div>
            <h2><b id="calendar-month">July</b></h2>
            <div class="left"><a href="#" onclick="changeMonth(1)">&#62;</a></div>
        </div>

        <div id="calendar" class="calendar"></div>
        
        <!-- <button id="add-event-btn" onclick="openModal()">Add New Schedule</button> -->

        <!-- Modal for adding new event -->
        <div id="addEventModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Add New Event</h2>
                </div>
                <form id="event-form">
                    <label for="event-date">Date:</label>
                    <input type="date" id="event-date" name="event-date" required>
                    <br>
                    <label for="event-time">Time:</label>
                    <input type="time" id="event-time" name="event-time" required>
                    <br>
                    <label for="event-title" >Event Title:</label>
                    <input type="text" id="event-title" name="event-title" value ="hello" required readonly disabled>
                    <br>
                    <label for="event-description">Description:</label>
                    <textarea id="event-description" name="event-description" required readonly disabled>hello</textarea>
                    <br>
                    <button type="submit">Add Event</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Second Section - Additional Scheduling (e.g., Company Visits) -->
    <section class="content">
            <div class="title">
                <div class="table-title">
                    <h3><b>Schedule Company Visits</b></h3>
                    <p>Plan company visits for Lecturers</p>
                </div>
                <button id="add-visit-btn" onclick="openVisitModal()">Add New Visit</button>
            </div>

            <div id="visit-list">
                <ul>
                    <li><b>2024-08-05:</b> Visit to Company A</li>
                    <li><b>2024-08-12:</b> Visit to Company B</li>
                    <li><b>2024-08-19:</b> Visit to Company C</li>
                </ul>
            </div>

            <!-- Modal for adding new visit -->
            <div id="addVisitModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" onclick="closeVisitModal()">&times;</span>
                        <h2>Add New Visit</h2>
                    </div>
                    <form id="visit-form">
                        <label for="visit-date">Date:</label>
                        <input type="date" id="visit-date" required>
                        <label for="visit-title">Company Name:</label>
                        <input type="text" id="visit-title" required>
                        <button type="submit">Add Visit</button>
                    </form>
                </div>
            </div>
    </section>
</div>    
</main>
<a href="sample">sample</a>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    const events = [
        { date: '2024-07-02', time: '15:00', title: 'WSO2 Introduction to C', description: 'Learn about C programming' },
        { date: '2024-07-09', time: '13:00', title: 'Pajero Python Basics', description: 'Introduction to Python' },
        { date: '2024-07-16', time: '15:00', title: 'IFS Git & Git Hub', description: 'Learn Git & GitHub' },
        { date: '2024-07-23', time: '15:00', title: 'CISCO OOP Concepts', description: 'Learn OOP Concepts' },
        { date: '2024-07-30', time: '15:00', title: 'IFS Java Basics', description: 'Introduction to Java' }
    ];

    let currentMonth = new Date().getMonth();
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    function renderCalendar() {
        const calendarDiv = document.getElementById("calendar");
        const monthYear = document.getElementById("calendar-month");
        const firstDay = new Date(2024, currentMonth, 1).getDay();
        const daysInMonth = new Date(2024, currentMonth + 1, 0).getDate();
        const monthName = monthNames[currentMonth];
        monthYear.textContent = monthName;

        calendarDiv.innerHTML = '';

        // Render day headers
        const daysOfWeek = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
        for (let day of daysOfWeek) {
            const dayDiv = document.createElement("div");
            dayDiv.classList.add("day");
            dayDiv.textContent = day;
            calendarDiv.appendChild(dayDiv);
        }

        // Render days of the month
        for (let i = 0; i < firstDay; i++) {
            calendarDiv.appendChild(document.createElement("div"));
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const dayDiv = document.createElement("div");
            dayDiv.textContent = i;
            dayDiv.classList.add("day-cell");

            const eventDivs = events.filter(event => event.date === `2024-${(currentMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`);
            eventDivs.forEach(event => {
                const eventDiv = document.createElement("div");
                eventDiv.classList.add("event");
                eventDiv.textContent = event.title;
                eventDiv.title = `${event.time} - ${event.description}`; // Tooltip
                dayDiv.appendChild(eventDiv);
            });

            calendarDiv.appendChild(dayDiv);
        }
    }

    function changeMonth(direction) {
        currentMonth += direction;
        if (currentMonth < 0) currentMonth = 11;
        if (currentMonth > 11) currentMonth = 0;
        renderCalendar();
    }

    function openModal() {
        document.getElementById('addEventModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('addEventModal').style.display = 'none';
    }

    document.getElementById('event-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const eventDate = document.getElementById('event-date').value;
        const eventTime = document.getElementById('event-time').value;
        const eventTitle = document.getElementById('event-title').value;
        const eventDescription = document.getElementById('event-description').value;

        const newEvent = { date: eventDate, time: eventTime, title: eventTitle, description: eventDescription };
        events.push(newEvent);
        renderCalendar();
        document.getElementById('event-form').reset();
        closeModal();
    });

    renderCalendar();

    /*add event*/

    function openVisitModal() {
    document.getElementById('addVisitModal').style.display = 'block';
}

// Close the modal
function closeVisitModal() {
    document.getElementById('addVisitModal').style.display = 'none';
}

// Handle the form submission for adding a visit
document.getElementById('visit-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Get the values from the form fields
    const visitDate = document.getElementById('visit-date').value;
    const companyName = document.getElementById('visit-title').value;

    if (visitDate && companyName) {
        // Here you can add logic to display the visit, save it to a database, etc.
        console.log(`Visit Scheduled: ${visitDate} - ${companyName}`);

        // Example: Add the visit to a list (you can update your UI here)
        const visitList = document.getElementById('visit-list').querySelector('ul');
        const newVisit = document.createElement('li');
        newVisit.innerHTML = `<b>${visitDate}:</b> Visit to ${companyName}`;
        visitList.appendChild(newVisit);

        // Close the modal after submitting
        closeVisitModal();

        // Reset the form
        document.getElementById('visit-form').reset();
    } else {
        alert('Please fill out all fields.');
    }
});

</script>
