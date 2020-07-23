<?php
    include("../../php/autoload.php");
    include("../pdf-property/mpdf/mpdf.php");
    include("../pdf-property/datepdf/view.php");
    ob_start();
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
<script src="view.js"></script>
วันที่พิมพ์ : <?=thai_date_and_time_short(time())?>
<section class="content-header" align="center">
    <h3 align="center">รายงานข้อมูลโครงการที่พิจารณา</h3>
    <small>แบบรายงานสรุปโครงการที่พิจารณาทั้งหมด</small>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h4 class="box-title">สรุปข้อมูลโครงการที่พิจารณาทั้งหมด</h4>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="project-consider-conclude">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive">
                <?php
                    $sdate = isset( $_GET["sdate"] ) ? $_GET["sdate"] : "" ;
                    $edate = isset( $_GET["edate"] ) ? $_GET["edate"] : "" ;
                    $condition_date = "";
                    if( $sdate!="" && $edate!="" ) {
                        $condition_date = " AND ( tb_project.date between '".$sdate." 00:00' AND '".$edate." 23:59' ) ";
                    }

                    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";

                    $SHOW = 10;

                    $start = ($PAGE-1)*$SHOW;
                    $sql = "
                        SELECT
                            tb_project.id,
                            tb_project.title,
                            tb_project.price,
                            tb_project.consider,
                            tb_office.`name` As office_name,
                            tb_year.`name` As year_name
                        FROM
                            tb_project
                            INNER JOIN tb_office ON tb_project.office_id = tb_office.id
                            INNER JOIN tb_year ON tb_project.year_id = tb_year.id
                         WHERE 
                            (
                                tb_project.id LIKE '%$SERACHING%' OR
                                tb_project.title LIKE '%$SERACHING%' OR
                                tb_year.`name` LIKE '%$SERACHING%' OR
                                tb_office.`name` LIKE '%$SERACHING%' 
                            ) ".$condition_date."
                        ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project.id DESC LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                            <th width="110"  height="40" bgcolor="#D5D5D5">ชื่อโครงการ</th>
                            <th width="110"  height="40" bgcolor="#D5D5D5">สำนักงาน</th>
                            <th width="110"  height="40" bgcolor="#D5D5D5">วงเงิน</th>
                            <th width="110"  height="40" bgcolor="#D5D5D5"><center>สถานะโครงการ</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <tr>
                                    <?php 
                                        $status_show = $row['consider'];
                                        if ( $status_show == "ตรวจสอบเรียบร้อยแล้ว") { 
                                    ?>
                                    <?php $row['id']; ?>
                                    <td height="30"><center><?php echo $key+1; ?> - <?php echo $row['year_name']; ?></center></td>
                                    <td height="30"><?php echo $row['title']; ?></td>
                                    <td height="30"><?php echo $row['office_name']; ?></td>
                                    <td height="30"><center><?php echo number_format($row['price'], 3); ?></center></td>
                                    <td height="30"><center>
                                        <?php echo $row['consider']; ?>
                                    </center></td>
                                    <?php } ?>
                                </tr>
                                <?php 
                            }
                        }else{
                            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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
    </div>
</section>


