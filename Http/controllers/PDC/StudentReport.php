<?php


use Models\pdc_studentreport;



$reportdata = pdc_studentreport::fetchAll();

view('PDC/StudentReport.view.php',['reports' => $reportdata]);