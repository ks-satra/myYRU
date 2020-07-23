<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id_ = $_REQUEST['id_'];
	
	$sql = "DELETE FROM tb_admin WHERE id='$id_'"; 

	$result = $DATABASE->Query($sql);
	
	if($result){
		echo "
			<script>
				location.href = '../../?content=user-admin&id=".$id_."&page=".$page."';
			</script>
		";
	} 
?> 