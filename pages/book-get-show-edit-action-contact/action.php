<?php
    $id = $_REQUEST['id'];
    $school_id = $_REQUEST['school_id'];
    $no = $_REQUEST['no'];
    $alley = $_REQUEST['alley'];
    $byway = $_REQUEST['byway'];
    $mu = $_REQUEST['mu'];
    $village = $_REQUEST['village'];
    $province_id = $_REQUEST['province_id_'];
    $amphur_id = $_REQUEST['amphur_id_'];
    $district_id = $_REQUEST['district_id_'];
    $passcode = $_REQUEST['passcode_'];

    echo $sql = "
        UPDATE tb_teacher SET 
                no = '$no',
                alley = '$alley',
                byway = '$byway',
                mu = '$mu',
                village = '$village',
                province_id = '$province_id',
                amphur_id = '$amphur_id',
                district_id = '$district_id',
                passcode = '$passcode'
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