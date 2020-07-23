<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_person WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
?>
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
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/person-add/action.php" method="post">
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="card">เลขบัตรประชาชน <red>*</red></label>
                            <input type="text" class="form-control" name="card" id="card" placeholder="เลขบัตรประชาชน" data-inputmask="'mask': '9-9999-99999-99-9'" value="<?php echo $data['card'];?>" required>
                            <small><red>เช่น 1-2345-67890-12-3 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="prefix_id">คำนำหน้า <red>*</red></label>
                            <select id="prefix_id" name="prefix_id" required class="form-control selectpicker" data-live-search="true" title="เลือกคำนำหน้า" style="width: 100%;" required>
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
                            <input type="text" class="form-control" name="name_eng" placeholder="ชื่ออังกฤษ" value="<?php echo $data['name_eng'];?>" required>
                            <small><red>เช่น Abc</red></small>
                        </div>
                        <div class="form-group">
                            <label for="lname_eng">สกุลอังกฤษ</label>
                            <input type="text" class="form-control" name="lname_eng" placeholder="สกุลอังกฤษ" value="<?php echo $data['lname_eng'];?>" required>
                            <small><red>เช่น Def</red></small>
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
                            <input type="date" class="form-control" name="birthday" placeholder="วันเกิด" value="<?php echo $data['birthday'];?>" required>
                            <small><red>เช่น 01/01/2561 (ไม่ต้องใส่ทับ /)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="position">ตำแหน่ง <red>*</red></label>
                            <input type="text" class="form-control" name="position" placeholder="ตำแหน่ง" value="<?php echo $data['position'];?>" required>
                            <small><red>เช่น ผู้อำนวยการ (ป้อนชื่อเต็ม)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="facebook">เฟสบุ๊ค</label>
                            <input type="text" class="form-control" name="facebook" placeholder="เฟสบุ๊ค" value="<?php echo $data['facebook'];?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">อีเมล <red>*</red></label>
                            <input type="email" class="form-control" name="email" placeholder="อีเมล" value="<?php echo $data['email'];?>"required>
                            <small><red>เช่น aaa@gmail.com</red></small>
                        </div>
                        <div class="form-group">
                            <label for="idline">ไอดีไลน์ <red>*</red></label>
                            <input type="text" class="form-control" name="idline" placeholder="ไอดีไลน์" value="<?php echo $data['idline'];?>" required>
                            <small><red>เช่น 0111111111</red></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alumni">ศิษย์เก่าจากสถาบัน <red>*</red></label>
                            <input type="text" class="form-control" name="alumni" placeholder="ศิษย์เก่าจากสถาบัน" value="<?php echo $data['alumni'];?>" value="<?php echo $data['alumni'];?>" required>
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
                                    if( $data["school_id"]==$row["id"] ) $selected = "selected";
                                    echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].' (ต. '.$row["district_name"].' อ. '.$row["amphur_name"].' จ. '.$row["province_name"].')</option>';
                                }
                                ?>
                            </select>
                            <br><br><small><red>เช่น รูสะมีแล (ไม่ต้องใส่ต.)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="address">ที่อยู่</label>
                            <textarea class="form-control" rows="3" name="address" placeholder="ที่อยู่"><?php echo $data['address'];?></textarea>
                        </div>
                        <?php
                            $arr = explode(",", $data['level']);
                            // $check_list = array(
                            //     "ลองกอง"=>"",
                            //     "มังคุด"=>"",
                            //     "ทุเรียน"=>"",
                            //     "เงาะ"=>"",
                            // );
                            $sql = "SELECT name FROM tb_level";
                            $check_list = array($sql=> "",);
                            foreach ($arr as $key => $value) {
                               if( $value=="" ) continue;
                               $check_list[$value] = "checked";

                               // echo ($key+1).". ".$value;
                               // echo '<br>';
                            }
                        ?>
                        <div class="form-group">
                            <label for="chkLevel[]" class="col-sm-3 control-label">สอนระดับชั้น <red>*</red></label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5" name="level" placeholder="สอนระดับชั้น" required="required"><?php echo $data['level'];?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="chkLevel[]">สอนระดับชั้น</label>
                            <?php
                            $obj = $DATABASE->QueryObj("SELECT * FROM tb_level ORDER BY id");
                            foreach($obj as $row) {
                                $selected = "";
                                echo '<br><input type="checkbox" name="level[]" value="'.$row["name"].'" "'.$check_list[$sql].'"> '.$row["name"].'';
                            }
                            ?>
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
<?php
    } else {
        echo 'No data.';
    }
?>