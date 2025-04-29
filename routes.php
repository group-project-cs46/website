<?php

// Thathsara ############################################################################################################################
// Student

$router->get('/files', 'files/show.php')->only('auth');

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


$router->get('/students/advertisements', 'students/advertisements/index.php')
    ->only('student')
    ->middleware(['isFirstRound']);
$router->get('/students/advertisements/show', 'students/advertisements/show.php')
    ->only('student')
    ->middleware(['isFirstRound']);

$router->get('/students/second_round', 'students/second_round/index.php')
    ->only('student')
    ->middleware(['isSecondRound']);
$router->post('/students/second_round', 'students/second_round/store.php')
    ->only('student')
    ->middleware(['isSecondRound']);
$router->delete('/students/second_round', 'students/second_round/destroy.php')
    ->only('student')
    ->middleware(['isSecondRound']);
$router->get('/students/second_round/shortlisted', 'students/second_round/shortlisted/show.php')
    ->only('student')
    ->middleware(['isSecondRound']);

$router->post('/students/applications', 'students/applications/store.php')->only('student');
$router->get('/students/applications/show', 'students/applications/show.php')->only('student');

$router->get('/students/companies/show', 'students/companies/show.php')->only('student');
$router->get('/students/events', 'students/events/index.php')->only('student');


$router->get('/account', 'account.php')->only('auth');
$router->get('/accounts/company', 'accounts/company/index.php')->only('company');
$router->patch('/accounts/company', 'accounts/company/update.php')->only('auth');
$router->get('/accounts/student', 'accounts/student/index.php')->only('student');
$router->patch('/accounts/student', 'accounts/student/update.php')->only('auth');

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
$router->get('/notifications/read_all', 'notifications/read_all.php')->only('auth');

$router->get('/students/complaints', 'students/complaints/index.php')->only('student');
$router->post('/students/complaints', 'students/complaints/store.php')->only('student');
$router->delete('/students/complaints', 'students/complaints/destroy.php')->only('student');
$router->get('/students/complaints/show', 'students/complaints/show.php')->only('student');
$router->post('/students/complaints/messages', 'students/complaints/messages/store.php')->only('student');

$router->get('/students/training_sessions/show', 'students/training_sessions/show.php')->only('student');
$router->get('/students/training_sessions/register', 'students/training_sessions/register.php')->only('student');
$router->post('/students/training_sessions/attendance', 'students/training_sessions/attendance.php')->only('student');

// Lecturer

$router->get('/lecturers/visits', 'lecturers/visits/index.php')->only('lecturer');
$router->get('/lecturers/visits/show', 'lecturers/visits/show.php')->only('lecturer');
$router->post('/lecturers/visits/reports', 'lecturers/visits/reports/store.php')->only('lecturer');
$router->get('/lecturers/visits/reports', 'lecturers/visits/reports/show.php')->only('lecturer');
$router->post('/lecturers/visits/toggle', 'lecturers/visits/toggle.php')->only('lecturer');

// Pdc

$router->get('/pdcs/batches', 'pdcs/batches/index.php')->only('pdc');
$router->get('/pdcs/batches/create', 'pdcs/batches/create.php')->only('pdc');
$router->post('/pdcs/batches/store', 'pdcs/batches/store.php')->only('pdc');
$router->get('/pdcs/batches/edit', 'pdcs/batches/edit.php')->only('pdc');
$router->patch('/pdcs/batches/update', 'pdcs/batches/update.php')->only('pdc');
$router->delete('/pdcs/batches/delete', 'pdcs/batches/destroy.php')->only('pdc');

// Company
$router->get('/companies/advertisements', 'companies/advertisements/index.php')->only('company');
$router->get('/companies/advertisements/create', 'companies/advertisements/create.php')->only('company');
$router->post('/companies/advertisements/store', 'companies/advertisements/store.php')->only('company');
$router->get('/companies/advertisements/show', 'companies/advertisements/show.php')->only('company');
$router->get('/companies/advertisements/edit', 'companies/advertisements/edit.php')->only('company');
$router->put('/companies/advertisements/update', 'companies/advertisements/update.php')->only('company');
$router->delete('/companies/advertisements/delete', 'companies/advertisements/destroy.php')->only('company');

