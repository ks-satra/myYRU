<?php
	session_start();
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$description = $_REQUEST['description'];
	$fileupload = $_FILES["filUpload"]["name"];
	
	$update_fileupload = "";
	if( move_uploaded_file($_FILES["filUpload"]["tmp_name"],"../../files/img_group_member/".$_FILES["filUpload"]["name"])) {
		$update_fileupload = ",fileupload = '$fileupload'";
		
		// remove image
		$sql = "SELECT * FROM tb_group_member WHERE id='".$id."'";
		$obj = $DATABASE->QueryObj($sql);
		unlink("../../files/img_group_member/".$obj[0]["fileupload"]);
	}
	
	$sql = "
		UPDATE tb_group_member SET
			name = '$name',
			description = '$description'
			$update_fileupload
		WHERE id = '$id'
	";
	
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=group-member';
			</script>
		";
	}
?>