<?php
    $id = $_REQUEST['id'];
    $school_id = $_REQUEST['school_id'];
    $alumni = $_REQUEST['alumni'];
    $faculty = $_REQUEST['faculty'];
    $branch = $_REQUEST['branch'];
    $buddhist_era_start = $_REQUEST['buddhist_era_start'];
    $buddhist_era_end = $_REQUEST['buddhist_era_end'];

    echo $sql = "
        UPDATE tb_teacher SET 
                alumni = '$alumni',
                faculty = '$faculty',
                branch = '$branch',
                buddhist_era_start = '$buddhist_era_start',
                buddhist_era_end = '$buddhist_era_end'
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