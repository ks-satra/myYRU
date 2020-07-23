<?php
	include("../../php/autoload.php");
	$id = $DATABASE->QueryMaxId("tb_group_member","id");
	$name = $_REQUEST['name'];
	$description = $_REQUEST['description'];
	$fileupload = $_FILES["filUpload"]["name"];
	
	move_uploaded_file($_FILES["filUpload"]["tmp_name"],"../../files/img_group_member/".$_FILES["filUpload"]["name"]);
	
	$sql = "INSERT INTO tb_group_member (id,name,description,fileupload) VALUES('$id','$name','$description','$fileupload')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=group-member';
			</script>
		";
	}
?>