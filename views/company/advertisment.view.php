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
                <!-- Table rows will be rendered here -->
            </tbody>
        </table>
    </section>
</main>

<!-- Modal for Add Advertisement Form -->
<div id="addModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="form-container">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="popup-text">
                <h1>Details about Advertisement</h1>
            </div>
            <form class="form-content" onsubmit="handleSubmit(event)">
                <div class="form-field">
                    <label for="role">Job Role :</label>
                    <input type="text" id="role" placeholder="About the Job Role" required />
                </div>
                <div class="form-field">
                    <label for="responsibilities">Responsibilities :</label>
                    <input type="text" id="responsibilities" placeholder="Enter About Responsibilities" />
                </div>
                <div class="form-field">
                    <label for="qualifications">Qualifications And Skills :</label>
                    <input type="text" id="qualifications" placeholder="Enter the Qualifications And Skills" />
                </div>
                <div class="form-field">
                    <label for="maxCVs">Maximum CV's Count:</label>
                    <input type="text" id="maxCVs" placeholder="Enter the Maximum CV's Count" />
                </div>
                <div class="form-field">
                    <label for="company-link">Company details link :</label>
                    <input type="text" id="company-link" placeholder="Update the link here" />
                </div>
                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Object to store advertisement data
    const advertisements = {};

    function openModal() {
        document.getElementById("addModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("addModal").style.display = "none";
    }

    function changeCount(role, change) {
        if (advertisements[role]) {
            advertisements[role].vacancyCount += change;
            if (advertisements[role].vacancyCount < 0) advertisements[role].vacancyCount = 0;
            renderTable();
        }
    }

    function editRow(role) {
        const ad = advertisements[role];
    }

    function deleteRow(role) {
        delete advertisements[role];
        renderTable();
    }

    function handleSubmit(event) {
        event.preventDefault();
        const role = document.getElementById("role").value;
        const responsibilities = document.getElementById("responsibilities").value;
        const qualifications = document.getElementById("qualifications").value;
        const maxCVs = document.getElementById("maxCVs").value;
        const companyLink = document.getElementById("company-link").value;

        if (advertisements[role]) {
            advertisements[role].vacancyCount++;
        } else {
            advertisements[role] = {
                role,
                responsibilities,
                qualifications,
                maxCVs,
                companyLink,
                vacancyCount: 1,
            };
        }

        closeModal();
        document.querySelector(".form-content").reset();
        renderTable();
    }

    function renderTable() {
        const tableBody = document.getElementById("advertisementTable");
        tableBody.innerHTML = ""; // Clear the table body

        for (const role in advertisements) {
            const ad = advertisements[role];
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${ad.role}</td>
                <td>
                    <div class="count">
                        <button class="decrease-btn" onclick="changeCount('${ad.role}', -1)">-</button>
                        <span class="vacancy-count">${ad.vacancyCount}</span>
                        <button class="increase-btn" onclick="changeCount('${ad.role}', 1)">+</button>
                    </div>
                </td>
                <td>
                    <div class="btn-container">
                        <button class="edit-btn" onclick="editRow('${ad.role}')">Edit</button>
                        <button class="delete-btn" onclick="deleteRow('${ad.role}')">Delete</button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        }
    }

    // Initial render
    renderTable();
</script>


<?php require base_path('views/partials/auth/auth-close.php') ?>