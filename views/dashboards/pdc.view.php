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



        <!-- <div class="content-boxes">
            <div class="box"><h3>Companies Registered</h3><h2>50</h2></div>
            <div class="box"><h3>Blacklisted Companies</h3><h2>5</h2></div>
            <div class="box"><h3>Students Registered</h3><h2>150</h2></div>
        </div> -->

        <section class="info-boxes">
            <div class="info-box">
                <div class="box-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M21 20V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1zm-2-1H5V5h14v14z" />
                        <path d="M10.381 12.309l3.172 1.586a1 1 0 0 0 1.305-.38l3-5-1.715-1.029-2.523 4.206-3.172-1.586a1.002 1.002 0 0 0-1.305.38l-3 5 1.715 1.029 2.523-4.206z" />
                    </svg>
                </div>

                <div class="box-content">
                    <span class="big">50</span>
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
                    <span class="big">10</span>
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
                    <span class="big">200</span>
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
                    <span class="big">50</span>
                    Students Hired
                </div>
            </div>
        </section>

        <div class="cards">
            <div class="card">
                <h3>First Round</h3>
                <p>
                    <input type="date" id="firstRoundStart" class="date-input">
                    to
                    <input type="date" id="firstRoundEnd" class="date-input">
                </p>
                <button id="disableFirstRound" class="disable-button">Disable First Round</button>
            </div>
            <div class="card">
                <h3>Second Round</h3>
                <p>
                    <input type="date" id="secondRoundStart" class="date-input" disabled>
                    to
                    <input type="date" id="secondRoundEnd" class="date-input" disabled>
                </p>
                <button id="enableSecondRound" class="enable-button" disabled>Disable Second Round</button>
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
                <!-- Dynamic content will be injected here -->
            </tbody>
        </table>
    </section>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
    const firstRoundStart = document.getElementById('firstRoundStart');
    const firstRoundEnd = document.getElementById('firstRoundEnd');
    const disableFirstRoundButton = document.getElementById('disableFirstRound');

    const secondRoundStart = document.getElementById('secondRoundStart');
    const secondRoundEnd = document.getElementById('secondRoundEnd');
    const enableSecondRoundButton = document.getElementById('enableSecondRound');

    // Disable first round if end date has passed
    function checkFirstRoundStatus() {
        const now = new Date();
        const endDate = new Date(firstRoundEnd.value);

        if (endDate < now) {
            disableFirstRound();
        }
    }

    // Disable first round
    function disableFirstRound() {
        firstRoundStart.disabled = true;
        firstRoundEnd.disabled = true;
        disableFirstRoundButton.disabled = true;

        secondRoundStart.disabled = false;
        secondRoundEnd.disabled = false;
        enableSecondRoundButton.disabled = false;
    }

    // Enable second round
    enableSecondRoundButton.addEventListener('click', () => {
        secondRoundStart.disabled = false;
        secondRoundEnd.disabled = false;
        enableSecondRoundButton.disabled = true;
    });

    // Check the first round status on page load
    window.addEventListener('load', () => {
        checkFirstRoundStatus();
    });

    // Sample data for demonstration
    const advertisements = [{
            title: "Software Engineer Intern (WSO2)",
            status: "Hiring",
            role: "Intern",
            applied: 10,
            email: "hiring@gmail.com"
        },
        {
            title: "Data Analyst Intern (Virtusa)",
            status: "Closed",
            role: "Intern",
            applied: 8,
            email: "apply@virtusa.com"
        },
        {
            title: "Frontend Developer Intern (99x)",
            status: "Hiring",
            role: "Intern",
            applied: 15,
            email: "jobs@99x.com"
        },
        {
            title: "Backend Developer Intern (Sysco LABS)",
            status: "Hiring",
            role: "Intern",
            applied: 12,
            email: "interns@syscolabs.com"
        },
        {
            title: "UI/UX Designer Intern (CreativeHub)",
            status: "Closed",
            role: "Intern",
            applied: 5,
            email: "careers@creativehub.com"
        }
    ];

    // Render advertisements
    function renderAdvertisements(data) {
        const advertisementList = document.getElementById('advertisement-list');
        advertisementList.innerHTML = ''; // Clear existing content

        data.forEach(ad => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${ad.title}</td>
                <td style="color: ${ad.status === 'Hiring' ? '#28a745' : '#dc3545'}">${ad.status}</td>
                <td>${ad.role}</td>
                <td>${ad.applied}</td>
                <td><a href="mailto:${ad.email}" style="color: #007bff;">${ad.email}</a></td>
            `;
            advertisementList.appendChild(row);
        });
    }

    renderAdvertisements(advertisements);
</script>