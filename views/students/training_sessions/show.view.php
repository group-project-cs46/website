<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px;">
        <h1 style="color: #333; text-align: center; margin-bottom: 30px;">Training Session Details</h1>

        <section style="background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; margin-bottom: 20px;">Session Details</h2>

            <div style="display: grid; gap: 15px;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0;">
                    <span style="font-weight: bold; color: #34495e;">Session Name:</span>
                    <span><?= $training_session['name'] ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0;">
                    <span style="font-weight: bold; color: #34495e;">Date:</span>
                    <span><?= date('d-m-Y', strtotime($training_session['date'])) ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0;">
                    <span style="font-weight: bold; color: #34495e;">Time:</span>
                    <div>
                        <span><?= date('H:i A', strtotime($training_session['start_time'])) ?></span> -
                        <span><?= date('H:i A', strtotime($training_session['end_time'])) ?></span>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0;">
                    <span style="font-weight: bold; color: #34495e;">Location:</span>
                    <span><?= $training_session['venue'] ?></span>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: center;">
                <a href="/students/training_sessions/register?id=<?= $training_session['id'] ?>" class="button">
                    <button>
                        Register for Session
                    </button>
                </a>
            </div>
        </section>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>