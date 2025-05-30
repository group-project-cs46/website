<?php require base_path('views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Lecturer</title>
    <style>
         body {
    background-color: white;
    justify-content: center;
    margin: 0;
    padding: 0;
}

.center-wrapper {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    margin-top: 30px; /* Reduced the top margin */
    width: 100%;
}

.form-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    padding: 20px; /* Reduced the padding */
    width: 100%;
    max-width: 600px; /* Reduced max-width */
    text-align: center;
    margin-bottom: 20px; /* Added margin bottom for spacing */
}

.form-container h2 {
    font-size: 22px; /* Slightly smaller font size */
    margin-bottom: 15px; /* Reduced bottom margin */
    margin-top: 5px;
    color: #3498db;
}

.form-group {
    text-align: left;
    margin-bottom: 15px; /* Reduced bottom margin */
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 4px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 8px; /* Reduced padding */
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
    background-color: #f9f9f9;
    font-size: 14px;
    font-family: inherit;
}

.submit-btn {
    background-color: #3498db;
    color: white;
    padding: 8px; /* Reduced padding */
    border: none;
    border-radius: 8px;
    width: 100%;
    font-size: 14px; /* Reduced font size */
    cursor: pointer;
    transition: 0.3s;
    font-weight: bold;
}

.submit-btn:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
}

        .input-validate:invalid {
            border: 1px solid red;
        }
        .input-validate:valid {
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
<div class="center-wrapper">
    <div class="form-container">
        <h2>Add New Lecturer</h2>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div style="background-color: #ffdddd; padding: 10px; border-radius: 5px; color: red; margin-bottom: 10px;">
                <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error_message'])): ?>
            <div style="color: red; margin-bottom: 15px;">
                <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="/lecturerAddition">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Name Here" required>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <select id="title" name="title" required>
                    <option value="" disabled selected hidden>Select Title</option>
                    <option value="Mr">Mr.</option>
                    <option value="Mrs">Mrs.</option>
                    <option value="Miss">Miss</option>
                    <option value="Dr">Dr.</option>
                    <option value="Prof">Prof.</option>
                </select>
            </div>

            <div class="form-group">
                <label for="employee-no">Employee No:</label>
                <input type="text" id="employee-no" name="employee_no" placeholder="Enter Employee ID Here" required pattern="^UCSC\/LEC\/\d{3}$" title="Format: UCSC/LEC/123" class="input-validate">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Email Address Here" required>
            </div>

            <div class="form-group">
                <label for="contact-no">Contact No</label>
                <input type="text" id="contact-no" name="contact" placeholder="Enter Contact No Here" required pattern="^\d{10}$" title="Enter exactly 10 digits" class="input-validate">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password Here" required minlength="6">
            </div>

            <button type="submit" class="submit-btn">Add Lecturer</button>
        </form>
    </div>
</div>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>
