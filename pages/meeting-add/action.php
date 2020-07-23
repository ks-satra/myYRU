<?php
	include("../../php/autoload.php");
	$id = $DATABASE->QueryMaxId("tb_meeting","id");
	$title = $_REQUEST['title'];
	$title_small = $_REQUEST['title_small'];
	$meeting_qty_id = $_REQUEST['meeting_qty_id'];
	$date_start = $_REQUEST['date_start'];
	$room = $_REQUEST['room'];

	echo $sql = "INSERT INTO tb_meeting (id,title,title_small,meeting_qty_id,date_start,room) VALUES('$id','$title','$title_small','$meeting_qty_id','$date_start','$room')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=meeting'; 
			</script>
		";
	}
?>