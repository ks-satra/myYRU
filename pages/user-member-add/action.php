<?php
	include("../../php/autoload.php");
	$id_ = $DATABASE->QueryMaxId("tb_member","id");
	$group_member_id_ = $_REQUEST['group_member_id_'];
	$prefix_id_ = $_REQUEST['prefix_id_'];
	$office_boss_name_ = $_REQUEST['office_boss_name_'];
	$surname_boss_name_ = $_REQUEST['surname_boss_name_'];
	$position_id_ = $_REQUEST['position_id_'];
	$number_ = $_REQUEST['number_'];
	$email = $_REQUEST['email'];
	$district_id_ = $_REQUEST['district_id_'];
	$amphur_id_ = $_REQUEST['amphur_id_'];
	$province_id_ = $_REQUEST['province_id_'];
	$passcode_ = $_REQUEST['passcode_'];
	// $status_id_ = $_REQUEST['status_id_'];
	$status_id_ = 3;
	//$username_ = $_REQUEST['username_'];
	$username_ = $DATABASE->QueryMaxId("tb_member","username","PTS-",4);
	$password_ = $_REQUEST['password_'];
	$confirm_password_ = $_REQUEST['confirm_password_'];
	
	$fileupload = $_FILES["filUpload"]["name"];	
	if( isset( $fileupload ) !="" ) {
		$temp_dir = "../../files/temp/";
		$file_dir = "../../files/img_member/";
		$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
	    $fileupload = "fileupload".$id_.'.'.$ext;
	    $no_photo = "fileupload".$id_.'.';
	    if($fileupload == $no_photo){	 
	    	$fileupload = "";
	    }
		move_uploaded_file( $_FILES["filUpload"]["tmp_name"], $file_dir.$fileupload );
	}

	// $fileupload = $_FILES["filUpload"]["name"];
	// move_uploaded_file($_FILES["filUpload"]["tmp_name"],"../../files/img_member/".$_FILES["filUpload"]["name"]);
	
	$sql = "INSERT INTO tb_member (id,group_member_id,prefix_id,name,lname,position_member_id,number,email_name,district_id,amphur_id,province_id,passcode,status_id,username,password,confirm_password,fileupload) VALUES('$id_','$group_member_id_','$prefix_id_','$office_boss_name_','$surname_boss_name_','$position_id_','$number_','$email','$district_id_','$amphur_id_','$province_id_','$passcode_','$status_id_','$username_','$password_','$confirm_password_','$fileupload')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=user-member'; 
			</script>
		";
	}
?>