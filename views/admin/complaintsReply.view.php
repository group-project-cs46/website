<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Reply</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            width: 92%;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 2rem;
        }

        .form-section {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }

        .form-section .box {
            flex: 1;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fafafa;
        }

        .box h2 {
            font-size: 18px;
            margin-bottom: 1rem;
        }

        .box textarea {
            width: 100%;
            height: 300px;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            resize: none;
        }

        .box textarea:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn-container {
            text-align: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.7rem 1.5rem;
            background-color:#007bff;
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
        <h1>Complaint Reply</h1>

        <div class="form-section">
            <div class="box">
                <h2>Complaint Details</h2>
                <textarea id="complaint-details" placeholder="Enter Complaint Here"></textarea>
            </div>
            <div class="box">
                <h2>Reply</h2>
                <textarea id="reply" placeholder="Enter Reply Here"></textarea>
            </div>
        </div>

        <div class="btn-container">
            <button class="btn">Submit</button>
        </div>
    </div>
</body>
</html>

<?php require base_path('views/partials/auth/auth-close.php') ?>
