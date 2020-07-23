<?php
	include("../../php/autoload.php");
	$id = $DATABASE->QueryMaxId("tb_project_member","id");
	$page = $_REQUEST['page'];
	$project_id = $_REQUEST['id'];
	$admin_id = $_REQUEST['admin_id'];
	
	$sql = "INSERT INTO tb_project_member (id,project_id,admin_id) VALUES('$id','$project_id','$admin_id')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=project-show&project_id=$project_id&page=$page';
			</script>
		";
	}
?>