<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Schedule.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-calendar-days" style="font-size: 40px;"></i>
            <h2><b>Schedule</b></h2>
        </div>
    </header>

    <section class="schedule-wrapper">
        <div class="tabs">
            <div class="tab active-tab" id="techtalk-tab" onclick="toggleSchedule('techtalk-section', 'techtalk-tab')">
                <h3>Schedule Techtalks</h3>
                <p>Schedule Techtalks for students</p>
            </div>
            <div class="divider"></div>
            <div class="tab" id="companyvisit-tab" onclick="toggleSchedule('companyvisit-section', 'companyvisit-tab')">
                <h3>Schedule Company Visits</h3>
                <p>Plan company visits for Lecturers</p>
            </div>
        </div>

        <div class="content" id="techtalk-section">
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
                        <label for="event-title">Event Title:</label>
                        <input type="text" id="event-title" name="event-title" value="...." required readonly disabled>
                        <br>
                        <label for="event-description">Description:</label>
                        <textarea id="event-description" name="event-description" required readonly disabled>....</textarea>
                        <br>
                        <button type="submit">Add Event</button>
                    </form>
                </div>
            </div>

            <!-- Modal for editing event -->
            <div id="editEventModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" onclick="closeEditModal()">&times;</span>
                        <h2>Edit Event</h2>
                    </div>
                    <form id="edit-event-form">
                        <label for="edit-event-date">Date:</label>
                        <input type="date" id="edit-event-date" required>
                        <label for="edit-event-time">Time:</label>
                        <input type="time" id="edit-event-time" required>
                        <label for="edit-event-title">Event Title:</label>
                        <input type="text" id="edit-event-title" required>
                        <label for="edit-event-description">Description:</label>
                        <textarea id="edit-event-description" required></textarea>
                        <button type="submit">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="content" id="companyvisit-section" style="display: none;">
            <div class="title">
                <div class="table-title">
                    <h3><b>Schedule Company Visits</b></h3>
                    <p>Plan company visits for Lecturers</p>
                </div>
                <button id="add-visit-btn" onclick="openVisitModal()">Add New Visit</button>
            </div>

            <!-- Company Map and List -->
            <div id="map-container">
                <div id="map"></div>
                <ul id="company-list">
                    <li><b>Available Companies:</b></li>
                </ul>
            </div>

            <!-- Modal for Scheduling Visit -->
            <div id="addVisitModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" onclick="closeVisitModal()">&times;</span>
                        <h2>Schedule Company Visit</h2>
                    </div>
                    <form id="visit-form">
                        <label for="company-name">Company Name:</label>
                        <select id="company-name" name="company-name" required></select>
                        <label for="visit-date">Date:</label>
                        <input type="date" id="visit-date" name="visit-date" required>
                        <label for="visit-time">Time:</label>
                        <input type="time" id="visit-time" name="visit-time" required>
                        <button type="submit">Schedule Visit</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // toogle schedule
    function toggleSchedule(sectionId, tabId) {
        document.querySelectorAll('.content').forEach(section => section.style.display = 'none');
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active-tab'));

        document.getElementById(sectionId).style.display = 'block';
        document.getElementById(tabId).classList.add('active-tab');
    }

    // Calendar Logic
    const calendar = document.getElementById('calendar');
    const events = []; // Store events here

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
                eventDiv.textContent = event.time;
                eventDiv.title = `${event.time} - ${event.description}`; // Tooltip
                eventDiv.onclick = () => openEditModal(event);
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

        const newEvent = {
            date: eventDate,
            time: eventTime,
            title: eventTitle,
            description: eventDescription
        };
        events.push(newEvent);
        renderCalendar();
        document.getElementById('event-form').reset();
        closeModal();
    });

    function openEditModal(event) {
        document.getElementById('edit-event-date').value = event.date;
        document.getElementById('edit-event-time').value = event.time;
        document.getElementById('edit-event-title').value = event.title;
        document.getElementById('edit-event-description').value = event.description;

        document.getElementById('editEventModal').style.display = 'block';

        document.getElementById('edit-event-form').onsubmit = function(e) {
            e.preventDefault();

            event.date = document.getElementById('edit-event-date').value;
            event.time = document.getElementById('edit-event-time').value;
            event.title = document.getElementById('edit-event-title').value;
            event.description = document.getElementById('edit-event-description').value;

            renderCalendar();
            closeEditModal();
        };
    }

    function closeEditModal() {
        document.getElementById('editEventModal').style.display = 'none';
    }

    renderCalendar();

    // Company visit logic

    // Initialize Google Map
    let map;
    let markers = [];
    const companies = [{
            name: "Company A",
            address: "123 Main St, City",
            lat: 40.7128,
            lng: -74.0060
        },
        {
            name: "Company B",
            address: "456 Elm St, City",
            lat: 40.7120,
            lng: -74.0050
        },
        {
            name: "Company C",
            address: "789 Oak St, City",
            lat: 40.7138,
            lng: -74.0070
        },
    ];

    const selectedCompanies = [];
    const visitSchedule = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 40.7128,
                lng: -74.0060
            },
            zoom: 14,
        });

        loadCompanyMarkers();
    }

    function loadCompanyMarkers() {
        companies.forEach((company, index) => {
            const marker = new google.maps.Marker({
                position: {
                    lat: company.lat,
                    lng: company.lng
                },
                map: map,
                title: company.name,
            });

            markers.push(marker);

            const listItem = document.createElement("li");
            listItem.textContent = `${company.name} - ${company.address}`;
            listItem.addEventListener("click", () => selectCompany(index));
            document.getElementById("company-list").appendChild(listItem);
        });
    }

    function selectCompany(index) {
        if (selectedCompanies.length >= 3) {
            alert("You can only select up to 3 companies.");
            return;
        }

        const company = companies[index];
        if (!selectedCompanies.includes(company)) {
            selectedCompanies.push(company);
            updateCompanyDropdown();
            alert(`${company.name} selected.`);
        }
    }

    function updateCompanyDropdown() {
        const dropdown = document.getElementById("company-name");
        dropdown.innerHTML = "";
        selectedCompanies.forEach(company => {
            const option = document.createElement("option");
            option.value = company.name;
            option.textContent = company.name;
            dropdown.appendChild(option);
        });
    }

    function openVisitModal() {
        if (selectedCompanies.length === 0) {
            alert("Please select at least one company from the list.");
            return;
        }
        document.getElementById("addVisitModal").style.display = "block";
    }

    function closeVisitModal() {
        document.getElementById("addVisitModal").style.display = "none";
    }

    document.getElementById("visit-form").addEventListener("submit", function(e) {
        e.preventDefault();
        const companyName = document.getElementById("company-name").value;
        const visitDate = document.getElementById("visit-date").value;
        const visitTime = document.getElementById("visit-time").value;

        visitSchedule.push({
            companyName,
            visitDate,
            visitTime
        });
        alert(`Visit scheduled for ${companyName} on ${visitDate} at ${visitTime}.`);
        closeVisitModal();
    });

    window.onload = initMap;
</script>