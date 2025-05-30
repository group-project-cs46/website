<?php require base_path('views/partials/auth/auth.php'); ?>
<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/company/advertisment.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
            <i class="fa-solid fa-rectangle-ad" style="font-size: 40px;"></i>
                <h2>Ads</h2>
            </div> 
        </div>
    </header>

    <section class="content">
        <div class="table-title">
            <div class="table-title-txt">
                <h3>Advertisement</h3>
                <p>View current Advertisement</p>
            </div>
            <button class="add-button" onclick="openModal()">+</button>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <th>Job Role</th>
                    <th>Job Role</th>
                    <th>Vacancy Count</th>
                    <th>Deadline Date</th>
                    <th>Deadline Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="advertisementTable">
                <?php foreach ($advertisements as $ad): ?>
                    <tr id="row-<?= $ad['id'] ?>">
                        <td><?= htmlspecialchars($ad['job_role']) ?></td>
                        <td><?= htmlspecialchars($ad['vacancy_count']) ?></td>
                        <td><?= htmlspecialchars($ad['deadline']) ?></td>
                        <td><?= htmlspecialchars($ad['job_role']) ?></td>
                        <td><?= htmlspecialchars($ad['vacancy_count']) ?></td>
                        <td><?= htmlspecialchars($ad['deadline']) ?></td>
                        <td>
                            <div class="btn-container">
                                <button class="view-btn" onclick="viewAd(<?= $ad['id'] ?>)">View</button>
                                <button class="edit-btn" onclick="editAd(<?= $ad['id'] ?>)">Edit</button>
                                <form method="POST" action="/ads/delete" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="id" value="<?= $ad['id'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="delete-btn" type="submit">Delete</button>
                                </form>
                                <button class="view-btn" onclick="viewAd(<?= $ad['id'] ?>)">View</button>
                                <button class="edit-btn" onclick="editAd(<?= $ad['id'] ?>)">Edit</button>
                                <form method="POST" action="/ads/delete" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="id" value="<?= $ad['id'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="delete-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<!-- Modal for Viewing Advertisement Details -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <div class="form-container">
            <span class="close" onclick="closeViewModal()">&times;</span>
            <div class="popup-text">
                <h3>Advertisement Details</h3>
                <h3>Advertisement Details</h3>
            </div>
            <div id="adDetails">
                <!-- Advertisement details will be dynamically injected here -->
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Advertisement -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <div class="form-container">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="popup-text">
                <h2>Details about Advertisement</h2>
                <h2>Details about Advertisement</h2>
            </div>
            <form class="form-content" method="POST" action="/ads/store" onsubmit="return validateForm();">
            <form class="form-content" method="POST" action="/ads/store" onsubmit="return validateForm();">
                <div class="form-field">
                    <label for="job_role">Job Role :</label>
                    <input type="text" name="job_role" id="job_role" list="jobRoles" placeholder="Type or select a job role" required />
                    <datalist id="jobRoles">
                        <option value="Software Engineer">
                        <option value="Cybersecurity Analyst">
                        <option value="DevOps Engineer">
                        <option value="IT Support Specialist">
                        <option value="AI/ML Engineer">
                        <option value="Data Analyst">
                    </datalist>
                    <input type="text" name="job_role" id="job_role" list="jobRoles" placeholder="Type or select a job role" required />
                    <datalist id="jobRoles">
                        <option value="Software Engineer">
                        <option value="Cybersecurity Analyst">
                        <option value="DevOps Engineer">
                        <option value="IT Support Specialist">
                        <option value="AI/ML Engineer">
                        <option value="Data Analyst">
                    </datalist>
                </div>
                <div class="form-field">
                    <label for="responsibilities">Responsibilities :</label>
                    <textarea name="responsibilities" id="responsibilities" placeholder="Enter Responsibilities" rows="4"></textarea>
                    <textarea name="responsibilities" id="responsibilities" placeholder="Enter Responsibilities" rows="4"></textarea>
                </div>
                <div class="form-field">
                    <label for="qualification_skills">Qualifications And Skills :</label>
                    <textarea name="qualification_skills" id="qualification_skills" placeholder="Enter Qualifications And Skills" rows="4"></textarea>
                </div>
                <div class="form-field">
                    <label for="vacancy_count">Vacancy Count :</label>
                    <input type="number" name="vacancy_count" id="vacancy_count" placeholder="Enter Vacancy Count" />
                    <textarea name="qualification_skills" id="qualification_skills" placeholder="Enter Qualifications And Skills" rows="4"></textarea>
                </div>
                <div class="form-field">
                    <label for="vacancy_count">Vacancy Count :</label>
                    <input type="number" name="vacancy_count" id="vacancy_count" placeholder="Enter Vacancy Count" />
                </div>
                <div class="form-field">
                    <label for="maxCVs">Maximum CV's Count:</label>
                    <input type="number" name="maxCVs" id="maxCVs" placeholder="Enter the Maximum CV's Count" />
                </div>
                <div class="form-field">
                    <label for="deadline">Deadline Date :</label>
                    <input type="date" name="deadline" id="deadline" placeholder="Enter Deadline Date" />
                    <label for="deadline">Deadline Date :</label>
                    <input type="date" name="deadline" id="deadline" placeholder="Enter Deadline Date" />
                </div>
                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Editing Advertisement Details -->
