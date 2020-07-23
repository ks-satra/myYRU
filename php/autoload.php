<?php
	include("class.database.php");
	include("class.function.php");
    include("config.php");
    include("function.php");
    $DATABASE = new Database($HOST,$USER,$PASS,$DBNAME);
    $FUNCTION = new Functions($DATABASE);
	$USER = $FUNCTION->GetUser();

?>