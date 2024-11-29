<?php

$router->get('/', 'index.php');
$router->get('/dashboard', 'dashboard.php')->only('auth');

$router->get('/dashboard/admin', 'dashboards/admin.php')->only('auth');
$router->get('/dashboard/student', 'dashboards/student.php')->only('auth');
$router->get('/dashboard/pdc', 'dashboards/pdc.php')->only('auth');
$router->get('/dashboard/company', 'dashboards/company.php')->only('auth');
$router->get('/dashboard/lecturer', 'dashboards/lecturer.php')->only('auth');

$router->get('/register', 'users/create.php')->only('guest');
$router->post('/register', 'users/store.php')->only('guest');

$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/sessions', 'sessions/store.php')->only('guest');
$router->delete('/sessions', 'sessions/destroy.php')->only('auth');

$router->get('/forgot_password', 'users/forgot_password.php')->only('guest');
$router->post('/forgot_password', 'users/send_reset_link.php')->only('guest');
$router->get('/reset_password', 'users/reset_password.php')->only('guest');
$router->post('/reset_password', 'users/update_password.php')->only('guest');


$router->get('/advertisements', 'advertisements/index.php')->only('student');
$router->get('/advertisements/show', 'advertisements/show.php')->only('student');

$router->post('/applications', 'applications/store.php')->only('student');

$router->get('/pdc-users', 'pdc-users/index.php')->only('admin');

$router->get('/account', 'account.php')->only('auth');
$router->post('/cv/store', 'cv/store.php')->only('student');
$router->get('/cv/show', 'cv/show.php')->only('student');
$router->delete('/cv/delete', 'cv/destroy.php')->only('student');

$router->get('/students/applications', 'students/applications/index.php')->only('student');
$router->delete('/students/applications/delete', 'students/applications/destroy.php')->only('student');
$router->get('/students/applications/edit', 'students/applications/edit.php')->only('student');
$router->patch('/students/applications/update', 'students/applications/update.php')->only('student');

$router->get('/students/cvs', 'students/cvs/index.php')->only('student');

//company

$router->get('/company/report', '/company/report.php');
$router->get('/company/advertisment', '/company/advertisment.php');
$router->get('/company/appliedStudent', '/company/appliedStudent.php');
$router->get('/company/schedule', 'company/schedule.php');
$router->get('/company/selectedStudent', '/company/selectedStudent.php');
$router->get('/company/shortedStudent', '/company/shortedStudent.php');
$router->get('/company/complaint', '/company/complaint.php');
$router->get('/company/list', '/company/list.php'); 
$router->get('/company/addInterview', '/company/addInterview.php');
$router->get('/company/account', '/company/account.php');
$router->get('/company/cv', '/company/cv.php');
$router->get('/company/dashcv', '/company/dashcv.php');
$router->get('/company/onlycv', '/company/onlycv.php');


//company action
$router->post('/ads/store', 'ads/store.php');
$router->delete('/ads/delete', 'ads/delete.php');
$router->post('/ads/edit', 'ads/edit.php');

//PDC

$router->get('/pdcs/companies', '/pdcs/companies/index.php');
$router->post('/pdcs/companies/approve', '/pdcs/companies/approve.php');

$router->get('/PDC/managestudents', '/PDC/ManageStudents.php');
$router->get('/PDC/advertisements', '/PDC/Advertisements.php');
$router->get('/PDC/managecompany', '/PDC/ManageCompany.php');
$router->get('/PDC/schedule', '/PDC/Schedule.php');

$router->post('/PDC/addstudent', '/PDC/addstudent.php');
$router->post('/PDC/updatestudent', '/PDC/updatestudent.php');
$router->post('/PDC/deletestudent', '/PDC/deletestudent.php');


$router->get('/PDC/Complaints&Feedback', '/PDC/Complaints&Feedback.php');
$router->get('/PDC/BlacklistedCompanies', '/PDC/BlacklistedCompanies.php');


$router->get('/complaints', controller: 'admin/complaints.php');
$router->get('/complaintsForm', controller: 'admin/complaintsForm.php');
$router->get('/complaintsReply', controller: 'admin/complaintsReply.php');

$router->get('/calendar', 'lecturer/calendar.php');
$router->get('/report', 'lecturer/report.php');

$router->get('/pdcManage', 'admin/pdcManage.php');
$router->get('/pdcAdd', 'admin/pdcAdd.php');
$router->get('/pdcEdit', controller: 'admin/pdcEdit.php');


$router->get('/lecturerManage', 'admin/lecturerManage.php');
$router->get('/lecturerAdd', 'admin/lecturerAdd.php');
$router->get('/lecturerEdit', 'admin/lecturerEdit.php');

$router->post('/pdcAddition', controller: 'admin/add-pdc.php');
$router->post('/pdcEdition', controller: 'admin/edit-pdc.php');
$router->post('/pdcDeletion', controller: 'admin/delete-pdc.php');

$router->get('/PDC/sample', '/PDC/sample.php');
$router->get('/PDC/Complaints&Feedback', '/PDC/Complaints&Feedback.php');
$router->get('/PDC/BlacklistedCompanies', '/PDC/BlacklistedCompanies.php');


