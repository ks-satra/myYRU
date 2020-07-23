<?php
	include("../../php/autoload.php");
	$id = $DATABASE->QueryMaxId("tb_person","id");
	$school_id = $_REQUEST['school_id'];
	$card = $_REQUEST['card'];
	$prefix_id = $_REQUEST['prefix_id'];
	$name_thai = $_REQUEST['name_thai'];
	$lname_thai = $_REQUEST['lname_thai'];
	$name_eng = $_REQUEST['name_eng'];
	$lname_eng = $_REQUEST['lname_eng'];
	$tel = $_REQUEST['tel'];
	$birthday = $_REQUEST['birthday'];
	$position = $_REQUEST['position'];
	$email = $_REQUEST['email'];
	$idline = $_REQUEST['idline'];
	$alumni = $_REQUEST['alumni'];
	$buddhist_era_start = $_REQUEST['buddhist_era_start'];
	$buddhist_era_end = $_REQUEST['buddhist_era_end'];
	$faculty = $_REQUEST['faculty'];
	$branch = $_REQUEST['branch'];
	$note = $_REQUEST['note'];
	$address = $_REQUEST['address'];
	$level_name = $_POST['level'];
	$get_level = " ";  
		foreach($level_name as $chk1)  
		{  
			$get_level .= $chk1.",";  
		}
	$topics_name = $_POST['topics'];
	$get_topics = " ";  
		foreach($topics_name as $chk2)  
		{  
			$get_topics .= $chk2.",";  
		}

	date_default_timezone_set("Asia/Bangkok");
    date_default_timezone_get();
	$date_start = date_create('now')->format('Y-m-d');
	$time_start = date_create('now')->format('H:i:s');

	echo $sql = "INSERT INTO tb_person (id,school_id,card,prefix_id,name_thai,lname_thai,name_eng,lname_eng,tel,birthday,position,email,idline,alumni,buddhist_era_start,buddhist_era_end,faculty,branch,address,level,topics,note,date_start,time_start) VALUES('$id','$school_id','$card','$prefix_id','$name_thai','$lname_thai','$name_eng','$lname_eng','$tel','$birthday','$position','$email','$idline','$alumni','$buddhist_era_start','$buddhist_era_end','$faculty','$branch','$address','$get_level','$get_topics','$note','$date_start','$time_start')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=person';
			</script>
		";
	}
?>