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
                        <label for="event-venue">Venue:</label>
                        <input type="text" id="event-venue" name="venue" required>
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
                        <label for="edit-event-venue">Venue:</label>
                        <input type="text" id="edit-event-venue" name="event-venue" required>
                        <div id="edit-event-description-container" style="display: none;">
                            <label for="edit-event-description">Description:</label>
                            <textarea id="edit-event-description" name="event-description" disabled></textarea>
                        </div>
                        <div id="edit-event-company-container" style="display: none;">
                            <label for="edit-event-company">Company:</label>
                            <input type="text" id="edit-event-company" name="event-company" disabled >
                        </div>
                        <div id="edit-event-contactperson-container" style="display: none;">
                            <label for="edit-event-contactperson">Contact Person:</label>
                            <input type="text" id="edit-event-contactperson" name="event-contactperson" disabled >
                        </div>
                        <div id="edit-event-contactemail-container" style="display: none;">
                            <label for="edit-event-contactemail">Contact Email:</label>
                            <input type="text" id="edit-event-contactemail" name="event-contactemail" disabled >
                        </div>
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

            <!-- Address Input and Company List -->
            <div id="map-container">
                <div id="map"></div>
                <div class="address-input">
                    <label for="user-address">Enter Your Address:</label>
                    <input type="text" id="user-address" placeholder="Enter your address" required>
                    <button onclick="findClosestCompanies()" style="color:blue">Find Closest Companies</button>
                </div>
                <label for="city-filter">Filter by City:</label>
                <select id="city-filter" onchange="filterCompaniesByCity()">
                    <option value="">All Cities</option>
                    <option value="Colombo 03">Colombo 03</option>
                    <option value="Colombo 04">Colombo 04</option>
                    <option value="Colombo 05">Colombo 05</option>
                    <option value="Colombo 09">Colombo 09</option>
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
                            <th>Lecturer</th>
                            <th>Company</th>
                            <th>Visit Time</th>
                            <th>Approved</th>
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
                            <!-- Dynamic time inputs will be generated here -->
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
    id: slot.slot_id, // Use slot_id instead of id
    date: slot.date,
    time: slot.time,
    venue: slot.venue,
    title: slot.title || 'Tech Talk',
    description: slot.description || 'N/A',
    company: slot.company_name || 'N/A',
    contactPerson: slot.host_name || 'N/A',
    contactEmail: slot.host_email || 'N/A'
})) : [];
console.log('events:', events); // Debug: Inspect events

