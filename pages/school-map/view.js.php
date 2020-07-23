<?php
	include("../../php/config.map.php");
	include("../../php/mysql.map.php");
	$mysql = new J_MYSQL;
	$mysql->J_Connect();
	$mysql->set_char_utf8();

	$sql = "
			SELECT
				SELECT
					tb_school.id as school_id,
					tb_school.`code` as code,
					tb_school.`name`,
					tb_school.`no`,
					tb_school.mu,
					tb_school.road,
					tb_school.alley,
					tb_school.village,
					tb_school.district_id,
					tb_school.amphur_id,
					tb_school.province_id,
					tb_school.passcode,
					tb_school.lat,
					tb_school.lng,
					tb_school.area_id,
					tb_school.department_id,
					tb_school.email,
					tb_school.website,
					tb_school.tel,
					tb_school.start_end_school,
					tb_school.prefix_name,
					tb_school.boss_name,
					tb_school.boss_lname,
					tb_school.position,
					tb_school.note,
					tb_school.fileupload,
					tb_district.`name` as district,
					tb_amphur.`name` as amphur,
					tb_province.`name` as province,
					tb_amphur.passcode
				FROM
					tb_school
					INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
					INNER JOIN tb_district ON tb_school.district_id = tb_district.id
					INNER JOIN tb_province ON tb_school.province_id = tb_province.id

			";
	$rs = $mysql->J_Execute($sql);
	$arr = array();

	foreach($rs as $read){
	    $arr2 = array();
	    $arr2["id"] = $read["id"];
	    $arr2["school_id"] = $read["school_id"];
	    $arr2["lat"] = $read["lat"];
	    $arr2["lng"] = $read["lng"];
	    $arr2["name"] = $read["name"];
	    $arr2["district"] = $read["district"];
	    $arr2["amphur"] = $read["amphur"];
	    $arr2["province"] = $read["province"];
	    $arr2["passcode"] = $read["passcode"];
	    $arr2["tel"] = $read["tel"];
	    $arr2["province_id"] = $read["province_id"];
	    array_push($arr,$arr2);
	}
	echo json_encode($arr);

	$mysql->J_Close();
?>
