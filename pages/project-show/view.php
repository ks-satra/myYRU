<?php
    $id = $_REQUEST['get_book'];
    
    $sql = "DELETE FROM tb_get_book WHERE id='$id'";

    $result = $DATABASE->Query($sql);
    
    if($result){
        echo "
            <script>
                location.href = '?content=project-onet&id=756&school_id=2&page=1';
            </script>
        ";
    } 
?> 