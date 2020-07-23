<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id_ = $_REQUEST['id_'];

	$fileupload = $_REQUEST['fileupload'];
	if( isset( $fileupload ) !="" ) {
		// remove image
		$sql = "SELECT * FROM tb_member WHERE id='".$id_."'";
		$obj = $DATABASE->QueryObj($sql);
		unlink("../../files/img_member/".$obj[0]["fileupload"]);
	}

	$sql = "DELETE FROM tb_member WHERE id='$id_'";

	$result = $DATABASE->Query($sql);
	
	if($result){
		echo "
			<script>
				location.href = '../../?content=user-member&id=".$id_."&page=".$page."';
			</script>
		";
	}
?>