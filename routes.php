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

$router->post('/users/change_password', 'users/change_password.php')->only('auth');
$router->patch('/users/profile/photo', 'users/profile/photo/update.php')->only('auth');
$router->patch('/users/profile/details', 'users/profile/update.php')->only('auth');


$router->get('/students/advertisements', 'students/advertisements/index.php')->only('student');
$router->get('/students/advertisements/show', 'students/advertisements/show.php')->only('student');
$router->get('/students/second_round', 'students/second_round/index.php')->only('student');
$router->post('/students/second_round', 'students/second_round/store.php')->only('student');
$router->delete('/students/second_round', 'students/second_round/destroy.php')->only('student');
$router->get('/students/second_round/shortlisted', 'students/second_round/shortlisted/show.php')->only('student');

$router->post('/students/applications', 'students/applications/store.php')->only('student');
$router->get('/students/applications/show', 'students/applications/show.php')->only('student');

$router->get('/students/companies/show', 'students/companies/show.php')->only('student');
$router->get('/students/events', 'students/events/index.php')->only('student');


$router->get('/account', 'account.php')->only('auth');
$router->get('/accounts/company', 'accounts/company/index.php')->only('company');
$router->patch('/accounts/company', 'accounts/company/update.php')->only('auth');

$router->post('/cv/store', 'cv/store.php')->only('student');
$router->get('/cv/show', 'cv/show.php')->only('student');
$router->delete('/cv/delete', 'cv/destroy.php')->only('student');

$router->get('/students/applications', 'students/applications/index.php')->only('student');
$router->delete('/students/applications/delete', 'students/applications/destroy.php')->only('student');
$router->get('/students/applications/edit', 'students/applications/edit.php')->only('student');
$router->patch('/students/applications/update', 'students/applications/update.php')->only('student');

$router->get('/students/cvs', 'students/cvs/index.php')->only('student');

$router->get('/students/internship_reports', 'students/internship_reports/index.php')->only('student');
$router->post('/students/internship_reports/store', 'students/internship_reports/store.php')->only('student');
$router->get('/students/internship_reports/show', 'students/internship_reports/show.php')->only('student');
$router->delete('/students/internship_reports/delete', 'students/internship_reports/destroy.php')->only('student');

$router->get('/notifications/resolve', 'notifications/resolve.php')->only('auth');


// Admin by thathsara

//$router->get('/admin/pdcs', 'admin/pdcs/index.php');
//$router->post('/admin/pdcs/disable', 'admin/pdcs/disable.php');
//$router->get('/admin/pdcs/create', 'admin/pdcs/create.php');
//$router->post('/admin/pdcs/store', 'admin/pdcs/store.php');

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

$router->post('/company_complaint/store', 'company_complaint/store.php');
$router->get('/company/complaint/list', 'company_complaint/list.php')->only('auth');
$router->post('/company_complaint/edit', 'company_complaint/edit.php')->only('auth');
$router->post('/company_complaint/delete', 'company_complaint/delete.php')->only('auth');


$router->post('/company_scedule/store', 'company_scedule/store_techtalk.php');
$router->post('/company_report/store', 'company_report/store.php');

$router->post('/company_student/shortlisted', 'company_student/store_shortlisted.php');
$router->post('/company_student/nonShortlisted', 'company_student/store_nonShortlisted.php');
$router->post('/company_student/select', 'company_student/store_selected.php');
$router->get('/company_student/selected', 'company_student/get_selected.php');


$router->post('/company_student/store_schedule', 'company_student/store_schedule.php');
$router->get('/company_student/interview_details', 'company_student/get_interview.php');
$router->post('/company_student/update_interview', 'company_student/update_interview.php');
$router->delete('/company_student/delete_interview', 'company_student/delete_interview.php');



//PDC

$router->get('/pdcs/companies', '/pdcs/companies/index.php');
$router->post('/pdcs/companies/approve', '/pdcs/companies/approve.php');
$router->post('/pdcs/companies/reject', '/pdcs/companies/reject.php');

// remove capital letters
$router->get('/PDC/managestudents', '/PDC/ManageStudents.php');
$router->get('/PDC/advertisements', '/PDC/Advertisements.php');
$router->get('/PDC/managecompany', '/PDC/ManageCompany.php');
$router->get('/PDC/schedule', '/PDC/Schedule.php');
$router->get('/PDC/studentreport', '/PDC/StudentReport.php');
$router->post('/PDC/addstudent', '/PDC/addstudent.php');
$router->post('/PDC/updatestudent', '/PDC/updatestudent.php');
$router->post('/PDC/deletestudent', '/PDC/deletestudent.php');
$router->get('/PDC/StudentReport', '/PDC/student_report.php');
$router->post('/PDC/deletestudentreport', '/PDC/student_report.php');
$router->post('/PDC/setround', '/PDC/setround.php');
$router->post('/PDC/updateround', '/PDC/updateround.php');
$router->post('/PDC/deleteround', '/PDC/deleteround.php');
$router->post('/PDC/createtechtalk', '/PDC/create_techtalk.php');    
$router->post('/PDC/deletetechtalk', '/PDC/delete_techtalk.php');
$router->post('/PDC/edittechtalk', '/PDC/edit_techtalk.php');

