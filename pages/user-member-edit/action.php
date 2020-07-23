<?php
	session_start();
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
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
	$username_ = $_REQUEST['username_'];
	$password_ = $_REQUEST['password_'];
	$confirm_password_ = $_REQUEST['confirm_password_'];
	

	$fileupload = $_FILES["fileupload"]["name"];
	if($fileupload != null){
		$update_fileupload = "";
		if( isset( $fileupload ) !="" ) {
				if( $fileupload == null){
					// remove image
					$sql = "SELECT * FROM tb_member WHERE id='".$id."'";
					$obj = $DATABASE->QueryObj($sql);
					unlink("../../files/img_member/".$obj[0]["fileupload"]);
				}
			$file_dir = "../../files/img_member/";
			$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
		    $fileupload = "fileupload".$id.'.'.$ext;
		    $update_fileupload = $fileupload;
		    $no_fileupload = "fileupload".$id.'.';
		    if($fileupload == $no_fileupload){	 
		    	$update_fileupload = "";
		    }
			move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $file_dir.$update_fileupload );
		}
	} else {
		$FILEUPLOAD = $DATABASE->QueryString("SELECT fileupload FROM tb_member WHERE id='".$id."'");
		$update_fileupload = $FILEUPLOAD;
	}

	// $fileupload = $_FILES["fileupload"]["name"];
	// $update_fileupload = "";
	// if( isset( $fileupload ) !="" ) {
	// 	// remove image
	// 	$sql = "SELECT * FROM tb_member WHERE id='".$id."'";
	// 	$obj = $DATABASE->QueryObj($sql);
	// 	unlink("../../files/img_member/".$obj[0]["fileupload"]);

	// 	$file_dir = "../../files/img_member/";
	// 	$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
	//     $fileupload = "fileupload".$id.'.'.$ext;
	//     $update_fileupload = $fileupload;
	//     $no_fileupload = "fileupload".$id.'.';
	//     if($fileupload == $no_fileupload){	 
	//     	$update_fileupload = "";
	//     }
	// 	move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $file_dir.$update_fileupload );
	// }

	$sql = "
		UPDATE tb_member SET
			group_member_id = '$group_member_id_',
			prefix_id= '$prefix_id_',
			name= '$office_boss_name_',
			lname = '$surname_boss_name_',
			position_member_id = '$position_id_',
			number = '$number_',
			email_name = '$email',
			district_id = '$district_id_' ,
			amphur_id = '$amphur_id_',
			province_id = '$province_id_',
			passcode = '$passcode_',
			status_id = '$status_id_',
			username = '$username_',
			password = '$password_',
			confirm_password = '$confirm_password_',
			fileupload = '$update_fileupload'
		WHERE id = '$id'
	";
	
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=user-member-edit&id=".$id."&page=".$page."';
			</script>
		";
	}
?>