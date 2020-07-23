<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $DATABASE->QueryMaxId("tb_school","id");
	$code = $_REQUEST['code'];
	$name = $_REQUEST['name'];
	$no = $_REQUEST['no'];
	$mu = $_REQUEST['mu'];
	$road = $_REQUEST['road'];
	$alley = $_REQUEST['alley'];
	$village = $_REQUEST['village'];
	$district_id = $_REQUEST['district_id_'];
	$amphur_id = $_REQUEST['amphur_id_'];
	$province_id = $_REQUEST['province_id_'];
	$passcode = $_REQUEST['passcode_'];
	$lat = $_REQUEST['latitude'];
	$lng = $_REQUEST['longitude'];
	$department_id = $_REQUEST['department_id'];
	$area_id = $_REQUEST['area_id'];
	$email = $_REQUEST['email'];
	$website = $_REQUEST['website'];
	$tel = $_REQUEST['tel'];
	$start_end_school = $_REQUEST['level'];
	$prefix_name = $_REQUEST['prefix_id'];
	$boss_name = $_REQUEST['boss_name'];
	$boss_lname = $_REQUEST['boss_lname'];
	$position = $_REQUEST['position'];
	$note = $_REQUEST['note'];
	$fileupload = $_FILES["fileupload"]["name"];
	if( isset( $fileupload ) !="" ) {
		$temp_dir = "../../files/temp/";
		$file_dir = "../../files/img_school/";
		$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
	    $fileupload = "fileupload".$id.'.'.$ext;
	    $no_fileupload = "fileupload".$id.'.';
	    if($fileupload == $no_fileupload){
	    	$fileupload = "";
	    }
		move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $file_dir.$fileupload );
	}

	echo $sql = "INSERT INTO tb_school (`id`, `code`, `name`, `no`, `mu`, `road`, `alley`, `village`, `district_id`, `amphur_id`, `province_id`, `passcode`, `lat`, `lng`, `department_id`, `area_id`, `email`, `website`, `tel`, `start_end_school`, `prefix_name`, `boss_name`, `boss_lname`, `position`, `note`, `fileupload`) VALUES('$id','$code','$name','$no','$mu','$road','$alley','$village','$district_id','$amphur_id','$province_id','$passcode','$lat','$lng','$department_id','$area_id','$email','$website','$tel','$start_end_school','$prefix_name','$boss_name','$boss_lname','$position','$note','$fileupload')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=school&id=".$id."&page=".$page."';
			</script>
		";
	}
?>