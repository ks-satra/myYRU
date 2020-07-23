<?php
    $id = $_REQUEST['id'];
    $school_id = $_REQUEST['school_id'];
    $card = $_REQUEST['card'];
    $sex_id = $_REQUEST['sex_id'];
    $prefix_id = $_REQUEST['prefix_id'];
    $name_thai = $_REQUEST['name_thai'];
    $lname_thai = $_REQUEST['lname_thai'];
    $name_eng = $_REQUEST['name_eng'];
    $lname_eng = $_REQUEST['lname_eng'];
    $birthday = $_REQUEST['birthday'];

    date_default_timezone_set("Asia/Bangkok");
    date_default_timezone_get();
    $date_start = date_create('now')->format('Y-m-d');
    $time_start = date_create('now')->format('H:i:s');

    echo $sql = "
        UPDATE tb_teacher SET 
            card = '$card',
            sex_id = '$sex_id',
            prefix_id = '$prefix_id',
            name_thai = '$name_thai',
            lname_thai = '$lname_thai',
            name_eng = '$name_eng',
            lname_eng = '$lname_eng',
            birthday = '$birthday'
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