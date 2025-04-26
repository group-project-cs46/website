<?php require base_path('views/partials/auth/auth.php') ?>

<main>
<link rel="stylesheet" href="/styles/students/table.css">
<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
<link rel="stylesheet" href="/styles/form.css">
    <div class="container">
        <div class="title">
            <span>Your CVs</span>
        </div>

        <form action="/cv/store" method="POST" enctype="multipart/form-data" class="upload-form"
            style="margin-top: 1rem; display: flex; align-items: center; gap: 1rem">
            <div>
                <label>
                    <input type="file" name="cv" class="file-input" required>
                </label>
                <?php if (isset($errors['cv'])): ?>
                    <p class="error"><?= $errors['cv'] ?></p>
                <?php endif ?>
            </div>
            <div>
                <input type="text" name="type" placeholder="Type (optional)">
                <?php if (isset($errors['type'])): ?>
                    <p class="error"><?= $errors['type'] ?></p>
                <?php endif ?>
            </div>
            <div>
                <button type="submit" class="button">
                    Upload
                </button>
            </div>
        </form>

        <div class="grid">
            <div class="grid-header">Name</div>
            <div class="grid-header">Type</div>
            <div class="grid-header"></div>
            <div class="grid-header"></div>
            <?php foreach ($cvs as $item): ?>
                <div class="grid-item"><?php echo htmlspecialchars($item['original_name']); ?></div>

                <div class="grid-item">
                    <?php if (!empty($item['type'])): ?>
                        <?php echo htmlspecialchars($item['type']); ?>
                    <?php else: ?>
                        <span style="color: #ccc">Not specified</span>
                    <?php endif ?>
                </div>

                <div class="grid-item" style="text-align: right">
                    <a href="/cv/show?id=<?= $item['id'] ?>" target="_blank" class="button">
                        Download
                    </a>
                </div>
                <div class="grid-item" style="text-align: right">
                    <form action="/cv/delete" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" class="button is-red">
                            Delete
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>



<?php require base_path('views/partials/auth/auth-close.php') ?>
<!-- view -->


<?php

use Core\Authenticator;
use Http\Forms;
use Models\Cv;
use Models\User;


$form = Forms\CvUpload::validate($attributes = [
    'cv' => $_FILES['cv'],
    'type' => $_POST['type']
]);


// Define the target directory
$targetDir = base_path('storage/cvs/');

// Get file details
$fileTmpPath = $attributes['cv']['tmp_name'];
$fileName = $attributes['cv']['name'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

// Sanitize and hash file name
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

$user = auth_user();
//$existingCv = Cv::findByUserId($user['id']);
//dd($existingCv);
//if ($existingCv) {
//    $existingFilePath = $targetDir . $existingCv['filename'];
//    if (file_exists($existingFilePath)) {
//        unlink($existingFilePath);
//    }
//    Cv::update($existingCv['id'], $newFileName);
//} else {
//}

// Define the target file path
$targetFile = $targetDir . $newFileName;

// Move the uploaded file to the target directory
if (move_uploaded_file($fileTmpPath, $targetFile)) {
//    echo "The file has been uploaded successfully.";
    Cv::create($user['id'], $newFileName, $attributes['cv']['name'], $attributes['type']);

} else {
    $form->error('cv', 'The file has not been uploaded.')->throw();
}

//dd($attributes);

redirect('/students/cvs');

// Controllers