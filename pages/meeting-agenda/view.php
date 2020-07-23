<?php
    include("pages/meeting/meeting-date.php");
    spl_autoload_extensions('.php');
    spl_autoload_register();

    use classes\thai as thai;
?>
<?php     
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_meeting WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
    $data = $obj[0];
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
            <h3 class="box-title">แก้ไขระเบียบวาระการประชุม</h3>
        </div>
        <form  id="myForm" class="meeting-container" action="pages/meeting/action.php" method="post" enctype="multipart/form-data">
            <div class="box-body" style="margin-top: 0px;">
                <input type="hidden" name="content" value="meeting-add">
                <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                <div class="row" align="right">
                    <div class="btn-group" role="group" aria-label>
                        <a href="#view<?php echo $data['id'];?>" data-toggle="modal" title="แก้ไขข้อมมูล"><button type="button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> แก้ไขข้อมมูล</button></a>
                    </div>
                </div>
                <div class="row">
                    <div align="center">
                        <p>
                            <img src="files/img/yru_01.png" alt="" width="9%" height="10%" />
                            <img src="files/img/pts_01.png" alt="" width="8%" height="10%" />
                        </p>
                        <input class="w3-input w3-animate-input text-center" type="text" align="center" style="width:90%" title="ชื่อเรื่อง" placeholder="ชื่อเรื่อง" name="title" required value="<?php echo $data["title"];?>">
                        <input class="w3-input w3-animate-input text-center" type="text" align="center" style="width:90%" title="ชื่อเรื่องย่อย" placeholder="ชื่อเรื่องย่อย" name="title_small" required value="<?php echo $data["title_small"];?>">
                        <select id="meeting_qty_id" name="meeting_qty_id" class="w3-select selectpicker text-center" data-live-search="true" title="ครั้งที่" required value="<?php echo $data["meeting_qty_id"];?>">
                            <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_meeting_qty ORDER BY qty");
                                foreach($obj as $row) {
                                    $selected = "";
                                    if( $data["meeting_qty_id"]==$row["id"] ) $selected = "selected";
                                    echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["qty"].'</option>';
                                }
                            ?>
                        </select>
                        <p align="right">
                        <?php
                            include("pages/date.php");
                            $strDate = $data['date_start'];
                        ?></p>
                        <input class="w3-input w3-animate-input text-center" type="text" style="width:190px" title="วันที่" placeholder="วันที่" id="date_start" name="date_start" required value="วันที่ <?php echo DateThai($strDate);?>">
                        <div id="view<?php echo $data["id"];?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #780808; color: #fff;">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                        <input class="w3-input w3-animate-input text-center" type="text" align="center" style="width:90%" title="ชื่อเรื่อง" placeholder="ชื่อเรื่อง" name="title" required value="<?php echo $data["title"];?>">
                                        <input class="w3-input w3-animate-input text-center" type="text" align="center" style="width:90%" title="ชื่อเรื่องย่อย" placeholder="ชื่อเรื่องย่อย" name="title_small" required value="<?php echo $data["title_small"];?>">
                                        <select id="meeting_qty_id" name="meeting_qty_id" class="w3-select selectpicker text-center" data-live-search="true" title="ครั้งที่" required value="<?php echo $data["meeting_qty_id"];?>">
                                            <?php
                                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_meeting_qty ORDER BY qty");
                                                foreach($obj as $row) {
                                                    $selected = "";
                                                    if( $data["meeting_qty_id"]==$row["id"] ) $selected = "selected";
                                                    echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["qty"].'</option>';
                                                }
                                            ?>
                                        </select>
                                        <p align="right">
                                        <?php
                                            //include("pages/date.php");
                                            $strDate = $data['date_start'];
                                        ?></p>
                                        <input class="w3-input w3-animate-input text-center" type="date" title="วันที่" style="width:190px" placeholder="วันที่" id="date_start" name="date_start" required value="<?php echo DateThai($strDate);?>">
                                        <input class="w3-input w3-animate-input text-center" type="text" style="width:190px" title="วันที่" placeholder="วันที่" id="date_start" name="date_start" disabled value="วันที่ <?php echo DateThai($strDate);?>">
                                        <input class="w3-input w3-animate-input text-center" type="text" style="width:90%" title="ห้องประชุม" placeholder="ห้องประชุม" name="room" value="<?php echo $data["room"];?>"><br>
                                    </div>
                                    <div class="modal-footer" style="background-color: #780808; color: #fff;">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                        <a href="?content=meeting-agenda-edit-action&id=<?php echo $data['id'];?>" class="btn btn-warning" title="แก้ไขข้อมูล" ><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>
                                        <a href="?content=meeting-agenda-del-action&id=<?php echo $data['id'];?>" class="btn btn-danger" title="ลบข้อมูล"><i class="fa fa-trash"></i> ลบข้อมูล</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="w3-input w3-animate-input text-center" type="text" style="width:90%" title="ห้องประชุม" placeholder="ห้องประชุม" name="room" value="<?php echo $data["room"];?>"><br>
                        <div class="text-right">
                            <button type="button" class="btn btn-default" title="รีเฟรส" onclick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                            <button type="submit" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>   
                        </div>
                    </div>
                    <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2") {?>
                        <a href="?content=meeting-agenda-add" class="btn btn-success" title="เพิ่มข้อมูล"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <?php } ?>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=book'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
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
                                                <?php $data = 2; if($data == 1){?>
                                                    <td style="text-align: right;">
                                                        <i class="fa fa-calendar" title="ยังไม่เพิ่มข้อมูล" style="margin-right: 13px;"></i>
                                                    </td>
                                                <?php }else { ?>
                                                    <td style="text-align: right;">
                                                        <i class="fa fa-calendar" title="เรียบร้อยแล้ว" style="margin-right: 13px; color: #34df09;"></i>
                                                    </td> 
                                                <?php } ?>
                                                <td style="text-align: right;">
                                                    <a class="btn btn-info btn-sm" href="?content=meeting-description-resolution&id=<?php echo $row['id']; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a>
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
<?php
    } else {
        echo 'ไม่พบข้อมูล';
    }
?>