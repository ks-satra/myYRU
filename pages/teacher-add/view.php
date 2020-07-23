<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    include("pages/date.php"); 
?>
<script src="pages/user-admin-add/view.js"></script>
<section class="content-header">
    <h1><i class="fa fa-user-circle-o" aria-hidden="true"></i> ข้อมูลบุคลากร<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลบุคลากร</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มข้อมูลบุคลากร</h3>
        </div>
            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/teacher-add/action.php" method="post" >
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <div class="panel-body"> 
                <div class="row form-horizontal">
                    <div class="col-md-6">
                        <div class="form-group" align="center">
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
                    <div class="col-md-6"></div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="card">เลขบัตรประชาชน <red>*</red></label>
                            <input type="text" class="form-control" name="card" id="card" placeholder="เลขบัตรประชาชน" data-inputmask="'mask': '9-9999-99999-99-9'" required>
                            <small><red>เช่น 1-2345-67890-12-3 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label name="sex_id">เพศ <red>*</red></label><br>
                                <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_sex ORDER BY id");
                                    foreach($obj as $row) {
                                        // $checked = "";
                                        // if( $row["id"]==$data["sex_id"] ) $checked = "checked";
                                        // echo '
                                        //     <div class="radio">
                                        //         <label>
                                        //             <input type="radio" name="sex_id" value="'.$row["id"].'" '.$checked.'>
                                        //             '.$row["name"].'
                                        //         </label>
                                        //     </div>
                                        // ';
                                        
                                        // echo '
                                        //     <div class="radio">
                                        //         <label>
                                        //             <input type="radio" name="sex_id" value="'.$row["id"].'" >
                                        //             '.$row["name"].'
                                        //         </label>
                                        //     </div>
                                        // ';
                                        echo '
                                            <label style="padding-left: 30px;">
                                                <input type="radio" name="sex_id" value="'.$row["id"].'" >
                                                    '.$row["name"].'
                                            </label>
                                        ';
                                    } 
                                ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="prefix_id">คำนำหน้า <red>*</red></label>
                                <select id="prefix_id" name="prefix_id" class="form-control selectpicker" data-live-search="true" title="เลือกคำนำหน้า" style="width: 100%; " required>
                                    <option value="">- เลือกคำนำหน้า -</option>
                                    <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_prefix ORDER BY name");
                                    foreach($obj as $row) {
                                        $selected = "";
                                        echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name_thai">ชื่อภาษาไทย <red>*</red></label>
                            <input type="text" class="form-control" name="name_thai" placeholder="ชื่อภาษาไทย" required>
                            <small><red>เช่น เอบีซี</red></small>
                        </div>
                        <div class="form-group">
                            <label for="lname_thai">สกุลภาษาไทย <red>*</red></label>
                            <input type="text" class="form-control" name="lname_thai" placeholder="สกุลภาษาไทย" required>
                            <small><red>เช่น ดีอีเอฟ</red></small>
                        </div>
                        <div class="form-group">
                            <label for="name_eng">ชื่ออังกฤษ</label>
                            <input type="text" class="form-control" name="name_eng" placeholder="ชื่ออังกฤษ">
                            <small><red>เช่น Abc</red></small>
                        </div>
                        <div class="form-group">
                            <label for="lname_eng">สกุลอังกฤษ</label>
                            <input type="text" class="form-control" name="lname_eng" placeholder="สกุลอังกฤษ">
                            <small><red>เช่น Def</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="no">เลขที่</label>
                                <input type="text" class="form-control" name="no" placeholder="เลขที่">
                                <small><red>เช่น 7</red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="alley">ตรอก</label>
                                <input type="text" class="form-control" name="alley" placeholder="ตรอก">
                                <small><red>เช่น - </red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="byway">ซอย</label>
                                <input type="text" class="form-control" name="byway" placeholder="ซอย">
                                <small><red>เช่น - </red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mu">หมู่ที่</label>
                                <input type="text" class="form-control" name="mu" placeholder="หมู่ที่">
                                <small><red>เช่น 4</red></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="village">หมู่บ้าน</label>
                            <input type="text" class="form-control" name="village" placeholder="หมู่บ้าน">
                            <small><red>เช่น บ้านทอง</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4" style="background-color: fff;">
                                <label for="province_id_" class="control-label">จังหวัด <red>*</red></label>
                                <select id="province_id_" name="province_id_" class="form-control" title="เลือกจังหวัด" style="width: 100%; background-color: #fff;" required>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amphur_id_" class="control-label">อำเภอ <red>*</red></label>
                                <select class="form-control" name="amphur_id_" >
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="district_id_" class="control-label">ตำบล <red>*</red></label>
                                <select class="form-control" name="district_id_" >
                                </select>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="post_" class="col-sm-3 control-label">รหัสไปรษณีย์ </label>
                            <input type="text" class="form-control disabled" name="passcode_" placeholder="รหัสไปรษณีย์" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tel">เบอร์โทรมือถือ <red>*</red></label>
                            <input type="text" class="form-control" name="tel" placeholder="เบอร์โทรมือถือ" data-inputmask="'mask': '999-9999999'" required>
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
                            <input type="date" class="form-control" name="birthday" placeholder="วันเกิด" required>
                            <small><red>เช่น 01/01/1990 (ไม่ต้องใส่ทับ /)</red></small>
                        </div>
                        <div class="row">                    
                            <div class="form-group col-md-6">
                                <label for="email">อีเมล <red>*</red></label>
                                <input type="email" class="form-control" name="email" placeholder="อีเมล"required>
                                <small><red>เช่น aaa@gmail.com</red></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="idline">ไอดีไลน์ <red>*</red></label>
                                <input type="text" class="form-control" name="idline" placeholder="ไอดีไลน์" required>
                                <small><red>เช่น 0111111111</red></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alumni">ศิษย์เก่าจากสถาบัน <red>*</red></label>
                            <input type="text" class="form-control" name="alumni" placeholder="ศิษย์เก่าจากสถาบัน" required>
                            <small><red>เช่น มหาวิทยาลัยราชภัฏยะลา</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="buddhist_era_start">จากพ.ศ.</label>
                                <input type="text" class="form-control" name="buddhist_era_start" placeholder="จากพ.ศ." data-inputmask="'mask': '9999'">
                                <small><red>เช่น 2555</red></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="buddhist_era_end">ถึงพ.ศ.</label>
                                <input type="text" class="form-control" name="buddhist_era_end" placeholder="ถึงพ.ศ." data-inputmask="'mask': '9999'">
                                <small><red>เช่น 2560</red></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="faculty">คณะ <red>*</red></label>
                            <input type="text" class="form-control" name="faculty" placeholder="คณะ" required>
                            <small><red>เช่น ครุศาสตร์ (ระบุชื่อคณะเต็ม)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="branch">สาขา <red>*</red></label>
                            <input type="text" class="form-control" name="branch" placeholder="สาขา" required>
                            <small><red>เช่น ครูปฐมวัย</red></small>
                        </div>
                        <div class="form-group">
                            <label for="school_id">โรงเรียน <red>*</red></label>
                            <select id="school_id" name="school_id" required class="form-control selectpicker" data-live-search="true" title="เลือกโรงเรียน" style="width: 100%;" required>
                                <option value="">- เลือกโรงเรียน -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("
                                    SELECT
                                        tb_school.id as school_id,
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
                                    echo '<option value="'.$row["school_id"].'" '.$selected.' >'.$row["name"].' (ต. '.$row["district_name"].' อ. '.$row["amphur_name"].' จ. '.$row["province_name"].')</option>';
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
                                    echo '
                                        <label style="padding-left: 25px;">
                                            <input type="radio" name="position" value="'.$row["name"].'" >
                                                '.$row["name"].'
                                        </label>
                                    ';
                                } 
                            ?>
                        </div>
                        <!-- <div class="form-group">
                            <label for="position">ตำแหน่ง <red>*</red></label>
                            <input type="text" class="form-control" name="position" placeholder="ตำแหน่ง" required>
                            <small><red>เช่น ผู้อำนวยการ (ป้อนชื่อเต็ม)</red></small>
                        </div> -->
                        <div class="form-group">
                            <label for="school_address">ที่อยู่</label>
                            <textarea class="form-control" rows="3" name="school_address" placeholder="ที่อยู่"></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="chkLevel[]">สอนระดับชั้น</label>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_level ORDER BY id");
                                foreach($obj as $row) {
                                    $selected = "";
                                    echo '<br><input type="checkbox" name="level[]" value="'.$row["name"].'"> '.$row["name"].'';
                                }
                                ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="chkTopics[]">กลุ่มสาระการสอน</label>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_topics ORDER BY id");
                                foreach($obj as $row) {
                                    $selected = "";
                                    echo '<br><input type="checkbox" name="topics[]" value="'.$row["name"].'"> '.$row["name"].'';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">หมายเหตุ</label>
                            <textarea class="form-control" rows="3" name="note" placeholder="หมายเหตุ"></textarea>
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