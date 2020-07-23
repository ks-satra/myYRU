<?php
	session_start();
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id_ = $_REQUEST['id_'];
	$name_ = $_REQUEST['name_'];
	$dep_id_ = $_REQUEST['dep_id_'];
	$prefix_id_ = $_REQUEST['prefix_id_'];
	$office_boss_name_ = $_REQUEST['office_boss_name_'];
	$surname_boss_name_ = $_REQUEST['surname_boss_name_'];
	$position_id_ = $_REQUEST['position_id_'];
	$number_ = $_REQUEST['number_'];
	$district_id_ = $_REQUEST['district_id_'];
	$amphur_id_ = $_REQUEST['amphur_id_'];
	$province_id_ = $_REQUEST['province_id_'];
	$passcode_ = $_REQUEST['passcode_'];
	$status_id_ = $_REQUEST['status_id_'];
	//$username_ = $_REQUEST['username_'];
	$password_ = $_REQUEST['password_'];
	
	$sql = "
		UPDATE tb_office SET
			name = '$name_',
			dep_id = '$dep_id_',
			prefix_id= '$prefix_id_',
			office_boss_name= '$office_boss_name_',
			surname_boss_name = '$surname_boss_name_',
			position_id = '$position_id_',
			number = '$number_',
			district_id = '$district_id_' ,
			amphur_id = '$amphur_id_',
			province_id = '$province_id_',
			passcode = '$passcode_',
			status_id = '$status_id_',
			password = '$password_'
		WHERE id = '$id_'
	";
	
	$result = $DATABASE->Query($sql);
	if($result){
		if( $_SESSION["table"] == "tb_commit") {
			echo "
				<script>
					location.href = '../../?content=user-office&id=".$id_."&page=".$page."';
				</script>
			";
		} else {
			echo "
				<script>
					location.href = '../../?content=user-office-show&id=".$id_."';
				</script>
			";
		} 
	}
?>