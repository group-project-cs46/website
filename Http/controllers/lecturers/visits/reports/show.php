<?php


use Core\Storage;

$report_file_id = $_GET['id'] ?? null;

Storage::download($report_file_id);