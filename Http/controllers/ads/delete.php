<?php


use Core\Validator;
use Models\deleteAd;

// Get the ID of the advertisement to delete from the POST data



    try {
        // Validate if ID is provided in the POST request
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            throw new Exception('Invalid or missing advertisement ID.');
        }

        // Sanitize and fetch the ID
        $id = $_POST['id'];

        if (!$id) {
            throw new Exception('Invalid advertisement ID format.');
        }

        // Attempt to delete the advertisement
        deleteAd::delete($id);

        // Redirect after successful deletion
        header('Location: /company/advertisment');
        exit();
    } catch (Exception $e) {
        // Log the error (optional, depending on your logging setup)
        error_log('Error deleting ad: ' . $e->getMessage());

        // Redirect to the advertisements page with an error message
        header('Location: /company/advertisment?error=' . urlencode($e->getMessage()));
        exit();
    }



