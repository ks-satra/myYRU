<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$description = $_REQUEST['description'];
	$date_start = $_REQUEST['date_start'];
	$time_news = $_REQUEST['time_news'];
	$fileupload = $_FILES["fileupload"]["name"];
	
	$update_fileupload = "";
	if( move_uploaded_file($_FILES["fileupload"]["tmp_name"],"../../files/img_news/".$_FILES["fileupload"]["name"])) {
		$update_fileupload = ",fileupload = '$fileupload'";
		
		// remove image
		$sql = "SELECT * FROM tb_news WHERE id='".$id."'";
		$obj = $DATABASE->QueryObj($sql);
		unlink("../../files/img_news/".$obj[0]["fileupload"]);
	}
	
	$sql = "
		UPDATE tb_news SET 
			name = '$name',
			description = '$description',
			date_start = '$date_start',
			time_news = '$time_news'
			$update_fileupload
			WHERE id = '$id'
		";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=news&id=".$id."&page=".$page."';
			</script>
		";
	}
?>