<div id="editModal" class="modal" style="display: none;">
    <div class="edit-modal-content">
        <div class="edit-form-container">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <div class="popup-text">
                <h3>Edit Advertisement</h3>
            </div>
            <form id="editAdForm" method="post" action="/ads/edit" onsubmit="return validateEditForm();">
                <input type="hidden" id="edit_id" name="id">
                <div class="edit-form-field">
                    <label for="edit_job_role">Job Role :</label>
                    <input type="text" id="edit_job_role" name="job_role" list="editJobRoles" required>
                    <datalist id="editJobRoles">
                        <option value="Software Engineer">
                        <option value="Cybersecurity Analyst">
                        <option value="DevOps Engineer">
                        <option value="IT Support Specialist">
                        <option value="AI/ML Engineer">
                        <option value="Data Analyst">
                    </datalist>
                </div>
                <div class="edit-form-field">
                    <label for="edit_responsibilities">Responsibilities :</label>
                    <textarea id="edit_responsibilities" name="responsibilities" required></textarea>
                </div>
                <div class="edit-form-field">
                    <label for="edit_qualifications_skills">Qualifications And Skills :</label>
                    <textarea id="edit_qualifications_skills" name="qualifications_skills" required></textarea>
                </div>
                <div class="edit-form-field">
                    <label for="edit_vacancy_count">Vacancy Count:</label>
                    <input type="number" id="edit_vacancy_count" name="vacancy_count" required>
                </div>
                <div class="edit-form-field">
                    <label for="edit_max_cvs">Maximum CVs:</label>
                    <input type="number" id="edit_max_cvs" name="max_cvs" required>
                </div>
                <div class="edit-form-field">
                    <label for="edit_deadline">Deadline:</label>
                    <input type="date" id="edit_deadline" name="deadline" required>
                </div>
                <button class="submit-btn" type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Editing Advertisement Details -->
