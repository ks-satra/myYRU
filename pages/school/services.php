<?php
	// include("../../php/autoload.php");
	// $Ln = $_POST["Ln"];
	// switch ($Ln) {
	// 	case 'loadDp': echo loadDp(); break;
	// 	case 'loadAr': echo loadAr(); break;
	// }
	// function loadDp() {
	// 	global $DATABASE;
	// 	return $DATABASE->QueryJson("SELECT * FROM tb_department ORDER BY name");
	// }
	// function loadAr() {
	// 	global $DATABASE;
	// 	$dp_id = $_POST["dp_id"];
	// 	return $DATABASE->QueryJson("SELECT * FROM tb_area WHERE department_id='".$dp_id."' ORDER BY name");
	// }
?>
<?php
    include("../../php/autoload.php");
    $department_id = @$_POST["department_id"];
    $sql = "SELECT * 
            FROM tb_area 
            WHERE department_id='".$department_id."'
    ";
    echo $DATABASE->QueryJson($sql);