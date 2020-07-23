<?php
    include("../../php/autoload.php");
    $book_id = @$_POST["book_id"];
    $sql = "SELECT * 
            FROM tb_get_book 
            WHERE book_id='".$book_id."'
    ";
    echo $DATABASE->QueryJson($sql);