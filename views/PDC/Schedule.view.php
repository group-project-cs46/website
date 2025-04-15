<?php require base_path('views/partials/auth/auth.php'); ?>

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
                <div class="right"><a href="#" onclick="changeMonth(-1)"><</a></div>
                <h2><b id="calendar-month">July</b></h2>
                <div class="left"><a href="#" onclick="changeMonth(1)">></a></div>
            </div>

            <div id="calendar" class="calendar"></div>

            <!-- Modal for adding new event -->
            <div id="addEventModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" onclick="closeModal()">×</span>
                        <h2>Add New Event</h2>
                    </div>
                    <form id="event-form">
                        <label for="event-date">Date:</label>
                        <input type="date" id="event-date" name="date" required>
                        <br>
                        <label for="event-time">Time:</label>
                        <input type="time" id="event-time" name="time" required>
                        <br>
<<<<<<< HEAD
                        <label for="event-venue">Venue:</label>
                        <input type="text" id="event-venue" name="venue" required>
=======
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
                        <button type="submit">Add Event</button>
                    </form>
                </div>
            </div>

            <!-- Modal for editing event -->
            <div id="editEventModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" onclick="closeEditModal()">×</span>
                        <h2>Edit Event</h2>
                    </div>
                    <form id="edit-event-form">
                        <input type="hidden" id="edit-event-id" name="event-id">
                        <label for="edit-event-date">Date:</label>
                        <input type="date" id="edit-event-date" name="event-date" required>
                        <label for="edit-event-time">Time:</label>
                        <input type="time" id="edit-event-time" name="event-time" required>
<<<<<<< HEAD
                        <label for="edit-event-venue">Venue:</label>
                        <input type="text" id="edit-event-venue" name="event-venue" required>
