<?php 
    include("../../php/autoload.php");
    include("../pdf-property/mpdf/mpdf.php");
    include("../pdf-property/datepdf/view.php");
    ob_start();
?>
<script src="view.js"></script>
<section class="content">
    <div class="box box-danger">
        <div class="box-body">      
            วันที่พิมพ์ : <?=thai_date_and_time_short(time())?>
            <div class="container">
                <div class="row">
                    <?php
                        $strKeyword=$_GET["strKeyword"];
                        $sql = "
                            SELECT
                                tb_project.id,
                                tb_project.title,
                                tb_project.price,
                                tb_office.`name` As office_name,
                                tb_year.`name` As year_name
                            FROM 
                                tb_project
                                INNER JOIN tb_office ON tb_project.office_id = tb_office.id
                                INNER JOIN tb_year ON tb_project.year_id = tb_year.id
                        ";
                        $all = $DATABASE->QueryNumRow($sql);
                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project.id DESC");
                    ?>
                    <br><br>
                    <div align="center">
                        <b><font face="Kanit Light" font size="5">รายงานข้อมูลโครงการที่พิจารณา <br><br></b><a>แบบรายงานสรุปโครงการที่พิจารณาทั้งหมด</a>
                        <br>
                    </div>
                    <br>
                    <table id="myTable" class="table table-hover style3" bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="110"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                <th width="110"  height="40" bgcolor="#D5D5D5">&nbsp; &nbsp; ชื่อโครงการ</th>
                                <th width="110"  height="40" bgcolor="#D5D5D5">สำนักงาน</th>
                                <th width="110"  height="40" bgcolor="#D5D5D5">&nbsp; &nbsp; วงเงิน</th>
                                <th width="110"  height="40" bgcolor="#D5D5D5"><center>สถานะโครงการ</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(sizeof($DATA)>0){
                                foreach($DATA as $row){
                                    ?>
                                    <tr>
                                        <td height="30"><center><?php echo $row['id']; ?>-<?php echo $row['year_name']; ?></center></td>
                                        <td height="30"><center><?php echo $row['title']; ?></center></td>
                                        <td height="30">&nbsp;<?php echo $row['office_name']; ?></td>
                                        <td height="30"><center>&nbsp;<?php echo $row['price']; ?></center></td>
                                        <td height="30"><center>&nbsp; 
                                            เหมาะสม
                                        </center></td>              
                                    </tr>
                                    <?php 
                                }
                            }else{
                                echo "<tr><td colspan='6' align='center'><i>No data</i></td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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