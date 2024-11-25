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


$router->get('/jobs', 'jobs/index.php')->only('student');

$router->get('/pdc-users', 'pdc-users/index.php')->only('admin');

$router->get('/account', 'account.php')->only('auth');
$router->post('/cv/store', 'cv/store.php')->only('student');
$router->get('/cv/show', 'cv/show.php')->only('student');


$router->get('/company/report', '/company/report.php');
$router->get('/company/advertisment', '/company/advertisment.php');
$router->get('/company/appliedStudent', '/company/appliedStudent.php');
$router->get('/company/schedule', 'company/schedule.php');
$router->get('/company/selectedStudent', '/company/selectedStudent.php');
$router->get('/company/shortedStudent', '/company/shortedStudent.php');
$router->get('/company/complaint', '/company/complaint.php');
$router->get('/company/list', '/company/list.php');
$router->get('/company/addInterview', '/company/addInterview.php');

$router->post('/ads/store', 'ads/store.php');

$router->get('/PDC/ManageStudents', '/PDC/ManageStudents.php');
$router->get('/PDC/Advertisements', '/PDC/Advertisements.php');
$router->get('/PDC/ManageCompany', '/PDC/ManageCompany.php');
$router->get('/PDC/Schedule', '/PDC/Schedule.php');
$router->get('/PDC/Complaints&Feedback', '/PDC/Complaints&Feedback.php');
$router->get('/PDC/BlacklistedCompanies', '/PDC/BlacklistedCompanies.php');

$router->get('/add-lecture', 'admin/add-lecture.php');
$router->get('/add-lecture/profile', controller: 'admin/profile-view.php');
$router->get('/addition-form', 'admin/addition-form.php');
$router->get('/add-lecture/addition', controller: 'admin/addition-form-view.php');

$router->get('/add-pdc', controller: 'admin/add-pdc.php');
$router->get('/add-pdc/profilepdc', controller: 'admin/profilepdc-view.php');
$router->get('/additionpdc-form', 'admin/additionpdc-form.php');

$router->get('/complaints', controller: 'admin/complaints.php');
$router->get('/complaints-form', controller: 'admin/complaints-form.php');

$router->get('/calendar', 'lecturer/calendar.php');
$router->get('/report', 'lecturer/report.php');

$router->get('/new', 'admin/new.php');
$router->get('/ManageLecturer', 'admin/managelecturer.php');