$router->get('/PDC/manageadvertisements', '/PDC/manage_advertisements.php');
$router->post('/PDC/manageadvertisements', '/PDC/manage_advertisements.php');


$router->get('/PDC/complaints&feedback', '/PDC/Complaints&Feedback.php');
$router->post('/PDC/managecomplaints', '/PDC/pdc_complaints.php');
$router->get('/PDC/managecomplaints', '/PDC/pdc_complaints.php');
$router->get('/PDC/blacklistedcompanies', '/PDC/BlacklistedCompanies.php');


$router->get('/complaints', controller: 'admins/complaints.php');
$router->get('/complaintsForm', controller: 'admins/complaintsForm.php');
$router->get('/complaintsReply', controller: 'admins/complaintsReply.php');

$router->get('/calendar', 'lecturer/calendar.php');
$router->get('/calendarVisit', 'lecturer/calendarVisit.php');
$router->get('/profilelec', 'lecturer/account.php');
$router->get('/profile', 'admins/account.php');



$router->get('/report', 'lecturer/report.php');
$router->get('/reportMain', 'lecturer/reportMain.php');
$router->get('/reportView', 'lecturer/reportView.php');

$router->get('/pdcManage', 'admins/pdcManage.php');
$router->get('/pdcAdd', 'admins/pdcAdd.php');
$router->get('/pdcEdit', controller: 'admins/pdcEdit.php');


$router->get('/lecturerManage', 'admins/lecturerManage.php');
$router->get('/lecturerAdd', 'admins/lecturerAdd.php');
$router->get('/lecturerEdit', 'admins/lecturerEdit.php');

$router->post('/pdcAddition', controller: 'admin/add-pdc.php');
$router->post('/pdcEdition', controller: 'admin/edit-pdc.php');
$router->post('/pdcDeletion', controller: 'admin/delete-pdc.php');
$router->post('/pdcToggleStatus', controller: 'admin/toggle-pdc-status.php');

$router->post('/lecturerAddition', controller: 'admin/add-lecturer.php');
$router->post('/lecturerEdition', controller: 'admin/edit-lecturer.php');
$router->post('/lecturerDeletion', controller: 'admin/delete-lecturer.php');
$router->post('/lecturerToggleStatus', controller: 'admin/toggle-lecturer-status.php');


$router->get('/PDC/sample', '/PDC/sample.php');
$router->get('/PDC/Complaints&Feedback', '/PDC/Complaints&Feedback.php');
$router->get('/PDC/BlacklistedCompanies', '/PDC/BlacklistedCompanies.php');

// $router->post('/admin/pdc/update-password', 'PdcController@updatePassword');


$router->get('/eventmanage', 'admin/eventmanage.php');
$router->get('/eventView', 'admin/eventView.php');
$router->get('/eventAdd', 'admin/eventAdd.php');


$router->get('/e-pdcadd', 'admin/e-pdcadd.php');







// $router->post('/admin/pdc/update-password', 'PdcController@updatePassword');

$router->get('/events', 'admin/eventmanage.php');
$router->get('/eventsView', 'admin/eventView.php');
$router->get('/eventsAdd', 'admin/eventAdd.php');
$router->get('/eventsEdit', 'admin/eventEdit.php');

$router->post('/eventsAddition', controller: 'admin/add-events.php');
$router->post('/eventsEdition', controller: 'admin/edit-events.php');
$router->post('/eventsDeletion', controller: 'admin/delete-events.php');


$router->post('/lecturerEdition', controller: 'admin/edit-lecturer.php');
$router->post('/lecturerDeletion', controller: 'admin/delete-lecturer.php');

$router->get('/eventStudentsManage', 'admin/eventStudentsManage.php');
$router->get('/eventStudentsAdd', 'admin/eventStudentsAdd.php');
$router->get('/eventStudentsEdit', 'admin/eventStudentsEdit.php');

$router->post('/eventsStudentsAddition', controller: 'admin/add-eventStudents.php');
$router->post('/eventsStudentsEdition', controller: 'admin/add-eventStudents.php');
$router->post('/eventsStudentsDeletion', controller: 'admin/add-eventStudents.php');

$router->get('/track', 'admin/track.php');










