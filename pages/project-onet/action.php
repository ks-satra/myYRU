<?php
    include("../../php/autoload.php");
    $page = $_REQUEST['page'];
    $id = $_REQUEST['book_id'];
    
    $sql = "DELETE FROM tb_get_book WHERE book_id='$id'";

    $result = $DATABASE->Query($sql);
    
    if($result){
        echo "
            <script>
                location.href = '../../?content=project-&id=756&school_id=2&page=".$page."';
            </script>
        ";
        // echo "
        //     <script>
        //         location.href = '../../?content=project-onet&page=".$page."';
        //     </script>
        // ";
    } 
?> 