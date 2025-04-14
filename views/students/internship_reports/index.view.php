<?php require base_path('views/partials/auth/auth.php') ?>


<div style="font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
    <!-- Header -->
    <h1 style="color: #0ea5e9; font-size: 28px; text-align: center; margin-bottom: 10px;">Monthly Company Report Upload</h1>
    <p style="color: #6b7280; font-size: 16px; text-align: center; margin-bottom: 30px;">Upload your PDF report about the company for each month.</p>

    <!-- Upload Form -->
    <div style="background: #e5e7eb; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
        <form id="reportForm" action="/students/internship_reports/store" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">

            <!-- Month Selection -->
            <div>
                <label for="month" style="display: block; color: #6b7280; font-size: 14px; margin-bottom: 8px;">Select Month</label>
                <select id="month" name="month" required style="width: 100%; padding: 12px; font-size: 16px; border: 1px solid #d1d5db; border-radius: 6px; background: #fff; color: #374151; outline: none; transition: border-color 0.2s;">
                    <option value="">Choose a month</option>
                    <option value="1">Month 1</option>
                    <option value="2">Month 2</option>
                    <option value="3">Month 3</option>
                    <option value="4">Month 4</option>
                    <option value="5">Month 5</option>
                    <option value="6">Month 6</option>
                </select>
                <?php if (isset($errors['month'])): ?>
                    <p class="error"><?= $errors['month'] ?></p>
                <?php endif ?>
            </div>

            <!-- PDF Upload -->
            <div>
                <label style="display: block; color: #6b7280; font-size: 14px; margin-bottom: 8px;">Upload PDF Report</label>
                <input type="file" id="pdf" name="pdf" accept=".pdf" required style="width: 100%; padding: 12px; font-size: 16px; border: 1px solid #d1d5db; border-radius: 6px; background: #fff; color: #374151; cursor: pointer;">
                <?php if (isset($errors['pdf'])): ?>
                    <p class="error"><?= $errors['pdf'] ?></p>
                <?php endif ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" style="background: #0ea5e9; color: #fff; padding: 12px; font-size: 16px; border: none; border-radius: 6px; cursor: pointer; transition: background 0.2s; width: 100%;">Upload Report</button>
        </form>
        <p id="status" style="color: #6b7280; font-size: 14px; text-align: center; margin-top: 10px; display: none;"></p>
    </div>

    <!-- Upload History -->
    <div>
        <h2 style="color: #0ea5e9; font-size: 22px; margin-bottom: 20px;">Upload History</h2>
        <div id="history" style="display: flex; flex-direction: column; gap: 15px;">
            <!-- Sample history item -->
            <?php foreach ($reports as $item): ?>
                <div style="background: #e5e7eb; padding: 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="color: #6b7280; font-size: 16px;">Month <?= $item['description'] ?></span><br>
                        <span style="color: #6b7280; font-size: 14px;">Uploaded: <?= date('Y-m-d H:i:s', strtotime($item['submitted_at'])) ?></span>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center">
                        <a href="/students/internship_reports/show?id=<?= $item['id'] ?>"
                           style="color: #0ea5e9; text-decoration: none; font-size: 14px;"
                           target="_blank"
                        >
                            Download PDF
                        </a>
                        <form action="/students/internship_reports/delete" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" class="button is-red">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach ?>
            <!-- More items would be added dynamically -->
        </div>
    </div>
</div>

<link rel="stylesheet" href="/styles/form.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>
