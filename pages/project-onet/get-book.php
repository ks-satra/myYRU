<?php
    include("../../php/autoload.php");
    $school_id = @$_POST["school_id"];
    $sql = "SELECT * 
            FROM tb_teacher 
            WHERE school_id='".$school_id."'
    ";
    echo $DATABASE->QueryJson($sql);