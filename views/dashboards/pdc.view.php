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

        <!-- existing round part deleted -->

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
                    <th>Vacancy_Count</th>
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
//round parts deleted

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