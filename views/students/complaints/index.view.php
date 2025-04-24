<?php require base_path('views/partials/auth/auth.php') ?>


<div style="font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
    <!-- Header -->
    <h1 style="color: #0ea5e9; font-size: 28px; text-align: center; margin-bottom: 10px;">Create complaints</h1>
    <p style="color: #6b7280; font-size: 16px; text-align: center; margin-bottom: 40px;">We value your feedback. Please provide details to help us address your concerns.</p>


    <!-- Upload Form -->
    <div style="padding: 20px; border-radius: 8px; margin-bottom: 30px;">
        <form id="complaintForm" method="post">
            <div style="margin-bottom: 15px;">
                <label for="subject" style="display: block; margin-bottom: 5px; font-weight: bold;">Subject</label>
                <input type="text" id="subject" name="subject" maxlength="255"
                value="<?= old('subject') ?>"
                       style="width: 100%; padding: 8px; border: 1px solid #e5e7eb; border-radius: 4px; font-size: 16px;"
                >
                <div>
                    <?php if (isset($errors['subject'])): ?>
                        <span class="error"><?= $errors['subject'] ?></span>
                    <?php endif ?>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Description</label>
                <textarea id="description" name="description"
                          style="width: 100%; padding: 8px; border: 1px solid #e5e7eb; border-radius: 4px; font-size: 16px; resize: vertical; min-height: 100px;"
                ><?= old('description') ?></textarea>
                <div>
                    <?php if (isset($errors['description'])): ?>
                        <span class="error"><?= $errors['description'] ?></span>
                    <?php endif ?>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="complaint_type" style="display: block; margin-bottom: 5px; font-weight: bold;">Complaint About</label>
                <div class="select" style="width: 100%">
                    <select class="select" name="accused_id">
                        <?php foreach ($accusable_entities as $item): ?>
                            <option <?= old('accused_id') == $item['id'] ? 'selected' : '' ?> value="<?= $item['id'] ?>"><?= $item['id'] === 1 ? "System" : $item['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="down_note"></div>
            </div>

            <button type="submit" style="background-color: #0ea5e9; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%;">Submit Complaint</button>
        </form>
    </div>
</div>

<div class="grid">
    <div class="grid-header">Subject</div>
    <div class="grid-header">About</div>
    <div class="grid-header">Status</div>
    <div class="grid-header"></div>
    <?php foreach ($complaints as $item): ?>
        <div class="grid-item">
            <a href="/students/complaints/show?id=<?= $item['id'] ?>">
                <?php echo htmlspecialchars($item['subject']); ?>
            </a>
        </div>
        <div class="grid-item"><?php echo htmlspecialchars($item['accused_id'] == 1 ? "System" : $item['accused_name']); ?></div>
        <div class="grid-item">
            <?php if ($item['status'] == 'pending'): ?>
                <span style="background-color: var(--color-primary); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Pending</span>
            <?php elseif ($item['status'] == 'in review'): ?>
                <span style="background-color: var(--yellow-500); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">In Review</span>
            <?php elseif ($item['status'] == 'resolved'): ?>
                <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Resolved</span>
            <?php elseif ($item['status'] == 'rejected'): ?>
                <span style="background-color: var(--red-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Rejected</span>
            <?php endif; ?>
        </div>
        <div class="grid-item">
            <form action="/students/complaints" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button type="submit" class="button" style="background-color: var(--red-700);">Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<link rel="stylesheet" href="/styles/form.css">
<link rel="stylesheet" href="/styles/select.css">
<link rel="stylesheet" href="/styles/students/complaints/table.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>
