<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	
	$sql = "DELETE FROM tb_group_member WHERE id='$id'"; 

	$result = $DATABASE->Query($sql);
	
	if($result){
		echo "
			<script>
				location.href = '../../?content=group-member&id=".$id."&page=".$page."';
			</script>
		";
	} 
?> 