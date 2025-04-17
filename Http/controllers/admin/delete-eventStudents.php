<!-- 
// use Models\AddEventStudent;

// $id = $_POST['id'];

// try {
    // AddEventStudent::delete($id);
// } catch (\Exception $e) {
    // die($e->getMessage());
// }

// redirect('/eventStudentsManage'); -->



 
 <?php

 use Models\AddEventStudent;
 
 // ✅ Safely retrieve the ID from POST and validate
 $id = $_POST['id'] ?? null;
 
 if (!$id) {
     // 🟡 If ID is missing, redirect or show error
     redirect('/eventStudentsManage');
     exit;
 }
 
 try {
     // ✅ Call the delete method
     AddEventStudent::delete($id);
 } catch (\Exception $e) {
     // 🔴 Optionally log the error instead of showing it
     die("Error deleting student: " . $e->getMessage());
 }
 
 // ✅ Redirect back to student management page
 redirect('/eventStudentsManage');
 exit;
 