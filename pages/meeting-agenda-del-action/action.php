<?php
	include("../../php/autoload.php");
	$id = $_REQUEST['id'];
	
	echo $sql = "DELETE FROM tb_meeting WHERE id='$id'";

	$result = $DATABASE->Query($sql);
	
	if($result){
		echo "
			<script>
				location.href = '../../?content=meeting&id=".$id.';
			</script>
		";
	}
?>