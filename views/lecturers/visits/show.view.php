<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="max-width: 1200px; margin: 3rem auto; padding: 2.5rem; background: linear-gradient(145deg, #ffffff, #f9fafb); border-radius: 12px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); font-family: 'Helvetica Neue', Arial, sans-serif;">
        <!-- Header Section -->
        <header style="text-align: center; margin-bottom: 2rem;">
            <h1 style="color: #2d3748; font-size: 1.8rem; font-weight: 700; margin: 0;">Lecturer Visit: Student Progress
                Review</h1>
            <p style="color: #6b7280; font-size: 1rem; margin-top: 0.5rem;">Monitoring student performance
                at <?= htmlspecialchars($lecturer_visit['company_name']) ?></p>
        </header>

        <!-- Company Address -->
        <section style="background-color: #e5e7eb; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
            <h2 style="color: #2d3748; font-size: 1.2rem; font-weight: 600; margin-bottom: 0.75rem;">Company
                Details</h2>
            <p style="color: #6b7280; font-size: 1rem; line-height: 1.5;">
                <span style="font-weight: bold">
                    <?= htmlspecialchars($lecturer_visit['company_name'] ?? '') ?>
                    <br>
                </span>
                <?= htmlspecialchars($lecturer_visit['company_building'] ?? '') ?>,
                <?= htmlspecialchars($lecturer_visit['company_street_name'] ?? '') ?>,
                <?= htmlspecialchars($lecturer_visit['company_address_line_2'] ?? '') ?><br>
                <?= htmlspecialchars($lecturer_visit['company_city'] ?? '') ?>,
                <?= htmlspecialchars($lecturer_visit['company_postal_code'] ?? '') ?>
            </p>
        </section>

        <!-- Visit Information -->
        <section
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <div style="background-color: #ffffff; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); text-align: center;">
                <span style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Visit ID</span>
                <p style="color: #2d3748; font-size: 1.1rem; font-weight: 600; margin: 0.25rem 0;"><?= $lecturer_visit['id'] ?></p>
            </div>
            <div style="background-color: #ffffff; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); text-align: center;">
                <span style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Date</span>
                <p style="color: #2d3748; font-size: 1.1rem; font-weight: 600; margin: 0.25rem 0;"><?= date('d-m-Y', strtotime($lecturer_visit['date'])) ?></p>
            </div>
            <div style="background-color: #ffffff; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); text-align: center;">
                <span style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Time</span>
                <p style="color: #2d3748; font-size: 1.1rem; font-weight: 600; margin: 0.25rem 0;"><?= date('H:i', strtotime($lecturer_visit['time'])) ?></p>
            </div>
            <div style="background-color: #ffffff; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); text-align: center;">
                <span style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Status</span>
                <p style="color: #0ea5e9; font-size: 1.1rem; font-weight: 600; margin: 0.25rem 0;">
                    <?php if ($lecturer_visit['visited']): ?>
                        <span style="color: #16a34a;">Visited</span>
                    <?php elseif (strtotime($lecturer_visit['date'] . ' ' . $lecturer_visit['time']) < time()): ?>
                        <span style="color: #dc2626;">Not Visited</span>
                    <?php else: ?>
                        <span style="color: #fbbf24;">Pending</span>
                    <?php endif; ?>
                </p>
            </div>
        </section>

        <!-- Report Upload Form -->
        <section style="background-color: var(--gray-100); padding: 2rem; border-radius: 8px;">
            <div style="border: 1px solid var(--gray-200); padding-inline: 2rem; padding-block: 1rem; border-radius: 8px; background-color: var(--gray-50);">
                <?php if ($lecturer_visit['report_file_id']): ?>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span><?= $lecturer_visit['report_file_name'] ?></span>
                        <a href="/lecturers/visits/reports?id=<?= $lecturer_visit['report_file_id'] ?>" class="button">
                            <button>
                                Download
                            </button>
                        </a>
                    </div>
                <?php else: ?>
                    <p style="color: #6b7280; font-style: italic; margin-bottom: 1rem; text-align: center">not uploaded yet</p>
                <?php endif ?>
            </div>


            <h2 style="color: #2d3748; font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem;">Upload Visit
                Report</h2>
            <form action="/lecturers/visits/reports" method="post" enctype="multipart/form-data">
                <div>
                    <label style="display: block; color: #6b7280; font-size: 14px; margin-bottom: 8px;">Upload PDF
                        Report</label>
                    <input type="file" id="pdf" name="pdf" accept=".pdf" required
                           style="width: 100%; padding: 12px; font-size: 16px; border: 1px solid #d1d5db; border-radius: 6px; background: #fff; color: #374151; cursor: pointer;">
                    <?php if (isset($errors['pdf'])): ?>
                        <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.5rem;"><?= $errors['pdf'] ?></p>
                    <?php endif ?>
                </div>
                <input type="hidden" name="id" value="<?= htmlspecialchars($lecturer_visit['id']) ?>">
                <button type="submit" class="button"
                        style="width: 100%; margin-top: 1rem; font-weight: 500"><?= $lecturer_visit['report_file_id'] ? "Change Report" : "Upload Report" ?></button>
            </form>
        </section>

        <!-- Students List -->
        <section style="margin-top: 2rem; padding: 2rem; border-radius: 12px; background-color: var(--gray-100);">
            <h2 style="color: #1a202c; font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; text-align: center; text-transform: uppercase; letter-spacing: 0.05em;">
                Students Under Review</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <?php if (empty($students_in_company)): ?>
                    <div style="background-color: #f9fafb; padding: 1.5rem; border-radius: 10px; text-align: center; color: #4a5568; font-size: 1rem; font-weight: 500;">
                        No students found for this company.
                    </div>
                <?php endif; ?>
                <?php foreach ($students_in_company as $student): ?>
                    <div style="background-color: #ffffff; padding: 1.5rem; border-radius: 10px; display: flex; align-items: center; gap: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); transition: transform 0.3s ease, box-shadow 0.3s ease; border: 1px solid #e2e8f0;">
                        <div style="font-size: 1rem; font-weight: 600; color: #2d3748; flex: 1;"><?= htmlspecialchars($student['name']) ?></div>
                        <div style="font-size: 0.9rem; color: #4a5568; flex: 1;"><?= htmlspecialchars($student['index_number']) ?></div>
                        <div style="font-size: 0.9rem; color: #4a5568; flex: 1;"><?= htmlspecialchars($student['registration_number']) ?></div>
                        <div style="font-size: 0.9rem; color: #4a5568; flex: 1; word-break: break-all;"><?= htmlspecialchars($student['email']) ?></div>
                        <div style="font-size: 0.9rem; color: #4a5568; flex: 1;"><?= htmlspecialchars($student['mobile']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <link rel="stylesheet" href="/styles/form.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>