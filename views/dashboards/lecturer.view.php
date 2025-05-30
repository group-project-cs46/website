<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/pasindu/eventsManage.css" />
<div class="mmm">
    <main class="main-content">
    <section class="content">

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <i class="fa-solid fa-calendar-check" style="font-size: 40px;"></i>
        <h2 style="margin: 0;"><b>Lecturer Dashboard</b></h2>
    </div>

    
    <div style="display: flex; gap: 15px; align-items: center;">
    <a href="/account">
        <button class="_button" style="padding: 8px 16px;">View Profile</button>
    </a>

    <!-- Logout -->
    <form action="/sessions" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="_button" style="background-color: #c0392b; padding: 8px 16px;">Logout</button>
    </form>
    </div>

</div>


            <!-- Dashboard Grid -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <!-- Left Column: Internship Applications & Recent Activities -->
                <div>

                
                    <!-- Internship Applications -->
                    <a href="/lecturers/visits" style="text-decoration: none; color: inherit;">

                    <div style="background: #f9f9f9; border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; color: #333; margin: 0 0 15px 0;">Lecturer Visit</h2>
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="max-height: 370px; overflow-y: auto; display: flex; flex-direction: column; gap: 15px;">
                        <div style="max-height: 370px; overflow-y: auto; display: flex; flex-direction: column; gap: 15px;">
                          <?php foreach ($lecturer_visits as $item): ?>
                              <?php
                                  $createdAt = strtotime($item['time']);
                                  $isNew = (time() - $createdAt) < 86400; // Last 24 hours
                              ?>
                              <div style="background: <?= $isNew ? '#e6f7ff' : 'white' ?>; border-left: <?= $isNew ? '5px solid #4a90e2' : 'none' ?>; border-radius: 8px; padding: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                                  <div>
                                      <h3 style="font-size: 16px; color: #333; margin: 0;">
                                          <?= $item['company_name'] ?>
                                          <?php if ($isNew): ?>
                                              <span style="background-color: #4a90e2; color: white; font-size: 10px; padding: 2px 6px; margin-left: 8px; border-radius: 4px;">NEW</span>
                                          <?php endif ?>
                                      </h3>
                                      <p style="font-size: 14px; color: #666; margin: 5px 0;">
                                          <?= date('Y-m-d H:i', $createdAt) ?> • Status <?= $item['status[depricated]'] ?>
                                      </p>
                                  </div>
                              </div>
                          <?php endforeach ?>
</div>

</div>


                        </div>
                       
                    </div>
</a>
                    
                </div>

                <div>
                    
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        <div style="background: #4a90e2; border-radius: 10px; padding: 20px; color: white; aspect-ratio: 1 / 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <p style="font-size: 20px; margin: 5px 0; text-align: center;">Registered PDC Account</p>
            <p style="font-size: 20px; margin: 5px 0; text-align: center;"><?= $PDC_COUNT ?></p>
        </div>

        <div style="background: #4a90e2; border-radius: 10px; padding: 20px; color: white; aspect-ratio: 1 / 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <p style="font-size: 20px; margin: 5px 0; text-align: center;">Registered Lecturer Account</p>
            <p style="font-size: 20px; margin: 5px 0; text-align: center;"><?= $LEC_COUNT ?></p>
        </div>

        <div style="background: #4a90e2; border-radius: 10px; padding: 20px; color: white; aspect-ratio: 1 / 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <p style="font-size: 20px; margin: 5px 0; text-align: center;">Registered Companies</p>
            <p style="font-size: 20px; margin: 5px 0; text-align: center;"><?= $COM_COUNT ?></p>
        </div>

        <div style="background: #4a90e2; border-radius: 10px; padding: 20px; color: white; aspect-ratio: 1 / 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <p style="font-size: 20px; margin: 5px 0; text-align: center;">Registered Students</p>
            <p style="font-size: 20px; margin: 5px 0; text-align: center;"><?= $STU_COUNT ?></p>
        </div>
</div>

                    
                </div>
            </div>
        </div>
        </section>
    </main>

   

<?php require base_path('views/partials/auth/auth-close.php'); ?>