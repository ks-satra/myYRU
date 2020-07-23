<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM tb_project WHERE id='$id'";
	$result = $DATABASE->Query($sql);
	if($result){
		$sql = "DELETE FROM tb_project_member WHERE project_id='$id'";
		$result = $DATABASE->Query($sql);
		echo "
			<script>
				location.href = '../../?content=project&page=".$page."';
			</script>
		";
	} 
?> 