<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f3f4f6;">
        <div style="background-color: #ffffff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px;">
            <form action="/pdcs/batches/store" method="post" style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="color: #6b7280; font-weight: 500;">First Round Start:</label>
                    <div style="display: flex; gap: 1rem;">
                        <input type="date" id="first_round_start_date" name="first_round_start_date"
                               style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';">
                        <input type="time" id="first_round_start_time" name="first_round_start_time" value="00:00" required
                               style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <?php if (isset($errors['first_round_start_time'])): ?>
                        <span style="color: #e11d48; font-size: 0.75rem;">
                        <?= $errors['first_round_start_time'] ?>
                    </span>
                    <?php endif ?>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="color: #6b7280; font-weight: 500;">First Round End: <span style="font-weight: 400; font-size: 0.875rem; color: #9ca3af;">(Optional)</span></label>
                    <div style="display: flex; gap: 1rem;">
                        <input type="date" id="first_round_end_date" name="first_round_end_date"
                               style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';">
                        <input type="time" id="first_round_end_time" name="first_round_end_time" value="00:00"
                               style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <?php if (isset($errors['first_round_end_time'])): ?>
                        <span style="color: #e11d48; font-size: 0.75rem;">
                        <?= $errors['first_round_end_time'] ?>
                    </span>
                    <?php endif ?>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="color: #6b7280; font-weight: 500;">Second Round Start: <span style="font-weight: 400; font-size: 0.875rem; color: #9ca3af;">(Optional)</span></label>
                    <div style="display: flex; gap: 1rem;">
                        <input type="date" id="second_round_start_date" name="second_round_start_date"
                               style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';">
                        <input type="time" id="second_round_start_time" name="second_round_start_time" value="00:00"
                               style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <?php if (isset($errors['second_round_start_time'])): ?>
                        <span style="color: #e11d48; font-size: 0.75rem;">
                        <?= $errors['second_round_start_time'] ?>
                    </span>
                    <?php endif ?>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="color: #6b7280; font-weight: 500;">Second Round End: <span style="font-weight: 400; font-size: 0.875rem; color: #9ca3af;">(Optional)</span></label>
                    <div style="display: flex; gap: 1rem;">
                        <input type="date" id="second_round_end_date" name="second_round_end_date"
                               style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';">
                        <input type="time" id="second_round_end_time" name="second_round_end_time" value="00:00"
                               style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; color: #6b7280; font-size: 1rem; outline: none; transition: border-color 0.2s; flex: 1;"
                               onfocus="this.style.borderColor='#0ea5e9';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <?php if (isset($errors['second_round_end_time'])): ?>
                        <span style="color: #e11d48; font-size: 0.75rem;">
                        <?= $errors['second_round_end_time'] ?>
                    </span>
                    <?php endif ?>
                </div>

                <button type="submit" class="button"
                        style="background-color: #0ea5e9; color: #ffffff; padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-size: 1rem; font-weight: 500; cursor: pointer; transition: background-color 0.2s;"
                        onmouseover="this.style.backgroundColor='#0284c7';" onmouseout="this.style.backgroundColor='#0ea5e9';">
                    Create
                </button>
            </form>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>