<?php require base_path(path: 'views/partials/auth/auth.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Profile</title>
    <link rel="stylesheet" href="/styles/pasindu/pdcEdit.css">
</head>

<body>
    <div class="container">
        <div class="add-lecturer-card">
            <h1>PDC Profile</h1>

            <div class="form-container">
                

                <!-- <div class="image-upload-section">
                    <div class="image-container">
                        <img id="previewImage" src="/api/placeholder/150/150" alt="Profile Picture">
                        <div class="camera-icon">
                            <label for="imageUpload" class="upload-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                                    <circle cx="12" cy="13" r="4"/>
                                </svg>
                            </label>
                            <input type="file" id="imageUpload" accept="image/*" hidden>
                        </div>
                    </div>
                </div> -->
                <label class="image-upload">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                        <circle cx="12" cy="13" r="4" />
                    </svg>
                    <img src="" alt="">
                    <input type="file" id="imageUpload" accept="image/*">
                </label>
                <script>
                    const imageUpload = document.querySelector(".image-upload")
                    const img = imageUpload.querySelector("img")
                    const svg = imageUpload.querySelector("svg")
                    img.style.display = 'none';
                    imageUpload.addEventListener("change", (e) => {
                        const file = e.target.files.length ? e.target.files[0] : null;
                        if (!file) {
                            img.style.display = 'none';
                            svg.style.display = 'block';
                            return;
                        }
                        let url = URL.createObjectURL(file)
                        img.style.display = 'block';
                        svg.style.display = 'none';
                        img.src = url;
                    })
                </script>

                <form id="lecturerForm" class="lecturer-form" action="/pdcEdition" method="post">
                    <div class="form-group">
                        <label for="name"> Name:</label>
                        <input type="text" value="<?= $PDC['name'] ?>" id="name" name="name" placeholder="Enter Name Here" required>
                    </div>

                    <div class="form-group">
                        <label for="lecturerId">Employee No:</label>
                        <input type="text" disabled value="<?= $PDC['employee_id'] ?>" id="lecturerId" name="lecturerId" placeholder="Enter Lecturer ID No. Here">
                        <input type="hidden" value="<?= $PDC['employee_id'] ?>" name="lecturerId">
                    </div>

                    <div class="form-group">
                        <label for="position">Title:</label>
                        <select id="position" name="position" required>
                            <option value="">Select Title</option>
                            <option value="Mr" <?= $PDC['title']==="Mr" ? "selected" : ""?> >Mr</option>
                            <option value="Mrs" <?= $PDC['title']==="Mrs" ? "selected" : ""?> >Mrs</option>
                            <option value="Ms" <?= $PDC['title']==="Ms" ? "selected" : ""?> >Ms</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input value="<?= $PDC['email'] ?>" type="email" id="email" name="email" placeholder="Enter Email Address Here" required>
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact No:</label>
                        <input value="<?= $PDC['contact_no'] ?>" type="tel" id="contact" name="contact" placeholder="Enter Contact No Here" required>
                    </div>

                    <button type="submit" class="add-button">Update</button>
                </form>
            </div>
        </div>
    </div>
    <!-- <script src="/scripts/pasindu/addition-form.js"></script> -->
</body>

</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>