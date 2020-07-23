<?php
	include("../../php/autoload.php");
	$id_ = $DATABASE->QueryMaxId("tb_admin","id");
	$prefix_id_ = $_REQUEST['prefix_id_'];
	$name_ = $_REQUEST['name_'];
	$lname_ = $_REQUEST['lname_'];
	$position_id_ = $_REQUEST['position_id_'];
	$tel_ = $_REQUEST['tel_'];
	$district_id_ = $_REQUEST['district_id_'];
	$amphur_id_ = $_REQUEST['amphur_id_'];
	$province_id_ = $_REQUEST['province_id_'];
	$passcode_ = $_REQUEST['passcode_'];
	$status_id_ = $_REQUEST['status_id_']; 
	// $status_id_ = 1; 
	$username_ = $_REQUEST['username_'];
	// $username_ = $DATABASE->QueryMaxId("tb_admin","username","CM",6);
	$password_ = $_REQUEST['password_'];
	$confirm_password_ = $_REQUEST['confirm_password_'];
	$fileupload = $_FILES["filUpload"]["name"];
	
	move_uploaded_file($_FILES["filUpload"]["tmp_name"],"../../files/img_admin/".$_FILES["filUpload"]["name"]);
	
	$sql = "INSERT INTO tb_admin (id,prefix_id,name,lname,position_id,tel,district_id,amphur_id,province_id,passcode,status_id,username,password,confirm_password,fileupload) VALUES('$id_','$prefix_id_','$name_','$lname_','$position_id_','$tel_','$district_id_','$amphur_id_','$province_id_','$passcode_','$status_id_','$username_','$password_','$confirm_password_','$fileupload')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=user-admin';
			</script>
		";
	}
?>