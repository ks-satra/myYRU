<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	
	$photo = $_REQUEST['photo'];
	if( isset( $photo ) !="" ) {
		// remove image
		$sql = "SELECT * FROM tb_book WHERE id='".$id."'";
		$obj = $DATABASE->QueryObj($sql);
		unlink("../../files/img_book/".$obj[0]["photo"]);
	}
	$fileupload = $_REQUEST['fileupload'];
	if( isset( $fileupload ) !="" ) {
		// remove image
		$sql = "SELECT * FROM tb_book WHERE id='".$id."'";
		$obj = $DATABASE->QueryObj($sql);
		unlink("../../files/file_book/".$obj[0]["fileupload"]);
	}

	$sql = "DELETE FROM tb_book WHERE id='$id'";

	$result = $DATABASE->Query($sql);	
	if($result){
		echo "
			<script>
				location.href = '../../?content=book&id=".$id."&page=".$page."';
			</script>
		";
	}
?>