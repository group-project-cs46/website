<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject Reason Form</title>
    <style>
        /* *body {
            background-color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .center-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
        } */

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
            padding: 10px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 15px;
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
        <h2>Reject Reason</h2>
        <form method="post" action="/add-reason">
            <div class="form-group">
                <label for="session-name">Name</label>
                <input type="text" id="session-name" name="name" value="<?= $TRAINING_SESSION['name'] ?>" required>
            </div>

            <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="<?= $TRAINING_SESSION['date'] ?>" required>
            </div>

            <div class="form-group">
                <label for="venue">Place</label>
                <input type="text" id="venue" name="venue" value="<?= $TRAINING_SESSION['venue'] ?>" required>
            </div>
            
            <div class="deadline-container">
                <div class="form-group">
                    <label for="start time">Start Time</label>
                    <input type="time" id="time" name="start_time" value="<?= $TRAINING_SESSION['start_time'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="end time">End Time</label>
                    <input type="time" id="time" name="end_time" value="<?= $TRAINING_SESSION['end_time'] ?>" required>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $TRAINING_SESSION['id'] ?>">

            <button type="submit" class="submit-btn">Save Change</button>
        </form>
    </div>
    </div>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>