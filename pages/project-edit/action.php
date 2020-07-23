<?php
	session_start();
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	$name_thai = $_REQUEST['name_thai'];
	$name_eng = $_REQUEST['name_eng'];
	$p_objective = $_REQUEST['p_objective'];
	$p_scope = $_REQUEST['p_scope'];
	$p_operating = $_REQUEST['p_operating'];
	$p_data_send = $_REQUEST['p_data_analysis'];
	$p_processing_time = $_REQUEST['p_processing_time'];
	$p_activity = $_REQUEST['p_activity'];
	$p_results = $_REQUEST['p_results'];
	$p_indicators = $_REQUEST['p_indicators'];
	$p_budget = $_REQUEST['p_budget'];
	$description = $_REQUEST['description'];
	
	$temp_dir = "../../files/temp/";
	$file_dir = "../../files/file_project/";
	$fileupload = $_FILES["fileupload"]["name"];
	$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
    $fileupload = "fileupload".$id.'.'.$ext;
	//move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $file_dir.$fileupload );

	//$fileupload = $_FILES["fileupload"]["name"];
	$update_fileupload = "";
	if( move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $file_dir.$fileupload ) ) {
		$update_fileupload = ",fileupload = '$fileupload'";
		
		// remove image
		$sql = "SELECT * FROM tb_project WHERE id='".$id."'";
		$obj = $DATABASE->QueryObj($sql);
		unlink("../../files/file_project/".$obj[0]["fileupload"]);
	}
	$sql = "
		UPDATE tb_project SET
			name_thai = '$name_thai',
			name_eng = '$name_eng',
			p_objective = '$p_objective',
			p_scope = '$p_scope',
			p_operating = '$p_operating',
			p_data_send = '$p_data_send',
			p_processing_time = '$p_processing_time',
			p_activity = '$p_activity',
			p_results = '$p_results',
			p_indicators = '$p_indicators',
			p_budget = '$p_budget',
			description = '$description'
			$update_fileupload
		WHERE id = '$id'
	";
	
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=project&project_id=".$id."&page=".$page."';
			</script>
		";
	}
?>