<?php require base_path('views/partials/auth/auth.php') ?>

    <main style="min-height: 100vh; padding: 20px; display: flex; justify-content: center; align-items: flex-start;">
        <div style="width: 100%; max-width: 1200px; background: #ffffff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 30px; margin: 20px;">
            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1 style="font-size: 28px; color: #333; margin: 0; font-weight: 600;">Welcome to Your Internship Dashboard</h1>
                <div style="display: flex; gap: 10px;">
                    <button style="padding: 10px 20px; background: #4a90e2; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; transition: background 0.3s;">View Profile</button>
                    <button style="padding: 10px 20px; background: #e94e77; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; transition: background 0.3s;">Logout</button>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <!-- Left Column: Internship Applications & Recent Activities -->
                <div>
                    <!-- Internship Applications -->
                    <div style="background: #f9f9f9; border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; color: #333; margin: 0 0 15px 0;">Your Internship Applications</h2>
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            <div style="background: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h3 style="font-size: 16px; color: #333; margin: 0;">Software Engineering Intern</h3>
                                    <p style="font-size: 14px; color: #666; margin: 5px 0;">Google Inc. • Applied on 04/10/2025</p>
                                </div>
                                <span style="padding: 5px 15px; background: #28a745; color: white; border-radius: 12px; font-size: 12px;">Under Review</span>
                            </div>
                            <div style="background: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h3 style="font-size: 16px; color: #333; margin: 0;">Data Science Intern</h3>
                                    <p style="font-size: 14px; color: #666; margin: 5px 0;">Microsoft • Applied on 04/05/2025</p>
                                </div>
                                <span style="padding: 5px 15px; background: #ffc107; color: white; border-radius: 12px; font-size: 12px;">Interview Scheduled</span>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; margin-top: 15px; color: #4a90e2; text-decoration: none; font-size: 14px;">View All Applications</a>
                    </div>

                    <!-- Recent Activities -->
                    <div style="background: #f9f9f9; border-radius: 10px; padding: 20px;">
                        <h2 style="font-size: 20px; color: #333; margin: 0 0 15px 0;">Recent Activities</h2>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px; color: #333;">
                                Submitted application for Google Inc. • <span style="color: #666;">04/10/2025</span>
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px; color: #333;">
                                Scheduled interview with Microsoft • <span style="color: #666;">04/08/2025</span>
                            </li>
                            <li style="padding: 10px 0; font-size: 14px; color: #333;">
                                Updated profile information • <span style="color: #666;">04/01/2025</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Column: Profile & Deadlines -->
                <div>
                    <!-- Profile Overview -->
                    <div style="background: #4a90e2; border-radius: 10px; padding: 20px; color: white; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; margin: 0 0 15px 0;">Profile Overview</h2>
                        <p style="font-size: 14px; margin: 5px 0;">Name: John Doe</p>
                        <p style="font-size: 14px; margin: 5px 0;">Major: Computer Science</p>
                        <p style="font-size: 14px; margin: 5px 0;">University: XYZ University</p>
                        <p style="font-size: 14px; margin: 5px 0;">Applications: 5</p>
                        <a href="#" style="display: inline-block; margin-top: 15px; color: white; text-decoration: underline; font-size: 14px;">Edit Profile</a>
                    </div>

                    <!-- Upcoming Deadlines -->
                    <div style="background: #f9f9f9; border-radius: 10px; padding: 20px;">
                        <h2 style="font-size: 20px; color: #333; margin: 0 0 15px 0;">Upcoming Deadlines</h2>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <div style="font-size: 14px; color: #333;">
                                Amazon Internship Application • <span style="color: #e94e77;">04/20/2025</span>
                            </div>
                            <div style="font-size: 14px; color: #333;">
                                Meta Internship Submission • <span style="color: #e94e77;">04/25/2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require base_path('views/partials/auth/auth-close.php') ?>