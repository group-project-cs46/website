<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            width: 80%;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 0.5rem;
        }

        p {
            font-size: 14px;
            color: #666;
            margin-bottom: 2rem;
        }

        .section {
            margin-bottom: 2rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fafafa;
        }

        .section h2 {
            font-size: 18px;
            margin-bottom: 1rem;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .form-group label {
            flex: 1;
            font-size: 14px;
            color: #333;
        }

        .form-group input, .form-group textarea {
            flex: 3;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group textarea {
            height: 100px;
            resize: none;
        }

        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #4b56cc;
        }

        .btn-container {
            text-align: right;
        }

        .btn {
            padding: 0.7rem 1.5rem;
            background-color: #4b56cc;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #3948a1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Complaint</h1>
        <p>View current progress</p>

        <div class="section">
            <h2>Student Details</h2>
            <div class="form-group">
                <label for="student-name">Name</label>
                <input type="text" id="student-name" placeholder="Enter Name Here">
            </div>
            <div class="form-group">
                <label for="student-email">Email</label>
                <input type="email" id="student-email" placeholder="Enter Name Here">
            </div>
            <div class="form-group">
                <label for="index-no">Index No</label>
                <input type="text" id="index-no" placeholder="Enter Name Here">
            </div>
            <div class="form-group">
                <label for="telephone">Telephone No</label>
                <input type="text" id="telephone" placeholder="Enter Name Here">
            </div>
        </div>

        <div class="section">
            <h2>Company Details</h2>
            <div class="form-group">
                <label for="company-name">Name</label>
                <input type="text" id="company-name" placeholder="Enter Name Here">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" placeholder="Enter Name Here">
            </div>
            <div class="form-group">
                <label for="date-time">Date and Time</label>
                <input type="datetime-local" id="date-time">
            </div>
            <div class="form-group">
                <label for="complaint-details">Complaint Details</label>
                <textarea id="complaint-details" placeholder="Enter Name Here"></textarea>
            </div>
        </div>

        <div class="btn-container">
            <button class="btn">Reply</button>
        </div>
    </div>
</body>
</html>

<?php require base_path('views/partials/auth/auth-close.php') ?>