// Thathsara END ########################################################################################################################################

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
$router->get('/company_complaint/show', 'company_complaint/show.php')->only('company');
$router->post('//messages', 'company_complaint/messages/store.php')->only('company');
$router->get('/company/complaint/show', 'company_complaint/show.php')->only('company');
$router->post('/company/complaint/messages', 'company_complaint/messages/store.php')->only('company');


$router->post('/company_schedule/store', 'company_schedule/store_techtalk.php');
$router->post('/company_schedule/edit', 'company_schedule/edit_techtalk.php');
$router->post('/company_schedule/delete', 'company_schedule/delete_techtalk.php');
$router->post('/company_schedule/store_lecturervisit', 'company_schedule/store_lecturervisit.php');
$router->post('/company_schedule/revert_lecturervisit', 'company_schedule/revert_lecturervisit.php');
$router->post('/company_schedule/reject_lecturervisit', 'company_schedule/reject_lecturervisit.php');




$router->post('/company_report/store', 'company_report/store.php');
$router->get('/company_report/show', 'company_report/show.php');
$router->get('/company_report/download_all', 'company_report/download_all.php')->only('auth');
$router->delete('/company_report/delete_all', 'company_report/delete_all.php')->only('auth');

$router->post('/company_student/shortlisted', 'company_student/store_shortlisted.php');
$router->post('/company_student/nonShortlisted', 'company_student/store_nonShortlisted.php');
$router->post('/company_student/select', 'company_student/store_selected.php');
$router->get('/company_student/selected', 'company_student/get_selected.php');
$router->get('/company_student/applied', 'company_student/get_applied.php');
$router->get('/company_student/shortlisted', 'company_student/get_shortlisted.php');
$router->get('/company/cv/download', 'company/cv_download.php')->only('company');
$router->post('/company_student/nonShortlistedFromShortlist', 'company_student/store_nonShortlistedFromShortlist.php');



$router->post('/company_student/store_schedule', 'company_student/store_schedule.php');
$router->get('/company_student/interview_details', 'company_student/get_interview.php');
$router->post('/company_student/update_interview', 'company_student/update_interview.php');
$router->delete('/company_student/delete_interview', 'company_student/delete_interview.php');


//###################################################################################################################
//PDC

$router->get('/PDC/show', '/PDC/show.php')->only('pdc');
$router->post('/PDC/messages', '/PDC/store.php')->only('pdc');


$router->get('/pdcs/companies', '/pdcs/companies/index.php');
$router->post('/pdcs/companies/approve', '/pdcs/companies/approve.php');
$router->post('/pdcs/companies/reject', '/pdcs/companies/reject.php');

$router->post('/PDC/uploadCsv', '/PDC/uploadCsv.php'); 
$router->post('/PDC/disablestudentaccount', '/PDC/disablestudentaccount.php'); 
$router->post('/PDC/enablestudentaccount', '/PDC/enablestudentaccount.php'); 


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
$router->post('/PDC/createtechtalk', '/PDC/create_techtalk.php');    
$router->post('/PDC/deletetechtalk', '/PDC/delete_techtalk.php');
$router->post('/PDC/edittechtalk', '/PDC/edit_techtalk.php');

$router->get('/PDC/downloadlecturerreport', '/PDC/downloadlecturerreport.php');
$router->get('/PDC/downloadReport', '/PDC/downloadReport.php');
$router->post('/PDC/blacklistcompany', '/PDC/blacklistcompany.php');
$router->post('/PDC/removeblacklist', '/PDC/removeBlacklist.php');

$router->get('/PDC/manageadvertisements', '/PDC/manage_advertisements.php');
$router->post('/PDC/manageadvertisements', '/PDC/manage_advertisements.php');
$router->get('/PDC/appliedStudents', '/PDC/appliedStudents.php');

$router->post('/PDC/createvisit', '/PDC/pdc_create_visit.php');    
$router->post('/PDC/deletevisit', '/PDC/pdc_delete_visit.php');
$router->post('/PDC/editvisit', '/PDC/pdc_edit_visit.php');

$router->get('/PDC/complaints&feedback', '/PDC/Complaints&Feedback.php');
$router->post('/PDC/managecomplaints', '/PDC/pdc_complaints.php');
$router->post('/PDC/markcomplaintsolved', '/PDC/markComplaintSolved.php');
$router->get('/PDC/managecomplaints', '/PDC/pdc_complaints.php');
$router->get('/PDC/blacklistedcompanies', '/PDC/BlacklistedCompanies.php');


