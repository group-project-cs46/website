<?php require base_path('views/partials/auth/auth.php') ?>

<main>
    <div class="container">
        <div style="padding-bottom:10px">
            <div style="color: var(--gray-700)">
                <span style="font-size: 2rem">Applications</span>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem; font-family: Arial, sans-serif;">
            <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">ID</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Role</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Interview</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Company</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;"></th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($applications as $application): ?>
                <tr style="background-color: #ffffff;">
                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo htmlspecialchars($application['id']); ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo htmlspecialchars($application['job_role']); ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php
                        if (!empty($application['interview_date'])) {
                            echo htmlspecialchars($application['interview_date']);
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo htmlspecialchars($application['company_name']); ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <a href="/students/applications/edit?id=<?= $application['id'] ?>" style="color: var(--sky-700);">Edit</a>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <form action="/students/applications/delete" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $application['id'] ?>">
                            <button type="submit" class="button" style="background-color: var(--red-700);">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>