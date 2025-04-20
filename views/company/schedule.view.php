<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/schedule.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-calendar-days" style="font-size: 40px;"></i>
                <h2>Schedule</h2>
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

        <div id="companyVisitsSection" class="companyVisitsSection">
            <div class="visit-list-container">
                <table class="visit-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Lecturer Name</th>
                            <th>Lecturer's Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="company-visits-list"></tbody>
                </table>
            </div>
        </div>

        <!-- Modal for Adding/Editing Tech Talk Details -->
        <div id="techTalkModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('techTalkModal')">×</span>
                <h3>Tech Talk Details</h3>
                <form id="techTalkForm" method="POST" action="/company_schedule/store">
                    <label for="techDate">Date:</label>
                    <input type="text" id="techDate" readonly />

                    <input type="text" name="techid" id="techid" hidden />
                    <input type="text" name="techtalk_id" id="techtalk_id" hidden />

                    <label for="techTime">Time:</label>
                    <input type="text" id="techTime" readonly />

                    <label for="techVenue">Venue:</label>
                    <input type="text" id="techVenue" readonly />

                    <label for="hostName">Resource person Name:</label>
                    <input name="hostName" type="text" id="hostName" placeholder="Enter Resource person Name" required />

                    <label for="hostEmail">Resource person's Email Address:</label>
                    <input name="hostEmail" type="email" id="hostEmail" placeholder="Enter Resource person's Email" required />

                    <label for="description">Description about the topic:</label>
                    <textarea name="description" id="description" placeholder="Enter Description" required></textarea>

                    <!-- Conditionally show Save or Edit/Delete buttons -->
                    <div id="actionButtons">
                        <button type="submit" id="saveButton">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth();

    techtalks = <?php echo json_encode($techtalk); ?>;
    const events = {
        'tech-talks': techtalks,
        'company-visits': <?php 
            use Models\CompanyLecturerVisit;
            $visits = CompanyLecturerVisit::fetchAll();
            $formattedVisits = array_map(function($visit) {
                return [
                    'id' => $visit['id'],
                    'date' => $visit['date'],
                    'time' => $visit['time'],
                    'lecturer_name' => $visit['lecturer_title'] . '.' . $visit['lecturer_name'],
                    'email' => $visit['lecturer_email'],
                    'status' => $visit['status']
                ];
            }, $visits);
            echo json_encode($formattedVisits);
        ?>
    };

    // Check for success or error message and display as a browser alert
    <?php if (isset($_SESSION['success'])): ?>
        alert('<?php echo $_SESSION['success']; unset($_SESSION['success']); ?>');
        sessionStorage.setItem('savedTechTalkDate', '<?php echo isset($_SESSION['savedDate']) ? $_SESSION['savedDate'] : ''; unset($_SESSION['savedDate']); ?>');
        sessionStorage.setItem('techTalkSaved', 'true');
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        alert('<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>');
    <?php endif; ?>

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
        initializeCalendar('tech-talks');
    }

    function updateCalendarHeader(section) {
        const headerElement = document.getElementById('calendarHeader');
        headerElement.textContent = `${new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long' })} ${currentYear}`;
    }

    function initializeCalendar(section) {
        const containerId = 'tech-talks-calendar';
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

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            calendarGrid.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const dayCell = document.createElement('div');
            dayCell.className = 'day-box';
            dayCell.textContent = day;

            const cellDate = new Date(year, month, day);
            cellDate.setHours(0, 0, 0, 0);

            const isPastDate = cellDate < today;

            const event = events.find(e => e.date === dateStr);
            if (event) {
                const savedDate = sessionStorage.getItem('savedTechTalkDate');
                if (isPastDate) {
                    dayCell.classList.add('past');
                } else if (savedDate === dateStr || (event.host_name && event.host_email && event.description)) {
                    dayCell.classList.add('saved');
                } else {
                    dayCell.classList.add('highlight');
                }

                const hasTechTalk = event.host_name && event.host_email && event.description;
                dayCell.onclick = () => {
                    if (isPastDate && !hasTechTalk) {
                        alert('This date is in the past and cannot be scheduled for a new tech talk.');
                    } else {
                        openTechTalkModal(event.date, event.time, event.slot_id, event.host_name, event.host_email, event.description, event.venue, event.techtalk_id, isPastDate);
                    }
                };
            } else if (isPastDate) {
                dayCell.style.cursor = 'not-allowed';
                dayCell.onclick = () => {
                    alert('This date is in the past and cannot be scheduled for a new tech talk.');
                };
            }

            calendarGrid.appendChild(dayCell);
        }

        container.appendChild(calendarGrid);
    }

    function initializeCompanyVisitsList() {
        const visitList = document.getElementById('company-visits-list');
        visitList.innerHTML = '';

        const companyVisits = events['company-visits'];
        companyVisits.forEach((visit, index) => {
            const row = document.createElement('tr');
            const status = ['t', true, 'true', '1', 1].includes(visit.status) ? true : false;

            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const visitDate = new Date(visit.date);
            const isPastDate = visitDate < today;

            row.innerHTML = `
                <td>${visit.date}</td>
                <td>${visit.time}</td>
                <td>${visit.lecturer_name}</td>
                <td>${visit.email}</td>
                <td>
                    ${status === true ? 
                        `<form method="POST" action="/company_schedule/revert_lecturervisit" id="revertForm-${visit.id}">
                            <input type="hidden" name="visit_id" value="${visit.id}">
                            <input type="hidden" name="action" value="revert">
                            <button type="button" class="approve-button approved${isPastDate ? ' past' : ''}" onclick="confirmRevert(${visit.id}, ${isPastDate})">Approved</button>
                        </form>` : 
                        `<form method="POST" action="/company_schedule/store_lecturervisit" id="approveForm-${visit.id}">
                            <input type="hidden" name="visit_id" value="${visit.id}">
                            <input type="hidden" name="action" value="approve">
                            <button type="button" class="approve-button${isPastDate ? ' past' : ''}" onclick="confirmApproval(${visit.id}, ${isPastDate})">Approve</button>
                        </form>`
                    }
                </td>
            `;

            if (isPastDate) {
                row.classList.add('past');
            }

            visitList.appendChild(row);
        });
    }

    function confirmApproval(visitId, isPastDate) {
        if (isPastDate) {
            alert('This date has already passed and cannot be approved.');
            return;
        }

        if (confirm('Are you sure you want to approve this visit?')) {
            const form = document.getElementById(`approveForm-${visitId}`);
            const formData = new FormData(form);

            fetch('/company_schedule/store_lecturervisit', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Visit approved successfully');
                    const button = form.querySelector('.approve-button');
                    button.textContent = 'Approved';
                    button.classList.add('approved');
                    button.setAttribute('onclick', `confirmRevert(${visitId}, ${isPastDate})`);
                    form.setAttribute('action', '/company_schedule/revert_lecturervisit');
                    form.querySelector('input[name="action"]').value = 'revert';
                    form.setAttribute('id', `revertForm-${visitId}`);
                } else {
                    alert('Failed to approve visit: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while approving the visit.');
            });
        }
    }

    function confirmRevert(visitId, isPastDate) {
        if (isPastDate) {
            alert('This date has already passed and cannot be reverted.');
            return;
        }

        if (confirm('Are you sure you want to revert this approval?')) {
            const form = document.getElementById(`revertForm-${visitId}`);
            const formData = new FormData(form);

            fetch('/company_schedule/revert_lecturervisit', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Visit approval reverted successfully');
                    const button = form.querySelector('.approve-button');
                    button.textContent = 'Approve';
                    button.classList.remove('approved');
                    button.setAttribute('onclick', `confirmApproval(${visitId}, ${isPastDate})`);
                    form.setAttribute('action', '/company_schedule/store_lecturervisit');
                    form.querySelector('input[name="action"]').value = 'approve';
                    form.setAttribute('id', `approveForm-${visitId}`);
                } else {
                    alert('Failed to revert visit approval: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while reverting the visit approval.');
            });
        }
    }

    window.onload = () => {
        updateCalendarHeader('tech-talks');
        initializeCalendar('tech-talks');
        initializeCompanyVisitsList();
        toggleSchedule('tech-talks');

        if (sessionStorage.getItem('techTalkSaved') === 'true') {
            const saveButton = document.getElementById('saveButton');
            if (saveButton) {
                saveButton.classList.add('saved');
            }
        }
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

    function openTechTalkModal(date, time, slot_id, host_name, host_email, description, venue, techtalk_id, isPast) {
        console.log('Opening modal with slot_id:', slot_id);
        document.getElementById('techDate').value = date;
        document.getElementById('techTime').value = time;
        document.getElementById('techid').value = slot_id;
        document.getElementById('techtalk_id').value = techtalk_id || '';
        document.getElementById('hostName').value = (host_name !== null && host_name !== undefined && host_name !== 'NULL') ? host_name : '';
        document.getElementById('hostEmail').value = (host_email !== null && host_email !== undefined && host_email !== 'NULL') ? host_email : '';
        document.getElementById('description').value = (description !== null && description !== undefined && description !== 'NULL') ? description : '';
        document.getElementById('techVenue').value = (venue !== null && venue !== undefined && venue !== 'NULL') ? venue : '';

        const hostNameInput = document.getElementById('hostName');
        const hostEmailInput = document.getElementById('hostEmail');
        const descriptionInput = document.getElementById('description');

        if (isPast) {
            hostNameInput.setAttribute('readonly', 'readonly');
            hostEmailInput.setAttribute('readonly', 'readonly');
            descriptionInput.setAttribute('readonly', 'readonly');
        } else {
            hostNameInput.removeAttribute('readonly');
            hostEmailInput.removeAttribute('readonly');
            descriptionInput.removeAttribute('readonly');
        }

        const hasData = host_name && host_email && description;
        const actionButtons = document.getElementById('actionButtons');
        actionButtons.innerHTML = '';

        if (isPast) {
            actionButtons.innerHTML = '';
        } else if (hasData) {
            actionButtons.innerHTML = `
            <button type="button" id="editButton" onclick="editTechTalk()">Edit</button>
            <button type="button" id="deleteButton" onclick="deleteTechTalk()">Delete</button>
        `;
        } else {
            actionButtons.innerHTML = `<button type="submit" id="saveButton">Save</button>`;
            if (sessionStorage.getItem('techTalkSaved') === 'true') {
                const saveButton = document.getElementById('saveButton');
                saveButton.classList.add('saved');
            }
        }

        document.getElementById('techTalkModal').style.display = 'flex';
        sessionStorage.setItem('currentTechTalkDate', date);
    }

    function editTechTalk() {
        const form = document.getElementById('techTalkForm');
        form.action = '/company_schedule/edit';
        form.submit();
    }

    function deleteTechTalk() {
        if (confirm('Are you sure you want to delete this tech talk?')) {
            const form = document.getElementById('techTalkForm');
            form.action = '/company_schedule/delete';
            form.submit();
        }
    }

    let lastClickedRow;

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>
