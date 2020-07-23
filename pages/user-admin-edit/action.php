<?php
	session_start();
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id_ = $_REQUEST['id_'];
	$prefix_id_ = $_REQUEST['prefix_id_'];
	$name_ = $_REQUEST['name_'];
	$lname_ = $_REQUEST['lname_'];
	$position_id_ = $_REQUEST['position_id_'];
	$tel_ = $_REQUEST['tel_'];
	$district_id_ = $_REQUEST['district_id_'];
	$amphur_id_ = $_REQUEST['amphur_id_'];
	$province_id_ = $_REQUEST['province_id_'];
	$passcode_ = $_REQUEST['passcode_'];
	// $status_id_ = 1;
	$status_id_ = $_REQUEST['status_id_'];
	$username_ = $_REQUEST['username_'];
	$password_ = $_REQUEST['password_'];
	$confirm_password_ = $_REQUEST['confirm_password_'];
	
	$fileupload = $_FILES["filUpload"]["name"];
	if($fileupload != null){
		$update_fileupload = "";
		if( move_uploaded_file($_FILES["filUpload"]["tmp_name"],"../../files/img_admin/".$_FILES["filUpload"]["name"])) {
			$update_fileupload = ",fileupload = '$fileupload'";
			
			// remove image
			$sql = "SELECT * FROM tb_admin WHERE id='".$id_."'";
			$obj = $DATABASE->QueryObj($sql);
			unlink("../../files/img_admin/".$obj[0]["fileupload"]);
		}
	} else {
		$FILEUPLOAD = $DATABASE->QueryString("SELECT fileupload FROM tb_admin WHERE id='".$id_."'");
		$update_fileupload = $FILEUPLOAD;
	}
	
	$sql = "
		UPDATE tb_admin SET
			prefix_id= '$prefix_id_',
			name = '$name_',
			lname = '$lname_',
			position_id = '$position_id_',
			tel = '$tel_',
			district_id = '$district_id_' ,
			amphur_id = '$amphur_id_',
			province_id = '$province_id_',
			passcode = '$passcode_',
			status_id = '$status_id_',
			username = '$username_',
			password = '$password_',
			confirm_password = '$confirm_password_'
			$update_fileupload
		WHERE id = '$id_'
	";
	
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=user-admin&id=".$id_."&page=".$page."';
			</script>
		";
	}
?>