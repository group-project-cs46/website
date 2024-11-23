<?php require base_path('views/partials/auth/auth.php') ?>

<main>
    <h1>Applications List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Interview</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applications as $application): ?>
                <tr>
                    <td><?php echo htmlspecialchars($application['id']); ?></td>
                    <td><?php echo htmlspecialchars($application['job_role']); ?></td>
                    <td>
                    <?php 
                        if (!empty($application['interview_date'])) {
                            echo htmlspecialchars($application['interview_date']);
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($application['company_name']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>