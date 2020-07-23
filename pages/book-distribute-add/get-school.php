<?php
    include("../../php/autoload.php");
    $school_id = @$_POST["school_id"];
    $sql = "SELECT
				tb_teacher.id,
				tb_teacher.school_id,
				tb_teacher.card,
				tb_teacher.prefix_id,
				tb_teacher.name_thai,
				tb_teacher.lname_thai,
				tb_teacher.name_eng,
				tb_teacher.lname_eng,
				tb_teacher.sex_id,
				tb_teacher.tel,
				tb_teacher.birthday,
				tb_teacher.position,
				tb_teacher.email,
				tb_teacher.idline,
				tb_teacher.alumni,
				tb_teacher.buddhist_era_start,
				tb_teacher.buddhist_era_end,
				tb_teacher.faculty,
				tb_teacher.branch,
				tb_teacher.`level`,
				tb_teacher.topics,
				tb_teacher.school_address,
				tb_teacher.note,
				tb_teacher.`no`,
				tb_teacher.mu,
				tb_teacher.alley,
				tb_teacher.byway,
				tb_teacher.village,
				tb_teacher.district_id,
				tb_teacher.amphur_id,
				tb_teacher.province_id,
				tb_teacher.passcode,
				tb_teacher.photo,
				tb_teacher.date_start,
				tb_teacher.time_start,
				tb_prefix.`name` as prefix_name
			FROM
				tb_teacher
				INNER JOIN tb_prefix ON tb_teacher.prefix_id = tb_prefix.id
            WHERE school_id='".$school_id."'
    ";
    echo $DATABASE->QueryJson($sql);