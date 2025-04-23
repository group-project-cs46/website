<?php

use Models\pdc_complaints;



$complaintdata = pdc_complaints::fetchAll();

view('PDC/Complaints&Feedback.view.php',['complaints' => $complaintdata]);

