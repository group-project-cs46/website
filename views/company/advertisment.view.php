<?php require base_path('views/partials/auth/auth.php') ;?>

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
                    <th>Job Role</th>
                    <th>Vacancy Count</th>
                    <th>Deadline</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="advertisementTable">
                <?php foreach ($advertisements as $ad): ?>
                    <tr id="row-<?= $ad['id'] ?>">
                        <td><?= htmlspecialchars($ad['job_role']) ?></td>
                        <td>
                            <div class="count">
                                <button class="decrease-btn" onclick="changeCount(<?= $ad['id'] ?>, -1)">-</button>
                                <span id="vacancy-<?= $ad['id'] ?>" class="vacancy-count"><?= $ad['vacancy_count'] ?></span>
                                <button class="increase-btn" onclick="changeCount(<?= $ad['id'] ?>, 1)">+</button>
                                <span id="vacancy-<?= $ad['id'] ?>" class="vacancy-count"><?= $ad['max_cvs'] ?></span>

                            </div>
                        </td>
                        <td><?= htmlspecialchars($ad['deadline']) ?></td>
                        <td>
                            <div class="btn-container">
                                <button class="view-btn"  >View</button>
                                <button class="edit-btn" >Edit</button>
                                <button class="delete-btn" onclick="deleteAd(<?= $ad['id'] ?>)">Delete</button>
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
                <h2>Details about Advertisement</h2>
            </div>
            <form class="form-content" method="POST">
                <input type="hidden" name="action" value="create">
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
                    <label for="deadline">Deadline Date :</label>
                    <input type="date" name="deadline" id="deadline" placeholder="Enter Deadline Date" />
                </div>
                <div class="form-field">
                    <label for="maxCVs">Maximum CV's Count:</label>
                    <input type="number" name="maxCVs" id="maxCVs" placeholder="Enter the Maximum CV's Count" />
                </div>
                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    
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


async function deleteAd(id) {
    try {
    const response = await fetch('/ads/delete', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id }),
    });

    if (response.ok) {
        alert('Ad deleted successfully!');
         location.reload();
        const adElement = document.getElementById(`ad-${id}`);
        if (adElement) {
            adElement.remove();
        } else {
            console.warn(`Element with id ad-${id} not found.`);
        }
        
    } else {
        const errorText = await response.text();
        console.error('Error Response:', errorText);
        alert('Failed to delete the ad.');
    }
} catch (error) {
    console.error('Fetch Error:', error.message);
    alert('An error occurred while deleting the ad.');
}

}
</script>
