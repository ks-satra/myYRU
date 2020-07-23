<?php
	include("../../php/autoload.php");
	$id = $DATABASE->QueryMaxId("tb_project","id");
	$name_thai = $_REQUEST['name_thai'];
	$name_eng = $_REQUEST['name_eng'];
	$description = $_REQUEST['description'];
	$p_objective = $_REQUEST['p_objective'];
	$p_scope = $_REQUEST['p_scope'];
	$p_operating = $_REQUEST['p_operating'];
	$p_data_send = $_REQUEST['p_data_analysis'];
	$p_processing_time = $_REQUEST['p_processing_time'];
	$p_activity = $_REQUEST['p_activity'];
	$p_results = $_REQUEST['p_results'];
	$p_indicators = $_REQUEST['p_indicators'];
	$p_budget = $_REQUEST['p_budget'];
	$fileupload = $_FILES["fileupload"]["name"];

	if( isset( $fileupload ) !="" ) {
		$temp_dir = "../../files/temp/";
		$file_dir = "../../files/file_project/";
		$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
	    $fileupload = "fileupload".$id.'.'.$ext;
		move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $file_dir.$fileupload );
	}
	$sql = "INSERT INTO tb_project (id,name_thai,name_eng,description,p_objective,p_scope,p_operating,p_data_send,p_processing_time,p_activity,p_results,p_indicators,p_budget,fileupload) VALUES('$id','$name_thai','$name_eng','$description','$p_objective','$p_scope','$p_operating','$p_data_send','$p_processing_time','$p_activity','$p_results','$p_indicators','$p_budget','$fileupload')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=project-member&project_id=$id';
			</script>
		";
	}
?>