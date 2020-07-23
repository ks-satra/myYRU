<?php
	include("../../php/autoload.php");
	$fn = $_POST["fn"];
	switch ($fn) {
		case 'loadCw': echo loadCw(); break;
		case 'loadAp': echo loadAp(); break;
		case 'loadTb': echo loadTb(); break;
		case 'loadPc': echo loadPc(); break;
	}
	function loadCw() {
		global $DATABASE;
		return $DATABASE->QueryJson("SELECT * FROM tb_province ORDER BY name");
	}
	function loadAp() {
		global $DATABASE;
		$cw_id = $_POST["cw_id"];
		return $DATABASE->QueryJson("SELECT * FROM tb_amphur WHERE province_id='".$cw_id."' ORDER BY name");
	}
	function loadTb() {
		global $DATABASE;
		$cw_id = $_POST["cw_id"];
		$ap_id = $_POST["ap_id"];
		return $DATABASE->QueryJson("SELECT * FROM tb_district WHERE province_id='".$cw_id."' AND amphur_id='".$ap_id."' ORDER BY name");
	}
	function loadPc() {
		global $DATABASE;
		$cw_id = $_POST["cw_id"];
		$ap_id = $_POST["ap_id"];
		return $DATABASE->QueryString("SELECT passcode FROM tb_amphur WHERE province_id='".$cw_id."' AND id='".$ap_id."' ORDER BY name");
	}
?>
