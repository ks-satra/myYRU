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
    ob_start();
?>
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
<script src="view.js"></script>
<section class="content">
    <div class="box box-danger">
        <div class="box-body">      
            วันที่พิมพ์ : <?=thai_date_and_time_short(time())?>
            <div class="container">
                <div class="row">
                    <br><br>
                    <div align="center">
                        <b><font face="Kanit Light" font size="4">แบบรายงานสรุปโครงการเพื่อพิจารณาความเหมาะสมของคุณลักษณะเฉพาะและราคา <br></b>
                        <b><font face="Kanit Light" font size="4">ชื่อโครงการ <?php echo $data['title'];?></b><br>
                        <font face="Kanit Light" font size="4">งบประมาณรายจ่ายประจำปี <?php echo $data['year_name'];?> จำนวนเงิน <?php echo number_format($data['price'], 3); ?> บาท<br>
                        <font face="Kanit Light" font size="4">ชื่อหน่วยงาน <?php echo $data['office_name'];?><br><br>
                    </div>
                    <form>
                        <table id="myTable" class="table table-hover style3" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" colspan="7" align="Light">ส่วนที่เป็นอุปกรณ์คอมพิวเตอร์ <br>กรณีตรงตามเกณฑ์ราคากลางและคุณลักษณะพื้นฐานครุภัณฑ์คอมพิวเตอร์ของกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม
                                    </th>
                                </tr>
                                <tr> 
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5">&nbsp; &nbsp; รายการ</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5">ข้อ (ตามเกณฑ์ MICT)</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5">&nbsp; &nbsp; ราคา MICT</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>ราคาอ้างอิง</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>จำนวน</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>วงเงินรวม</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $strKeyword=$_GET["strKeyword"];
                                    $sql = "
                                        SELECT
                                            tb_project_details.proj_id,
                                            tb_project_details.device_name,
                                            tb_project_details.type_criterion_id,
                                            tb_project_details.criterion_id,
                                            tb_project_details.qty,
                                            tb_project_details.price,
                                            tb_project.title,
                                            tb_type_criterion.`name` As type_criterion_name
                                        FROM
                                            tb_project_details
                                            INNER JOIN tb_project ON tb_project_details.proj_id = tb_project.id
                                            INNER JOIN tb_type_criterion ON tb_project_details.type_criterion_id = tb_type_criterion.id
                                        WHERE tb_project_details.proj_id = $id
                                    ";
                                    $all = $DATABASE->QueryNumRow($sql);
                                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_details.proj_id" );
                                ?>
                                <?php
                                if(sizeof($DATA)>0){
                                    $sum_all = 0;
                                    foreach($DATA as $key => $row){
                                        ?>
                                        <tr>
                                            <?php $row['proj_id']; ?>
                                            <td height="30"><center><?php echo $key+1; ?></center></td>
                                            <td height="30"><center><?php echo $row['device_name']; ?></center></td>
                                            <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px"><?php echo $row['type_criterion_name']; ?></span></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $row['price']; ?></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $row['price']; ?></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $row['qty']; ?></center></td>
                                            <?php 
                                                $qty = $row['qty'];
                                                $price = $row['price'];;
                                                $sum = $qty * $price;
                                                $sum_all = $sum_all + $sum;
                                            ?>
                                            <td height="30"><center>&nbsp;<?php echo $sum; ?></center></td>    
                                        </tr>
                                        <?php 
                                    }
                                }else{
                                    echo "<tr><td height='30' colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                }
                                ?>
                            </tbody>
                            <tr>
                                <th width="110"  height="40" bgcolor="#ffffff" colspan="7" align="Light">รวมจำนวนเงินตามเกณฑ์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($sum_all, 3); ?>
                                </th>
                            </tr>
                        </table><br>
                        <table id="myTable" class="table table-hover style3" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" colspan="10" align="Light">กรณีไม่มีราคาตามเกณฑ์ของกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม
                                    </th>
                                </tr>
                                <tr> 
                                    <th width="110"  height="40" bgcolor="#D5D5D5" rowspan="2"><center>ลำดับ</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" rowspan="2">&nbsp; &nbsp; รายการ</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" colspan="4">การสืบราคาจากท้องตลาด รวมทั้งเว็บไซต์ต่างๆ</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" rowspan="2"><center>ราคาอ้างอิง</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" rowspan="2"><center>จำนวน</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" rowspan="2"><center>วงเงินรวม</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" rowspan="2"><center>หมายเหตุ</center></th>
                                </tr>
                                <tr> 
                                    <th width="110"  height="40" bgcolor="#D5D5D5">ชื่อบริษัท / ยี่ห้อและรุ่น</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5">&nbsp; &nbsp; ชื่อบริษัท / ยี่ห้อและรุ่น</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>ชื่อบริษัท / ยี่ห้อและรุ่น</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>รวมทั้งเว็บไซต์</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $strKeyword=$_GET["strKeyword"];
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
                                        WHERE tb_project_details_non.proj_id=$id
                                    ";
                                    $all = $DATABASE->QueryNumRow($sql);
                                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_details_non.proj_id" );
                                ?>
                                <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $key => $row){
                                        $min = 9999999999;
                                        if( $min>=$row['c_price1'] ) $min = $row['c_price1'];
                                        if( $min>=$row['c_price2'] ) $min = $row['c_price2'];
                                        if( $min>=$row['c_price3'] ) $min = $row['c_price3'];
                                        if( $min>=$row['w_price1'] ) $min = $row['w_price1'];
                                        $sum_min = $min * $row['c_qty1'];
                                        $sum_all = $sum_all + $sum_min;
                                ?> 
                                        <tr>
                                            <?php $row['proj_id']; ?>
                                            <td height="30"><center><?php echo $key+1; ?></center></td>
                                            <td height="30"><center><?php echo $row['device_name']; ?></center></td>
                                            <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px"><?php echo $row['company1']; ?><br><?php echo $row['c_price1']; ?></span></center></td>
                                            <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px"><?php echo $row['company2']; ?><br><?php echo $row['c_price2']; ?></span></center></td>
                                            <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px"><?php echo $row['company3']; ?><br><?php echo $row['c_price3']; ?></span></center></td>
                                            <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px"><?php echo $row['website1']; ?><br><?php echo $row['w_price1']; ?></span></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $min; ?></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $row['c_qty1']; ?></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $sum_min; ?></center></td>   
                                            <td height="30"><center><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px"><?php echo $row['company1']; ?></span><?php echo $row['note']; ?></center></td>  
                                        </tr>
                                        <?php 
                                    }

                                }else{
                                    echo "<tr><td height='30' colspan='10' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                }
                                ?>
                            </tbody>
                            <tr>
                                <th width="110"  height="40" bgcolor="#ffffff" colspan="10" align="Light">รวมจำนวนเงินกรณีไม่มีเกณฑ์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($sum_all, 3); ?><br>
                                </th>
                            </tr>
                            <tr>
                                <th width="110"  height="40" bgcolor="#ffffff" colspan="10" align="Light">รวมจำนวนเงินส่วนที่เป็นอุกรณ์คอมพิวเตอร์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($sum_all, 3); ?><br>
                                </th>
                            </tr>
                        </table><br>
                        <table id="myTable" class="table table-hover style3" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="110"  height="40" bgcolor="#D5D5D5" colspan="5" align="Light">ส่วนที่เป็นอุปกรณ์อื่นๆ <br>
                                    </th>
                                </tr>
                                <tr> 
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5">&nbsp; &nbsp; รายการ</th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>จำนวนเงิน</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>จำนวน</center></th>
                                    <th width="110"  height="40" bgcolor="#D5D5D5"><center>จำนวนเงินรวม</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $strKeyword=$_GET["strKeyword"];
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
                                        WHERE tb_project_details_another.proj_id = $id

                                    ";
                                    $all = $DATABASE->QueryNumRow($sql);
                                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_details_another.proj_id" );
                                ?>
                                <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $key => $row){
                                        ?>
                                        <tr>
                                            <?php $row['proj_id']; ?>
                                            <td height="30"><center><?php echo $key+1; ?></center></td>
                                            <td height="30"><center><?php echo $row['devece_name_another']; ?></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $row['price']; ?></center></td>
                                            <td height="30"><center>&nbsp;<?php echo $row['qty']; ?></center></td>
                                            <?php 
                                                $a = $row['qty'];
                                                $b = $row['price'];
                                                $c = $a * $b;
                                                $sum_all = $sum_all + $c;
                                            ?>
                                            <td height="30"><center>&nbsp;<?php echo $c; ?></center></td>              
                                        </tr>
                                        <?php 
                                    }
                                }else{
                                    echo "<tr><td height='30' colspan='5' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                }
                                ?>
                            </tbody>
                            <tr>
                                <th width="110"  height="40" bgcolor="#ffffff" colspan="5" align="Light">รวมเงินจำนวนส่วนที่เป็นอุปกรณ์อื่นๆ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($sum_all, 3); ?><br>
                                </th>
                            </tr>
                            <tr>
                                <th width="110"  height="40" bgcolor="#ffffff" colspan="5" align="Light">รวมวงเงินโครงการ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($sum_all, 3); ?><br>
                                </th>
                            </tr>
                        </table>
                    <?php
                        } else {
                            echo 'ไม่มีข้อมูล';
                        }
                    ?>
                    </form>
                </div>
            </div>
            <?php
                $html = ob_get_contents();        //เก็บค่า html ไว้ใน $html 
                ob_end_clean();
                $pdf = new mPDF('th', 'A4-L', '0', 'THSarabun');   //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
                $pdf->SetAutoFont();
                $pdf->SetDisplayMode('fullpage');
                $pdf->WriteHTML($html, 2);
                $pdf->Output();
            ?>
        </div>
    </div>
</section>