<div id="editModal" class="modal" style="display: none;">
    <div class="edit-modal-content">
        <div class="edit-form-container">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <div class="popup-text">
                <h3>Edit Advertisement</h3>
            </div>
            <form id="editAdForm" method="post" action="/ads/edit" onsubmit="return validateEditForm();">
                <input type="hidden" id="edit_id" name="id">
                <div class="edit-form-field">
                    <label for="edit_job_role">Job Role :</label>
                    <input type="text" id="edit_job_role" name="job_role" list="editJobRoles" required>
                    <datalist id="editJobRoles">
                        <option value="Software Engineer">
                        <option value="Cybersecurity Analyst">
                        <option value="DevOps Engineer">
                        <option value="IT Support Specialist">
                        <option value="AI/ML Engineer">
                        <option value="Data Analyst">
                    </datalist>
                </div>
                <div class="edit-form-field">
                    <label for="edit_responsibilities">Responsibilities :</label>
                    <textarea id="edit_responsibilities" name="responsibilities" required></textarea>
                </div>
                <div class="edit-form-field">
                    <label for="edit_qualifications_skills">Qualifications And Skills :</label>
                    <textarea id="edit_qualifications_skills" name="qualifications_skills" required></textarea>
                </div>
                <div class="edit-form-field">
                    <label for="edit_vacancy_count">Vacancy Count:</label>
                    <input type="number" id="edit_vacancy_count" name="vacancy_count" required>
                </div>
                <div class="edit-form-field">
                    <label for="edit_max_cvs">Maximum CVs:</label>
                    <input type="number" id="edit_max_cvs" name="max_cvs" required>
                </div>
                <div class="edit-form-field">
                    <label for="edit_deadline">Deadline:</label>
                    <input type="date" id="edit_deadline" name="deadline" required>
                </div>
                <button class="submit-btn" type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Modal controls
    const advertisement = <?php echo json_encode($advertisements); ?>;

    // Function to view advertisement details
    function viewAd(adId) {
        // Find the clicked advertisement by its ID
        const ad = advertisement.find(ad => ad.id === adId);

        if (ad) {
            // Get the modal content area
            const adDetails = document.getElementById('adDetails');

            // Populate the modal with advertisement details
            adDetails.innerHTML = `
            <form>
                <div class="form-field">
                    <label for="job_role">Job Role:</label>
                    <input type="text" id="job_role" value="${ad.job_role}" readonly>
                </div>
                <div class="form-field">
            <label for="responsibilities">Responsibilities:</label>
            <textarea id="responsibilities" readonly>${ad.responsibilities}</textarea>
        </div>
        <div class="form-field">
            <label for="qualification_skills">Qualifications And Skills:</label>
            <textarea id="qualification_skills" readonly>${ad.qualifications_skills}</textarea>
        </div>
                <div class="form-field">
                    <label for="max_cvs">Vacancy Count:</label>
                    <input type="text" id="vacancy_count" value="${ad.vacancy_count}" readonly>
                </div>
                <div class="form-field">
                    <label for="max_cvs">Maximum CVs:</label>
                    <input type="text" id="max_cvs" value="${ad.max_cvs}" readonly>
                </div>
                <div class="form-field">
                    <label for="deadline">Deadline:</label>
                    <input type="text" id="deadline" value="${ad.deadline}" readonly>
                </div>
            </form>
        `;

            // Show the modal
            document.getElementById('viewModal').style.display = 'block';
        } else {
            alert('Advertisement not found!');
        }
    }

    function confirmDelete() {
        return confirm("Are you sure you want to delete this advertisement?");
    }
    // Modal controls
    const advertisement = <?php echo json_encode($advertisements); ?>;

    // Function to view advertisement details
    function viewAd(adId) {
        // Find the clicked advertisement by its ID
        const ad = advertisement.find(ad => ad.id === adId);

        if (ad) {
            // Get the modal content area
            const adDetails = document.getElementById('adDetails');

            // Populate the modal with advertisement details
            adDetails.innerHTML = `
            <form>
                <div class="form-field">
                    <label for="job_role">Job Role:</label>
                    <input type="text" id="job_role" value="${ad.job_role}" readonly>
                </div>
                <div class="form-field">
            <label for="responsibilities">Responsibilities:</label>
            <textarea id="responsibilities" readonly>${ad.responsibilities}</textarea>
        </div>
        <div class="form-field">
            <label for="qualification_skills">Qualifications And Skills:</label>
            <textarea id="qualification_skills" readonly>${ad.qualifications_skills}</textarea>
        </div>
                <div class="form-field">
                    <label for="max_cvs">Vacancy Count:</label>
                    <input type="text" id="vacancy_count" value="${ad.vacancy_count}" readonly>
                </div>
                <div class="form-field">
                    <label for="max_cvs">Maximum CVs:</label>
                    <input type="text" id="max_cvs" value="${ad.max_cvs}" readonly>
                </div>
                <div class="form-field">
                    <label for="deadline">Deadline:</label>
                    <input type="text" id="deadline" value="${ad.deadline}" readonly>
                </div>
            </form>
        `;

            // Show the modal
            document.getElementById('viewModal').style.display = 'block';
        } else {
            alert('Advertisement not found!');
        }
    }

    function confirmDelete() {
        return confirm("Are you sure you want to delete this advertisement?");
    }

    function closeViewModal() {
        document.getElementById('viewModal').style.display = 'none';
    }
    function closeViewModal() {
        document.getElementById('viewModal').style.display = 'none';
    }

    function openModal() {
        document.getElementById('addModal').style.display = 'block';
    }
    function openModal() {
        document.getElementById('addModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('addModal').style.display = 'none';
    }
    function closeModal() {
        document.getElementById('addModal').style.display = 'none';
    }

    // Function to open the Edit Modal and populate fields
    function editAd(adId) {
        const ad = advertisement.find(ad => ad.id === adId);

        if (ad) {
            document.getElementById('edit_id').value = ad.id;
            document.getElementById('edit_job_role').value = ad.job_role;
            document.getElementById('edit_responsibilities').value = ad.responsibilities;
            document.getElementById('edit_qualifications_skills').value = ad.qualifications_skills;
            document.getElementById('edit_vacancy_count').value = ad.vacancy_count;
            document.getElementById('edit_max_cvs').value = ad.max_cvs;
            document.getElementById('edit_deadline').value = ad.deadline;

            document.getElementById('editModal').style.display = 'block';
        }
    }

    // Function to close the Edit Modal
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Function to handle form submission and update data
    async function submitEditAd(event) {
        event.preventDefault(); // Prevent default form submission

        const form = document.getElementById('editAdForm');
        const formData = new FormData(form);

        try {
            const response = await fetch('/ads/edit', {
                method: 'POST',
                body: formData,
            });

            if (response.ok) {
                const updatedAd = await response.json();
                console.log('Updated Ad:', updatedAd);

                // Update the table dynamically
                const row = document.getElementById(`row-${updatedAd.id}`);
                row.querySelector('td:nth-child(1)').textContent = updatedAd.job_role;
                row.querySelector('td:nth-child(2)').textContent = updatedAd.vacancy_count;
                row.querySelector('td:nth-child(3)').textContent = updatedAd.deadline;

                // Close the modal
                closeEditModal();
                alert('Advertisement updated successfully!');
    // Function to open the Edit Modal and populate fields
    function editAd(adId) {
        const ad = advertisement.find(ad => ad.id === adId);

        if (ad) {
            document.getElementById('edit_id').value = ad.id;
            document.getElementById('edit_job_role').value = ad.job_role;
            document.getElementById('edit_responsibilities').value = ad.responsibilities;
            document.getElementById('edit_qualifications_skills').value = ad.qualifications_skills;
            document.getElementById('edit_vacancy_count').value = ad.vacancy_count;
            document.getElementById('edit_max_cvs').value = ad.max_cvs;
            document.getElementById('edit_deadline').value = ad.deadline;

            document.getElementById('editModal').style.display = 'block';
        }
    }

    // Function to close the Edit Modal
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Function to handle form submission and update data
    async function submitEditAd(event) {
        event.preventDefault(); // Prevent default form submission

        const form = document.getElementById('editAdForm');
        const formData = new FormData(form);

        try {
            const response = await fetch('/ads/edit', {
                method: 'POST',
                body: formData,
            });

            if (response.ok) {
                const updatedAd = await response.json();
                console.log('Updated Ad:', updatedAd);

                // Update the table dynamically
                const row = document.getElementById(`row-${updatedAd.id}`);
                row.querySelector('td:nth-child(1)').textContent = updatedAd.job_role;
                row.querySelector('td:nth-child(2)').textContent = updatedAd.vacancy_count;
                row.querySelector('td:nth-child(3)').textContent = updatedAd.deadline;

                // Close the modal
                closeEditModal();
                alert('Advertisement updated successfully!');
            } else {
                // Log and handle error responses
                const error = await response.json();
                console.error("Error response:", error);
                alert(error.error || 'Failed to update the advertisement.');
            }
        } catch (err) {
            console.error("Fetch Error:", err); // Debugging
            alert('An error occurred while updating the advertisement.');
        }
    }

    function validateForm() {
        const vacancyCount = document.getElementById('vacancy_count').value;
        const maxCVs = document.getElementById('maxCVs').value;
        const deadline = document.getElementById('deadline').value;
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

        // Check if values are negative or non-integer
        if (vacancyCount < 0 || maxCVs < 0 || !Number.isInteger(Number(vacancyCount)) || !Number.isInteger(Number(maxCVs))) {
            alert('Vacancy Count and Maximum CV\'s Count cannot be negative or non-integer.');
            return false; // Prevent form submission
        }

        // Check if deadline is in the past
        if (deadline && deadline < today) {
            alert('Please select a valid deadline date. Past dates are not allowed.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }

    function validateEditForm() {
        const vacancyCount = document.getElementById('edit_vacancy_count').value;
        const maxCVs = document.getElementById('edit_max_cvs').value;
        const deadline = document.getElementById('edit_deadline').value;
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

        // Check if values are negative or non-integer
        if (vacancyCount < 0 || maxCVs < 0 || !Number.isInteger(Number(vacancyCount)) || !Number.isInteger(Number(maxCVs))) {
            alert('Vacancy Count and Maximum CV\'s Count cannot be negative or non-integer.');
            return false; // Prevent form submission
        }

        // Check if deadline is in the past and not be null
        if (deadline && deadline < today) {
            alert('Please select a valid deadline date. Past dates are not allowed.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
                // Log and handle error responses
                const error = await response.json();
                console.error("Error response:", error);
                alert(error.error || 'Failed to update the advertisement.');
            }
        } catch (err) {
            console.error("Fetch Error:", err); // Debugging
            alert('An error occurred while updating the advertisement.');
        }
    }

    function validateForm() {
        const vacancyCount = document.getElementById('vacancy_count').value;
        const maxCVs = document.getElementById('maxCVs').value;
        const deadline = document.getElementById('deadline').value;
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

        // Check if values are negative or non-integer
        if (vacancyCount < 0 || maxCVs < 0 || !Number.isInteger(Number(vacancyCount)) || !Number.isInteger(Number(maxCVs))) {
            alert('Vacancy Count and Maximum CV\'s Count cannot be negative or non-integer.');
            return false; // Prevent form submission
        }

        // Check if deadline is in the past
        if (deadline && deadline < today) {
            alert('Please select a valid deadline date. Past dates are not allowed.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }

    function validateEditForm() {
        const vacancyCount = document.getElementById('edit_vacancy_count').value;
        const maxCVs = document.getElementById('edit_max_cvs').value;
        const deadline = document.getElementById('edit_deadline').value;
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

        // Check if values are negative or non-integer
        if (vacancyCount < 0 || maxCVs < 0 || !Number.isInteger(Number(vacancyCount)) || !Number.isInteger(Number(maxCVs))) {
            alert('Vacancy Count and Maximum CV\'s Count cannot be negative or non-integer.');
            return false; // Prevent form submission
        }

        // Check if deadline is in the past and not be null
        if (deadline && deadline < today) {
            alert('Please select a valid deadline date. Past dates are not allowed.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>