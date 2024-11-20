<?php require base_path('views/partials/auth/auth.php') ?>

<link rel="stylesheet" href="/styles/company/advertisment.css" />

<main class="main-content">
    <header class="header">
        <div class="above">
            <div class="above-left">
                <i class="fa-solid fa-file-invoice" style="font-size: 40px;"></i>
                <h2>Ads</h2>
            </div>
            <div class="above-right">
                <div class="company-info">
                    <i class="fa-regular fa-building" style="font-size: 40px;"></i>
                    <div class="company-name">Creative<br>Software</div>
                </div>
                <div>
                    <i class="fa-solid fa-bell" style="font-size: 40px;"></i>
                </div>
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
                    <th>Job Type</th>
                    <th>Vacancy Count</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="advertisementTable">
                <?php foreach ($advertisements as $ad): ?>
                    <tr id="row-<?= $ad['id'] ?>">
                        <td><?= htmlspecialchars($ad['job_type']) ?></td>
                        <td>
                            <div class="count">
                                <button class="decrease-btn" onclick="changeCount(<?= $ad['id'] ?>, -1)">-</button>
                                <span id="vacancy-<?= $ad['id'] ?>" class="vacancy-count"><?= $ad['max_cvs'] ?></span>
                                <button class="increase-btn" onclick="changeCount(<?= $ad['id'] ?>, 1)">+</button>
                            </div>
                        </td>
                        <td>
                            <div class="btn-container">
                                <button class="view-btn" onclick="viewRow(<?= $ad['id'] ?>)">View</button>
                                <button class="edit-btn" onclick="editRow(<?= $ad['id'] ?>)">Edit</button>
                                <button class="delete-btn" onclick="deleteRow(<?= $ad['id'] ?>)">Delete</button>
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
                <h1>Advertisement Details</h1>
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
                <h1>Details about Advertisement</h1>
            </div>
            <form class="form-content" method="POST" action="/ads/store">
                <div class="form-field">
                    <label for="job_type">Job Type :</label>
                    <input type="text" name="job_type" id="job_type" placeholder="About the Job Type" required />
                </div>
                <div class="form-field">
                    <label for="job_role">Job Role :</label>
                    <input type="text" name="job_role" id="job_role" placeholder="About the Job Role" required />
                </div>
                <div class="form-field">
                    <label for="responsibilities">Responsibilities :</label>
                    <input type="text" name="responsibilities" id="responsibilities" placeholder="Enter Responsibilities" />
                </div>
                <div class="form-field">
                    <label for="qualification_skills">Qualifications And Skills :</label>
                    <input type="text" name="qualification_skills" id="qualification_skills" placeholder="Enter Qualifications And Skills" />
                </div>
                <div class="form-field">
                    <label for="maxCVs">Maximum CV's Count:</label>
                    <input type="number" name="maxCVs" id="maxCVs" placeholder="Enter the Maximum CV's Count" />
                </div>
                <div class="form-field">
                    <label for="company_link">Company Details Link :</label>
                    <input type="url" name="company_link" id="company_link" placeholder="Update the link here" />
                </div>
                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Fetch and display advertisement details
function viewRow(id) {
    fetch(`/advertisment.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const ad = data.advertisement;
                const detailsHTML = `
                    <p><strong>Job Type:</strong> ${ad.job_type}</p>
                    <p><strong>Job Role:</strong> ${ad.job_role}</p>
                    <p><strong>Responsibilities:</strong> ${ad.responsibilities}</p>
                    <p><strong>Qualifications & Skills:</strong> ${ad.qualification_skills}</p>
                    <p><strong>Maximum CVs:</strong> ${ad.maxCVs}</p>
                    <p><strong>Company Link:</strong> <a href="${ad.company_link}" target="_blank">${ad.company_link}</a></p>
                `;
                document.getElementById('adDetails').innerHTML = detailsHTML;
                document.getElementById('viewModal').style.display = 'block';
            } else {
                alert('Error fetching advertisement details.');
            }
        });
}

// Modal controls
function closeViewModal() {
    document.getElementById('viewModal').style.display = 'none';
}

function openModal() {
    document.getElementById('addModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('addModal').style.display = 'none';
}

function deleteRow(id) {
    if (confirm('Are you sure you want to delete this advertisement?')) {
        fetch('/advertisment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'delete',
                id: id,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the row from the table
                const row = document.getElementById(`row-${id}`);
                row.parentNode.removeChild(row);
                alert('Advertisement deleted successfully.');
            } else {
                alert('Error deleting advertisement.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting advertisement.');
        });
    }
}

// Edit advertisement
function editRow(id) {
    fetch(`/advertisment.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const ad = data.advertisement;
                document.getElementById('job_type').value = ad.job_type;
                document.getElementById('job_role').value = ad.job_role;
                document.getElementById('responsibilities').value = ad.responsibilities;
                document.getElementById('qualification_skills').value = ad.qualification_skills;
                document.getElementById('maxCVs').value = ad.maxCVs;
                document.getElementById('company_link').value = ad.company_link;
                document.getElementById('addModal').style.display = 'block';
            } else {
                alert('Error fetching advertisement details.');
            }
        });
}

// Update vacancy count
function changeCount(id, change) {
    const currentCount = parseInt(document.getElementById(`vacancy-${id}`).innerText);
    const newCount = currentCount + change;
    if (newCount >= 0) {
        document.getElementById(`vacancy-${id}`).innerText = newCount;

        // Update the database
        fetch('/advertisment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'update',
                id: id,
                vacancy_count: newCount,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert('Error updating vacancy count.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating vacancy count.');
        });
    }
}

</script>
