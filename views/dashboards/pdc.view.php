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
                <button id="enableSecondRound" class="enable-button" disabled>Enable Second Round</button>
            </div>
        </div>

        <div class="content-boxes">
            <div class="box"><h3>Companies Registered</h3><h2>50</h2></div>
            <div class="box"><h3>Blacklisted Companies</h3><h2>5</h2></div>
            <div class="box"><h3>Students Registered</h3><h2>150</h2></div>
        </div>
        <div class="table-title">
            <div class="table-title-txt">
                <h3>Advertisements</h3>
            </div>
            <button class="view-button">View</button>
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
    const advertisements = [
        { title: "Software Engineer Intern (WSO2)", status: "Hiring", role: "Intern", applied: 10, email: "hiring@gmail.com" },
        { title: "Data Analyst Intern (Virtusa)", status: "Closed", role: "Intern", applied: 8, email: "apply@virtusa.com" },
        { title: "Frontend Developer Intern (99x)", status: "Hiring", role: "Intern", applied: 15, email: "jobs@99x.com" },
        { title: "Backend Developer Intern (Sysco LABS)", status: "Hiring", role: "Intern", applied: 12, email: "interns@syscolabs.com" },
        { title: "UI/UX Designer Intern (CreativeHub)", status: "Closed", role: "Intern", applied: 5, email: "careers@creativehub.com" }
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
