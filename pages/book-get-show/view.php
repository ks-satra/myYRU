<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    include("pages/date.php");
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $school_id = $_GET["school_id"];
    $sql = "SELECT * FROM tb_teacher WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
?>
<section class="content-header">
    <h1><i class="glyphicon glyphicon-book"></i> รายละเอียดคนที่รับหนังสือ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">รายละเอียดคนที่รับหนังสือ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">แดสดงรายละเอียดคนที่รับหนังสือ</h3>
        </div>
        <!-- <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/book-get-show-edit-action/action.php" method="post"> -->
        <div class="box-body">
            
            <a href="?content=book-get-person&school_id=<?php echo $data['school_id']; ?>&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <a class="btn btn-warning btn" href="?content=teacher-edit&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>

                <?php 
                    $DEL_PERSON = $DATABASE->QueryString("SELECT teacher_id FROM tb_get_book WHERE teacher_id='".$data['id']."'");
                    if($DEL_PERSON != Null){
                  
                ?>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-trash"></i> ลบข้อมูล
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #780808; color: #fff;">
                                    <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <script type="text/javascript" src="//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
                                    <center><h4><i class="glyphicon glyphicon-trash"></i> กรุณาลบข้อมูลรายการหนังสือก่อน</h4></center>
                                </div>
                                <div class="modal-footer" style="background-color: #780808; color: #fff;">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                   } else {
                ?>
                    <a class="btn btn-danger btn" href="?content=teacher-del&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="ลบข้อมูล"><i class="fa fa-trash"></i> ลบข้อมูล</a>
                <?php    
                    }
                ?>
            <div class="btn-group" title="พิมพ์ข้อมูล">
                <button type="button" class="btn btn-danger" style="background-color: #ff65a5; border-color: #ff65a5;"><i class="fa fa-print"></i> พิมพ์ข้อมูล</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #ff65a5; border-color: #ff65a5;">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-header" style="color: #e50000;">ชุดที่ 1 นิทาน</li>
                    <li><a href="report/report-book-set-1/view.php?id=<?php echo $id;?>" target="_blank">ชุดนิทานคุณธรรมจากวรรณกรรมในฝักกริช</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header" style="color: #e50000;">ชุดที่ 2 Bookbank สมุดธนาคาร</li>
                    <li><a href="report/report-book-set-2/view.php?id=<?php echo $id;?>" target="_blank">ชุดสมุดธนาคารนิทานคุณธรรมจากวรรณกรรมในฝักกริช (Bookbank)</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header" style="color: #e50000;">ชุดที่ 3 แบบเริ่มเรียน</li>
                    <li><a href="report/report-book-set-3/view.php?id=<?php echo $id;?>" target="_blank">ชุดหนังสือแบบเริ่มเรียนมูลาบาฮาซา (ระดับชั้นประถมศึกษา)</a></li>
                    <li role="separator" class="divider"></li>                
                </ul>
            </div>
            <div class="panel-body" style="margin-top: 10px;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-user" aria-hidden="true"></i> ข้อมูลบุคลากร</h4>
                                <a class="btn btn-warning btn-sm" href="#view_user<?php echo $data['id'];?>" data-toggle="modal" title="แก้ไขข้อมูล" style="float: right;"><i class="fa fa-edit"></i></a>
                            </div>
                            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="?content=book-get-show-edit-action&id=<?php echo $data['id'];?>&school_id=<?php echo $data['school_id'];?>" method="post">
                                <div id="view_user<?php echo $data['id'];?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขข้อมูลบุคลากร</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                            <input type="text" name="card" id="card" class="form-control" placeholder="เลขบัตรประจำตัวประชาชน" aria-describedby="basic-addon1" data-inputmask="'mask': '9-9999-99999-99-9'" value="<?php echo $data["card"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <select id="prefix_id" name="prefix_id" class="form-control selectpicker" data-live-search="true" title="เลือกคำนำหน้า" style="width: 100%;" required>
                                                                <option value="">- เลือกคำนำหน้า -</option>
                                                                <?php
                                                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_prefix ORDER BY name");
                                                                foreach($obj as $row) {
                                                                    $selected = "";
                                                                    if( $data["prefix_id"]==$row["id"] ) $selected = "selected";
                                                                    echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" name="name_thai" id="name_thai" placeholder="ชื่อภาษาไทย" aria-describedby="basic-addon1" value="<?php echo $data["name_thai"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                            <input type="text" class="form-control" name="lname_thai" id="lname_thai" placeholder="นามสกุลภาษาไทย" aria-describedby="basic-addon1" value="<?php echo $data["lname_thai"];?>">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" name="name_eng" id="name_eng" placeholder="ชื่อภาษาอังกฤษ" aria-describedby="basic-addon1" value="<?php echo $data["name_eng"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                            <input type="text" class="form-control" name="lname_eng" id="lname_eng" placeholder="นามสกุลภาษาอังกฤษ" aria-describedby="basic-addon1" value="<?php echo $data["lname_eng"];?>">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label name="sex_id" id="sex_id">เพศ <red>*</red></label><br>
                                                        <?php
                                                        $obj = $DATABASE->QueryObj("SELECT * FROM tb_sex ORDER BY id");
                                                        foreach($obj as $row) {
                                                            $checked = "";
                                                            if( $row["id"]==$data["sex_id"] ) $checked = "checked";
                                                            echo '
                                                            <label style="padding-left: 30px;">
                                                            <input type="radio" name="sex_id" value="'.$row["id"].'" '.$checked.'>
                                                            '.$row["name"].'
                                                            </label>
                                                            ';
                                                        } 
                                                        ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="birthday">วันเกิด <red>*</red></label>
                                                        <input type="date" class="form-control" name="birthday" id="birthday" placeholder="วันเกิด" value="<?php echo $data['birthday'];?>" value="<?php echo $data["birthday"];?>" required>
                                                        <small><red>เช่น 01/01/2561 (ไม่ต้องใส่ทับ /)</red></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                <button type="submit" class="btn btn-warning" title="ยืนยันการแก้ไข"><i class="fa fa-edit"></i> ยืนยันการแก้ไข</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href="#" class="thumbnail" style="width: 150px; height: 150px; margin: 0px;">
                                                <img id="img_" style="width: 100%;height: 100%;" src="files/img_teacher/<?php echo $data['photo']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)"> 
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $data['card']; ?></p>
                                        <p><?php
                                        $PREFIX_NAME = $DATABASE->QueryString("SELECT name FROM tb_prefix WHERE id='".$data['prefix_id']."'");
                                        echo $PREFIX_NAME;
                                        ?><?php echo $data['name_thai']; ?> <?php echo $data['lname_thai']; ?>
                                    </p>
                                    <p><?php
                                        $PREFIX_NAME_ENG = $DATABASE->QueryString("SELECT abbreviation FROM tb_prefix WHERE id='".$data['prefix_id']."'");
                                        ?><?php echo $PREFIX_NAME_ENG; ?><?php echo $data['name_eng']; ?> <?php echo $data['lname_eng']; ?>
                                    </p>
                                    <p>เพศ <?php 
                                        $SEX_NAME = $DATABASE->QueryString("SELECT name FROM tb_sex WHERE id='".$data['sex_id']."'");
                                            echo $SEX_NAME;?></p>
                                    <p>วันเกิด : <?php
                                        $all = $DATABASE->QueryNumRow($sql);
                                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_teacher.id");
                                        if(sizeof($DATA)>0){
                                            foreach($DATA as $row){
                                                $strDate = $row['birthday'];
                                                echo DateThai($strDate);
                                            }
                                        }
                                    ?></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-phone" aria-hidden="true"></i> การติดต่อ</h4>
                                <div class="btn-group" role="group" aria-label style="float: right;">
                                    <a href="#view_address<?php echo $data['id'];?>" data-toggle="modal"><button type="button" class="btn btn-warning btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></button></a>
                                </div>
                            </div>
                            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="?content=book-get-show-edit-action-address&id=<?php echo $data['id'];?>&school_id=<?php echo $data['school_id'];?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
                                <input type="hidden" name="school_id" value="<?php echo $data["school_id"]; ?>">
                                <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                                <div id="view_address<?php echo $data["id"];?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-trash"></i> แก้ไขข้อมูลการติดต่อ</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                                            <input type="text" class="form-control" name="tel" id="tel" placeholder="มือถือ" aria-describedby="basic-addon1" data-inputmask="'mask': '999-9999999'" value="<?php echo $data["tel"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="อีเมล" aria-describedby="basic-addon1" value="<?php echo $data["email"];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-comment"></i></span>
                                                            <input type="text" class="form-control" name="idline" id="idline" placeholder="ไอดีไลน์" aria-describedby="basic-addon1" value="<?php echo $data["idline"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        
                                                    </div>
                                                </div><br>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                <button type="submit" class="btn btn-warning" title="ยืนยันการแก้ไข"><i class="fa fa-edit"></i> ยืนยันการแก้ไข</button> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#"><i class="fa fa-phone" aria-hidden="true" style="color: #bc1616;"></i> <b>มือถือ :</b> <?php echo $data['tel']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true" style="color: #0f6c09;"></i> <b>อีเมล :</b> <?php echo $data['email']; ?></a></li>
                                                <li><a href="#"><img src="files/img/line.png" style="width: 5%; height: 5%;"><b>ไลน์ :</b>  <?php echo $data['idline']; ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-home" aria-hidden="true"></i> ที่อยู่ตามสำเนา</h4>
                                <a class="btn btn-warning btn-sm" href="#view_contact<?php echo $data['id'];?>" data-toggle="modal" title="แก้ไขข้อมูล" style="float: right;"><i class="fa fa-edit"></i></a>
                            </div>
                            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="?content=book-get-show-edit-action-contact&id=<?php echo $data['id'];?>&school_id=<?php echo $data['school_id'];?>" method="post">
                                <div id="view_contact<?php echo $data['id'];?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขข้อมูลประวัติโดยย่อ</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                            <input type="text" name="no" id="no" class="form-control" placeholder="เลขที่" aria-describedby="basic-addon1" value="<?php echo $data["no"];?>">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                            <input type="text" name="mu" id="mu" class="form-control" placeholder="หมู่ที่" aria-describedby="basic-addon1" value="<?php echo $data["mu"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                            <input type="text" name="village" id="village" class="form-control" placeholder="หมู่บ้าน" aria-describedby="basic-addon1" value="<?php echo $data["village"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                            <input type="text" name="alley" id="alley" class="form-control" placeholder="ตรอก" aria-describedby="basic-addon1" value="<?php echo $data["alley"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                            <input type="text" name="byway" id="byway" class="form-control" placeholder="ซอย" aria-describedby="basic-addon1" value="<?php echo $data["byway"];?>">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select id="province_id_" name="province_id_" class="form-control selectpicker" data-live-search="true" title="เลือกจังหวัด" style="width: 100%;" required>
                                                            <option value="">- เลือกจังหวัด -</option>
                                                            <?php
                                                            $obj = $DATABASE->QueryObj("SELECT * FROM tb_province ORDER BY name");
                                                            foreach($obj as $row) {
                                                                $selected = "";
                                                                if( $data["province_id"]==$row["id"] ) $selected = "selected";
                                                                echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="amphur_id_" required>
                                                            <option value="">- เลือกอำเภอ -</option>
                                                            <?php
                                                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_amphur WHERE province_id='".$data["province_id"]."' ORDER BY name");
                                                                foreach($obj as $row) {
                                                                    $selected = "";
                                                                    if( $data["amphur_id"]==$row["id"] ) $selected = "selected";
                                                                    echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>  
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="district_id_" required>
                                                            <option value="">- เลือกตำบล -</option>
                                                            <?php
                                                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_district WHERE province_id='".$data["province_id"]."' AND amphur_id='".$data["amphur_id"]."' ORDER BY name");
                                                                foreach($obj as $row) {
                                                                    $selected = "";
                                                                    if( $data["district_id"]==$row["id"] ) $selected = "selected";
                                                                    echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>                                                      
                                                </div><br>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="passcode_" placeholder="รหัสไปรษณีย์" data-inputmask="'mask': '99999'" value="<?php echo $data['passcode'];?>" readonly>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                <button type="submit" class="btn btn-warning" title="ยืนยันการแก้ไข"><i class="fa fa-edit"></i> ยืนยันการแก้ไข</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><i class="fa fa-home" aria-hidden="true"></i> <b>ที่อยู่ :</b> <?php echo $data['no']; ?> <b>หมู่ที่ :</b> <?php echo $data['mu']; ?> <b>หมู่บ้าน :</b> <?php echo $data['village']; ?> </p>
                                        <p><b>ตรอก / ซอย :</b> 
                                            <?php 
                                                echo $data['alley']; 
                                            ?> / <?php echo $data['byway']; ?> <b>ตำบล : </b>  
                                            <?php 
                                                $DISTRICT_NAME = $DATABASE->QueryString("SELECT name FROM tb_district WHERE id='".$data['district_id']."'");
                                                echo $DISTRICT_NAME; 
                                            ?> <b>อำเภอ : </b>  
                                            <?php 
                                                $AMPHUR_NAME = $DATABASE->QueryString("SELECT name FROM tb_amphur WHERE id='".$data['amphur_id']."'");
                                                echo $AMPHUR_NAME; 
                                            ?> <b>จังหวัด : </b>  
                                            <?php 
                                                $PROVINCE_NAME = $DATABASE->QueryString("SELECT name FROM tb_province WHERE id='".$data['province_id']."'");
                                                echo $PROVINCE_NAME; 
                                            ?> <?php echo $data['passcode'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-history" aria-hidden="true"></i> ประวัติโดยย่อ</h4>
                                <a class="btn btn-warning btn-sm" href="#view_history<?php echo $data['id'];?>" data-toggle="modal" title="แก้ไขข้อมูล" style="float: right;"><i class="fa fa-edit"></i></a>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#"><i class="fa fa-circle-o text-black" aria-hidden="true"></i> <b>จบจากสถาบัน : </b> <?php echo $data['alumni']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-circle-o text-red" aria-hidden="true"></i> <b>จากปี : </b> <?php echo $data['buddhist_era_start']; ?> <b>ถึงปี : </b> <?php echo $data['buddhist_era_end']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-circle-o text-green" aria-hidden="true"></i> <b>คณะ : </b> <?php echo $data['faculty']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-circle-o text-orange" aria-hidden="true"></i> <b>สาขา : </b> <?php echo $data['branch']; ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="?content=book-get-show-edit-action-history&id=<?php echo $data['id'];?>&school_id=<?php echo $data['school_id'];?>" method="post">
                                <div id="view_history<?php echo $data['id'];?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขข้อมูลประวัติโดยย่อ</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                                            <input type="text" name="alumni" id="alumni" class="form-control" placeholder="จบจากสถาบัน" aria-describedby="basic-addon1" value="<?php echo $data["alumni"];?>">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            <input type="text" name="buddhist_era_start" id="buddhist_era_start" class="form-control" placeholder="จากปี" aria-describedby="basic-addon1" value="<?php echo $data["buddhist_era_start"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                                            <input type="text" name="buddhist_era_end" id="buddhist_era_end" class="form-control" placeholder="ถึงปี" aria-describedby="basic-addon1" value="<?php echo $data["buddhist_era_end"];?>">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                                            <input type="text" name="faculty" id="faculty" class="form-control" placeholder="คณะ" aria-describedby="basic-addon1" value="<?php echo $data["faculty"];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                                            <input type="text" name="branch" id="branch" class="form-control" placeholder="สาขา" aria-describedby="basic-addon1" value="<?php echo $data["branch"];?>">
                                                        </div>
                                                    </div>
                                                </div><br>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                <button type="submit" class="btn btn-warning" title="ยืนยันการแก้ไข"><i class="fa fa-edit"></i> ยืนยันการแก้ไข</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-history" aria-hidden="true"></i> ประวัติการสอน</h4>
                                <a class="btn btn-warning btn-sm" href="#view_teach<?php echo $data['id'];?>" data-toggle="modal" title="แก้ไขข้อมูล" style="float: right;"><i class="fa fa-edit"></i></a>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#"><i class="fa fa-circle-o text-black" aria-hidden="true"></i>  <b>สอนระดับชั้น :</b> <?php echo $data['level']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-circle-o text-red" aria-hidden="true"></i> <b>กลุ่มสาระวิชา :</b> <?php echo $data['topics']; ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="?content=book-get-show-edit-action-teach&id=<?php echo $data['id'];?>&school_id=<?php echo $data['school_id'];?>" method="post">
                                <div id="view_teach<?php echo $data['id'];?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขข้อมูลประวัติการสอน</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <?php
                                                        $arr = explode(",", $data['level']);
                                                        $check_list = array(
                                                            "อนุบาล 1"=>"",
                                                            "อนุบาล 2"=>"",
                                                            "อนุบาล 3"=>"",
                                                            "ประถมศึกษาชั้นปีที่ 1"=>"",
                                                            "ประถมศึกษาชั้นปีที่ 2"=>"",
                                                            "ประถมศึกษาชั้นปีที่ 3"=>"",
                                                            "ประถมศึกษาชั้นปีที่ 4"=>"",
                                                            "ประถมศึกษาชั้นปีที่ 5"=>"",
                                                            "ประถมศึกษาชั้นปีที่ 6"=>"",
                                                            "มัธยมศึกษาปีที่ 1"=>"",
                                                            "มัธยมศึกษาปีที่ 2"=>"",
                                                            "มัธยมศึกษาปีที่ 3"=>"",
                                                            "มัธยมศึกษาปีที่ 4"=>"",
                                                            "มัธยมศึกษาปีที่ 5"=>"",
                                                            "มัธยมศึกษาปีที่ 6"=>"",
                                                        );
                                                        foreach ($arr as $key => $value) {
                                                           if( $value=="" ) continue;
                                                           $check_list[$value] = "checked";
                                                        }
                                                    ?>
                                                
                                                    <div class="form-group col-md-6">
                                                        <label for="chkDel[]" class="control-label">สอนระดับชั้น <red>*</red></label><br>
                                                        <input type="checkbox" name="techno[]" value="อนุบาล 1" <?php echo $check_list["อนุบาล 1"]; ?>>อนุบาล 1 <br>
                                                        <input type="checkbox" name="techno[]" value="อนุบาล 2" <?php echo $check_list["อนุบาล 2"]; ?>>อนุบาล 2 <br>
                                                        <input type="checkbox" name="techno[]" value="อนุบาล 3" <?php echo $check_list["อนุบาล 3"]; ?>>อนุบาล 3 <br>
                                                        <input type="checkbox" name="techno[]" value="ประถมศึกษาชั้นปีที่ 1" <?php echo $check_list["ประถมศึกษาชั้นปีที่ 1"]; ?>>ประถมศึกษาชั้นปีที่ 1 <br>
                                                        <input type="checkbox" name="techno[]" value="ประถมศึกษาชั้นปีที่ 2" <?php echo $check_list["ประถมศึกษาชั้นปีที่ 2"]; ?>>ประถมศึกษาชั้นปีที่ 2 <br>
                                                        <input type="checkbox" name="techno[]" value="ประถมศึกษาชั้นปีที่ 3" <?php echo $check_list["ประถมศึกษาชั้นปีที่ 3"]; ?>>ประถมศึกษาชั้นปีที่ 3 <br>
                                                        <input type="checkbox" name="techno[]" value="ประถมศึกษาชั้นปีที่ 4" <?php echo $check_list["ประถมศึกษาชั้นปีที่ 4"]; ?>>ประถมศึกษาชั้นปีที่ 4 <br>
                                                        <input type="checkbox" name="techno[]" value="ประถมศึกษาชั้นปีที่ 5" <?php echo $check_list["ประถมศึกษาชั้นปีที่ 5"]; ?>>ประถมศึกษาชั้นปีที่ 5 <br>
                                                        <input type="checkbox" name="techno[]" value="ประถมศึกษาชั้นปีที่ 6" <?php echo $check_list["ประถมศึกษาชั้นปีที่ 6"]; ?>>ประถมศึกษาชั้นปีที่ 6 <br>
                                                        <input type="checkbox" name="techno[]" value="มัธยมศึกษาปีที่ 1" <?php echo $check_list["มัธยมศึกษาปีที่ 1"]; ?>>มัธยมศึกษาปีที่ 1 <br>
                                                        <input type="checkbox" name="techno[]" value="มัธยมศึกษาปีที่ 2" <?php echo $check_list["มัธยมศึกษาปีที่ 2"]; ?>>มัธยมศึกษาปีที่ 2 <br>
                                                        <input type="checkbox" name="techno[]" value="มัธยมศึกษาปีที่ 3" <?php echo $check_list["มัธยมศึกษาปีที่ 3"]; ?>>มัธยมศึกษาปีที่ 3 <br>
                                                        <input type="checkbox" name="techno[]" value="มัธยมศึกษาปีที่ 4" <?php echo $check_list["มัธยมศึกษาปีที่ 4"]; ?>>มัธยมศึกษาปีที่ 4 <br>
                                                        <input type="checkbox" name="techno[]" value="มัธยมศึกษาปีที่ 5" <?php echo $check_list["มัธยมศึกษาปีที่ 5"]; ?>>มัธยมศึกษาปีที่ 5 <br>
                                                        <input type="checkbox" name="techno[]" value="มัธยมศึกษาปีที่ 6" <?php echo $check_list["มัธยมศึกษาปีที่ 6"]; ?>>มัธยมศึกษาปีที่ 6 <br>
                                                    </div>
                                                    <?php
                                                        $arr = explode(",", $data['topics']);
                                                        $check_list = array(
                                                            "กลุ่มสาระการเรียนรู้ภาษาไทย"=>"",
                                                            "กลุ่มสาระการเรียนรู้คณิตศาสตร์"=>"",
                                                            "กลุ่มสาระการเรียนรู้วิทยาศาสตร์"=>"",
                                                            "กลุ่มสาระการเรียนรู้สังคมศึกษาและศาสนาและวัฒนธรรม"=>"",
                                                            "กลุ่มสาระการเรียนรู้สุขศึกษาและพลศึกษา"=>"",
                                                            "กลุ่มสาระการเรียนรู้ศิลปะ"=>"",
                                                            "กลุ่มสาระการเรียนรู้การงานอาชีพและเทคโนโลยี"=>"",
                                                            "กลุ่มสาระการเรียนรู้ภาษาต่างประเทศ"=>"",
                                                        );
                                                        foreach ($arr as $key => $value) {
                                                           if( $value=="" ) continue;
                                                           $check_list[$value] = "checked";
                                                        }
                                                    ?>
                                                    <div class="form-group col-md-6">
                                                        <label for="chkTopics[]" class="control-label">สอนระดับชั้น <red>*</red></label><br>
                                                        <input type="checkbox" name="topics[]" value="กลุ่มสาระการเรียนรู้ภาษาไทย" <?php echo $check_list["กลุ่มสาระการเรียนรู้ภาษาไทย"]; ?>>กลุ่มสาระการเรียนรู้ภาษาไทย <br>
                                                        <input type="checkbox" name="topics[]" value="กลุ่มสาระการเรียนรู้คณิตศาสตร์" <?php echo $check_list["กลุ่มสาระการเรียนรู้คณิตศาสตร์"]; ?>>กลุ่มสาระการเรียนรู้คณิตศาสตร์ <br>
                                                        <input type="checkbox" name="topics[]" value="กลุ่มสาระการเรียนรู้วิทยาศาสตร์" <?php echo $check_list["กลุ่มสาระการเรียนรู้วิทยาศาสตร์"]; ?>>กลุ่มสาระการเรียนรู้วิทยาศาสตร์ <br>
                                                        <input type="checkbox" name="topics[]" value="กลุ่มสาระการเรียนรู้สังคมศึกษาและศาสนาและวัฒนธรรม" <?php echo $check_list["กลุ่มสาระการเรียนรู้สังคมศึกษาและศาสนาและวัฒนธรรม"]; ?>>กลุ่มสาระการเรียนรู้สังคมศึกษาและศาสนาและวัฒนธรรม <br>
                                                        <input type="checkbox" name="topics[]" value="กลุ่มสาระการเรียนรู้สุขศึกษาและพลศึกษา" <?php echo $check_list["กลุ่มสาระการเรียนรู้สุขศึกษาและพลศึกษา"]; ?>>กลุ่มสาระการเรียนรู้สุขศึกษาและพลศึกษา <br>
                                                        <input type="checkbox" name="topics[]" value="กลุ่มสาระการเรียนรู้ศิลปะ" <?php echo $check_list["กลุ่มสาระการเรียนรู้ศิลปะ"]; ?>>กลุ่มสาระการเรียนรู้ศิลปะ <br>
                                                        <input type="checkbox" name="topics[]" value="กลุ่มสาระการเรียนรู้การงานอาชีพและเทคโนโลยี" <?php echo $check_list["กลุ่มสาระการเรียนรู้การงานอาชีพและเทคโนโลยี"]; ?>>กลุ่มสาระการเรียนรู้การงานอาชีพและเทคโนโลยี <br>
                                                        <input type="checkbox" name="topics[]" value="กลุ่มสาระการเรียนรู้ภาษาต่างประเทศ" <?php echo $check_list["กลุ่มสาระการเรียนรู้ภาษาต่างประเทศ"]; ?>>กลุ่มสาระการเรียนรู้ภาษาต่างประเทศ <br>
                                                    </div>
                                                </div><br>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                <button type="submit" class="btn btn-warning" title="ยืนยันการแก้ไข"><i class="fa fa-edit"></i> ยืนยันการแก้ไข</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-building" aria-hidden="true"></i> โรงเรียน</h4>
                                <a class="btn btn-warning btn-sm" href="#view_school<?php echo $data['id'];?>" data-toggle="modal" title="แก้ไขข้อมูล" style="float: right;"><i class="fa fa-edit"></i></a>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <?php
                                                    $sql = "
                                                        SELECT
                                                            tb_school.id,
                                                            tb_school.`code`,
                                                            tb_school.`name`,
                                                            tb_school.`no`,
                                                            tb_school.mu,
                                                            tb_school.road,
                                                            tb_school.alley,
                                                            tb_school.village,
                                                            tb_school.district_id,
                                                            tb_school.amphur_id,
                                                            tb_school.province_id,
                                                            tb_school.passcode,
                                                            tb_school.lat,
                                                            tb_school.lng,
                                                            tb_school.department_id,
                                                            tb_school.area_id,
                                                            tb_school.email,
                                                            tb_school.website,
                                                            tb_school.tel,
                                                            tb_school.start_end_school,
                                                            tb_school.prefix_name,
                                                            tb_school.boss_name,
                                                            tb_school.boss_lname,
                                                            tb_school.position,
                                                            tb_district.`name` as school_district_name,
                                                            tb_amphur.`name` as school_amphur_name,
                                                            tb_amphur.passcode,
                                                            tb_province.`name` As school_province_name
                                                        FROM
                                                            tb_school
                                                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                                                        WHERE tb_school.id = '".$data['school_id']."'";
                                                    $all = $DATABASE->QueryNumRow($sql);
                                                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_school.id");
                                                    if(sizeof($DATA)>0){
                                                        foreach($DATA as $row){
                                                ?>
                                                <li>
                                                    <a href="#"><i class="fa fa-building" aria-hidden="true"></i> <b>ชื่อโรงเรียน : </b> 
                                                        <?php echo $row['name'];?>
                                                    </a>
                                                </li>
                                                 <li>
                                                    <a href="#"><i class="fa fa-circle-o text-black"></i> <b>รหัสโรงเรียน : </b> 
                                                        <?php echo $row['code'];?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fa fa-circle-o text-green"></i> <b>ที่อยู่ :</b> <?php echo $row['no']; ?> <b>หมู่ที่ : </b> <?php echo $row['mu']; ?> <?php echo $row['village']; ?> <b>ตรอก / ซอย : </b>  <?php echo $row['alley']; ?> / <?php echo $row['road']; ?> <b>ตำบล : </b> <?php echo $row['school_district_name']; ?> <b>อำเภอ : </b>  <?php echo $row['school_amphur_name']; ?> <b>จังหวัด : </b>  <?php echo $row['school_province_name']; ?>
                                                    </a>
                                                </li>
                                                <?php 
                                                        }
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="?content=book-get-show-edit-action-school&id=<?php echo $data['id'];?>&school_id=<?php echo $data['school_id'];?>" method="post">
                                <div id="view_school<?php echo $data['id'];?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขข้อมูลโรงเรียน</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="school_id">โรงเรียน <red>*</red></label>
                                                    <select id="school_id" name="school_id" class="form-control selectpicker" data-live-search="true" title="เลือกโรงเรียน" style="width: 100%;" required>
                                                        <option value="">- เลือกโรงเรียน -</option>
                                                        <?php
                                                            $obj = $DATABASE->QueryObj("
                                                                SELECT
                                                                tb_school.id,
                                                                tb_school.`name`,
                                                                tb_amphur.`name` As amphur_name,
                                                                tb_district.`name` As district_name,
                                                                tb_province.`name` As province_name
                                                                FROM
                                                                tb_school
                                                                INNER JOIN tb_amphur ON tb_amphur.id = tb_school.amphur_id
                                                                INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                                                INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                                                                ORDER BY name");
                                                            foreach($obj as $row) {
                                                                $selected = "";
                                                                if( $data["school_id"]==$row["id"] ) $selected = "selected";
                                                                echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].' (ต. '.$row["district_name"].' อ. '.$row["amphur_name"].' จ. '.$row["province_name"].')</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    <br><small><red>เช่น บ้านยะลา</red></small>
                                                </div><br>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ff9120; color: #fff;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                <button type="submit" class="btn btn-warning" title="ยืนยันการแก้ไข"><i class="fa fa-edit"></i> ยืนยันการแก้ไข</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid" style="background-color: #dbd6d6;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-book" aria-hidden="true"></i> ชื่อหนังสือ 
                                </h4>
                                <?php $type_book_id = $DATABASE->QueryString("SELECT type_book_id FROM tb_get_book WHERE teacher_id = '".$data['id']."'"); ?>
                                <?php $book_id = $DATABASE->QueryString("SELECT book_id FROM tb_get_book WHERE teacher_id = '".$data['id']."'"); ?>
                                <a class="btn btn-warning btn-sm" href="?content=book-distribute-edit&id=<?php echo $data['id']; ?>&school_id=<?php echo $data['school_id']; ?>&page=<?php echo $PAGE; ?>" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i></a>
                                <div class="box-tools text-right">
                                    <p><?php 
                                        $COUNT_BOOK = $DATABASE->QueryString("SELECT COUNT(DISTINCT (book_id)) FROM tb_get_book WHERE teacher_id = '".$data['id']."'");
                                        $COUNT_QTY = $DATABASE->QueryString("SELECT SUM(QTY) FROM tb_get_book WHERE teacher_id = '".$data['id']."'");
                                        echo $COUNT_BOOK;
                                    ?> เรื่อง <?php echo $COUNT_QTY;?> เล่ม</p>
                                </div>
                            </div>
                            <?php
                                $sql = "
                                    SELECT
                                        tb_get_book.id,
                                        tb_get_book.type_book_id,
                                        tb_get_book.book_id,
                                        tb_get_book.qty,
                                        tb_get_book.teacher_id,
                                        tb_get_book.school_id,
                                        tb_get_book.note,
                                        tb_get_book.date_start,
                                        tb_book.name_thai as BOOK_THAI,
                                        SUM(tb_get_book.qty) as BOOK_QTY
                                    FROM
                                        tb_get_book
                                        INNER JOIN tb_book ON tb_get_book.book_id = tb_book.id
                                    WHERE tb_get_book.teacher_id = '".$data['id']."'
                                    GROUP BY tb_get_book.book_id
                                    ";
                                $all = $DATABASE->QueryNumRow($sql);
                                $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_get_book.id DESC");
                                if(sizeof($DATA)>0){ 
                                    foreach($DATA as $key => $row){
                            ?>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked"> 
                                    <?php if($row['type_book_id'] == 1){
                                    ?>
                                    <li><a href="#" style="color: #00a65a;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                    <span class="label label-success pull-right" style="background-color: #00a65a;"><?php echo $row['BOOK_QTY'];?></span></a></li>
                                    <?php } else if ($row['type_book_id'] == 2){
                                    ?>
                                    <li><a href="#" style="color: #ff00f7;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                    <span class="label label-success pull-right" style="background-color: #ff00f7;"><?php echo $row['BOOK_QTY'];?></span></a></li>
                                    <?php } else { ?>
                                    <li><a href="#" style="color: #0400ff;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                    <span class="label label-success pull-right" style="background-color: #0400ff;"><?php echo $row['BOOK_QTY'];?></span></a></li>
                                    <?php } ?> 
                                </ul>
                            </div>
                            <?php 
                                }
                            }else{
                                echo '<br>';
                                echo "<div colspan='6' align='center'><i>ไม่มีข้อมูล</i></div>";
                                echo '<br>';
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    } else {
        echo 'No data.';
    }
?>