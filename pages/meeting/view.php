<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
<section class="content-header">
    <h1><i class="fa fa-calendar-o" aria-hidden="true"></i> ข้อมูลการประชุม<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลการประชุม</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลการประชุมทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="meeting">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=meeting-add" class="btn btn-success" title="เพิ่มข้อมูล">
                    <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=meeting'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูล" value="<?php echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive">
                <?php
                    $SHOW = 30;
                    $start = ($PAGE-1)*$SHOW;
                    $sql = "
                        SELECT
                            tb_meeting.id,
                            tb_meeting.title,
                            tb_meeting.title_small,
                            tb_meeting.meeting_qty_id,
                            tb_meeting.date_start,
                            tb_meeting.room,
                            tb_meeting_qty.qty As name_qty
                        FROM
                           tb_meeting
                           INNER JOIN tb_meeting_qty ON tb_meeting.meeting_qty_id = tb_meeting_qty.id
                        WHERE 
                            tb_meeting.id LIKE '%$SERACHING%' OR
                            tb_meeting.title LIKE '%$SERACHING%' OR
                            CONCAT( tb_meeting.title, ' ' , tb_meeting_qty.qty) LIKE '%$SERACHING%'
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_meeting.id DESC LIMIT $start,$SHOW ");
                ?>

                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr style="background-color: #780808; color: #fff;">
                            <th class="text-left">ลำดับ</th>
                            <th width="100%">รายการ</th>
                            <th class="text-right" style="padding-right: 19px;">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <tr>
                                    <td class="text-left" style="padding-left: 20px"><?php echo $key+1; ?></td>
                                    <td><?php echo $row['title']; ?> <?php echo $row['name_qty']; ?></td>
                                    <td class="text-right">
                                        <a class="btn btn-info btn-sm" href="?content=meeting-agenda&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a>
                                    </td>
                                    <?php 
                                }
                        }else{
                                echo "<tr><td colspan='3' align='center'><i>ไม่พบข้อมูล</i></td></tr>";
                                
                        }
                    ?>
                    </tbody>
                </table>
                <div style="text-align: right;">จำนวนข้อมูลบุคลากรทั้งหมด <?php echo $all;?> คน</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=meeting&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=meeting&page='.($PAGE+1).$searhing.'"';

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
