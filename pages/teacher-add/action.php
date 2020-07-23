<?php
	include("../../php/autoload.php");
	$id = $DATABASE->QueryMaxId("tb_teacher","id");
	$school_id = $_REQUEST['school_id'];
	$card = $_REQUEST['card'];
	$sex_id = $_REQUEST['sex_id'];
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
	$school_address = $_REQUEST['school_address'];
	$note = $_REQUEST['note'];
	$no = $_REQUEST['no'];
	$alley = $_REQUEST['alley'];
	$byway = $_REQUEST['byway'];
	$mu = $_REQUEST['mu'];
	$village = $_REQUEST['village'];
	$province_id = $_REQUEST['province_id_'];
	$amphur_id = $_REQUEST['amphur_id_'];
	$district_id = $_REQUEST['district_id_'];
	$passcode = $_REQUEST['passcode_'];
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
	$photo = $_FILES["filUpload_1"]["name"];	
	if( isset( $photo ) !="" ) {
		$temp_dir = "../../files/temp/";
		$file_dir = "../../files/img_teacher/";
		$ext = pathinfo($photo, PATHINFO_EXTENSION);
	    $photo = "photo".$id.'.'.$ext;
	    $no_photo = "photo".$id.'.';
	    if($photo == $no_photo){	 
	    	$photo = "";
	    }
		move_uploaded_file( $_FILES["filUpload_1"]["tmp_name"], $file_dir.$photo );
	}

	date_default_timezone_set("Asia/Bangkok");
    date_default_timezone_get();
	$date_start = date_create('now')->format('Y-m-d');
	$time_start = date_create('now')->format('H:i:s');

	$sql = "INSERT INTO tb_teacher (id,school_id,card,sex_id,prefix_id,name_thai,lname_thai,name_eng,lname_eng,tel,birthday,position,email,idline,alumni,buddhist_era_start,buddhist_era_end,faculty,branch,level,topics,school_address,note,date_start,time_start,no,alley,byway,mu,village,province_id,amphur_id,district_id,passcode,photo) VALUES('$id','$school_id','$card','$sex_id','$prefix_id','$name_thai','$lname_thai','$name_eng','$lname_eng','$tel','$birthday','$position','$email','$idline','$alumni','$buddhist_era_start','$buddhist_era_end','$faculty','$branch','$get_level','$get_topics','$school_address','$note','$date_start','$time_start','$no','$alley','$byway','$mu','$village','$province_id','$amphur_id','$district_id','$passcode','$photo')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=teacher';
			</script>
		";
	}
?>