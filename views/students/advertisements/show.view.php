<?php require base_path('views/partials/auth/auth.php') ?>

    <style>
        .yellow {
            color: var(--yellow-400);
        }
    </style>

    <script>

        function setPriority(priority) {
            const input = document.getElementById('priority')
            const star1 = document.getElementById('star1')
            const star2 = document.getElementById('star2')
            const star3 = document.getElementById('star3')
            const star4 = document.getElementById('star4')
            const star5 = document.getElementById('star5')

            const stars = [star1, star2, star3, star4, star5]

            for (const star of stars) {
                star.classList.remove('yellow')
            }

            for (let i = 0; i < priority; i++) {
                stars[i].classList.add('yellow')

            }


            input.value = priority
        }
    </script>

    <main style="min-height: 100vh; padding: 40px 20px;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 30px;">
            <!-- Job Details Section -->
            <div style="flex: 2; min-width: 300px; background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <h1 style="font-size: 2.2rem; color: #1a202c; margin: 0 0 10px; font-weight: 700;"><?= htmlspecialchars($ad['internship_role']) ?></h1>
                <div style="margin-bottom: 25px;">
                    <span style="font-size: 1.25rem; color: #2d3748; font-weight: 600;"><?= htmlspecialchars($ad['name']) ?></span>
                    <br/>
                    <span style="font-size: 0.9rem; color: #718096; line-height: 1.5;">
                    <?= htmlspecialchars($ad['building']) ?>,
                    <?= htmlspecialchars($ad['street_name']) ?>,
                    <?= htmlspecialchars($ad['city']) ?>
                </span>
                    <br/>
                    <span style="font-size: 0.9rem; color: #4a5568; font-weight: 500; margin-top: 8px; display: block;">
                    Number of Vacancies: <strong><?= isset($ad['vacancy_count']) ? htmlspecialchars($ad['vacancy_count']) : 'N/A' ?></strong>
                </span>
                </div>

                <div style="margin-bottom: 30px;">
                    <h2 style="font-size: 1.5rem; color: #2d3748; margin: 0 0 15px; font-weight: 600;">Key Responsibilities</h2>
                    <div style="font-size: 1rem; color: #4a5568; line-height: 1.8; background: #f7fafc; padding: 20px; border-radius: 8px;">
                        <?= nl2br(htmlspecialchars($ad['responsibilities'])) ?>
                    </div>
                </div>

                <div>
                    <h2 style="font-size: 1.5rem; color: #2d3748; margin: 0 0 15px; font-weight: 600;">Required Qualifications & Skills</h2>
                    <div style="font-size: 1rem; color: #4a5568; line-height: 1.8; background: #f7fafc; padding: 20px; border-radius: 8px;">
                        <?= nl2br(htmlspecialchars($ad['qualifications_skills'])) ?>
                    </div>
                </div>
            </div>

            <!-- Apply Form Section -->
            <div style="flex: 1; min-width: 300px; background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <h2 style="font-size: 1.5rem; color: #2d3748; margin: 0 0 20px; font-weight: 600;">Apply for this Job</h2>
                <form action="/students/applications" id="apply_form" method="post" style="display: flex; flex-direction: column; gap: 20px;">
                    <input type="hidden" name="ad_id" value="<?= htmlspecialchars($ad['id']) ?>">
                    <div>
                        <label for="resume" style="font-size: 1rem; color: #2d3748; font-weight: 500; display: block; margin-bottom: 8px;">Resume</label>
                        <div class="select" style="width: 100%">
                            <select id="resume" name="cv_id" class="select">
                                <?php foreach ($userCvs as $cv): ?>
                                    <option value="<?= htmlspecialchars($cv['id']) ?>"><?= htmlspecialchars($cv['original_name']) ?>
                                        <?php if(!empty($cv['type'])):  ?>
                                            (<?= htmlspecialchars($cv['type']) ?>)
                                        <?php endif;?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="down_note"></div>

                        <div style="margin-top: 8px">
                            <?php if (isset($errors['cv_id'])): ?>
                                <div class="error">
                                    <?= htmlspecialchars($errors['cv_id']) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div style="margin-top: 1rem">
                            <label for="rate" style="font-size: 1rem; color: #2d3748; font-weight: 500; display: block; margin-bottom: 8px;">Priority</label>
                            <div>
                                <i id="star1" class="fas fa-star" onclick="setPriority(1)"></i>
                                <i id="star2" class="fas fa-star" onclick="setPriority(2)"></i>
                                <i id="star3" class="fas fa-star" onclick="setPriority(3)"></i>
                                <i id="star4" class="fas fa-star" onclick="setPriority(4)"></i>
                                <i id="star5" class="fas fa-star" onclick="setPriority(5)"></i>
                            </div>

                            <input type="hidden" name="rate" id="priority">
                            <div style="margin-top: .5rem">
                                <?php if (isset($errors['rate'])): ?>
                                    <div class="error">
                                        <?= htmlspecialchars($errors['rate']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button">
                        Submit Application
                    </button>
                </form>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="/styles/form.css">
    <link rel="stylesheet" href="/styles/select.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>