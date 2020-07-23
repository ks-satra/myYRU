<?php
    include("../../php/autoload.php");
    // $year_id = @$_POST["year_id"];
    $type_book_id = @$_POST["type_book_id"];
    // $sql = "SELECT * 
    //         FROM tb_criterion 
    //         WHERE year_id='".$year_id."' 
    //             AND type_book_id='".$type_book_id."'
    //         ORDER BY year_id
    // ";
    $sql = "SELECT * 
            FROM tb_book 
            WHERE book_type_id='".$type_book_id."'
    ";
    echo $DATABASE->QueryJson($sql);