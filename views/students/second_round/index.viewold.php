<?php require base_path('views/partials/auth/auth.php') ?>

    <main class="main-container">
        <div class="container">
            <header class="header" style="display: flex; flex-direction: column;">
                <h1 class="header-title">Select Job Roles</h1>
                <p style="color: var(--gray-500)">Select three different job roles you like for the second round</p>
            </header>

            <?php if (!$currentRound): ?>
                <div class="no-round-message">
                    <h2>No round has started yet</h2>
                </div>
            <?php else: ?>
                <form action="/students/applications/second_round" method="post" class="application-form">
                    <div class="form-group">
                        <label for="job_role_1" class="form-label">First Job Role</label>
                        <div class="select" style="width: 100%">
                            <select class="select" id="job_role_1" name="job_role_1" required>
                                <option value="" disabled selected>Select first job role</option>
                                <?php foreach ($job_roles as $item): ?>
                                    <option value="<?= htmlspecialchars($item['id']) ?>"><?= htmlspecialchars($item['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="down_note"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="job_role_2" class="form-label">Second Job Role</label>
                        <div class="select" style="width: 100%">
                            <select class="select" id="job_role_2" name="job_role_2" required>
                                <option value="" disabled selected>Select second job role</option>
                                <?php foreach ($job_roles as $item): ?>
                                    <option value="<?= htmlspecialchars($item['id']) ?>"><?= htmlspecialchars($item['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="down_note"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="job_role_3" class="form-label">Third Job Role</label>
                        <div class="select" style="width: 100%">
                            <select class="select" id="job_role_3" name="job_role_3" required>
                                <option value="" disabled selected>Select third job role</option>
                                <?php foreach ($job_roles as $item): ?>
                                    <option value="<?= htmlspecialchars($item['id']) ?>"><?= htmlspecialchars($item['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="down_note"></div>
                        </div>
                    </div>

                    <button type="submit" class="button" style="width: 100%">Apply Now</button>
                </form>
            <?php endif; ?>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
    <link rel="stylesheet" href="/styles/select.css">
    <style>
        .main-container {
            min-height: 100vh;
            padding: 2rem 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .header {
            text-align: center;
            padding: 2rem 0;
        }

        .header-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
        }

        .no-round-message {
            text-align: center;
            padding: 4rem 0;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .no-round-message h2 {
            font-size: 1.5rem;
            color: #4a5568;
            margin: 0;
        }

        .application-form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 640px) {
            .header-title {
                font-size: 2rem;
            }

            .application-form {
                padding: 1.5rem;
            }

            .submit-button {
                font-size: 1rem;
            }
        }
    </style>

<?php require base_path('views/partials/auth/auth-close.php') ?>