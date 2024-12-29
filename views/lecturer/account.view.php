<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="profile-container">
        <h1><span>👨‍🎓</span> PDC Profile</h1>
        <div class="profile-card">
            <div class="profile-header">
                <img src="profile-pic.png" alt="Profile Picture" class="profile-image">
                <div>
                    <h2>Dr. Manju Sri</h2>
                    <p>manjusri@ucsc.ac.lk</p>
                </div>
            </div>
            <form id="profileForm">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="Manju Sri" required>

                <label for="id">ID</label>
                <input type="text" id="id" name="id" value="2022/UCSC/PDC/223" required>

                <label for="position">Academic Position</label>
                <input type="text" id="position" name="position" value="Dr" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="manjusri@ucsc.ac.lk" required>

                <label for="contact">Contact No</label>
                <input type="tel" id="contact" name="contact" value="0715588999" required>

                <button type="submit">Save Changed</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Profile</title>
    <link rel="stylesheet" href="/styles/pasindu/accountlec.css">
</head>
<body>
    <div class="profile-container">
     
        <div class="profile-card">
            <div class="profile-header">
                <img src="profile-pic.png" alt="Profile Picture" id="profileImage" class="profile-image">
                <div>
                    <h2>Mr. Manju Sri</h2>
                    <p>manjusri@ucsc.ac.lk</p>
                </div>
            </div>
            <form id="profileForm">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="Manju Sri" required>

                <label for="id">ID</label>
                <input type="text" id="id" name="id" value="2022/UCSC/223" required>

                <label for="position">Employee No</label>
                <input type="text" id="position" name="position" value="Mr" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="manjusri@ucsc.ac.lk" required>

                <label for="contact">Contact No</label>
                <input type="tel" id="contact" name="contact" value="0715588999" required>

                <button type="submit">Save Change</button>
            </form>
        </div>
    </div>
    <script src="/scripts/pasindu/accountlec.js"></script>
</body>
</html>

<?php require base_path('views/partials/auth/auth-close.php') ?>
