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
            <div id="techTalkTab" class="schedule-system-txt" onclick="toggleSchedule('tech-talks')">
                <h3>Schedule Tech Talks</h3>
                <p>Manage Schedule Tech Talks</p>
            </div>

            <div class="divider"></div>

            <div id="companyVisitTab" class="schedule-student-txt" onclick="toggleSchedule('company-visits')">
                <h3>Schedule Company Visits</h3>
                <p>Manage Schedule Company Visits</p>
            </div>
        </div>

        <div id="techTalksSection" class="calendar-section active">
            <div class="calendar-navigation-container">
                <button id="prevMonth" class="nav-button" onclick="changeMonth(-1)">←</button>
                <h2 id="calendarHeader" class="calendar-header"></h2>
                <button id="nextMonth" class="nav-button" onclick="changeMonth(1)">→</button>
            </div>

            <div id="tech-talks-calendar" class="calendar-container"></div>
        </div>

        <div id="companyVisitsSection" class="calendar-section">
            <div class="calendar-navigation-container">
                <button id="prevMonth" class="nav-button" onclick="changeMonth(-1)">←</button>
                <h2 id="calendarHeaderCompanyVisits" class="calendar-header"></h2>
                <button id="nextMonth" class="nav-button" onclick="changeMonth(1)">→</button>
            </div>
            <div id="company-visits-calendar" class="calendar-container"></div>
        </div>

        <!-- Modal for Adding Tech Talk Details -->
        <div id="techTalkModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('techTalkModal')">×</span>
                <h3>Tech Talk Details</h3>
                <form id="techTalkForm">
                    <label for="techDate">Date:</label>
                    <input type="text" id="techDate" readonly />

                    <label for="techTime">Time:</label>
                    <input type="text" id="techTime" readonly />

                    <label for="constructorName">Constructor Name:</label>
                    <input type="text" id="constructorName" placeholder="Enter Constructor Name" required />

                    <label for="constructorEmail">Constructor Email:</label>
                    <input type="email" id="constructorEmail" placeholder="Enter Constructor Email" required />

                    <label for="description">Description:</label>
                    <textarea id="description" placeholder="Enter Description" required></textarea>

                    <button type="submit">Save</button>
                </form>
            </div>
        </div>

        <!-- Modal for Approving Company Visit -->
        <div id="companyVisitModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('companyVisitModal')">×</span>
                <h3>Company Visit Details</h3>
                <p><strong>Date:</strong> <span id="visitDate"></span></p>
                <p><strong>Time:</strong> <span id="visitTime"></span></p>
                <p><strong>Lecturer Name:</strong> <span id="lecturerName"></span></p>
                <p><strong>Email:</strong> <span id="lecturerEmail"></span></p>
                <button id="approveButton" onclick="approveVisit()">Approve</button>
            </div>
        </div>
    </section>
</main>

