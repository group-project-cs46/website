<?php require base_path('views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New PDC</title>
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
        <h2>Add New PDC</h2>
        <form method="post" action="/pdcAddition" >

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
                <input type="text" id="employee-no" name="employee_no" placeholder="Enter Employee ID Here" required pattern="^UCSC\/PDC\/\d{3}$" title="Format: UCSC/PDC/123" class="input-validate">
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

            <button type="submit" class="submit-btn">Add PDC</button>

            <?php if (isset($_SESSION['success_message']) || isset($_SESSION['error_message'])): ?>
    <div id="notification" class="notification <?= isset($_SESSION['error_message']) ? 'error' : 'success' ?>">
        <span class="icon"><?= isset($_SESSION['error_message']) ? '❌' : '✔️' ?></span>
        <span class="message"><?= $_SESSION['error_message'] ?? $_SESSION['success_message'] ?></span>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const notification = document.getElementById('notification');
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        });
    </script>
    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            font-size: 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 9999;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s, transform 0.5s;
        }
        .notification.success {
            background: linear-gradient(135deg, #4caf50, #81c784); /* Green */
        }
        .notification.error {
            background: linear-gradient(135deg, #e53935, #e35d5b); /* Red */
        }
        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }
        .notification .icon {
            font-size: 20px;
        }
        .notification .message {
            flex-grow: 1;
        }
    </style>
    <?php 
    unset($_SESSION['success_message']);
    unset($_SESSION['error_message']);
    ?>
<?php endif; ?>

        </form>
    </div>
</div>
</body>
<script>
    function validatePDCForm() {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const employeeNo = document.getElementById('employee-no').value.trim();
        const title = document.getElementById('title').value.trim();
        const contact = document.getElementById('contact-no').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!name || !email || !employeeNo || !title || !contact || !password) {
            alert('Please fill all required fields.');
            return false;
        }
        return true;
    }
</script>

</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>
