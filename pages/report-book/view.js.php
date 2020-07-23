<?php
	include("../../php/config.map.php");
	include("../../php/mysql.map.php");
	$mysql = new J_MYSQL;
	$mysql->J_Connect();
	$mysql->set_char_utf8();

	$sql = "SELECT
				tb_farmer.id,
				tb_farmer.member_id,
				tb_farmer.`name`,
				tb_farmer.lat,
				tb_farmer.lng,
				tb_farmer.area,
				tb_farmer.farmer_list_all,
				tb_farmer.place,
				tb_farmer.note,
				tb_farmer.filUpload1,
				tb_farmer.filUpload2,
				tb_farmer.filUpload3,
				tb_farmer.filUpload4,
				tb_farmer.filUpload5,
				tb_farmer.filUpload6
			FROM
				tb_farmer
			";
	$rs = $mysql->J_Execute($sql);
	$arr = array();

	foreach($rs as $read){
	    $arr2 = array();
	    $arr2["id"] = $read["id"];
	    $arr2["member_id"] = $read["member_id"];
	    $arr2["lat"] = $read["lat"];
	    $arr2["lng"] = $read["lng"];
	    $arr2["name"] = $read["name"];
	    array_push($arr,$arr2);
	}
	echo json_encode($arr);

	$mysql->J_Close();
?>
