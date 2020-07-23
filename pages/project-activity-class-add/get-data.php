<?php
    include("../../php/autoload.php"); 

    $sql = "                
    SELECT * 
    FROM tb_person
    ";
    $all = $DATABASE->QueryNumRow($sql);
    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_person.id DESC ");
?>
<table id="myTable" class="table table-hover">
    <thead>
        <tr style="background: #861010; color: #fff;">
            <th width="10%"><center>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input mycheckbok-all" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">เลือก</label>
                </div>
            </center></th>
            <th width="70%">ชื่อหนังสือ</th>
            <th width="10%">จำนวน</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(sizeof($DATA)>0){
            foreach($DATA as $key=>$row){
                ?>
                <tr>
                    <td><center>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input mycheckbok" id="customCheck2_<?php echo $key; ?>">
                            <label class="custom-control-label" for="customCheck2_<?php echo $key; ?>"></label>
                        </div>
                    </center></td>
                    <td><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px"><?php echo $row['name_thai']; ?></span></td>
                    <td></td>
                </tr>
                <?php 
            }
        }else{
            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
        }
        ?>
    </tbody>
</table>