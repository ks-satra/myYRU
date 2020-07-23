<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	$project_id = $_REQUEST['project_id'];
	$admin_id = $_REQUEST['admin_id'];
	$sql = "DELETE FROM tb_project_member WHERE id='".$id."' AND project_id = '".$project_id."'";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=project-show&project_id=".$project_id."';
			</script>
		";
	}
?>