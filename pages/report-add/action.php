<?php
	include("../../php/autoload.php");
	$id = $DATABASE->QueryMaxId("tb_fileupload_report","id");
	$report_id = $_REQUEST['report_id'];
	$fileupload = $_FILES["fileupload"]["name"];

	if( isset( $fileupload ) !="" ) {
		$temp_dir = "../../files/temp/";
		$file_dir = "../../files/file_report/";
		$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
	    $fileupload = "fileupload".$id.'.'.$ext;
		move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $file_dir.$fileupload );
	}
	$sql = "INSERT INTO tb_fileupload_report (id,report_id,fileupload) VALUES('$id','$report_id','$fileupload')";
	$result = $DATABASE->Query($sql);
	
	if($result){
		echo "
			<script>
				location.href = '../../?content=report';
			</script>
		";
	}
?>