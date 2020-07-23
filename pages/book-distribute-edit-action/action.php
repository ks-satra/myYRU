<?php
    $id = $_REQUEST['id'];
    $teacher_id = $_GET['teacher_id'];
    $school_id = $_GET['school_id'];
    $book_id = $_REQUEST['book_id'];
    
    $sql = "DELETE FROM tb_get_book WHERE id='".$id."' AND teacher_id='".$teacher_id."' AND school_id='".$school_id."' AND book_id='".$book_id."'";

    $result = $DATABASE->Query($sql);
    if($result){
        echo "
            <script>
                location.href = '?content=book-distribute-edit&id=".$teacher_id."&school_id=".$school_id."';
            </script>
        ";
    } 
?> 