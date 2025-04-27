<?php


$report_file_id = $_GET['id'] ?? null;

\Core\Storage::download($report_file_id);