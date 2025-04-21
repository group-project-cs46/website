<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Details</title>
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
    </style>
</head>
<body>
<div class="center-wrapper">
    <div class="form-container">
        <h2>Competition Details</h2>
        <form method="post" action="/eventsEdition">
    <div class="form-group">
        <label for="competition-name">Competition Name</label>
        <input type="text" id="competition-name" name="competition-name" value="<?= $event['name'] ?>" readonly>
    </div>

    <div class="form-group">
        <label for="events-no">Event No</label>
        <input type="text" id="events-no" name="events-no" value="<?= $event['events_no'] ?>" readonly>
    </div>

    <div class="deadline-container">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="<?= $event['date'] ?>" readonly>
        </div>
        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" id="time" name="time" value="<?= $event['time'] ?>" readonly>
        </div>
    </div>

    <div class="deadline-container">
        <div class="form-group">
            <label for="deadline-date">Deadline Date</label>
            <input type="date" id="deadline-date" name="deadline-date" value="<?= $event['deadline_date'] ?>" readonly>
        </div>
        <div class="form-group">
            <label for="deadline-time">Deadline Time</label>
            <input type="time" id="deadline-time" name="deadline-time" value="<?= $event['deadline_time'] ?>" readonly>
        </div>
    </div>

            <div class="button-container">
            <button type="submit" class="submit-btn"><a href="/eventmanage">Previous</a></button>
            <button type="submit" class="submit-btn"><a href="/eventStudentsManage"> Students List</a></button>
</div>

        </form>
    </div>
    </div>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>