<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	
	$photo = $_REQUEST['photo'];
	if( isset( $photo ) !="" ) {
		// remove image
		$sql = "SELECT * FROM tb_teacher WHERE id='".$id."'";
		$obj = $DATABASE->QueryObj($sql);
		unlink("../../files/img_teacher/".$obj[0]["photo"]);
	}

	$sql = "DELETE FROM tb_teacher WHERE id='$id'";

	$result = $DATABASE->Query($sql);	
	if($result){
		echo "
			<script>
				location.href = '../../?content=teacher&id=".$id."&page=".$page."';
			</script>
		";
	}
?>