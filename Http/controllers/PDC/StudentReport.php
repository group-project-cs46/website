<?php


use Models\pdc_studentreport;



$reportdata = pdc_studentreport::fetchall();

view('PDC/StudentReport.view.php',['reports' => $reportdata]);