<?php 
    // include("../../php/class.database.php");
    // include("../../php/class.function.php");
    // include("../../php/config.php");
    // include("../../php/function.php");
    // $DATABASE = new Database($HOST,$USER,$PASS,$DBNAME);
    // $FUNCTION = new Functions($DATABASE);
    // $USER = $FUNCTION->GetUser();

    // if( $USER==null ) {
    //     LINKTO("../../login.php");
    // }

    include("../../php/autoload.php");
    include("../pdf-property/mpdf/mpdf.php");
    include("../pdf-property/datepdf/view.php");
    $id = $_GET["id"];
    $PROCECT_ID = isset($_GET["id"])?$_GET["id"]:"";
    // $OFFICE_ID1 = $_SESSION["data_id"];
    $OFFICE_ID = $DATABASE->QueryString("SELECT office_id FROM tb_project_person_cur WHERE office_id= '".$PROCECT_ID."'");
    ob_start();
?>
<script src="view.js"></script>
<section class="content">
    <div class="box box-danger">
        <div class="box-body">      
            วันที่พิมพ์ : <?=thai_date_and_time_short(time())?>
            <div class="container">
                <div class="row">
                    <br><br>
                    <div align="center">
                        <b><font face="Kanit Light" font size="3">แบบรายงานการจัดหาระบบคอมพิวเตอร์ที่มีมูลค่าไม่เกิน ๑๐ ล้านบาท <br><br></b>
                    </div>
                    <form>
                        <?php
                            $sql = "
                               SELECT
                                    tb_project.id,
                                    tb_project.title,
                                    tb_project.office_id,
                                    tb_project.manager,
                                    tb_project.m_position_id,
                                    tb_project.reponsible,
                                    tb_project.r_position_id,
                                    tb_project.reponsible_phone,
                                    tb_project.price,
                                    tb_project.money_type_id,
                                    tb_project.money_type_99,
                                    tb_project.sale_type_id,
                                    tb_project.sale_type_99,
                                    tb_project.problem_desc,
                                    tb_project.quality_desc,
                                    tb_project.compare_desc,
                                    tb_project.procurement_id,
                                    tb_project.procurement_99,
                                    tb_project.year_id,
                                    tb_project.consider,
                                    tb_project.date,
                                    tb_office.`name` As office_name,
                                    tb_year.`name`,
                                    tb_position.`name` As position_name,
                                    tb_office.id,
                                    tb_office.prefix_id,
                                    tb_office.office_boss_name,
                                    tb_office.surname_boss_name,
                                    tb_office.position_id,
                                    tb_office.number,
                                    tb_office.district_id,
                                    tb_office.amphur_id,
                                    tb_office.province_id,
                                    tb_office.passcode,
                                    tb_office.status_id,
                                    tb_office.username,
                                    tb_office.`password`,
                                    tb_office.dep_id,
                                    tb_prefix.`name` As prefix_name
                                FROM
                                    tb_project
                                    INNER JOIN tb_office ON tb_office.id = tb_project.office_id
                                    INNER JOIN tb_year ON tb_year.id = tb_project.year_id
                                    INNER JOIN tb_position ON tb_position.id = tb_project.m_position_id AND tb_position.id = tb_office.position_id
                                    INNER JOIN tb_prefix ON tb_prefix.id = tb_office.prefix_id
                                WHERE tb_project.id = $id
                            ";
                            $obj =$DATABASE->QueryObj($sql);
                            if( sizeof($obj)>=1 ) {
                                $data = $obj[0];
                        ?>
                        ๑. ชื่อโครงการ <u><?php echo $data['title'];?></u><br>
                        ๒. ส่วนราชการ / รัฐวิสาหกิจ <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อส่วนราชการ / รัฐวิสาหกิจ <u><?php echo $data['office_name'];?></u><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อหัวหน้าส่วนราชการ / รัฐวิสาหกิจ <u><?php echo $data['prefix_name'];?><?php echo $data['office_boss_name'];?><?php echo $data['office_boss_name'];?></u> ตำแหน่ง <u><?php echo $data['position_name'];?></u><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้รับผิดชอบโครงการ <u><?php echo $data['reponsible'];?></u> ตำแหน่ง <u><?php echo $data['position_name'];?></u> โทรศัพท์ <u><?php echo $data['reponsible_phone'];?></u><br>
                        ๓. ค่าใช้จ่าย <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วงเงินรวมทั้งสิ้น <u><?php echo number_format($data['price'], 3); ?></u> บาท <br>
                            <div class="form-group">
                                <label name="money_type_id_">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แหล่งเงิน</label>
                                <div class="radio">&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <!--<input type="radio" name="money_type_id_" value="99" <?php //if($data['money_type_id']=="99") echo "checked"; ?>>-->
                                        <?php if($data['money_type_id']=="1") echo "/"; ?> &nbsp;&nbsp;&nbsp;&nbsp;ซื้อ
                                    </label>
                                    <label>
                                        <!-- <input type="radio" name="money_type_id_" value="2" <?php //if($data['money_type_id']=="99") echo "/"; ?>> -->
                                        <?php if($data['money_type_id']=="2") echo "/"; ?> &nbsp;&nbsp;&nbsp;&nbsp;เช่า
                                    </label>
                                    <label>
                                        <!-- <input type="radio" name="money_type_id_" value="3" <?php //if($data['money_type_id']=="99") echo "/"; ?>> -->
                                      <?php if($data['money_type_id']=="3") echo "/"; ?> &nbsp;&nbsp;&nbsp;&nbsp;รับบริจาค
                                    </label>
                                    <label>
                                        <!-- <input type="radio" name="money_type_id_" value="4" <?php //if($data['money_type_id']=="99") echo "/"; ?>> -->
                                       <?php if($data['money_type_id']=="99") echo "/"; ?> &nbsp;&nbsp;&nbsp;&nbsp;อื่นๆ (ระบุ) <input type="text" name="money_type_99_" class="form-control" placeholder="อื่นๆ (ระบุ)" value="<?php echo $data['money_type_99']; ?>">
                                    </label>
                                </div><br>
                            </div>
                        ๔. รายละเอียดของอุปกรณ์ที่จะจัดหาครั้งนี้<br>
                            <p>กรณีตรงตามเกณฑ์ราคากลางและคุณลักษณะพื้นฐานครุภัณฑ์คอมพิวเตอร์ของกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม</p>
                            <div class="table-responsive">
                                <?php
                                    $sql = "
                                        SELECT
                                            tb_project_details.proj_id,
                                            tb_project_details.device_name,
                                            tb_project_details.type_criterion_id,
                                            tb_project_details.criterion_id,
                                            tb_project_details.qty,
                                            tb_project_details.price,
                                            tb_project.title,
                                            tb_type_criterion.`name` As type_criterion_name,
                                            tb_criterion.`name` As criterion_name
                                        FROM
                                            tb_project_details
                                            INNER JOIN tb_project ON tb_project_details.proj_id = tb_project.id
                                            INNER JOIN tb_type_criterion ON tb_project_details.type_criterion_id = tb_type_criterion.id
                                            INNER JOIN tb_criterion ON tb_project_details.criterion_id = tb_criterion.id
                                        WHERE tb_project_details.proj_id=$PROCECT_ID
                                    ";
                                    $all = $DATABASE->QueryNumRow($sql);
                                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_details.proj_id");
                                ?>
                                <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5">ประเภทเกณฑ์</th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5">เกณฑ์ราคากลาง</th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5"><center>จำนวน</center></th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5">ราคา</th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5">รวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if(sizeof($DATA)>0){
                                            foreach($DATA as $row){
                                                ?>
                                                <tr>
                                                    <td height="30"><center><?php echo ++$i; ?></center></td>
                                                    <td height="30"><?php echo $row['device_name']; ?> </td>
                                                    <td height="30" title="<?php echo $row['type_criterion_name']; ?>"><?php echo $row['type_criterion_name']; ?></td>
                                                    <td title="<?php echo $row['criterion_name']; ?>"><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:120px"><?php echo $row['criterion_name']; ?></span></td>
                                                    <td height="30"><center><?php echo $row['qty']; ?></center></td>
                                                    <td height="30"><center><?php echo number_format($row['price'], 3); ?></center></td>
                                                    <?php 
                                                        $a = $row['qty'];
                                                        $b = $row['price'];
                                                        $sum = $a * $b;
                                                    ?>
                                                    <td height="30"><center><?php echo number_format($sum, 3); ?></center></td>
                                                </tr>
                                                <?php 
                                            }
                                        }else{
                                            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                    $sql = "SELECT * FROM tb_project_details_non WHERE proj_id='".$_GET["id"]."' 
                    ";
                    $a = $DATABASE->QueryObj($sql);
                    if( sizeof($a) != 0 ) { 
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <p>กรณีไม่มีราคาตามเกณฑ์ฯ ของกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม</p>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <?php
                                        $sql = "
                                            SELECT
                                                tb_project_details_non.id As device_id,
                                                tb_project_details_non.proj_id,
                                                tb_project_details_non.device_name,
                                                tb_project_details_non.description,
                                                tb_project_details_non.reason,
                                                tb_project_details_non.note,
                                                tb_project_details_non.company1,
                                                tb_project_details_non.c_qty1,
                                                tb_project_details_non.c_price1,
                                                tb_project_details_non.company2,
                                                tb_project_details_non.c_qty2,
                                                tb_project_details_non.c_price2,
                                                tb_project_details_non.company3,
                                                tb_project_details_non.c_qty3,
                                                tb_project_details_non.c_price3,
                                                tb_project_details_non.website1,
                                                tb_project_details_non.w_qty1,
                                                tb_project_details_non.w_price1,
                                                tb_project_details_non.website2,
                                                tb_project_details_non.w_qty2,
                                                tb_project_details_non.w_price2,
                                                tb_project_details_non.website3,
                                                tb_project_details_non.w_qty3,
                                                tb_project_details_non.w_price3,
                                                tb_project.title
                                            FROM
                                                tb_project_details_non
                                                INNER JOIN tb_project ON tb_project_details_non.proj_id = tb_project.id
                                            WHERE tb_project_details_non.proj_id=$PROCECT_ID
                                        ";
                                        $all = $DATABASE->QueryNumRow($sql);
                                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_details_non.id");
                                    ?>
                                    <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">รายละเอียด</th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">เหตุผล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            if(sizeof($DATA)>0){
                                                foreach($DATA as $row){
                                                    ?>
                                                    <tr>
                                                        <?php $row['device_id']; ?>
                                                        <td height="30"><center><?php echo ++$i; ?></center></td>
                                                        <td height="30"><?php echo $row['device_name']; ?> </td>
                                                        <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:120px"><?php echo $row['description']; ?></span></center></td>
                                                        <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:120px"><?php echo $row['note']; ?></span></center></td>
                                                    </tr>
                                                    <?php 
                                                }
                                            }else{
                                                echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php 
                    $sql = "SELECT * FROM tb_project_details_another WHERE proj_id='".$_GET["id"]."' 
                    ";
                    $a = $DATABASE->QueryObj($sql);
                    if( sizeof($a) != 0 ) { 
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <p>กรณีไม่มีราคาตามเกณฑ์ฯ ส่วนที่เป็นอุปกรณ์อื่นๆ</p>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <?php
                                        $sql = "
                                            SELECT
                                                tb_project_details_another.id As device_another_id,
                                                tb_project_details_another.proj_id,
                                                tb_project_details_another.devece_name_another,
                                                tb_project_details_another.qty,
                                                tb_project_details_another.price,
                                                tb_project_details_another.description,
                                                tb_project.title
                                            FROM
                                                tb_project_details_another
                                                INNER JOIN tb_project ON tb_project_details_another.proj_id = tb_project.id
                                            WHERE tb_project_details_another.proj_id=$PROCECT_ID
                                            ";
                                        $all = $DATABASE->QueryNumRow($sql);
                                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_details_another.id");
                                    ?>
                                    <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">รายละเอียด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            if(sizeof($DATA)>0){
                                                foreach($DATA as $row){
                                                    ?>
                                                    <tr>
                                                        <?php $row['device_another_id']; ?>
                                                        <td><center><?php echo ++$i; ?></center></td>
                                                        <td height="30"><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:120px"><?php echo $row['devece_name_another']; ?></span></td>
                                                        <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:120px"><?php echo $row['description']; ?></span></center></td>
                                                    </tr>
                                                    <?php 
                                                }
                                            }else{
                                                echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    <br>๕. วิธีการจัดหา 
                        <div class="radio">&nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <?php if($data['sale_type_id']=="1") echo "/"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                เงินงบประมาณ
                            </label>
                            <label>
                                <?php if($data['sale_type_id']=="2") echo "/"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                เงินรายได้
                            </label>
                            <label>
                                <?php if($data['sale_type_id']=="3") echo "/"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                เงินช่วยเหลืออื่นๆ
                            </label>
                            <label>
                                <?php if($data['sale_type_id']=="99") echo "/"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                อื่นๆ (ระบุ) <input type="text" name="sale_type_99_" class="form-control" placeholder="อื่นๆ (ระบุ)" value="<?php echo $data['sale_type_99']; ?>">
                            </label>
                        </div><br>
                    ๖. สถานที่ติดตั้ง <br>
                        <div class="form-group">
                            <p>กรณีตรงตามเกณฑ์ราคากลางและคุณลักษณะพื้นฐานครุภัณฑ์คอมพิวเตอร์ของกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม</p>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <?php
                                        $sql = "
                                            SELECT
                                                tb_project.title,
                                                tb_project_details.device_name,
                                                tb_type_criterion.`name`,
                                                tb_criterion.`name`,
                                                tb_project_installation1.proj_id,
                                                tb_project_installation1.type_criterion_id,
                                                tb_project_installation1.criterion_id,
                                                tb_project_installation1.qty1,
                                                tb_project_installation1.qty2
                                                FROM
                                                tb_project
                                                INNER JOIN tb_project_details ON tb_project_details.proj_id = tb_project.id
                                                INNER JOIN tb_project_installation1 ON tb_project_installation1.proj_id = tb_project_details.proj_id AND tb_project_installation1.type_criterion_id = tb_project_details.type_criterion_id AND tb_project_installation1.criterion_id = tb_project_details.criterion_id
                                                INNER JOIN tb_criterion ON tb_project_details.criterion_id = tb_criterion.id
                                                INNER JOIN tb_type_criterion ON tb_project_details.type_criterion_id = tb_type_criterion.id
                                            WHERE tb_project_installation1.proj_id = $PROCECT_ID
                                        ";
                                        $all = $DATABASE->QueryNumRow($sql);
                                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_installation1.proj_id");
                                    ?>
                                    <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">ฝ่ายแผนงานและงบประมาณ</th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">ฝ่ายนิติการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            if(sizeof($DATA)>0){
                                                foreach($DATA as $row){
                                                    ?>
                                                    <tr>
                                                        <td height="30"><center><?php echo ++$i; ?></center></td>
                                                        <td height="30"><center><?php echo $row['device_name']; ?></center></td>
                                                        <td height="30"><center><?php echo $row['qty1']; ?></center></td>
                                                        <td height="30"><center><?php echo $row['qty2']; ?></center></td>
                                                    </tr>
                                                    <?php 
                                                }
                                            }else{
                                                echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php 
                            $sql = "SELECT * FROM tb_project_installation2 WHERE proj_id='".$PROCECT_ID."'
                                ";
                                $a = $DATABASE->QueryObj($sql);
                                if( sizeof($a) != 0 ) {
                        ?>
                            <div class="form-group">
                                <p>กรณีไม่มีราคาตามเกณฑ์ฯ ของกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม</p>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <?php
                                            $sql = "
                                                SELECT
                                                    tb_project_installation2.id,
                                                    tb_project_installation2.proj_id,
                                                    tb_project_installation2.proj_details_non_id,
                                                    tb_project_installation2.qty1,
                                                    tb_project_installation2.qty2,
                                                    tb_project.title,
                                                    tb_project_details_non.device_name
                                                    FROM
                                                    tb_project_installation2
                                                    INNER JOIN tb_project_details_non ON tb_project_installation2.proj_details_non_id = tb_project_details_non.id
                                                    INNER JOIN tb_project ON tb_project_installation2.proj_id = tb_project.id
                                                WHERE tb_project_installation2.proj_id = $PROCECT_ID
                                            ";
                                            $all = $DATABASE->QueryNumRow($sql);
                                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_installation2.proj_id");
                                        ?>
                                        <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5">ฝ่ายแผนงานและงบประมาณ</th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5">ฝ่ายนิติการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if(sizeof($DATA)>0){
                                                    foreach($DATA as $row){
                                                        ?>
                                                        <tr>
                                                            <?php $row['id']; ?>
                                                            <?php $row['proj_details_non_id']; ?>
                                                            <?php $row['proj_id']; ?>
                                                            <td height="30"><center><?php echo ++$i; ?></center></td>
                                                            <td height="30"><center><?php echo $row['device_name']; ?></center></td>
                                                            <td height="30"><center><?php echo $row['qty1']; ?></center></td>
                                                            <td height="30"><center><?php echo $row['qty2']; ?></center></td>
                                                        </tr>
                                                        <?php 
                                                    }
                                                }else{
                                                    echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            }
                        ?>
                        <?php 
                            $sql = "SELECT * FROM tb_project_installation3 WHERE proj_id='".$PROCECT_ID."'
                                ";
                                $a = $DATABASE->QueryObj($sql);
                                if( sizeof($a) != 0 ) {
                        ?>
                            <div class="form-group">
                                <p>กรณีไม่มีราคาตามเกณฑ์ฯ ส่วนที่เป็นอุปกรณ์อื่นๆ</p>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <?php
                                            $sql = "
                                                SELECT
                                                    tb_project_installation3.id,
                                                    tb_project_installation3.proj_id,
                                                    tb_project_installation3.proj_details_another_id,
                                                    tb_project_installation3.qty1,
                                                    tb_project_installation3.qty2,
                                                    tb_project_details_another.devece_name_another,
                                                    tb_project.title
                                                    FROM
                                                    tb_project_installation3
                                                    INNER JOIN tb_project ON tb_project_installation3.proj_id = tb_project.id
                                                    INNER JOIN tb_project_details_another ON tb_project_installation3.proj_details_another_id = tb_project_details_another.id
                                                WHERE tb_project_installation3.proj_id = $PROCECT_ID
                                            ";
                                            $all = $DATABASE->QueryNumRow($sql);
                                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_installation3.proj_id");
                                        ?>
                                        <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5">ฝ่ายแผนงานและงบประมาณ</th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5">ฝ่ายนิติการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if(sizeof($DATA)>0){
                                                    foreach($DATA as $row){
                                                        ?>
                                                        <tr>
                                                            <?php $row['id']; ?>
                                                            <?php $row['proj_details_another_id']; ?>
                                                            <?php $row['proj_id']; ?>
                                                            <td height="30"><center><?php echo ++$i; ?></center></td>
                                                            <td height="30"><center><?php echo $row['devece_name_another']; ?></center></td>
                                                            <td height="30"><center><?php echo $row['qty1']; ?></center></td>
                                                            <td height="30"><center><?php echo $row['qty2']; ?></center></td>>
                                                        </tr>
                                                        <?php 
                                                    }
                                                }else{
                                                    echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            }
                        ?>
                    <br>๗. ระบบหรืออุปกรณ์คอมพิวเตอ์ที่มีอยู่ในปัจจุบันของหน่วยงาน ตามข้อ ๖<br>
                    <div class="form-group">
                        <p>กรณีตรงตามเกณฑ์ราคากลางและคุณลักษณะพื้นฐานครุภัณฑ์คอมพิวเตอร์ของกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม</p>
                        <div class="box-body">
                            <div class="table-responsive">
                                <?php
                                    $sql = "
                                        SELECT
                                            tb_project.title,
                                            tb_project_details.device_name,
                                            tb_type_criterion.`name`,
                                            tb_criterion.`name`,
                                            tb_project_installation1.install_name,
                                            tb_project_installation1.buddhist_era,
                                            tb_project_installation1.proj_id,
                                            tb_project_installation1.type_criterion_id,
                                            tb_project_installation1.criterion_id,
                                            tb_project_installation1.qty1,
                                            tb_project_installation1.qty2
                                            FROM
                                            tb_project
                                            INNER JOIN tb_project_details ON tb_project_details.proj_id = tb_project.id
                                            INNER JOIN tb_project_installation1 ON tb_project_installation1.proj_id = tb_project_details.proj_id AND tb_project_installation1.type_criterion_id = tb_project_details.type_criterion_id AND tb_project_installation1.criterion_id = tb_project_details.criterion_id
                                            INNER JOIN tb_criterion ON tb_project_details.criterion_id = tb_criterion.id
                                            INNER JOIN tb_type_criterion ON tb_project_details.type_criterion_id = tb_type_criterion.id
                                        WHERE tb_project_installation1.proj_id = $PROCECT_ID
                                    ";
                                    $all = $DATABASE->QueryNumRow($sql);
                                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_installation1.proj_id");
                                ?>
                                <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5">สถานที่ติดตั้ง / ชื่อระบบงาน</th>
                                            <th width="110"  height="40" bgcolor="#D5D5D5"><center>พ.ศ.</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if(sizeof($DATA)>0){
                                            foreach($DATA as $row){
                                                ?>
                                                <tr>
                                                    <td height="30"><center><?php echo ++$i; ?></center></td>
                                                    <td height="30"><?php echo $row['device_name']; ?> </td>
                                                    <td height="30"><center><?php echo $row['install_name']; ?></center> </td>
                                                    <td height="30"><center><?php echo $row['buddhist_era']; ?></center> </td>
                                                </tr>
                                                <?php 
                                            }
                                        }else{
                                            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $sql = "SELECT * FROM tb_project_installation2 WHERE proj_id='".$PROCECT_ID."'
                            ";
                            $a = $DATABASE->QueryObj($sql);
                            if( sizeof($a) != 0 ) {
                    ?>
                        <div class="form-group">
                            <label for="fileinstall_">
                            <p>กรณีไม่มีราคาตามเกณฑ์ฯ ของกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม</p>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <?php
                                        $sql = "
                                            SELECT
                                                tb_project_installation2.id,
                                                tb_project_installation2.proj_id,
                                                tb_project_installation2.proj_details_non_id,
                                                tb_project_installation2.install_name,
                                                tb_project_installation2.buddhist_era,
                                                tb_project_installation2.qty1,
                                                tb_project_installation2.qty2,
                                                tb_project.title,
                                                tb_project_details_non.device_name
                                                FROM
                                                tb_project_installation2
                                                INNER JOIN tb_project_details_non ON tb_project_installation2.proj_details_non_id = tb_project_details_non.id
                                                INNER JOIN tb_project ON tb_project_installation2.proj_id = tb_project.id
                                            WHERE tb_project_installation2.proj_id = $PROCECT_ID
                                        ";
                                        $all = $DATABASE->QueryNumRow($sql);
                                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_installation2.proj_id");
                                    ?>
                                    <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5">สถานที่ติดตั้ง / ชื่อระบบงาน</th>
                                                <th width="110"  height="40" bgcolor="#D5D5D5"><center>พ.ศ.</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            if(sizeof($DATA)>0){
                                                foreach($DATA as $row){
                                                    ?>
                                                    <tr>
                                                        <td height="30"><center><?php echo ++$i; ?></center></td>
                                                        <td height="30"><center><?php echo $row['device_name']; ?></center> </td>
                                                        <td height="30"><center><?php echo $row['install_name']; ?></center> </td>
                                                        <td height="30"><center><?php echo $row['buddhist_era']; ?></center></td>
                                                    </tr>
                                                    <?php 
                                                }
                                            }else{
                                                echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php 
                        }
                    ?>
                    <?php 
                        $sql = "SELECT * FROM tb_project_installation3 WHERE proj_id='".$PROCECT_ID."'
                            ";
                            $a = $DATABASE->QueryObj($sql);
                            if( sizeof($a) != 0 ) {
                    ?>
                        <div class="form-group">
                            <p>กรณีไม่มีราคาตามเกณฑ์ฯ ส่วนที่เป็นอุปกรณ์อื่นๆ</p>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <?php
                                            $sql = "
                                                SELECT
                                                    tb_project_installation3.id,
                                                    tb_project_installation3.proj_id,
                                                    tb_project_installation3.proj_details_another_id,
                                                    tb_project_installation3.install_name,
                                                    tb_project_installation3.buddhist_era,
                                                    tb_project_installation3.qty1,
                                                    tb_project_installation3.qty2,
                                                    tb_project_details_another.devece_name_another,
                                                    tb_project.title
                                                    FROM
                                                    tb_project_installation3
                                                    INNER JOIN tb_project ON tb_project_installation3.proj_id = tb_project.id
                                                    INNER JOIN tb_project_details_another ON tb_project_installation3.proj_details_another_id = tb_project_details_another.id
                                                WHERE tb_project_installation3.proj_id = $PROCECT_ID
                                            ";
                                            $all = $DATABASE->QueryNumRow($sql);
                                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_installation3.proj_id");
                                        ?>
                                        <table class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5">รายการ</th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5">สถานที่ติดตั้ง / ชื่อระบบงาน</th>
                                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>พ.ศ.</center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if(sizeof($DATA)>0){
                                                    foreach($DATA as $row){
                                                        ?>
                                                        <tr>
                                                            <td height="30"><center><?php echo ++$i; ?></center></td>
                                                            <td height="30"><?php echo $row['devece_name_another']; ?> </td>
                                                            <td height="30"><?php echo $row['install_name']; ?> </td>
                                                            <td height="30"><center><?php echo $row['buddhist_era']; ?></center></td>
                                                        </tr>
                                                        <?php 
                                                    }
                                                }else{
                                                    echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    <?php 
                        }
                    ?>
                    <br>๘. ปัญหา / อุปสรรคในการปฎิบัติงานหรือเหตุผลความจำเป็นที่ต้องจัดหาอุปกรณ์ครั้งนี้ <br><br><?php echo $data['problem_desc'];?><br><br>
                    ๙. ลักษณะงานหรือระบบงานที่จะใช้กับอุปกรณ์ที่จัดหาครั้งนี้ <br><br><?php echo $data['quality_desc'];?><br><br>
                    ๑๐. เปรียบเทียบอุปกรณ์ที่จัดหาครั้งนี้กับปริมาณงาน <br><br><?php echo $data['compare_desc'];?><br><br>
                    ๑๑. บุคลากรด้านคอมพิวเตอร์ที่มีอยู่ปัจจุบัน <br><br>
                    <table id="myTable" class="table table-hover style3" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5">&nbsp; &nbsp; ตำแหน่ง</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $strKeyword=$_GET["strKeyword"];
                                    $sql = "
                                        SELECT
                                            tb_project_person_cur.id,
                                            tb_project_person_cur.office_id,
                                            tb_project_person_cur.person_name,
                                            tb_project_person_cur.qty
                                        FROM
                                            tb_project_person_cur
                                        WHERE office_id = $OFFICE_ID
                                    ";
                                    $all = $DATABASE->QueryNumRow($sql);
                                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_person_cur.id" );
                                ?>
                                <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $key => $row){
                                        ?>
                                        <tr>
                                            <td height="30"><center><?php echo $key+1; ?></center></td>
                                            <td height="30"><center><?php echo $row['person_name']; ?></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $row['qty']; ?></center></td>            
                                        </tr>
                                        <?php 
                                    }
                                }else{
                                    echo "<tr><td height='30' colspan='3' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                }
                                ?>
                            </tbody>
                        </table><br>
                    ๑๒. ลักษณะการจัดหา <br>
                        <div class="radio">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๑๒.๑ การจัดหา
                            <label>
                                <?php if($data['procurement_id']=="1") echo "/"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                ขยายระบบเดิม
                            </label>
                            <label>
                                <?php if($data['procurement_id']=="2") echo "/"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                จัดหาใหม่
                            </label>
                        </div><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๑๒.๒ ขยายระบบเดิม <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['procurement_99']; ?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๑๒.๓ จัดหาใหม่ <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['procurement_99
                        ']; ?><br><br><br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้รายงาน.......................................................... <br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(....................................................) <br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง ......................................................... <br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; วัน เดือน ปี ......................................................
                    <?php
                        } else {
                            echo 'No data.';
                        }
                    ?>
                    </form>
                </div>
            </div>
            <?Php
                $html = ob_get_contents();
                ob_end_clean();
                $pdf = new mPDF('th', 'A4', '0', 'TH SarabunPSK');
                $pdf->SetAutoFont();
                $pdf->SetDisplayMode('fullpage');
                $pdf->WriteHTML($html, 2);
                $pdf->Output();
            ?>
        </div>
    </div>
</section>