<?php 
    include("pages/meeting-description-add/meeting-date.php");
    spl_autoload_extensions('.php');
    spl_autoload_register();

    use classes\thai as thai;
?>
<link href="pages/meeting-description-add/meeting.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1><i class="fa fa-file"></i> ระเบียบวาระการประชุม<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ระเบียบวาระการประชุม</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มระเบียบวาระการประชุม</h3>
        </div>
        <form  id="myForm" class="meeting-container" action="pages/meeting-add/action.php" method="post" enctype="multipart/form-data">
            <div class="box-body" style="margin-top: 0px;">
                <input type="hidden" name="content" value="meeting-add">
                <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                <div class="row">
                    <div align="center">
                        <p>
                            <img src="files/img/yru_01.png" alt="" width="9%" height="10%" />
                            <img src="files/img/pts_01.png" alt="" width="8%" height="10%" />
                        </p>
                        <input class="w3-input w3-animate-input text-center" type="text" align="center" style="width:90%" title="ชื่อเรื่อง" placeholder="ชื่อเรื่อง" name="title" required>
                        <input class="w3-input w3-animate-input text-center" type="text" align="center" style="width:90%" title="ชื่อเรื่องย่อย" placeholder="ชื่อเรื่องย่อย" name="title_small" required>
                        <select id="meeting_qty_id" name="meeting_qty_id" class="w3-select selectpicker text-center" data-live-search="true" title="ครั้งที่" required>
                            <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_meeting_qty ORDER BY qty");
                                foreach($obj as $row) {
                                    $selected = "";
                                    echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["qty"].'</option>';
                                }
                            ?>
                        </select>
                        <?php
                            $mydate = new DateTime();
                                //echo thai::date_format($mydate, 'วันlที่ d F พ.ศ. Y H:i:s');
                        ?>
                        <input class="w3-input w3-animate-input text-center" type="date" style="width:160px" title="วันที่" placeholder="วันที่" id="date_start" name="date_start" required>
                        <input class="w3-input w3-animate-input text-center" type="text" style="width:90%" title="ห้องประชุม" placeholder="ห้องประชุม" name="room"><br>
                        <div class="text-right">
                            <button type="button" class="btn btn-default" title="รีเฟรส" onclick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                            <button type="submit" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>   
                        </div>
                    </div>
                    <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2") {?>
                        <a href="?content=meeting" class="btn btn-success disabled" title="เพิ่มข้อมูล"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <?php } ?>
                    <button type="button" class="btn btn-default disabled" onClick="location.href='?content=meeting'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <div class="table-responsive" style="margin-top: 30px;">
                        <?php
                            $sql = "                
                                SELECT
                                    *
                                FROM
                                    tb_meeting_agenda
                            ";
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_meeting_agenda.id");
                        ?>
                        <table id="myTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-left">วาระที่</th>
                                    <th width="76%">หัวข้อ</th>
                                    <th style="text-align: right;">สถานะ</th>
                                    <th style="text-align: right; padding-right: 19px;">จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(sizeof($DATA)>0){ 
                                        foreach($DATA as $key => $row){
                                            ?>
                                            <tr>
                                                <td class="text-left"><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['description']; ?></span></td>
                                                <?php $data = 1; if($data == 1){?>
                                                    <td style="text-align: right;">
                                                        <i class="fa fa-calendar" title="ยังไม่เพิ่มข้อมูล" style="margin-right: 13px;"></i>
                                                    </td>
                                                <?php }else { ?>
                                                    <td style="text-align: right;">
                                                        <i class="fa fa-calendar" title="เรียบร้อยแล้ว" style="margin-right: 13px; color: #34df09;"></i>
                                                    </td> 
                                                <?php } ?>
                                                <td style="text-align: right;">
                                                    <a class="btn btn-info btn-sm disabled" href="?content=meeting-description-resolution&id=<?php echo $row['id']; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a>
                                                </td>            
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
        </form>
    </div>
</section>