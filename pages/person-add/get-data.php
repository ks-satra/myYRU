<?php
    include("../../php/autoload.php"); 

    $type = @$_POST["project_id"];
    $condition = "";
    if( $type!="" ) {
        $condition = "WHERE project_id='".$type."' ";
    }
    $sql = "                
    SELECT * 
    FROM tb_activity
    ".$condition."
    ";
    $all = $DATABASE->QueryNumRow($sql);
    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_activity.id DESC ");
?>
<div class="form-group" id="show-data">
    <label for="activity_id">กิจกรรม <red>*</red></label>
    <select id="activity_id" name="activity_id" class="form-control selectpicker mycheckbok-all" data-live-search="true" title="เลือกกิจกรรม" style="width: 100%;" required>
        <option value="">- เลือกกิจกรรม -</option>
        <?php
        $obj = $DATABASE->QueryObj("
            SELECT
            *
            FROM
            tb_activity
            ORDER BY name");
        foreach($obj as $row) {
            $selected = "";
            echo '<option class="mycheckbok" value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
        }
        ?>
    </select>
    <br><br><small><red>เช่น กิจกรรมที่ 1 : พัฒนาศักยภาพครูในพื้นที่ชายแดนใต้ในเรื่องการผลิตสื่อเพื่อส่งเสริมการอ่านออกเขียนได้</red></small>
</div>