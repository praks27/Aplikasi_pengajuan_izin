<?php
$tahunskrg = date('Y');
$dir = 'fotoapproval'; // path ke folder yang ingin di-zip
$zip_file = "example $tahunskrg.zip"; // nama file ZIP yang dihasilkan

// membuat file ZIP
$zip = new \PharData($zip_file);
$zip->buildFromDirectory($dir);

// download file ZIP
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$zip_file.'"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($zip_file));
readfile($zip_file);

// hapus file ZIP setelah didownload
unlink($zip_file);
?>
