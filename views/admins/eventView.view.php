<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            width: 100%;
            max-width: 900px;
            display: flex;
            gap: 30px;
        }

        .competition-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 300px;
        }

        .card-header {
            background-color: #3498db;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .card-header h1 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .card-header p {
            font-size: 18px;
        }

        .details-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .detail-item {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .detail-item h2 {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .de-item{
            display: flex;
            gap: 20px;
        }

        .detail-item p {
            font-size: 18px;
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #3498db;
            color: white;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="competition-card">
            <div class="card-header">
                <h1>Hour of Code</h1>
                <p>2025/02/10</p>
            </div>
        </div>

        <div class="details-section">
            <div class="detail-item">
                <h2>Competition Name</h2>
                <p>Hour of Code</p>
            </div>

            <div class="detail-item">
                <h2>Date</h2>
                <p>2025/02/10</p>
            </div>

            <div class="detail-item">
                <h2>Time</h2>
                <p>9.00 am</p>
            </div>

            <div class="de-item">

            <div class="detail-item">
                <h2>Deadline</h2>
                <p>2025/02/05</p>
            </div>
            <div class="detail-item">
                <h2>Deadline Time</h2>
                <p>12.00 am</p>
            </div>
        </div>

            <div class="button-container">
                <button class="btn" onclick="goBack()">Back</button>
                <button class="btn" onclick="viewList()">View List</button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            // Add your back navigation logic here
            console.log('Back button clicked');
        }

        function viewList() {
            // Add your view list logic here
            console.log('View List button clicked');
        }
    </script>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>