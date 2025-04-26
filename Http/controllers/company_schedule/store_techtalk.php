<?php
use Models\companyTechtalk;
use Models\Notification;
use Core\Validator;
use Core\App;
use Core\Database;

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $techtalkSlotId = $_POST['techid'] ?? null;
    $hostName = $_POST['hostName'] ?? null;
    $hostEmail = $_POST['hostEmail'] ?? null;
    $description = $_POST['description'] ?? null;
    $companyId = auth_user()['id'];  // Assuming the logged-in user has a company ID

    // Validate the required fields
    if (empty($techtalkSlotId) || empty($hostName) || empty($hostEmail) || empty($description)) {
        $_SESSION['error'] = 'All fields are required';
        header('Location: /company/schedule');
        exit();
    }

    // Validate the email format
    if (!filter_var($hostEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header('Location: /company/schedule');
        exit();
    }

    // Insert host details into techtalks table
    try {
        companyTechtalk::insertHostDetails($techtalkSlotId, $companyId, $hostName, $hostEmail, $description);

        // Fetch the company name from the users table notification start
        $db = App::resolve(Database::class);
        $company = $db->query("SELECT name FROM users WHERE id = ?", [$companyId])->find();
        $companyName = $company['name'] ?? 'Unknown Company';

        // Fetch the tech talk date and time from techtalk_slots
        $techtalkSlot = $db->query("
            SELECT 
                TO_CHAR(datetime, 'YYYY-MM-DD') AS date,
                TO_CHAR(datetime, 'HH12:MI AM') AS time
            FROM techtalk_slots
            WHERE id = ?
        ", [$techtalkSlotId])->find();

        $date = $techtalkSlot['date'] ?? 'Unknown Date';
        $time = $techtalkSlot['time'] ?? 'Unknown Time';

        // Fetch all PDC user IDs
        $pdc_users = $db->query("SELECT id FROM pdcs", [])->get();

        // Send a notification to each PDC user
        foreach ($pdc_users as $pdc) {
            Notification::create(
                $pdc['id'], // user_id (PDC user)
                'New Tech Talk Scheduled',
                'A new tech talk has been scheduled by ' . $companyName . ' on ' . $date . ' at ' . $time,
                null, // No action URL as per previous pattern
                date('Y-m-d H:i:s', strtotime('+1 day')) // Expires in 1 day
            );
        }
        //above notification part
        $_SESSION['success'] = 'Tech talk details saved successfully';
        header('Location: /company/schedule');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = 'Failed to add host details';
        header('Location: /company/schedule');
        exit();
    }
}