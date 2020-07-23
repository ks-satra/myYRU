<?php
	session_start();
	include("../../php/autoload.php");
	$id = $_REQUEST['id'];
	$title = $_REQUEST['title'];
	$title_small = $_REQUEST['title_small'];
	$meeting_qty_id = $_REQUEST['meeting_qty_id'];
	$date_start = $_REQUEST['date_start'];
	$room = $_REQUEST['room'];
	
	echo $sql = "
		UPDATE tb_meeting SET
			title = '$title',
			title_small= '$title_small',
			meeting_qty_id= '$meeting_qty_id',
			date_start = '$date_start',
			room = '$room'
		WHERE id = '$id'
	";
	
	// $result = $DATABASE->Query($sql);	
	// if($result){
	// 	echo "
	// 		<script>
	// 			location.href = '?content=meeting&id=".$id."';
	// 		</script>
	// 	";
	// }
?>