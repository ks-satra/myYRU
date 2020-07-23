<?php
	include("../../php/config.map.php");
	include("../../php/mysql.map.php");
	$mysql = new J_MYSQL;
	$mysql->J_Connect();
	$mysql->set_char_utf8();
	$sql = "SELECT
				tb_get_book.id,
				tb_get_book.type_book_id,
				tb_get_book.book_id,
				tb_get_book.qty,
				tb_get_book.teacher_id,
				tb_get_book.school_id,
				tb_get_book.note,
				tb_get_book.date_start,
				tb_school.`name`,
				tb_school.id as school_id,
				tb_school.`code`,
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
				tb_province.`name` as province
			FROM
				tb_get_book
				INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
				INNER JOIN tb_district ON tb_school.district_id = tb_district.id
				INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
				INNER JOIN tb_province ON tb_school.province_id = tb_province.id
			WHERE 
				tb_school.`name` LIKE '%".$_POST["keyword"]."%' OR
				tb_district.`name` LIKE '%".$_POST["keyword"]."%' OR
				tb_amphur.`name` LIKE '%".$_POST["keyword"]."%' OR
				tb_province.`name` LIKE '%".$_POST["keyword"]."%' OR
				CONCAT('จังหวัด', tb_province.`name`) LIKE '%".$_POST["keyword"]."%'
			GROUP BY tb_get_book.school_id
			ORDER BY tb_school.`name`
			";
	$rs = $mysql->J_Execute($sql);
	$arr = array();

	foreach($rs as $read){
		$arr2 = array();
		$arr2["id"] = $read["id"];
		$arr2["lat"] = $read["lat"];
		$arr2["lng"] = $read["lng"];
		$arr2["name"] = $read["name"];
		$arr2["school_id"] = $read["school_id"];
		$arr2["code"] = $read["code"];
		$arr2["district"] = $read["district"];
		$arr2["amphur"] = $read["amphur"];
		$arr2["province"] = $read["province"];
		$arr2["passcode"] = $read["passcode"];
		$arr2["province_id"] = $read["province_id"];
		$arr2["tel"] = $read["tel"];
		array_push($arr,$arr2);
	}
	echo json_encode($arr);

	$mysql->J_Close();
?>