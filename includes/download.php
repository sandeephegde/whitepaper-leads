<?php

$file = basename($_REQUEST['file']);
$dirname = dirname($_REQUEST['file']);
$file_location = substr($dirname, strlen($dirname) - 8, strlen($dirname));
//$loc = '../../../uploads' . $file_location . '/' . $file;
$loc = $dirname . '/' . $file;//location modified when the files were not downloading.
header('Set-Cookie: fileDownload=true');
header('Cache-Control: max-age=60, must-revalidate');
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="' . $file);
ob_clean();
readfile($loc);

flush();
?>