<?php
    $id = $_REQUEST['id'];
    $school_id = $_REQUEST['school_id'];
    $tel = $_REQUEST['tel'];
    $email = $_REQUEST['email'];
    $idline = $_REQUEST['idline'];

    echo $sql = "
        UPDATE tb_teacher SET 
            tel = '$tel',
            email = '$email',
            idline = '$idline'
        WHERE id = '$id' AND school_id = '$school_id'
    ";
    $result = $DATABASE->Query($sql);
    if($result){
        echo "
            <script>
                location.href = '?content=book-get-show&id=$id&school_id=$school_id';
            </script>
        ";
    }
?>