=======
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
                        <button type="submit" style="margin-top: 10px;">Save Changes</button>
                        <button type="button" id="delete-event-btn" style="background-color: #ff4444; color: white; margin-top: 10px;">Delete slot</button>
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
                <label for="city-filter">Filter by City:</label>
                <select id="city-filter" onchange="filterCompaniesByCity()">
                    <option value="">All Cities</option>
                    <option value="City A">City A</option>
                    <option value="City B">City B</option>
                    <option value="City C">City C</option>
                </select>
                <ul id="company-list">
                    <li><b>Available Companies:</b></li>
                </ul>
            </div>

            <!-- Table for scheduled visits -->
            <div id="visit-table-container">
                <table id="visit-table">
                    <thead>
                        <tr>
                            <th>Visit Date</th>
                            <th>Company Name</th>
                            <th>Visit Time</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Scheduled visits will be added here -->
                    </tbody>
                </table>
            </div>

            <!-- Modal for Scheduling Visit -->
            <div id="addVisitModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" onclick="closeVisitModal()">×</span>
                        <h2>Schedule Company Visit</h2>
                    </div>
                    <form id="visit-form">
                        <label for="visit-date">Date:</label>
                        <input type="date" id="visit-date" name="visit-date" required>
                        <div id="company-time-selection">
                            <h3>Select Time for Companies:</h3>
                            <!-- Dynamic time input will be generated here -->
                        </div>
                        <button type="submit">Schedule Visit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // Pass PHP data to JavaScript
    let techtalkData = <?php echo json_encode($techtalk); ?>;
    console.log('techtalkData:', techtalkData); // Debug: Inspect techtalkData
    let events = techtalkData ? techtalkData.map(slot => ({
        id: slot.id,
        date: slot.date,
        time: slot.time,
<<<<<<< HEAD
        venue: slot.venue,
=======
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
        title: slot.title || 'Tech Talk',
        description: slot.description || 'Scheduled Tech Talk'
    })) : [];
    console.log('events:', events); // Debug: Inspect events

    // Toggle schedule
    function toggleSchedule(sectionId, tabId) {
        document.querySelectorAll('.content').forEach(section => section.style.display = 'none');
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active-tab'));
        document.getElementById(sectionId).style.display = 'block';
        document.getElementById(tabId).classList.add('active-tab');
    }

    // Calendar Logic
    const calendar = document.getElementById('calendar');
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    function renderCalendar() {
        console.log('Rendering calendar for:', monthNames[currentMonth], currentYear); // Debug
        const calendarDiv = document.getElementById("calendar");
        const monthYear = document.getElementById("calendar-month");
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        monthYear.textContent = `${monthNames[currentMonth]} ${currentYear}`;
        calendarDiv.innerHTML = '';

        const daysOfWeek = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
        for (let day of daysOfWeek) {
            const dayDiv = document.createElement("div");
            dayDiv.classList.add("day");
            dayDiv.textContent = day;
            calendarDiv.appendChild(dayDiv);
        }

        for (let i = 0; i < firstDay; i++) {
            calendarDiv.appendChild(document.createElement("div"));
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const dayDiv = document.createElement("div"); // Fixed typo: createEvent -> createElement
            dayDiv.textContent = i;
            dayDiv.classList.add("day-cell");

            const eventDivs = events.filter(event => 
                event.date === `${currentYear}-${(currentMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`
            );
            eventDivs.forEach(event => {
                const eventDiv = document.createElement("div");
                eventDiv.classList.add("event");
                eventDiv.textContent = event.time;
                eventDiv.title = `${event.time} - ${event.description}`;
                eventDiv.onclick = () => openEditModal(event);
                dayDiv.appendChild(eventDiv);
            });

            calendarDiv.appendChild(dayDiv);
        }
    }

    function changeMonth(direction) {
        currentMonth += direction;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear -= 1;
        }
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear += 1;
        }
        renderCalendar();
    }

    function openModal() {
        document.getElementById('addEventModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('addEventModal').style.display = 'none';
    }

    let currentEventId = null;

    function openEditModal(event) {
        currentEventId = event.id;
        document.getElementById('edit-event-id').value = event.id;
        document.getElementById('edit-event-date').value = event.date;
        
        // Convert time to HH:MM if needed
        let time = event.time;
        if (time && !time.match(/^\d{2}:\d{2}$/)) {
            const date = new Date(`1970-01-01 ${time}`);
            time = date.toTimeString().slice(0, 5);
        }
        document.getElementById('edit-event-time').value = time || '';
<<<<<<< HEAD
        document.getElementById('edit-event-venue').value = event.venue || '';
=======
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
        
        document.getElementById('editEventModal').style.display = 'block';

        document.getElementById('delete-event-btn').onclick = function() {
            deleteEvent(currentEventId);
        };
    }

    function deleteEvent(id) {
        if (!confirm('Are you sure you want to delete this tech talk slot?')) return;

        if (!id || isNaN(id)) {
            alert('Invalid event ID');
            return;
        }

        sendAjaxRequest('/PDC/deletetechtalk', { id: id }, function(response) {
            if (response.success) {
                events = events.filter(event => event.id != id);
                renderCalendar();
                closeEditModal();
                window.location.reload();
            } else {
                alert('Failed to delete tech talk: ' + (response.error || 'Unknown error'));
            }
        });
    }

    function closeEditModal() {
        document.getElementById('editEventModal').style.display = 'none';
    }

    // AJAX function to handle POST requests
    function sendAjaxRequest(url, data, callback) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    callback(JSON.parse(xhr.responseText));
                } else {
                    console.error('Error:', xhr.statusText);
                    alert('An error occurred while processing your request: ' + xhr.statusText);
                }
            }
        };
        const params = Object.keys(data).map(key => `${key}=${encodeURIComponent(data[key])}`).join('&');
        xhr.send(params);
    }

    // Handle Create Event
    document.getElementById('event-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const eventDate = document.getElementById('event-date').value;
        const eventTime = document.getElementById('event-time').value;
<<<<<<< HEAD
        const eventVenue = document.getElementById('event-venue').value;
        const newEvent = {
            date: eventDate,
            time: eventTime,
            venue: eventVenue
=======
        const newEvent = {
            date: eventDate,
            time: eventTime
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
        };
        console.log('Creating tech talk:', newEvent); // Debug
        sendAjaxRequest('/PDC/createtechtalk', newEvent, function(response) {
            console.log('Create response:', response); // Debug
            if (response.success) {
                events.push({
                    id: response.id,
                    date: response.date,
                    time: response.time,
<<<<<<< HEAD
                    venue: response.venue,
=======
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
                    title: 'Tech Talk',
                    description: 'Scheduled Tech Talk'
                });
                renderCalendar();
                document.getElementById('event-form').reset();
                closeModal();
                window.location.reload();
            } else {
                alert('Failed to create tech talk: ' + (response.error || 'Unknown error'));
            }
        });
    });

    // Handle Edit Event
    document.getElementById('edit-event-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('edit-event-id').value;
        const eventDate = document.getElementById('edit-event-date').value;
        const eventTime = document.getElementById('edit-event-time').value;
<<<<<<< HEAD
        const eventVenue = document.getElementById('edit-event-venue').value;
        const updatedEvent = {
            id: id,
            date: eventDate,
            time: eventTime,
            venue: eventVenue
=======
        const updatedEvent = {
            id: id,
            date: eventDate,
            time: eventTime
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
        };
        sendAjaxRequest('/PDC/edittechtalk', updatedEvent, function(response) {
            if (response.success) {
                const eventIndex = events.findIndex(event => event.id == id);
                if (eventIndex !== -1) {
                    events[eventIndex] = {
                        ...events[eventIndex],
                        date: eventDate,
<<<<<<< HEAD
                        time: eventTime,
                        venue: eventVenue
=======
                        time: eventTime
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
                    };
                    renderCalendar();
                    closeEditModal();
                    window.location.reload();
                }
            } else {
                alert('Failed to update tech talk: ' + (response.error || 'Unknown error'));
            }
        });
    });

    // Initialize calendar
    try {
        renderCalendar();
    } catch (error) {
        console.error('Error rendering calendar:', error);
    }

    // Company visit logic (unchanged)
    let map;
    let markers = [];
    const companies = [{
            name: "Company A",
            address: "123 Main St, City A",
            lat: 40.7128,
            lng: -74.0060,
            city: "City A"
        },
        {
            name: "Company B",
            address: "456 Elm St, City B",
            lat: 40.7120,
            lng: -74.0050,
            city: "City B"
        },
        {
            name: "Company C",
            address: "789 Oak St, City C",
            lat: 40.7138,
            lng: -74.0070,
            city: "City C"
        },
        {
            name: "Company D",
            address: "101 Pine St, City A",
            lat: 40.7150,
            lng: -74.0080,
            city: "City A"
        },
        {
            name: "Company E",
            address: "202 Birch St, City B",
            lat: 40.7112,
            lng: -74.0035,
            city: "City B"
        },
        {
            name: "Company F",
            address: "303 Cedar St, City C",
            lat: 40.7145,
            lng: -74.0045,
            city: "City C"
        }
    ];

    const selectedCompanies = [];
    const visitSchedule = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 40.7128, lng: -74.0060 },
            zoom: 14,
        });
        loadCompanyMarkers();
    }

    function loadCompanyMarkers() {
        companies.forEach((company, index) => {
            const marker = new google.maps.Marker({
                position: { lat: company.lat, lng: company.lng },
                map: map,
                title: company.name,
            });
            markers.push(marker);
            const listItem = document.createElement("li");
            listItem.innerHTML = `<input type="checkbox" id="company-${index}" onclick="selectCompany(${index})"> ${company.name} - ${company.address} (${company.city})`;
            document.getElementById("company-list").appendChild(listItem);
        });
    }

    function selectCompany(index) {
        const checkbox = document.getElementById(`company-${index}`);
        const company = companies[index];
        if (checkbox.checked && selectedCompanies.length < 3) {
            selectedCompanies.push(company);
        } else if (!checkbox.checked) {
            const companyIndex = selectedCompanies.indexOf(company);
            if (companyIndex > -1) {
                selectedCompanies.splice(companyIndex, 1);
            }
        }
        updateCompanyDropdown();
        updateSelectedCompaniesDisplay();
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

    function updateSelectedCompaniesDisplay() {
        const selectedCompaniesList = document.getElementById("selected-companies");
        selectedCompaniesList.innerHTML = "";
        selectedCompanies.forEach(company => {
            const listItem = document.createElement("li");
            listItem.textContent = `${company.name} - ${company.address} (${company.city})`;
            selectedCompaniesList.appendChild(listItem);
        });
    }

    function openVisitModal() {
        if (selectedCompanies.length === 0) {
            alert("Please select at least one company from the list.");
            return;
        }
        const companyTimeSelection = document.getElementById("company-time-selection");
        companyTimeSelection.innerHTML = "";
        selectedCompanies.forEach((company, index) => {
            const companyTimeDiv = document.createElement("div");
            companyTimeDiv.classList.add("company-time");
            const companyLabel = document.createElement("label");
            companyLabel.textContent = `Time for ${company.name}:`;
            const timeInput = document.createElement("input");
            timeInput.type = "time";
            timeInput.id = `time-${index}`;
            timeInput.name = `time-${index}`;
            timeInput.required = true;
            companyTimeDiv.appendChild(companyLabel);
            companyTimeDiv.appendChild(timeInput);
            companyTimeSelection.appendChild(companyTimeDiv);
        });
        document.getElementById("addVisitModal").style.display = "block";
    }

    document.getElementById("visit-form").addEventListener("submit", function(e) {
        e.preventDefault();
        const visitDate = document.getElementById("visit-date").value;
        const visitTimes = selectedCompanies.map((company, index) => ({
            companyName: company.name,
            visitTime: document.getElementById(`time-${index}`).value
        }));
        const newVisit = { visitDate, visitTimes };
        visitSchedule.push(newVisit);
        addVisitToTable(newVisit);
        closeVisitModal();
    });

    function addVisitToTable(visit) {
        const tableBody = document.getElementById("visit-table").getElementsByTagName("tbody")[0];
        visit.visitTimes.forEach((visitTime, index) => {
            const newRow = tableBody.insertRow();
            if (index === 0) {
                const dateCell = newRow.insertCell(0);
                dateCell.rowSpan = visit.visitTimes.length;
                dateCell.textContent = visit.visitDate;
            }
            const companyCell = newRow.insertCell(-1);
            companyCell.textContent = visitTime.companyName;
            const timeCell = newRow.insertCell(-1);
            timeCell.textContent = visitTime.visitTime;
            const actionCell = newRow.insertCell(-1);
            const editButton = document.createElement("button");
            editButton.textContent = "Edit";
            editButton.onclick = () => editVisit(newRow, visit.visitDate, visitTime.companyName);
            actionCell.appendChild(editButton);
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Delete";
            deleteButton.onclick = () => deleteVisitRow(newRow);
            actionCell.appendChild(deleteButton);
        });
    }

    function deleteVisitRow(row) {
        const tableBody = document.getElementById("visit-table").getElementsByTagName("tbody")[0];
        tableBody.removeChild(row);
    }

    function editVisit(row, date, companyName) {
        const visitIndex = visitSchedule.findIndex(v => v.visitDate === date);
        const companyIndex = selectedCompanies.findIndex(c => c.name === companyName);
        const visitTime = visitSchedule[visitIndex].visitTimes[companyIndex];
        document.getElementById("visit-date").value = date;
        document.getElementById(`time-${companyIndex}`).value = visitTime.visitTime;
        document.getElementById("addVisitModal").style.display = "block";
        document.getElementById("visit-form").onsubmit = function(e) {
            e.preventDefault();
            const newVisitTime = document.getElementById(`time-${companyIndex}`).value;
            visitSchedule[visitIndex].visitTimes[companyIndex].visitTime = newVisitTime;
            row.cells[1].textContent = newVisitTime;
            closeVisitModal();
        };
    }

    function filterCompaniesByCity() {
        const selectedCity = document.getElementById("city-filter").value;
        document.getElementById("company-list").innerHTML = "<li><b>Available Companies:</b></li>";
        companies.forEach((company, index) => {
            if (selectedCity === "" || company.city === selectedCity) {
                const listItem = document.createElement("li");
                listItem.innerHTML = `<input type="checkbox" id="company-${index}" onclick="selectCompany(${index})"> ${company.name} - ${company.address} (${company.city})`;
                document.getElementById("company-list").appendChild(listItem);
            }
        });
    }

    function closeVisitModal() {
        document.getElementById("addVisitModal").style.display = "none";
    }

    window.onload = initMap;
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>