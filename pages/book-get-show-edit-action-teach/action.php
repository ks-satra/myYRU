<?php
    $id = $_REQUEST['id'];
    $school_id = $_REQUEST['school_id'];
    $checkbox1=$_POST['techno'];
    $chk="";  
        foreach($checkbox1 as $chk1)  
        {  
            $chk .= $chk1.",";  
        }
    $checkbox2=$_POST['topics'];
    $get_topics="";  
        foreach($checkbox2 as $chk2)  
        {  
            $get_topics .= $chk2.",";  
        }

    echo $sql = "
        UPDATE tb_teacher SET 
                level = '$chk',
            topics = '$get_topics'
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