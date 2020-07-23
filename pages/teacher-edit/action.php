<?php
	session_start();
	include("../../php/autoload.php");
	$id = $_REQUEST['id'];
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
	$checkbox1=$_POST['techno'];
	$chk="";  
		foreach($checkbox1 as $chk1)  
		{  
			$chk .= $chk1.",";  
		}
	$checkbox2=$_POST['topics'];
	$get_topics="";  
		foreach($checkbox2 as $chk2)  
		{  
			$get_topics .= $chk2.",";  
		}
	// $level_name = $_POST['level'];
	// $get_level = "";  
		// foreach($level_name as $chk1)
		// {  
		// 	$get_level .= $chk1.",";  
		// }
	// $topics_name = $_POST['topics'];
	// $get_topics = "";  
		// foreach($topics_name as $chk2)  
		// {  
		// 	$get_topics .= $chk2.",";  
		// }
	$photo = $_FILES["filUpload_1"]["name"];
	
	$update_fileupload = "";
	if( move_uploaded_file($_FILES["filUpload_1"]["tmp_name"],"../../files/img_teacher/".$_FILES["filUpload_1"]["name"])) {
		$update_fileupload = ",photo = '$photo'";
		
		// remove image
		$sql = "SELECT * FROM tb_teacher WHERE id='".$id."'";
		$obj = $DATABASE->QueryObj($sql);
		unlink("../../files/img_teacher/".$obj[0]["photo"]);
	}

	//$photo = $_FILES["filUpload_1"]["name"];

	// if( isset( $photo ) =="" ) {
	// 	$temp_dir = "../../files/temp/";
	// 	$file_dir = "../../files/img_teacher/";
	// 	$ext = pathinfo($photo, PATHINFO_EXTENSION);
	//     $photo = "photo".$id.'.'.$ext;
	//     $no_photo = "photo".$id.'.';
	//     if($photo == $no_photo){	 
	//     	$photo = "";
	//     }
	// 	move_uploaded_file( $_FILES["filUpload_1"]["tmp_name"], $file_dir.$photo );
	// }
	// if(){
		// $data_photo = $DATABASE->QueryString("SELECT photo FROM tb_teacher WHERE id='".$id."'");
		// $photo == $data_photo; 
	// }

	date_default_timezone_set("Asia/Bangkok");
    date_default_timezone_get();
	$date_start = date_create('now')->format('Y-m-d');
	$time_start = date_create('now')->format('H:i:s');

	$sql = "
		UPDATE tb_teacher SET 
			school_id = '$school_id',
			card = '$card',
			sex_id = '$sex_id',
			prefix_id = '$prefix_id',
			name_thai = '$name_thai',
			lname_thai = '$lname_thai',
			name_eng = '$name_eng',
			lname_eng = '$lname_eng',
			tel = '$tel',
			birthday = '$birthday',
			position = '$position',
			email = '$email',
			idline = '$idline',
			alumni = '$alumni',
			buddhist_era_start = '$buddhist_era_start',
			buddhist_era_end = '$buddhist_era_end',
			faculty = '$faculty',
			branch = '$branch',
			school_address = '$school_address',
			note = '$note',
			date_start = '$date_start',
			time_start = '$time_start',
			no = '$no',
			alley = '$alley',
			byway = '$byway',
			mu = '$mu',
			village = '$village',
			province_id = '$province_id',
			amphur_id = '$amphur_id',
			district_id = '$district_id',
			level = '$chk',
			topics = '$get_topics',
			passcode = '$passcode'
			$update_fileupload
		WHERE id = '$id'
	";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=teacher';
			</script>
		";
	}
?>