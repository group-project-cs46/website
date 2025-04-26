<?php


use Models\pdc_studentreport;



$reportdata = pdc_studentreport::fetchStudentreports();
$companyreportdata = pdc_studentreport::fetchCompanyreports();

view('PDC/StudentReport.view.php',['reports' => $reportdata, 'companyreports' => $companyreportdata]);