// Pass company visits data
let visitData = <?php echo json_encode($visits); ?>;
console.log('visitData:', visitData); // Debug: Inspect visitData
let visits = visitData ? visitData.map(visit => ({
    id: visit.id,
    date: visit.date,
    time: visit.time,
    lecturer: visit.lecturer_name || 'N/A',
    company: visit.company_name || 'N/A', // Use actual status if available
    approved: visit.approved || 'No' // Use actual approved status if available
})) : [];
console.log('visits:', visits); // Debug: Inspect visits

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
        const dayDiv = document.createElement("div");
        dayDiv.textContent = i;
        dayDiv.classList.add("day-cell");

        const eventDivs = events.filter(event => 
            event.date === `${currentYear}-${(currentMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`
        );
        eventDivs.forEach(event => {
            const eventDiv = document.createElement("div");
            eventDiv.classList.add("event");
            eventDiv.style.backgroundColor = event.company && event.company !== 'N/A' ? '#90EE90' : '#007bff'; // Green for allocated, blue for unallocated
            eventDiv.style.color = '#000000'; // Ensure text is readable 
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
    document.getElementById('edit-event-venue').value = event.venue || '';

    // Conditionally show fields only if data is available (not 'N/A')
    const descriptionContainer = document.getElementById('edit-event-description-container');
    const companyContainer = document.getElementById('edit-event-company-container');
    const contactPersonContainer = document.getElementById('edit-event-contactperson-container');
    const contactEmailContainer = document.getElementById('edit-event-contactemail-container');

    if (event.description && event.description !== 'N/A') {
        document.getElementById('edit-event-description').value = event.description;
        descriptionContainer.style.display = 'block';
    } else {
        descriptionContainer.style.display = 'none';
    }

    if (event.company && event.company !== 'N/A') {
        document.getElementById('edit-event-company').value = event.company;
        companyContainer.style.display = 'block';
    } else {
        companyContainer.style.display = 'none';
    }

    if (event.contactPerson && event.contactPerson !== 'N/A') {
        document.getElementById('edit-event-contactperson').value = event.contactPerson;
        contactPersonContainer.style.display = 'block';
    } else {
        contactPersonContainer.style.display = 'none';
    }

    if (event.contactEmail && event.contactEmail !== 'N/A') {
        document.getElementById('edit-event-contactemail').value = event.contactEmail;
        contactEmailContainer.style.display = 'block';
    } else {
        contactEmailContainer.style.display = 'none';
    }
    
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
            window.location.href = '/PDC/schedule'; // Explicit redirect
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
                try {
                    const response = JSON.parse(xhr.responseText);
                    callback(response);
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    alert('An error occurred while processing the response: Invalid JSON');
                }
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
    const eventVenue = document.getElementById('event-venue').value;
    const newEvent = {
        date: eventDate,
        time: eventTime,
        venue: eventVenue
    };
    console.log('Creating tech talk:', newEvent); // Debug
    sendAjaxRequest('/PDC/createtechtalk', newEvent, function(response) {
        console.log('Create response:', response); // Debug
        if (response.success) {
            events.push({
                id: response.id,
                date: response.date,
                time: response.time,
                venue: response.venue,
                title: 'Tech Talk',
                description: 'Scheduled Tech Talk'
            });
            renderCalendar();
            document.getElementById('event-form').reset();
            closeModal();
            window.location.href = '/PDC/schedule'; // Explicit redirect
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
    const eventVenue = document.getElementById('edit-event-venue').value;
    const updatedEvent = {
        id: id,
        date: eventDate,
        time: eventTime,
        venue: eventVenue
    };
    sendAjaxRequest('/PDC/edittechtalk', updatedEvent, function(response) {
        if (response.success) {
            const eventIndex = events.findIndex(event => event.id == id);
            if (eventIndex !== -1) {
                events[eventIndex] = {
                    ...events[eventIndex],
                    date: eventDate,
                    time: eventTime,
                    venue: eventVenue
                };
                renderCalendar();
                closeEditModal();
                window.location.href = '/PDC/schedule'; // Explicit redirect
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

// Company Visit Logic
let map;
let markers = [];
let userMarker = null;
let userLatLng = null;

const companies = <?php echo json_encode(array_map(function($company) {
    $addressParts = array_filter([
        $company['building'] ?? '',
        $company['street_name'] ?? '',
        $company['address_line_2'] ?? '',
        $company['city'] ?? '',
        $company['postal_code'] ?? ''
    ]);
    $address = implode(', ', $addressParts);
    
    return [
        'id' => $company['id'],
        'name' => $company['company_name'],
        'address' => $address ?: 'Address not available',
        'city' => $company['city'] ?? 'City not available'
    ];
}, $companies)); ?>;
console.log('Companies array:', companies);

const selectedCompanies = [];

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 6.9271, lng: 79.8612 }, // Default: Colombo city center
        zoom: 12,
    });
    geocodeCompaniesAndLoadMarkers();
}

function geocodeCompaniesAndLoadMarkers() {
    const geocoder = new google.maps.Geocoder();
    Promise.all(companies.map((company, index) => {
        return new Promise((resolve) => {
            geocoder.geocode({ address: company.address }, (results, status) => {
                if (status === google.maps.GeocoderStatus.OK && results[0]) {
                    const { lat, lng } = results[0].geometry.location;
                    companies[index] = {
                        ...company,
                        lat: lat(),
                        lng: lng()
                    };
                    resolve();
                } else {
                    console.error(`Geocoding failed for ${company.address}: ${status}`);
                    companies[index] = { ...company, lat: null, lng: null };
                    resolve();
                }
            });
        });
    })).then(() => {
        const validCompanies = companies.filter(c => c.lat !== null && c.lng !== null);
        loadCompanyMarkers(validCompanies);
        updateCompanyList(validCompanies);
    }).catch(error => {
        console.error('Error geocoding companies:', error);
        alert('Failed to load company locations. Please try again later.');
    });
}

function loadCompanyMarkers(companiesToDisplay) {
    markers.forEach(marker => marker.setMap(null));
    markers = [];

    companiesToDisplay.forEach((company) => {
        if (company.lat && company.lng) {
            const marker = new google.maps.Marker({
                position: { lat: company.lat, lng: company.lng },
                map: map,
                title: company.name,
                icon: {
                    url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                }
            });
            markers.push(marker);
        }
    });
}

function updateCompanyList(companiesToDisplay) {
    const companyList = document.getElementById("company-list");
    companyList.innerHTML = "<li><b>Available Companies:</b></li>";
    companiesToDisplay.forEach((company, index) => {
        if (!company.id) {
            console.error('Company missing ID:', company);
            return;
        }
        const listItem = document.createElement("li");
        let distanceText = company.distanceText ? ` (${company.distanceText})` : '';
        listItem.innerHTML = `<input type="checkbox" id="company-${index}" onchange="selectCompany('${company.id}', '${company.name}', this.checked)"> ${company.name} - ${company.address} (${company.city})${distanceText}`;
        companyList.appendChild(listItem);

        const isSelected = selectedCompanies.some(selected => selected.id == company.id);
        document.getElementById(`company-${index}`).checked = isSelected;
    });
}

function selectCompany(companyId, companyName, isChecked) {
    console.log('Selecting company:', { companyId, companyName, isChecked });
    const company = companies.find(c => c.id == companyId);
    if (!company) {
        console.error('Company not found for ID:', companyId);
        return;
    }

    if (isChecked) {
        if (!selectedCompanies.some(selected => selected.id == company.id)) {
            if (selectedCompanies.length < 3) {
                selectedCompanies.push(company);
            } else {
                document.getElementById(`company-${index}`).checked = false;
                alert("You can select up to 3 companies.");
            }
        }
    } else {
        const companyIndex = selectedCompanies.findIndex(selected => selected.id == company.id);
        if (companyIndex > -1) {
            selectedCompanies.splice(companyIndex, 1);
        }
    }
    console.log('Updated selectedCompanies:', selectedCompanies);
}

function findClosestCompanies() {
    const address = document.getElementById("user-address").value;
    if (!address) {
        alert("Please enter your address.");
        return;
    }

    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: address }, (results, status) => {
        if (status === google.maps.GeocoderStatus.OK && results[0]) {
            userLatLng = results[0].geometry.location;

            if (userMarker) {
                userMarker.setMap(null);
            }

            userMarker = new google.maps.Marker({
                position: userLatLng,
                map: map,
                title: "Your Location",
                icon: {
                    url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
                }
            });

            map.setCenter(userLatLng);
            map.setZoom(14);

            const validCompanies = companies.filter(c => c.lat !== null && c.lng !== null);
            if (validCompanies.length === 0) {
                alert("No valid company locations available for distance calculation.");
                return;
            }

            const distanceMatrixService = new google.maps.DistanceMatrixService();
            distanceMatrixService.getDistanceMatrix({
                origins: [userLatLng],
                destinations: validCompanies.map(company => new google.maps.LatLng(company.lat, company.lng)),
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC
            }, (response, status) => {
                if (status === google.maps.DistanceMatrixStatus.OK) {
                    const distances = response.rows[0].elements;
                    const companiesWithDistance = companies.map((company, index) => {
                        if (company.lat !== null && company.lng !== null && distances[index] && distances[index].status === "OK") {
                            return {
                                ...company,
                                distance: distances[index].distance.value,
                                distanceText: distances[index].distance.text
                            };
                        } else {
                            return {
                                ...company,
                                distance: Infinity,
                                distanceText: "N/A"
                            };
                        }
                    });

                    companiesWithDistance.sort((a, b) => a.distance - b.distance);

                    companies.forEach((company, index) => {
                        companies[index] = companiesWithDistance.find(c => c.id === company.id) || company;
                    });

                    updateCompanyList(companiesWithDistance);
                } else {
                    alert("Error calculating distances: " + status);
                }
            });
        } else {
            alert("Could not find the address: " + status);
        }
    });
}

// Function to open the visit modal for adding or editing
function openVisitModal(visitId = null) {
    console.log('Opening visit modal, visitId:', visitId);
    
    // If this is an edit operation
    if (visitId) {
        const visit = visits.find(v => v.id == visitId);
        if (!visit) {
            alert("Visit not found!");
            return;
        }
        
        document.getElementById("visit-date").value = visit.date;
        
        const companyTimeSelection = document.getElementById("company-time-selection");
        companyTimeSelection.innerHTML = "<h3>Edit Visit Time:</h3>";
        
        const companyTimeDiv = document.createElement("div");
        companyTimeDiv.classList.add("company-time");
        
        const companyLabel = document.createElement("label");
        companyLabel.textContent = `Time for ${visit.company}:`;
        
        const timeInput = document.createElement("input");
        timeInput.type = "time";
        timeInput.id = `time-0`;
        timeInput.name = `time-0`;
        timeInput.value = visit.time;
        timeInput.required = true;
        
        companyTimeDiv.appendChild(companyLabel);
        companyTimeDiv.appendChild(timeInput);
        companyTimeSelection.appendChild(companyTimeDiv);
        
        // Set a data attribute to know we're editing
        document.getElementById("visit-form").dataset.visitId = visitId;
    } 
    // If this is an add operation
    else {
        if (selectedCompanies.length === 0) {
            alert("Please select at least one company from the list.");
            return;
        }
        
        const companyTimeSelection = document.getElementById("company-time-selection");
        companyTimeSelection.innerHTML = "<h3>Select Time for Companies:</h3>";
        
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
        
        // Remove any previous visit ID
        document.getElementById("visit-form").removeAttribute("data-visit-id");
    }

    document.getElementById("addVisitModal").style.display = "block";
}

// Handle the visit form submission (create or edit)
document.getElementById("visit-form").onsubmit = function(e) {
    e.preventDefault();
    const visitDate = document.getElementById("visit-date").value;
    
    // Check if we're editing (has data-visit-id attribute)
    const visitId = this.dataset.visitId;
    
    if (visitId) {
        // Handle edit operation
        const visitTime = document.getElementById("time-0").value;
        const data = { 
            id: visitId, 
            date: visitDate, 
            time: visitTime 
        };
        
        sendAjaxRequest('/PDC/editvisit', data, function(response) {
            if (response.success) {
                // Update the visit in our local array
                const visitIndex = visits.findIndex(v => v.id == visitId);
                if (visitIndex !== -1) {
                    visits[visitIndex] = { 
                        ...visits[visitIndex], 
                        date: visitDate, 
                        time: visitTime 
                    };
                    
                    // Update the UI
                    updateVisitTable();
                    closeVisitModal();
                    alert("Visit updated successfully!");
                }
            } else {
                alert('Failed to update visit: ' + (response.error || 'Unknown error'));
            }
        });
    } else {
        // Handle create operation
        const times = selectedCompanies.map((_, index) => 
            document.getElementById(`time-${index}`).value
        );
        
        const companyIds = selectedCompanies.map(company => company.id);
        
        const data = {
            date: visitDate,
            times: JSON.stringify(times),
            company_ids: JSON.stringify(companyIds)
        };

        sendAjaxRequest('/PDC/createvisit', data, function(response) {
            console.log('Create visit response:', response);
            if (response.success && response.ids) {
                // Add new visits to the visits array
                response.ids.forEach((id, index) => {
                    visits.push({
                        id: id,
                        date: visitDate,
                        time: times[index],
                        lecturer: 'N/A', // Updated on page reload
                        company: selectedCompanies[index].name,
                        approved: 'No'
                    });
                });
                
                // Update the UI
                updateVisitTable();
                closeVisitModal();
                selectedCompanies.length = 0; // Clear selections
                updateCompanyList(companies); // Refresh company list
                alert("Visits created successfully!");
            } else {
                alert('Failed to create visits: ' + (response.error || 'Unknown error'));
            }
        });
    }
};

// Update Visit Table
function updateVisitTable() {
    const tableBody = document.getElementById("visit-table").getElementsByTagName("tbody")[0];
    tableBody.innerHTML = "";
    visits.forEach(visit => addVisitToTable(visit));
}

// Add a visit to the table
function addVisitToTable(visit) {
    const tableBody = document.getElementById("visit-table").getElementsByTagName("tbody")[0];
    const newRow = tableBody.insertRow();
    newRow.dataset.visitId = visit.id;

    const dateCell = newRow.insertCell(0);
    dateCell.textContent = visit.date;

    const lecturerCell = newRow.insertCell(1);
    lecturerCell.textContent = visit.lecturer;

    const companyCell = newRow.insertCell(2);
    companyCell.textContent = visit.company;

    const timeCell = newRow.insertCell(3);
    timeCell.textContent = visit.time;

    const approvedCell = newRow.insertCell(4);
    approvedCell.textContent = visit.approved;

    const actionCell = newRow.insertCell(5);
    
    const editButton = document.createElement("button");
    editButton.textContent = "Edit";
    editButton.onclick = function(e) {
        e.preventDefault();
        openVisitModal(visit.id);
    };
    actionCell.appendChild(editButton);
    
    const deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.onclick = function(e) {
        e.preventDefault();
        deleteVisit(visit.id);
    };
    actionCell.appendChild(deleteButton);
}

// Delete Visit
function deleteVisit(visitId) {
    if (!confirm('Are you sure you want to delete this company visit?')) return;

    sendAjaxRequest('/PDC/deletevisit', { id: visitId }, function(response) {
        if (response.success) {
            visits = visits.filter(visit => visit.id != visitId);
            updateVisitTable();
            alert("Visit deleted successfully!");
        } else {
            alert('Failed to delete visit: ' + (response.error || 'Unknown error'));
        }
    });
}

function closeVisitModal() {
    document.getElementById("addVisitModal").style.display = "none";
    document.getElementById("visit-form").reset();
}

function filterCompaniesByCity() {
    const selectedCity = document.getElementById("city-filter").value;
    let filteredCompanies = companies;
    if (selectedCity) {
        filteredCompanies = companies.filter(company => company.city === selectedCity);
    }
    updateCompanyList(filteredCompanies);
    loadCompanyMarkers(filteredCompanies);
}

function closeVisitModal() {
    document.getElementById("addVisitModal").style.display = "none";
}

function sendAjaxRequest(url, data, callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    callback(response);
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    alert('An error occurred while processing the response: Invalid JSON');
                }
            } else {
                console.error('Error:', xhr.statusText);
                alert('An error occurred while processing your request: ' + xhr.statusText);
            }
        }
    };
    const params = Object.keys(data).map(key => `${key}=${encodeURIComponent(data[key])}`).join('&');
    xhr.send(params);
}

// Initialize visits table
try {
    updateVisitTable();
} catch (error) {
    console.error('Error rendering visit table:', error);
}

window.onload = initMap;
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh1Uj9nFjEWa5SotbgSKrwOc-9Tv3Jljo&callback=initMap&libraries=places"></script>