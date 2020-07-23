<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_teacher WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
        $prefix_name = $DATABASE->QueryString("SELECT name FROM tb_prefix WHERE id='".$data['prefix_id']."'");
?>
<script src="pages/teacher-edit/view.js"></script>
<section class="content-header">
    <h1><i class="fa fa-registered"></i> ข้อมูลสมาชิก<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลสมาชิก</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header"> 
            <h3 class="box-title">แก้ไขข้อมูลสมาชิก</h3>
            <i class="fa fa-angle-right"></i> <a href="Javascript:location.reload();"><?php echo $prefix_name ." ". $data['name_thai'] ." ". $data['lname_thai'];?></a>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/teacher-edit/action.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <a href="?content=teacher&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <a class="btn btn-info btn" href="?content=teacher-show&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แสดงข้อมูล"><i class="fa fa-eye"></i> แสดงข้อมูล</a>
            <a class="btn btn-danger btn" href="?content=teacher-del&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="ลบข้อมูล"><i class="fa fa-trash"></i> ลบข้อมูล</a>
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <a href="#" class="thumbnail" style="width: 250px; height: 250px; margin: 0px;">
                                    <img id="img_1" style="width: 100%;height: 100%;" src="files/img_teacher/<?php echo $data['photo']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)">
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="position:relative;">
                                <a class='btn btn-info' href='javascript:;'>
                                    เลือกภาพหลัก... 
                                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="filUpload_1" id="filUpload_1" size="40" accept="image/*" onchange="IMAGE_RENDER(this, '#img_1').val();">
                                </a>
                                &nbsp;
                                <span class='label label-success' id="upload-file-info"></span>
                            </div>
                        </div>

                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="card">เลขบัตรประชาชน <red>*</red></label>
                            <input type="text" class="form-control" name="card" id="card" placeholder="เลขบัตรประชาชน" data-inputmask="'mask': '9-9999-99999-99-9'" value="<?php echo $data['card'];?>" required>
                            <small><red>เช่น 1-2345-67890-12-3 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label name="sex_id">เพศ <red>*</red></label><br>
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
                            <div class="form-group col-md-6">
                                <label for="prefix_id">คำนำหน้า <red>*</red></label>
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
                        <div class="form-group">
                            <label for="name_thai">ชื่อภาษาไทย <red>*</red></label>
                            <input type="text" class="form-control" name="name_thai" placeholder="ชื่อภาษาไทย" value="<?php echo $data['name_thai'];?>" required>
                            <small><red>เช่น เอบีซี</red></small>
                        </div>
                        <div class="form-group">
                            <label for="lname_thai">สกุลภาษาไทย <red>*</red></label>
                            <input type="text" class="form-control" name="lname_thai" placeholder="สกุลภาษาไทย" value="<?php echo $data['lname_thai'];?>" required>
                            <small><red>เช่น ดีอีเอฟ</red></small>
                        </div>
                        <div class="form-group">
                            <label for="name_eng">ชื่ออังกฤษ</label>
                            <input type="text" class="form-control" name="name_eng" placeholder="ชื่ออังกฤษ" value="<?php echo $data['name_eng'];?>">
                            <small><red>เช่น Abc</red></small>
                        </div>
                        <div class="form-group">
                            <label for="lname_eng">สกุลอังกฤษ</label>
                            <input type="text" class="form-control" name="lname_eng" placeholder="สกุลอังกฤษ" value="<?php echo $data['lname_eng'];?>">
                            <small><red>เช่น Def</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="no">เลขที่</label>
                                <input type="text" class="form-control" name="no" placeholder="เลขที่" value="<?php echo $data['no'];?>">
                                <small><red>เช่น 7</red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="alley">ตรอก</label>
                                <input type="text" class="form-control" name="alley" placeholder="ตรอก" value="<?php echo $data['alley'];?>">
                                <small><red>เช่น - </red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="byway">ซอย</label>
                                <input type="text" class="form-control" name="byway" placeholder="ซอย" value="<?php echo $data['byway'];?>">
                                <small><red>เช่น - </red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mu">หมู่ที่</label>
                                <input type="text" class="form-control" name="mu" placeholder="หมู่ที่" value="<?php echo $data['mu'];?>">
                                <small><red>เช่น 4</red></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="village">หมู่บ้าน</label>
                            <input type="text" class="form-control" name="village" placeholder="หมู่บ้าน" value="<?php echo $data['village'];?>">
                            <small><red>เช่น 4</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="province_id_">จังหวัด <red>*</red></label>
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
                            <div class="form-group col-md-4">
                                <label for="amphur_id_">อำเภอ <red>*</red></label>
                                <!-- <select id="amphur_id" name="amphur_id" class="form-control selectpicker" data-live-search="true" title="เลือกอำเภอ" style="width: 100%;" required> -->
                                <select class="form-control" name="amphur_id_" required>
                                    <option value="">- เลือกอำเภอ -</option>
                                    <?php
                                        // $obj = $DATABASE->QueryObj("SELECT * FROM tb_amphur ORDER BY name");
                                        // foreach($obj as $row) {
                                        //     $selected = "";
                                        //     if( $data["amphur_id"]==$row["id"] ) $selected = "selected";
                                        //     echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                        // }
                                    ?>
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
                            <div class="form-group col-md-4">
                                <label for="district_id_">ตำบล <red>*</red></label>
                                <!-- <select id="district_id" name="district_id" class="form-control selectpicker" data-live-search="true" title="เลือกตำบล" style="width: 100%;" required> -->
                                <select class="form-control" name="district_id_" required>
                                    <option value="">- เลือกตำบล -</option>
                                    <?php
                                        // $obj = $DATABASE->QueryObj("SELECT * FROM tb_district ORDER BY name");
                                        // foreach($obj as $row) {
                                        //     $selected = "";
                                        //     if( $data["district_id"]==$row["id"] ) $selected = "selected";
                                        //     echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                        // }
                                    ?>
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
                        </div>
                        <div class="form-group">
                            <label for="passcode_">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" name="passcode_" placeholder="รหัสไปรษณีย์" data-inputmask="'mask': '99999'" value="<?php echo $data['passcode'];?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tel">เบอร์โทรมือถือ <red>*</red></label>
                            <input type="text" class="form-control" name="tel" placeholder="เบอร์โทรมือถือ" data-inputmask="'mask': '999-9999999'" value="<?php echo $data['tel'];?>" required>
                            <small><red>เช่น 011-2345699 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                        <style type="text/css">
                            input[type="date"]::-webkit-clear-button {
                                display: none;
                            }
                            input[type="date"]::-webkit-inner-spin-button { 
                                display: none;
                            }
                            input[type="date"]::-webkit-calendar-picker-indicator {
                                color: #2c3e50;
                            }
                            input[type="date"] {
                                appearance: none;
                                -webkit-appearance: none;
                                color: #000;
                                font-family: "Helvetica", arial, sans-serif;
                                font-size: 12px;
                                border:1px solid #cecece;
                                background:#fff;
                                padding:5px;
                                display: inline-block !important;
                                visibility: visible !important;
                            }
                            input[type="date"], focus {
                                color: #000;
                                box-shadow: none;
                                -webkit-box-shadow: none;
                                -moz-box-shadow: none;
                            }
                        </style>
                        <div class="form-group">
                            <label for="birthday">วันเกิด <red>*</red></label>
                            <input type="date" class="form-control" name="birthday" placeholder="วันเกิด" value="<?php echo $data['birthday'];?>" required>
                            <small><red>เช่น 01/01/2561 (ไม่ต้องใส่ทับ /)</red></small>
                        </div>
                        <div class="row">                    
                            <div class="form-group col-md-6">
                                <label for="email">อีเมล <red>*</red></label>
                                <input type="email" class="form-control" name="email" placeholder="อีเมล" value="<?php echo $data['email'];?>" required>
                                <small><red>เช่น aaa@gmail.com</red></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="idline">ไอดีไลน์ <red>*</red></label>
                                <input type="text" class="form-control" name="idline" placeholder="ไอดีไลน์" value="<?php echo $data['idline'];?>" required>
                                <small><red>เช่น 0111111111</red></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alumni">ศิษย์เก่าจากสถาบัน <red>*</red></label>
                            <input type="text" class="form-control" name="alumni" placeholder="ศิษย์เก่าจากสถาบัน" value="<?php echo $data['alumni'];?>" required>
                            <small><red>เช่น มหาวิทยาลัยราชภัฏยะลา</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="buddhist_era_start">จากพ.ศ.</label>
                                <input type="text" class="form-control" name="buddhist_era_start" placeholder="จากพ.ศ." data-inputmask="'mask': '9999'" value="<?php echo $data['buddhist_era_start'];?>">
                                <small><red>เช่น 2555</red></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="buddhist_era_end">ถึงพ.ศ.</label>
                                <input type="text" class="form-control" name="buddhist_era_end" placeholder="ถึงพ.ศ." data-inputmask="'mask': '9999'" value="<?php echo $data['buddhist_era_end'];?>">
                                <small><red>เช่น 2560</red></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="faculty">คณะ <red>*</red></label>
                            <input type="text" class="form-control" name="faculty" placeholder="คณะ" value="<?php echo $data['faculty'];?>" required>
                            <small><red>เช่น ครุศาสตร์</red></small>
                        </div>
                        <div class="form-group">
                            <label for="branch">สาขา <red>*</red></label>
                            <input type="text" class="form-control" name="branch" placeholder="สาขา" value="<?php echo $data['branch'];?>" required>
                            <small><red>เช่น ครูปฐมวัย</red></small>
                        </div>
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
                        </div>
                        <div class="form-group">
                            <label name="position">สถานะภาพ <red>*</red></label><br>
                            <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_position ORDER BY id");
                                foreach($obj as $row) {
                                    $checked = "";
                                    if( $row["name"]==$data["position"] ) $checked = "checked";
                                    echo '
                                        <label style="padding-left: 25px;">
                                            <input type="radio" name="position" value="'.$row["name"].'" '.$checked.'>
                                                '.$row["name"].'
                                        </label>
                                    ';
                                } 
                            ?>
                        </div>
                        <!-- <div class="form-group">
                            <label for="position">ตำแหน่ง <red>*</red></label>
                            <input type="text" class="form-control" name="position" placeholder="ตำแหน่ง" value="<?php //echo $data['position'];?>" required>
                            <small><red>เช่น ผู้อำนวยการ (ป้อนชื่อเต็ม)</red></small>
                        </div> -->
                        <div class="form-group">
                            <label for="school_address">ที่อยู่โรงเรียน</label>
                            <textarea class="form-control" rows="3" name="school_address" placeholder="เลขที่ หมู่ที่ ตำบล อำเภอ จังหวัด"><?php echo $data['school_address'];?></textarea>
                            <small><red>เช่น 43 หมู่ที่ 3 ต.ยะลา อ.ยะลา จ.ยะลา</red></small>
                        </div>
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
                                   //echo ($key+1).". ".$value;
                                   //echo '<br>';
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
                        <!-- <div class="row"> -->
                            <!-- <div class="form-group col-md-6">
                                <label for="chkLevel[]" class="control-label">สอนระดับชั้น <red>*</red></label><br> -->
                                <?php
                                    // $arr = explode(",", $data['level']);
                                    // //print_r($arr);
                                    // //echo '<br>';
                                    
                                    // $obj = $DATABASE->QueryObj("SELECT * FROM tb_level");
                                    // foreach($obj as $row) {
                                    //     $check_list = array(
                                    //         $row["name"]=>"",
                                    //     );
                                    // }
                                    // foreach ($arr as $key => $value) {
                                    //    if( $value=="" ) continue;
                                    //    $check_list[$value] = "checked";
                                    //    echo '<input type="checkbox" name="level[]" value="'.$value.'" '.$check_list[$value].' > '.$value.' <br>';
                                    // }
                                ?>
                            <!-- </div> -->
                            <!-- <div class="form-group col-md-6"> -->
                                <!-- <label for="chkTopics[]" class="control-label">กลุ่มสาระวิชาที่สอน <red>*</red></label><br> -->
                                <?php
                                    // $arr = explode(",", $data['topics']);
                                    // //print_r($arr);
                                    // //echo '<br>';
                                    
                                    // $obj = $DATABASE->QueryObj("SELECT * FROM tb_topics");
                                    // foreach($obj as $row) {
                                    //     $check_list = array(
                                    //         $row["name"]=>"",
                                    //     );
                                    // }
                                    // foreach ($arr as $key => $value) {
                                    //    if( $value=="" ) continue;
                                       
                                    //    $check_list[$value] = "checked";
                                    //    echo '<input type="checkbox" name="level[]" value="'.$value.'" '.$check_list[$value].' > '.$value.' <br>';
                                    // }
                                ?>
                            <!-- </div> -->
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
                                   //echo ($key+1).". ".$value;
                                   //echo '<br>';
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
                        </div>
                        <div class="form-group">
                            <label for="note">หมายเหตุ</label>
                            <textarea class="form-control" rows="3" name="note" placeholder="หมายเหตุ"><?php echo $data['note'];?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> บันทึก</button>
            </div>
        </form>
    </div>
</section>
<?php
    } else {
        //echo 'No data.';
        echo "
                <script>
                    location.href = '?content=pagenotfound';
                </script>
            ";
    }
?>