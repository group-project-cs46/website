<?php require base_path('views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Visit Session</title>
    <style>
       .center-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 50px;
            width: 100%;
        }

        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 30px;
            width: 100%;
            max-width: 700px;
            text-align: center;
        }

        .form-container h2 {
            font-size: 25px;
            margin-bottom: 20px;
            margin-top: 5px;
            color: #3498db;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .form-group input {
            width: 100%;
            padding: 9px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 14px;
        }

        .submit-btn {
            background-color: #3498db;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
        }
        .submit-btn a {
            color: white;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            height: 100%;
        } 

        .submit-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
    </style>
</head>
<body>
<div class="center-wrapper">
    <div class="form-container">
        <h2>Lecturer Visit Deatails</h2>
        <form method="post" action="/visitAddition">
            <div class="form-group">
                <label for="visit-date">Date</label>
                <input type="date" id="visit-date" name="date" required readonly>
            </div>

            <div class="form-group">
                <label for="visit-time">Time</label>
                <input type="time" id="visit-time" name="time" required readonly>
            </div>

            <div class="form-group">
                <label for="company-name">Company Name</label>
                <input type="text" id="company-name" name="company_name" required readonly>
            </div>

            <button type="submit" class="submit-btn"><a href="/calendar">Back</a></button>
        </form>
    </div>
</div>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>
