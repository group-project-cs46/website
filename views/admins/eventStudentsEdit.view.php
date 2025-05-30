<?php require base_path(path: 'views/partials/auth/auth.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            padding: 15px 20px;
            border-bottom: 1px solid #e1e1e1;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            text-align: center;
        }

        .form-container {
            padding: 20px;
            display: flex;
        }

        .left-column {
            flex: 1;
            padding-right: 20px;
        }

        .right-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            margin-top: 24px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23131313%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
            padding-right: 30px;
        }

        .profile-image-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 15px;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .file-upload-status {
            font-size: 13px;
            color: #777;
            margin: 10px 0;
        }

        .file-upload-buttons {
            display: flex;
            justify-content: space-between;
            width: 100%;

        }

        .btn {
            padding: 8px 15px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #3498db;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #2980b9;
        }

        .btn-file {
            background-color: #e0e0e0;
            color: #333;
            flex: 1;
            margin-right: 5px;
            text-align: center;
        }

        .btn-file:hover {
            background-color: #d1d1d1;
        }

        .btn-upload {
            background-color: #3498db;
            color: white;
            flex: 0 0 80px;
        }

        .btn-upload:hover {
            background-color: #2980b9;
        }
        .type-container {
        display: flex;
        gap: 20px; /* space between the two boxes */
        margin-bottom: 15px;
        }

        .type-container .form-group {
            flex: 1; /* makes both form-group elements take equal width */
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
    <form class="container" method="post" action="/eventsStudentsEdition">
        <div class="header">
            <h2>Edit Students</h2>
        </div>
        <!--add post -->
        <div class="form-container">
            <div class="left-column">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" value="<?= $student['name'] ?>" id="name" placeholder="Enter Name Here" name="name" required>
                </div>

                <div class="form-group">
                    <label for="student-no">Student No:</label>
                    <input type="text" value="<?= $student['student_id'] ?>" required id="student-no" placeholder="Enter Lecturer ID No. Here" name="student_no" pattern="^UCSC\/(CS|IS)\/\d{3}$" title="Format: UCSC/CS/123 or UCSC/IS/123" class="input-validate">
                </div>
                <div class="type-container">
                    <div class="form-group">
                        <label for="title">Title:</label>
                            <select id="title" name="title" required>
                                <option value="">Select Title</option>
                                <option value="mr" <?= $student['title'] === "mr" ? "selected" : "" ?>>Mr.</option>
                                <option value="mrs" <?= $student['title'] === "mr" ? "selected" : "" ?>>Mrs.</option>
                                <option value="ms" <?= $student['title'] === "mr" ? "selected" : "" ?>>Ms.</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="course">Course:</label>
                        <input type="text" value="<?= $student['course'] ?>" required id="course" placeholder="Enter Course. Here" name="course">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" value="<?= $student['email'] ?>" required placeholder="Enter Email Address Here" name="email">
                </div>

                <div class="form-group">
                    <label for="contact-no">Contact No:</label>
                    <input type="text" id="contact-no" value="<?= $student['mobile'] ?>" required placeholder="Enter Contact No Here" name="contact" pattern="^\d{10}$" title="Enter exactly 10 digits" class="input-validate">
                </div>
            </div>

            <div class="right-column">
                <div class="profile-image-container">
                    <img id="profile-preview" src="https://via.placeholder.com/150/6c7eb7/ffffff?text=Profile" alt="">
                </div>

                <div class="file-upload">
                    <div class="file-upload-buttons">
                        <button class="btn btn-file" id="choose-file-btn">Choose File</button>
                        <input type="file" id="file-input" accept="image/*" style="display: none;">
                        <button class="btn btn-upload" id="upload-btn">Upload</button>
                    </div>
                    <div class="file-upload-status" id="file-status">No file chosen</div>
                </div>

                <!-- <div class="form-group" style="width: 100%; margin-top: 15px;">
                    <label for="username">Username</label>
                    <input type="text" id="username">
                </div> -->

                <div class="form-group" style="width: 100%;">
                    <label for="password">Password</label>
                    <input type="text" id="password" required minlength="6" name="password">
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $student['id'] ?>" />

        <div style="padding: 0 20px 20px 20px;">
            <button class="btn btn-primary" id="add-and-send-btn">save change</button>
        </div>
    </form>

    <script>
        // File upload functionality
        const fileInput = document.getElementById('file-input');
        const chooseFileBtn = document.getElementById('choose-file-btn');
        const uploadBtn = document.getElementById('upload-btn');
        const fileStatus = document.getElementById('file-status');
        const profilePreview = document.getElementById('profile-preview');
        const addAndSendBtn = document.getElementById('add-and-send-btn');

        chooseFileBtn.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                fileStatus.textContent = fileInput.files[0].name;

                // Preview the selected image
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                fileStatus.textContent = 'No file chosen';
            }
        });

        uploadBtn.addEventListener('click', function() {
            if (fileInput.files.length > 0) {
                // In a real application, this would handle the file upload
                alert('Uploading file: ' + fileInput.files[0].name);
            } else {
                alert('Please choose a file first');
            }
        });

        // addAndSendBtn.addEventListener('click', function() {
        //     // Validate form fields
        //     const name = document.getElementById('name').value;
        //     const employeeNo = document.getElementById('employee-no').value;
        //     const title = document.getElementById('title').value;
        //     const email = document.getElementById('email').value;
        //     const contactNo = document.getElementById('contact-no').value;
        //     const username = document.getElementById('username').value;
        //     const password = document.getElementById('password').value;

        //     if (!name || !employeeNo || !title || !email || !contactNo || !username || !password) {
        //         alert('Please fill in all fields');
        //         return;
        //     }

        //     // In a real application, this would submit the form
        //     // alert('Form submitted successfully!');
        // });
    </script>
</body>

</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>