<?php
	include("../../php/autoload.php");

	$card = $_POST["card"];

	$obj = $DATABASE->QueryObj("SELECT * FROM tb_teacher WHERE card='".$card."'");
	if( sizeof($obj)>0 ) echo "N";
	else echo "Y";