$router->get('/PDC/managejobroles', '/PDC/Job_roles.php');
$router->post('/PDC/createjobroles', '/PDC/createjobrole.php');
$router->post('/PDC/editjobroles', '/PDC/editjobrole.php');
$router->post('/PDC/deletejobroles', '/PDC/deletejobrole.php');

//#################################################################################################################


$router->get('/complaints', controller: 'admin/complaintManage.php');
$router->get('/complaintssForm', controller: 'admin/complaintsForm.php');
$router->get('/complaintsReply', controller: 'admin/complaintsReply.php');

$router->get('/Visit', 'lecturer/companyVisit.php');
$router->get('/VisitView', 'lecturer/companyVisitView.php');
$router->get('/profilelec', 'lecturer/account.php');
$router->get('/profile', 'admin/account.php');



$router->get('/report', 'lecturer/report.php');
$router->get('/reportView', 'lecturer/reportView.php');

$router->get('/pdcManage', 'admin/pdcManage.php');
$router->get('/pdcAdd', 'admin/pdcAdd.php');
$router->get('/pdcEdit', controller: 'admin/pdcEdit.php');


$router->get('/lecturerManage', 'admin/lecturerManage.php');
$router->get('/lecturerAdd', 'admin/lecturerAdd.php');
$router->get('/lecturerEdit', 'admin/lecturerEdit.php');

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

// $router->post('/admin/pdc/update-password', 'PdcController@updatePassword');

$router->get('/events', 'admin/eventmanage.php');
$router->get('/eventsView', 'admin/eventView.php');
$router->get('/eventsAdd', 'admin/eventAdd.php');
$router->get('/eventsEdit', 'admin/eventEdit.php');

//training session get
$router->get('/trainingSession', 'admin/trainingManage.php');
$router->get('/trainingView', 'admin/trainingView.php');
$router->get('/trainingAdd', 'admin/trainingAdd.php');
$router->get('/trainingEdit', 'admin/trainingEdit.php');

//training session post
$router->post('/trainingAddition', controller: 'admin/add-training.php');
$router->post('/trainingEdition', controller: 'admin/edit-training.php');
$router->post('/trainingDeletion', controller: 'admin/delete-training.php');
$router->get('/admin/training_sessions/qrcodes/show', 'admin/training_sessions/qrcodes/show.php');


$router->post('/eventsAddition', controller: 'admin/add-events.php');
$router->post('/eventsEdition', controller: 'admin/edit-events.php');
$router->post('/eventsDeletion', controller: 'admin/delete-events.php');


$router->post('/lecturerEdition', controller: 'admin/edit-lecturer.php');
$router->post('/lecturerDeletion', controller: 'admin/delete-lecturer.php');

$router->get('/eventStudentsManage', 'admin/eventStudentsManage.php');
$router->get('/eventStudentsAdd', 'admin/eventStudentsAdd.php');
$router->get('/eventStudentsEdit', 'admin/eventStudentsEdit.php');

$router->post('/eventsStudentsAddition', controller: 'admin/add-eventStudents.php');
$router->post('/eventsStudentsEdition', controller: 'admin/edit-eventStudents.php');
$router->post('/eventsStudentsDeletion', controller: 'admin/add-eventStudents.php');

$router->get('/track', 'admin/track.php');

$router->get('/complaintView', controller: 'admin/complaintView.php');

$router->get('/attendance', controller: 'admin/attendanceManage.php');
$router->post('/messageAddition', controller: 'admin/add-message.php');

$router->post('/complaintDeletion', controller: 'admin/reject-complaint.php');
$router->post('/complaintResolve', 'admin/complaintResolve.php');


$router->post('/uploadreports', 'lecturer/uploadReport.php');

$router->get('/trainingView', 'lecturer/trainingView.php');

$router->post('/visitUpdate', 'lecturer/updateVisit.php');
$router->get('/rejectReason', 'lecturer/rejectReason.php');

$router->post('/addReason', controller: 'lecturer/add-Reason.php');
$router->get('/dashboard/admin', 'dashboards/admins.php')->only('auth');