<script>
    let currentYear = new Date().getFullYear(); // Start with current year
    let currentMonth = new Date().getMonth(); // Start with current month (0-indexed)

    // Convert PHP techtalk data to JavaScript
    const techTalksFromDB = <?php echo json_encode($techtalk); ?>;

    // Format the tech talk data for the calendar
    const formattedTechTalks = techTalksFromDB.map(event => {
        const dateTime = new Date(event.date);
        const date = dateTime.toISOString().split('T')[0]; // e.g., "2025-04-01"
        const time = dateTime.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' }); // e.g., "8:00 AM"
        return { date, time };
    });

    const events = {
        'tech-talks': formattedTechTalks,
        'company-visits': [
            { date: '2024-11-07', time: '2:00 PM', lecturer_name: 'John', email: 'John1234@gmail.com' },
            { date: '2024-11-14', time: '4:00 PM', lecturer_name: 'Nimal', email: 'Nimal1234@gmail.com' }
        ]
    };

    function changeMonth(direction) {
        currentMonth += direction;

        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        } else if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }

        updateCalendarHeader('tech-talks');
        updateCalendarHeader('company-visits');
        initializeCalendar('tech-talks');
        initializeCalendar('company-visits');
    }

    function updateCalendarHeader(section) {
        const headerElement = section === 'tech-talks'
            ? document.getElementById('calendarHeader')
            : document.getElementById('calendarHeaderCompanyVisits');
        headerElement.textContent = `${new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long' })} ${currentYear}`;
    }

    function initializeCalendar(section) {
        const containerId = section === 'tech-talks' ? 'tech-talks-calendar' : 'company-visits-calendar';
        const eventList = events[section];
        createCalendar(containerId, eventList, currentYear, currentMonth);
    }

    function createCalendar(containerId, events, year, month) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';

        const daysContainer = document.createElement('div');
        daysContainer.className = 'calendar-days';
        ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'].forEach(day => {
            const dayElement = document.createElement('div');
            dayElement.className = 'day';
            dayElement.textContent = day;
            daysContainer.appendChild(dayElement);
        });
        container.appendChild(daysContainer);

        const calendarGrid = document.createElement('div');
        calendarGrid.className = 'calendar';
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            calendarGrid.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const dayCell = document.createElement('div');
            dayCell.className = 'day-box';
            dayCell.textContent = day;

            // Find all events for this date
            const dayEvents = events.filter(e => e.date === dateStr);
            if (dayEvents.length > 0) {
                dayCell.classList.add('highlight');
                if (containerId === 'tech-talks-calendar') {
                    // For tech talks, show the first event's time and allow clicking to view details
                    const firstEvent = dayEvents[0];
                    dayCell.innerHTML += `<br><small>${firstEvent.time}</small>`;
                    dayCell.onclick = () => openTechTalkModal(firstEvent.date, firstEvent.time);
                } else if (containerId === 'company-visits-calendar') {
                    // Company visits remain unchanged
                    const event = dayEvents[0];
                    dayCell.onclick = () =>
                        openCompanyVisitModal(event.date, event.time, event.lecturer_name, event.email, dayCell);
                }
            }

            calendarGrid.appendChild(dayCell);
        }

        container.appendChild(calendarGrid);
    }

    window.onload = () => {
        updateCalendarHeader('tech-talks');
        updateCalendarHeader('company-visits');
        initializeCalendar('tech-talks');
        initializeCalendar('company-visits');
        toggleSchedule('tech-talks');
    };

    function toggleSchedule(section) {
        const techTalksTab = document.getElementById('techTalkTab');
        const companyVisitsTab = document.getElementById('companyVisitTab');
        const techTalksSection = document.getElementById('techTalksSection');
        const companyVisitsSection = document.getElementById('companyVisitsSection');

        if (section === 'tech-talks') {
            techTalksTab.classList.add('active');
            companyVisitsTab.classList.remove('active');
            companyVisitsSection.classList.remove('active');
            companyVisitsSection.style.display = 'none';
            techTalksSection.style.display = 'flex';
            setTimeout(() => techTalksSection.classList.add('active'), 10);
        } else {
            companyVisitsTab.classList.add('active');
            techTalksTab.classList.remove('active');
            techTalksSection.classList.remove('active');
            techTalksSection.style.display = 'none';
            companyVisitsSection.style.display = 'flex';
            setTimeout(() => companyVisitsSection.classList.add('active'), 10);
        }
    }

    function openTechTalkModal(date, time) {
        document.getElementById('techDate').value = date;
        document.getElementById('techTime').value = time;
        document.getElementById('techTalkModal').style.display = 'flex';
    }

    function openCompanyVisitModal(date, time, lecturerName, email, dateElement) {
        document.getElementById('visitDate').textContent = date;
        document.getElementById('visitTime').textContent = time;
        document.getElementById('lecturerName').textContent = lecturerName;
        document.getElementById('lecturerEmail').textContent = email;
        lastClickedDateElement = dateElement;
        document.getElementById('companyVisitModal').style.display = 'flex';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function approveVisit() {
        if (lastClickedDateElement) {
            lastClickedDateElement.style.backgroundColor = 'green';
            lastClickedDateElement.style.color = 'white';
        }
        closeModal('companyVisitModal');
        alert('Company Visit Approved!');
    }

    document.getElementById('techTalkForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const constructorName = document.getElementById('constructorName').value;
        const constructorEmail = document.getElementById('constructorEmail').value;
        const description = document.getElementById('description').value;
        alert(`Tech Talk Details Saved:
        Constructor Name: ${constructorName}
        Constructor Email: ${constructorEmail}
        Description: ${description}`);
        closeModal('techTalkModal');
    });
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>