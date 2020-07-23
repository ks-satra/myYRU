<?php
	require_once __DIR__ . '/../vendor/autoload.php';
	$mpdf = new \Mpdf\Mpdf();
	$html = file_get_contents("aa.php");
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 300);
    ini_set('pcre.backtrack_limit', 90000000000000000000000000000000000000000000000000000);