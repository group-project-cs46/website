<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="display: flex; justify-content: center; align-items: center; padding: 20px;">
        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); padding: 40px; max-width: 900px; width: 100%; margin: 0 auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;">
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: #1a1a1a; font-size: 28px; font-weight: 600; margin: 0; line-height: 1.3;">Internship Advertisement #<?= $advertisement['id'] ?></h2>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: flex-start;">
                <!-- Details Section -->
                <div style="flex: 1; min-width: 300px;">
                    <div style="margin-bottom: 20px;">
                        <strong style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Role:</strong>
                        <span style="color: #2a2a2a; font-size: 16px; line-height: 1.5;"><?= $advertisement['internship_role'] ?></span>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <strong style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Maximum CVs:</strong>
                        <span style="color: #2a2a2a; font-size: 16px; line-height: 1.5;"><?= $advertisement['max_cvs'] ?></span>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <strong style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Responsibilities:</strong>
                        <p style="color: #2a2a2a; font-size: 16px; line-height: 1.6; margin: 0;"><?= $advertisement['responsibilities'] ?></p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <strong style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Qualifications & Skills:</strong>
                        <p style="color: #2a2a2a; font-size: 16px; line-height: 1.6; margin: 0;"><?= $advertisement['qualifications_skills'] ?></p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <strong style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Deadline:</strong>
                        <span style="color: #2a2a2a; font-size: 16px; line-height: 1.5;"><?= $advertisement['deadline'] ?></span>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <strong style="color: #4a4a4a; font-size: 16px; font-weight: 600; display: block; margin-bottom: 4px;">Vacancy Count:</strong>
                        <span style="color: #2a2a2a; font-size: 16px; line-height: 1.5;"><?= $advertisement['vacancy_count'] ?></span>
                    </div>
                </div>
                <!-- Image Section -->
                <div style="flex: 1; min-width: 300px; text-align: center;">
                    <img src="/files?id=<?= $advertisement['photo_id'] ?>" alt="Advertisement Image" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                </div>
            </div>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>