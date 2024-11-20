<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/schedule.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-calendar-days" style="font-size: 40px;"></i>
                <h2>Schedule</h2>
            </div>
            <div class="above-right">
                <div class="company-info">
                    <i class="fa-regular fa-building" style="font-size: 40px;"></i>
                    <div class="company-name">
                        Creative<br>Software
                    </div>
                </div>
                <div>
                    <i class="fa-solid fa-bell" style="font-size: 40px;"></i>
                </div>
            </div>
        </div>
    </header>

    <section class="content">
        <div class="schedule-title">
            <div class="schedule-system-txt">
                <h3>Schedule Tech Talks</h3>
                <button onclick="showAddScheduleModal('tech-talks')">Add Schedule</button>
            </div>

            <div class="schedule-student-txt">
                <h3>Schedule Company Visits</h3>
                <button onclick="showAddScheduleModal('company-visits')">Add Schedule</button>
            </div>
        </div>

        <div class="calendars">
            <!-- Tech Talks Calendar Section -->
            <div class="calendar-box">
                <div id="tech-talks-calendar" class="calendar-container"></div>
            </div>

            <!-- Company Visits Calendar Section -->
            <div class="calendar-box">
                <div id="company-visits-calendar" class="calendar-container"></div>
            </div>
        </div>

        <!-- Add Schedule Modal for Adding Events -->
        <div id="addScheduleModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>Add Schedule</h3>
                <label for="date">Select Date:</label>
                <input type="date" id="schedule-date">
                <label for="event">Event Description:</label>
                <input type="text" id="schedule-event" placeholder="Event Details">
                <button onclick="addEvent()">Add</button>
            </div>
        </div>

        <!-- Event Detail Modal to Display Event Info on Click -->
        <div id="eventDetailModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEventDetailModal()">&times;</span>
                <h3>Event Details</h3>
                <p id="event-details"></p>
            </div>
        </div>
    </section>
</main>

<script>
const events = {
    'tech-talks': [
        { date: '2024-07-02', time: '3:00 p.m', location: 'WSO2', description: 'Introduction to C' },
        { date: '2024-07-09', time: '1:00 p.m', location: 'Pajero', description: 'Python Basics' }
    ],
    'company-visits': [
        { date: '2024-07-16', time: '3:00 p.m', location: 'IFS', description: 'Git & GitHub' },
        { date: '2024-07-23', time: '3:00 p.m', location: 'CISCO', description: 'OOP Concepts' }
    ]
};

const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

function createCalendar(containerId, events, year, month) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';

    const monthYearHeader = document.createElement('h2');
    monthYearHeader.classList.add('calendar-header');
    monthYearHeader.textContent = `${monthNames[month]} ${year}`;
    container.appendChild(monthYearHeader);

    const daysContainer = document.createElement('div');
    daysContainer.classList.add('calendar-days');
    const dayHeaders = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
    dayHeaders.forEach(day => {
        const dayDiv = document.createElement('div');
        dayDiv.className = 'day';
        dayDiv.textContent = day;
        daysContainer.appendChild(dayDiv);
    });
    container.appendChild(daysContainer);

    const calendarGrid = document.createElement('div');
    calendarGrid.classList.add('calendar');

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement('div');
        calendarGrid.appendChild(emptyCell);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayCell = document.createElement('div');
        dayCell.classList.add('day-box');
        dayCell.textContent = day;

        const event = events.find(event => event.date === dateStr);
        if (event) {
            dayCell.classList.add('highlight');
            dayCell.onclick = () => showEventDetail(event);
        }

        calendarGrid.appendChild(dayCell);
    }

    container.appendChild(calendarGrid);
}

function initializeCalendars() {
    const year = 2024;
    const month = 6; // July (months are 0-indexed in JavaScript)

    createCalendar('tech-talks-calendar', events['tech-talks'], year, month);
    createCalendar('company-visits-calendar', events['company-visits'], year, month);
}

function showAddScheduleModal(calendarId) {
    document.getElementById('addScheduleModal').style.display = 'block';
    window.selectedCalendar = calendarId;
}

function closeModal() {
    document.getElementById('addScheduleModal').style.display = 'none';
}

function addEvent() {
    const date = document.getElementById('schedule-date').value;
    const eventText = document.getElementById('schedule-event').value;

    if (date && eventText) {
        const time = prompt("Enter event time:");
        const location = prompt("Enter event location:");
        const newEvent = { date, time, location, description: eventText };
        
        events[window.selectedCalendar].push(newEvent);
        createCalendar(`${window.selectedCalendar}-calendar`, events[window.selectedCalendar], 2024, 6);
    }
    closeModal();
}

function showEventDetail(event) {
    document.getElementById('event-details').innerHTML = `${event.time} - ${event.location}<br>${event.description}`;
    document.getElementById('eventDetailModal').style.display = 'block';
}

function closeEventDetailModal() {
    document.getElementById('eventDetailModal').style.display = 'none';
}

window.onload = initializeCalendars;
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
