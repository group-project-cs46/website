<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="max-width: 900px; margin: 3rem auto; padding: 2.5rem; background: linear-gradient(145deg, #ffffff, #f9fafb); border-radius: 12px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); font-family: 'Helvetica Neue', Arial, sans-serif;">
        <!-- Header Section -->
        <header style="text-align: center; margin-bottom: 2rem;">
            <h1 style="color: #2d3748; font-size: 1.8rem; font-weight: 700; margin: 0;">Lecturer Visit: Student Progress Review</h1>
            <p style="color: #6b7280; font-size: 1rem; margin-top: 0.5rem;">Monitoring student performance at <?= htmlspecialchars($lecturer_visit['name']) ?></p>
        </header>

        <!-- Company Address -->
        <section style="background-color: #e5e7eb; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
            <h2 style="color: #2d3748; font-size: 1.2rem; font-weight: 600; margin-bottom: 0.75rem;">Company Details</h2>
            <p style="color: #6b7280; font-size: 1rem; line-height: 1.5;">
                <?= htmlspecialchars($lecturer_visit['building'] ?? '') ?>,
                <?= htmlspecialchars($lecturer_visit['street_name'] ?? '') ?>,
                <?= htmlspecialchars($lecturer_visit['address_line_2'] ?? '') ?><br>
                <?= htmlspecialchars($lecturer_visit['city'] ?? '') ?>,
                <?= htmlspecialchars($lecturer_visit['postal_code'] ?? '') ?>
            </p>
        </section>

        <!-- Visit Information -->
        <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
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
                <p style="color: #0ea5e9; font-size: 1.1rem; font-weight: 600; margin: 0.25rem 0;"><?= ucwords($lecturer_visit['status']) ?></p>
            </div>
        </section> 

        <!-- Report Upload Form -->
        <section style="background-color: var(--gray-100); padding: 2rem; border-radius: 8px;">
            <h2 style="color: #2d3748; font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem;">Upload Visit Report</h2>
            
            
          
            <form action="/uploadreports" method="post" enctype="multipart/form-data">
                <input type="hidden" name="lecturer_visit_id" value="<?= $lecturer_visit['leid'] ?>">

                <div>
                    <label style="display: block; color: #6b7280; font-size: 14px; margin-bottom: 8px;">Upload PDF Report</label>
                    <input type="file" id="pdf" name="pdf" accept=".pdf" required style="width: 100%; padding: 12px; font-size: 16px; border: 1px solid #d1d5db; border-radius: 6px; background: #fff; color: #374151; cursor: pointer;">
                    <?php if (isset($errors['pdf'])): ?>
                        <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.5rem;"><?= $errors['pdf'] ?></p>
                    <?php endif ?>
                </div>

                <button type="submit" class="button" style="width: 100%; margin-top: 1rem">Upload Report</button>
            </form>
        </section>

       


        <!-- Students List -->
        <section style="margin-bottom: 2rem;">
            <h2 style="color: #2d3748; font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem;">Students Under Review</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <?php foreach ($students_in_company as $student): ?>
                    <div style="background-color: #e5e7eb; padding: 1rem; border-radius: 8px; color: #2d3748; font-size: 1rem; text-align: center; transition: transform 0.2s; cursor: default;" onmouseover="this.style.transform='scale(1.02)';" onmouseout="this.style.transform='scale(1)';">
                        <?= htmlspecialchars($student['name']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <link rel="stylesheet" href="/styles/form.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>