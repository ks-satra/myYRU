<?php
    include("../../php/autoload.php");
    include("../pdf-property/mpdf/mpdf.php");
    include("../pdf-property/datepdf/view.php");
    ob_start();
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
วันที่พิมพ์ : <?=thai_date_and_time_short(time())?>
<section class="content-header">
    <h3 align="center">ข้อมูลโครงการ<small></small></h3>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header" align="center">
            <small>สรุปข้อมูลโครงการทั้งหมด</small>
        </div>
    </div>
    <div class="box-body" style="margin-top: 0px;">
        <div class="table-responsive">
            <?php
                $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
                $SHOW = 10;
                $start = ($PAGE-1)*$SHOW;

                $condition = "";
                    if( $_SESSION["table"]=="tb_office" ) $condition = " AND tb_project.office_id = '".$_SESSION["data_id"]."' 
                ";
                $sql = "
                    SELECT
                        tb_project.id,
                        tb_project.title,
                        tb_project.price,
                        tb_project.consider,
                        tb_office.`name` As office_name,
                        tb_year.id As year_id,
                        tb_year.`name` As year_name
                    FROM
                        tb_project
                        INNER JOIN tb_office ON tb_project.office_id = tb_office.id
                        INNER JOIN tb_year ON tb_project.year_id = tb_year.id
                     WHERE (
                        tb_project.id LIKE '%$SERACHING%' OR
                        tb_project.title LIKE '%$SERACHING%' OR
                        tb_year.`name` LIKE '%$SERACHING%' OR
                        tb_office.`name` LIKE '%$SERACHING%' 
                    ) ".$condition."
                    ";
                $all = $DATABASE->QueryNumRow($sql);
                $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project.id DESC LIMIT $start,$SHOW ");
            ?>
            <br><table id="myTable" class="table table-hover" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                        <th width="110"  height="40" bgcolor="#D5D5D5">ชื่อโครงการ</th>
                        <?php if( $_SESSION["table"]=="tb_commit" ) { ?>
                            <th>สำนักงาน</th>
                        <?php } ?>
                        <th width="110"  height="40" bgcolor="#D5D5D5">วงเงิน</th>
                        <th width="110"  height="40" bgcolor="#D5D5D5"><center>สถานะโครงการ</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(sizeof($DATA)>0){
                        foreach($DATA as $key=>$row){
                            ?>
                            <tr>
                                <?php $row['id']; ?>
                                <td height="30"><center><?php echo $key+1; ?>-<?php echo $row['year_name']; ?></center></td>
                                <td height="30"><?php echo $row['title']; ?></td>
                                <?php if( $_SESSION["table"]=="tb_commit" ) { ?>
                                    <td><?php echo $row['office_name']; ?></td>
                                <?php } ?>
                                <td height="30"><center><?php echo number_format($row['price'], 3); ?></center></td>
                                <td height="30"><center><?php echo $row['consider']; ?></center></td>
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
</section>


