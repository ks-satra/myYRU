<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	
	$sql = "DELETE FROM tb_fileupload_report WHERE id='$id'";

	$result = $DATABASE->Query($sql);
	
	if($result){
		echo "
			<script>
				location.href = '../../?content=report&page=".$page."';
			</script>
		";
	} 
?> 