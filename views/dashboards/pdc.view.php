<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/PDC/Dashboard.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fa fa-dashboard" style="font-size: 40px;"></i>
            <h2>PDC Dashboard</h2>
        </div>
    </header>

    <section class="content">
        <div class="heading">
            <h2>Dashboard</h2>
        </div>

        <section class="info-boxes">
            <div class="info-box">
                <div class="box-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M21 20V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1zm-2-1H5V5h14v14z" />
                        <path d="M10.381 12.309l3.172 1.586a1 1 0 0 0 1.305-.38l3-5-1.715-1.029-2.523 4.206-3.172-1.586a1.002 1.002 0 0 0-1.305.38l-3 5 1.715 1.029 2.523-4.206z" />
                    </svg>
                </div>

                <div class="box-content">
                    <span class="big"><?php echo htmlspecialchars($registeredCompanies); ?></span>
                    Companies Registered
                </div>
            </div>

            <div class="info-box">
                <div class="box-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M20 10H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V11a1 1 0 0 0-1-1zm-1 10H5v-8h14v8zM5 6h14v2H5zM7 2h10v2H7z" />
                    </svg>
                </div>

                <div class="box-content">
                    <span class="big"><?php echo htmlspecialchars($blacklistedCompanies); ?></span>
                    Blacklisted Companies
                </div>
            </div>

            <div class="info-box">
                <div class="box-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M3,21c0,0.553,0.448,1,1,1h16c0.553,0,1-0.447,1-1v-1c0-3.714-2.261-6.907-5.478-8.281C16.729,10.709,17.5,9.193,17.5,7.5 C17.5,4.468,15.032,2,12,2C8.967,2,6.5,4.468,6.5,7.5c0,1.693,0.771,3.209,1.978,4.219C5.261,13.093,3,16.287,3,20V21z M8.5,7.5 C8.5,5.57,10.07,4,12,4s3.5,1.57,3.5,3.5S13.93,11,12,11S8.5,9.43,8.5,7.5z M12,13c3.859,0,7,3.141,7,7H5C5,16.141,8.14,13,12,13z" />
                    </svg>
                </div>

                <div class="box-content">
                    <span class="big"><?php echo htmlspecialchars($registeredStudents); ?></span>
                    Students Registered
                </div>
            </div>

            <div class="info-box">
                <div class="box-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M12 3C6.486 3 2 6.364 2 10.5c0 2.742 1.982 5.354 5 6.678V21a.999.999 0 0 0 1.707.707l3.714-3.714C17.74 17.827 22 14.529 22 10.5 22 6.364 17.514 3 12 3zm0 13a.996.996 0 0 0-.707.293L9 18.586V16.5a1 1 0 0 0-.663-.941C5.743 14.629 4 12.596 4 10.5 4 7.468 7.589 5 12 5s8 2.468 8 5.5-3.589 5.5-8 5.5z" />
                    </svg>
                </div>

                <div class="box-content">
                    <span class="big"><?php echo htmlspecialchars($hiredStudents); ?></span>
                    Students Hired
                </div>
            </div>
        </section>

        <div class="container">
            <button class="button button-primary" onclick="openAddModal()">Set New Round</button>
            <div id="rounds-container" style="margin-top: 20px;">
                <div class="no-rounds">No rounds available. Click "Set New Round" to create one.</div>
            </div>
        </div>

        <!--ADD round Modal Form -->
        <div id="roundModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="modalTitle">Set New Round</h2>
                </div>
                <form id="addRoundForm" method="POST" action="/PDC/setround">
                    <input type="hidden" id="addRoundId">
                    <div class="form-group">
                        <label for="addRoundName">Round Name</label>
                        <input type="text" id="addRoundName" name="round_name" required>
                    </div>
                    <div class="form-group">
                        <label for="addStartDate">Start Date</label>
                        <input type="date" id="addStartDate" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="addEndDate">End Date</label>
                        <input type="date" id="addEndDate" name="end_date" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-danger" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="button button-primary" id="addSubmitBtn">Set Round</button>
                    </div>
                </form>
            </div>
        </div>

        <!--Edit Round Modal Form -->
        <div id="EditroundModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="editModalTitle">Edit Round</h2>
                </div>
                <form id="editRoundForm" method="POST" action="/PDC/updateround">
                    <input type="hidden" id="editRoundId" name="id">
                    <div class="form-group">
                        <label for="editRoundName">Round Name</label>
                        <input type="text" id="editRoundName" name="round_name" required>
                    </div>
                    <div class="form-group">
                        <label for="editStartDate">Start Date</label>
                        <input type="date" id="editStartDate" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="editEndDate">End Date</label>
                        <input type="date" id="editEndDate" name="end_date" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-danger" onclick="closeEditModal()">Cancel</button>
                        <button type="submit" class="button button-primary" id="editSubmitBtn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-title">
            <div class="table-title-txt">
                <h3>Advertisements</h3>
            </div>
            <button class="view-button"><a href="/PDC/advertisements">View</a></button>
        </div>

        <table class="advertisement-table">
            <thead>
                <tr>
                    <th>Advertisement</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>No. of Students Applied</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody id="advertisement-list">
                <?php if (empty($approvedAds)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No approved advertisements available.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($approvedAds as $ad): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ad['company_name']); ?></td>
                            <td style="color: <?php echo $ad['approved'] ? '#28a745' : '#dc3545'; ?>">
                                <?php echo $ad['approved'] ? 'Approved' : 'Not Approved'; ?>
                            </td>
                            <td><?php echo htmlspecialchars($ad['job_role']); ?></td>
                            <td>
                                <?php echo htmlspecialchars($ad['vacancy_count']); ?>
                            </td>
                            <td>
                                <a href="mailto:<?php echo htmlspecialchars($ad['company_email']); ?>">
                                    <?php echo htmlspecialchars($ad['company_email']); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    // Store rounds data globally
    let rounds = <?php echo json_encode($rounds); ?>;

    // Format date to a readable string
    function formatDate(dateString) {
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };
        return new Date(dateString).toLocaleDateString(undefined, options);
    }

    // Render rounds in the DOM
    function renderRounds() {
        const container = document.getElementById('rounds-container');
        if (rounds.length) {
            let html = '';
            rounds.forEach(round => {
                html += `
                <div class="round-item" id="round-${round.id}">
                    <div class="round-info">
                        <div class="round-title">${round.round_name}</div>
                        <div class="round-dates">${formatDate(round.start_date)} - ${formatDate(round.end_date)}</div>
                    </div>
                    <div class="button-group">
                        <button class="button button-edit" onclick="openEditModal(${round.id})">Edit</button>
                        <button class="button button-danger" onclick="deleteRound(${round.id})">Delete</button>
                    </div>
                </div>`;
            });
            container.innerHTML = html;
        } else {
            container.innerHTML = '<div class="no-rounds">No rounds available. Click "Set New Round" to create one.</div>';
        }
    }

    // Open modal for editing round
    function openEditModal(id) {
        const round = rounds.find(r => r.id === id);
        if (!round) return;

        // Set values for the edit modal form fields
        document.getElementById('editRoundId').value = round.id;
        document.getElementById('editRoundName').value = round.round_name;
        document.getElementById('editStartDate').value = round.start_date;
        document.getElementById('editEndDate').value = round.end_date;

        // Open edit modal
        document.getElementById('EditroundModal').classList.add('active');
    }

    // Close edit modal
    function closeEditModal() {
        document.getElementById('EditroundModal').classList.remove('active');
        document.getElementById('editRoundForm').reset();
    }

    // Delete round from the list
    async function deleteRound(id) {
        if (!confirm("Are you sure you want to delete this round?")) {
            return;
        }

        try {
            let response = await fetch('/PDC/deleteround', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    id: id
                })
            });

            if (response.ok) {
                // Fetch updated rounds from server instead of manually filtering
                await fetchRounds();
                location.reload();
            } else {
                alert('Failed to delete round. Please try again.');
            }
        } catch (error) {
            console.error('Error deleting round:', error);
            alert('Failed to delete round. Please try again.');
        }
    }

    // Fetch rounds from the server
    async function fetchRounds() {
        try {
            const response = await fetch('/PDC/getrounds');
            if (response.ok) {
                rounds = await response.json();
                renderRounds();
            } else {
                console.error('Failed to fetch rounds');
            }
        } catch (error) {
            console.error('Error fetching rounds:', error);
        }
    }

    // Setup form submission for adding round
    document.addEventListener("DOMContentLoaded", () => {
        renderRounds();

        // Add Round Form Setup
        document.getElementById('addRoundForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            // Form validation
            const name = document.getElementById('addRoundName').value.trim();
            const startDateValue = document.getElementById('addStartDate').value;
            const endDateValue = document.getElementById('addEndDate').value;

            // Validate dates
            const startDate = new Date(startDateValue);
            const endDate = new Date(endDateValue);
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            startDate.setHours(0, 0, 0, 0);
            endDate.setHours(0, 0, 0, 0);

            if (startDate < currentDate) {
                alert("Start date must be today or a future date.");
                return;
            }
            if (endDate <= startDate) {
                alert("End date must be greater than start date.");
                return;
            }

            // Create form data for submission
            const formData = new FormData(this);

            try {
                const response = await fetch('/PDC/setround', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    closeModal();
                    await fetchRounds();
                    location.reload() // Refresh rounds from server
                } else {
                    alert('Failed to add round. Please try again.');
                }
            } catch (error) {
                console.error('Error adding round:', error);
                alert('Failed to add round. Please try again.');
            }
        });

        // Edit Round Form Setup
        document.getElementById('editRoundForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            // Form validation
            const name = document.getElementById('editRoundName').value.trim();
            const startDateValue = document.getElementById('editStartDate').value;
            const endDateValue = document.getElementById('editEndDate').value;

            // Validate dates
            const startDate = new Date(startDateValue);
            const endDate = new Date(endDateValue);
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            startDate.setHours(0, 0, 0, 0);
            endDate.setHours(0, 0, 0, 0);

            if (startDate < currentDate) {
                alert("Start date must be today or a future date.");
                return;
            }
            if (endDate <= startDate) {
                alert("End date must be greater than start date.");
                return;
            }

            // Create form data for submission
            const formData = new FormData(this);

            try {
                const response = await fetch('/PDC/updateround', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    closeEditModal();
                    await fetchRounds();
                    location.reload(); // Refresh rounds from server
                } else {
                    alert('Failed to update round. Please try again.');
                }
            } catch (error) {
                console.error('Error updating round:', error);
                alert('Failed to update round. Please try again.');
            }
        });
    });

    // Open modal for new round
    function openAddModal() {
        document.getElementById('roundModal').classList.add('active');
        document.getElementById('addRoundForm').reset();

        // Set min date for start date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('addStartDate').min = today;
    }

    // Close add modal
    function closeModal() {
        document.getElementById('roundModal').classList.remove('active');
        document.getElementById('addRoundForm').reset();
    }

    // Render advertisements
    function renderAdvertisements(data) {
        const advertisementList = document.getElementById('advertisement-list');
        advertisementList.innerHTML = ''; // Clear existing content

        data.forEach(ad => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${ad.company_name}</td>
                <td style="color: ${ad.approved === 'approved' ? '#28a745' : '#dc3545'}">${ad.approved}</td>
                <td>${ad.job_role}</td>
                <td>${ad.vacancy_count}</td>
                <td><a href="mailto:${ad.company_email}" style="color: #007bff;">${ad.company_email}</a></td>
            `;
            advertisementList.appendChild(row);
        });
    }

    // Initial load of advertisements
    document.addEventListener('DOMContentLoaded', function() {
        renderRounds();
        // Initial fetch of rounds data
        fetchRounds();
    });
</script>