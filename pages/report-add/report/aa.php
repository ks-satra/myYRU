<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?> 
<section class="content-header">
    <h1><i class="fa fa-bar-chart-o"></i> รายงานต่างๆ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">รายงานต่างๆ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> รายงานต่างๆทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="report">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=report-add" class="btn btn-success" title="เพิ่มข้อมูล">
                    <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=report'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหารายงาน" value="<?php echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive">
                <?php
                $SHOW = 10;
                $start = ($PAGE-1)*$SHOW;
                    $sql = "
                        SELECT
                            tb_fileupload_report.id,
                            tb_fileupload_report.fileupload,
                            tb_fileupload_report.report_id,
                            tb_report.`name`,
                            tb_report.`year`
                        FROM
                            tb_fileupload_report
                            INNER JOIN tb_report ON tb_fileupload_report.report_id = tb_report.id 
                        WHERE 
                            tb_fileupload_report.id LIKE '%$SERACHING%' OR
                            tb_fileupload_report.fileupload LIKE '%$SERACHING%' OR
                            tb_report.`name` LIKE '%$SERACHING%' OR
                            tb_report.`year` LIKE '%$SERACHING%' 
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_fileupload_report.id LIMIT $start,$SHOW ");
                ?>

                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">ลำดับ</th>
                            <th>ชื่อเอกสาร</th>
                            <th>ประจำปี</th>
                            <th>เอกสารแนบ</th>
                            <th class="text-right">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $row){
                                ?>
                                <tr>
                                    <td class="text-left"><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['year']; ?></td>
                                    <td><a href="files/file_report/<?php echo $row['fileupload'];?>"><?php echo $row['fileupload'];?></a></td>
                                    <td class="text-right">
                                        <a class="btn btn-danger btn-sm" href="?content=report-del&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="ลบข้อมูล"><i class="fa fa-trash"></i> ลบข้อมูล</a>
                                    </td>
                                    <?php 
                                }
                        }else{
                                echo "<tr><td colspan='6' align='center'><i>ไม่พบข้อมูล</i></td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <div>จำนวนรายงานทั้งหมด <?php echo $all;?> ไฟล์</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=report&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=report&page='.($PAGE+1).$searhing.'"';

                    if($PAGE==1){
                        $disabled1 = "disabled";
                        $href1 = "";
                    }
                    if($PAGE*$SHOW>=$all){
                        $disabled2 = "disabled";
                        $href2 = "";
                    }
                ?>
                <nav>
                    <ul class="pager">
                        <li class="<?php echo $disabled1;?>"><a <?php echo $href1;?>>ก่อนหน้า</a></li>
                        <?php echo $PAGE;?>/<?php echo ceil($all/$SHOW);?>
                        <li class="<?php echo $disabled2;?>"><a <?php echo $href2;?>>ถัดไป</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
