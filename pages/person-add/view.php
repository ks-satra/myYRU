<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    include("pages/date.php"); 
?>
<script>
    $(function() {
        $("#project_id").change(function() {
            var v = $(this).val();


            $.post("pages/person-add/get-data.php", {
                project_id: v
            }, function(data) {
                $("#show-data").html(data);
            });
        });
        $("#show-data").on("click", ".mycheckbok-all", function() {
            var chkall = $(".mycheckbok-all").prop("checked");
            $(".mycheckbok").prop("checked", chkall);
        });
    });
</script>
<section class="content-header">
    <h1><i class="fa fa-registered"></i> ข้อมูลผู้ลงทะเบียน<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้ลงทะเบียน</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มข้อมูลผู้ลงทะเบียน</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/person-add/action.php" method="post">
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="school_id">โครงการ <red>*</red></label>
                            <select id="school_id" name="school_id" class="form-control selectpicker" data-live-search="true" title="เลือกโครงการ" style="width: 100%;" required>
                                <option value="">- เลือกโครงการ -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("
                                    SELECT
                                    * FROM tb_project
                                    ORDER BY name");
                                foreach($obj as $row) {
                                    $selected = "";
                                    echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                            <br><br><small><red>เช่น โครงการพัฒนาคุณภาพสถานศึกษาและบุคลากรทางการศึกษาชายแดนภาคใต้</red></small>
                        </div>
                        <div class="form-group" id="show-data">
                            <label for="activity_id">กิจกรรม <red>*</red></label>
                            <select id="activity_id" name="activity_id" class="form-control selectpicker mycheckbok-all" data-live-search="true" title="เลือกกิจกรรม" style="width: 100%;" required>
                                <option value="">- เลือกกิจกรรม -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("
                                    SELECT
                                    *
                                    FROM
                                    tb_activity
                                    ORDER BY name");
                                foreach($obj as $row) {
                                    $selected = "";
                                    echo '<option class="mycheckbok" value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                            <br><br><small><red>เช่น กิจกรรมที่ 1 : พัฒนาศักยภาพครูในพื้นที่ชายแดนใต้ในเรื่องการผลิตสื่อเพื่อส่งเสริมการอ่านออกเขียนได้</red></small>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="card">เลขบัตรประชาชน <red>*</red></label>
                            <input type="text" class="form-control" name="card" id="card" placeholder="เลขบัตรประชาชน" data-inputmask="'mask': '9-9999-99999-99-9'" required>
                            <small><red>เช่น 1-2345-67890-12-3 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="prefix_id">คำนำหน้า <red>*</red></label>
                            <select id="prefix_id" name="prefix_id" class="form-control selectpicker" data-live-search="true" title="เลือกคำนำหน้า" style="width: 100%;" required>
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
                                font-size: 15px;
                                border:1px solid #cecece;
                                background:#fff;
                                padding:5px;
                                display: inline-block !important;
                                visibility: visible !important;
                            }
                            input[type="date"], focus {
                                color: #95a5a6;
                                box-shadow: none;
                                -webkit-box-shadow: none;
                                -moz-box-shadow: none;
                            }
                        </style>
                        <div class="form-group">
                            <label for="birthday">วันเกิด <red>*</red></label>
                            <input type="date" class="form-control" name="birthday" placeholder="วันเกิด" required>
                            <small><red>เช่น 01/01/2561 (ไม่ต้องใส่ทับ /)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="position">ตำแหน่ง <red>*</red></label>
                            <input type="text" class="form-control" name="position" placeholder="ตำแหน่ง" required>
                            <small><red>เช่น ผู้อำนวยการ (ป้อนชื่อเต็ม)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="email">อีเมล <red>*</red></label>
                            <input type="email" class="form-control" name="email" placeholder="อีเมล"required>
                            <small><red>เช่น aaa@gmail.com</red></small>
                        </div>
                        <div class="form-group">
                            <label for="idline">ไอดีไลน์ <red>*</red></label>
                            <input type="text" class="form-control" name="idline" placeholder="ไอดีไลน์" required>
                            <small><red>เช่น 0111111111</red></small>
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
                            <small><red>เช่น ครุศาสตร์</red></small>
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
                                    echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].' (ต. '.$row["district_name"].' อ. '.$row["amphur_name"].' จ. '.$row["province_name"].')</option>';
                                }
                                ?>
                            </select>
                            <br><br><small><red>เช่น รูสะมีแล (ไม่ต้องใส่ต.)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="address">ที่อยู่</label>
                            <textarea class="form-control" rows="3" name="address" placeholder="ที่อยู่"></textarea>
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
            <button type="submit" class="btn btn-success" style="background-color: #255f07; border: #255f07;"><i class="fa fa-check" aria-hidden="true"></i> บันทึกข้อมูล</button>
        </form>
    </div>
</section>