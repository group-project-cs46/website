<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trining Session</title>
    <style>
        *body {
                background-color: white;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: flex-start; /* Align to the top instead of center (NEW) */
        }

        .center-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align items towards the top (NEW) */
            margin-top: 50px; /* Add some space from the top (NEW) */
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
            outline: none;
            background-color: #f9f9f9;
        }

        .deadline-container {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .deadline-container .form-group {
            flex: 1;
        }

        .submit-btn {
            background-color: #3498db;
            color: white;
            padding: 12px; 
            border: none;
            border-radius: 8px;
            width: auto;
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

        .button-container {
            display: flex;
            justify-content: space-between; /* or 'space-between' or 'gap' */
            margin-top: 20px;
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
        <h2>Trining Session</h2>
        <form method="post" action="/eventsAddition">
            <div class="form-group">
                <label for="competition-name">Name</label>
                <input type="text" id="competition-name" name="competition-name" required>
            </div>

            <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="competition-name">Place</label>
                <input type="text" id="competition-name" name="competition-name" required>
            </div>
            
            <div class="deadline-container">
                <div class="form-group">
                    <label for="time">Start Time</label>
                    <input type="time" id="time" name="time" required>
                </div>
                <div class="form-group">
                    <label for="time">End Time</label>
                    <input type="time" id="time" name="time" required>
                </div>
            </div>

            <div class="button-container">
                <button type="submit" class="submit-btn"><a href="/trainingSession">Previous</a></button>
                <button type="submit" class="submit-btn"><a href="/eventStudentsManage"> Students List</a></button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>