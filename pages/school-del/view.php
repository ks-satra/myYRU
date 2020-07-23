
<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_school WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
?>
<script src="pages/school/view.js"></script>
<section class="content-header">
    <h1><i class="fa fa-hospital-o"></i> ข้อมูลโรงเรียน<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลโรงเรียน</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">แสดงข้อมูลโรงเรียน</h3> > <small><?php $SCHOOL_NAME = $DATABASE->QueryString("SELECT name FROM tb_school WHERE id='".$data['id']."'"); echo $SCHOOL_NAME;?></small>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/school-add/action.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <a href="?content=school&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <a class="btn btn-warning btn" href="?content=school-edit&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>
            <a class="btn btn-info btn" href="?content=school-show&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แสดงข้อมูล"><i class="fa fa-eye"></i> แสดงข้อมูล</a>

            <div class="panel-body"> 
                <div class="row form-horizontal">
                    <div class="col-md-6">
                        <div class="form-group" align="center">
                            <div class="col-sm-offset-3 col-sm-9">
                                <a href="#" class="thumbnail" style="width: 250px; height: 250px; margin: 0px;">
                                    <img id="img_1" style="width: 100%;height: 100%;" src="files/img_school/<?php echo $data['fileupload']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)">
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="position:relative;">
                                <a class='btn btn-info' href='javascript:;'>
                                    เลือกภาพหลัก... 
                                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="fileupload" id="fileupload" size="40" accept="image/*" onchange="IMAGE_RENDER(this, '#img_1').val();">
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
                            <label for="code">รหัสโรงเรียน <red>*</red></label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="รหัสโรงเรียน" data-inputmask="'mask': '9999999999'" <?php echo $data['code']; ?> required>
                            <small><red>เช่น 1234567890 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="name">ชื่อโรงเรียน <red>*</red></label>
                            <input type="text" class="form-control" name="name" placeholder="ชื่อโรงเรียน" value="<?php echo $data["name"]; ?>" readonly>
                            <small><red>เช่น โรงเรียนบ้านยะลา</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="no">เลขที่</label>
                                <input type="text" class="form-control" name="no" placeholder="เลขที่" value="<?php echo $data["no"]; ?>" readonly>
                                <small><red>เช่น 7</red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="alley">ตรอก</label>
                                <input type="text" class="form-control" name="alley" placeholder="ตรอก" value="<?php echo $data["alley"]; ?>" readonly>
                                <small><red>เช่น - </red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="road">ซอย</label>
                                <input type="text" class="form-control" name="road" placeholder="ซอย" value="<?php echo $data["road"]; ?>" readonly>
                                <small><red>เช่น - </red></small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mu">หมู่ที่</label>
                                <input type="text" class="form-control" name="mu" placeholder="หมู่ที่" value="<?php echo $data["mu"]; ?>" readonly>
                                <small><red>เช่น 4</red></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="village">หมู่บ้าน</label>
                            <input type="text" class="form-control" name="village" placeholder="หมู่บ้าน" value="<?php echo $data["village"]; ?>" readonly>
                            <small><red>เช่น บ้านทอง</red></small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4" style="background-color: fff;">
                                <label for="province_id_" class="control-label">จังหวัด <red>*</red></label>
                                <select id="province_id_" name="province_id_" class="form-control selectpicker" data-live-search="true" title="เลือกจังหวัด" style="width: 100%; background-color: #fff;" readonly>
                                    <?php
                                        $obj = $DATABASE->QueryObj("SELECT * FROM tb_province ORDER BY name");
                                        foreach($obj as $row) {
                                            $selected = "";
                                            if( $data["province_id"]==$row["id"] ) $selected = "selected";
                                            echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amphur_id_" class="control-label">อำเภอ <red>*</red></label>
                                <select class="form-control" name="amphur_id_" readonly>
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
                                <label for="district_id_" class="control-label">ตำบล <red>*</red></label>
                                <select class="form-control" name="district_id_" readonly>
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
                            <label for="passcode_" class="col-sm-3 control-label">รหัสไปรษณีย์ </label>
                            <input type="text" class="form-control disabled" name="passcode_" placeholder="รหัสไปรษณีย์" value="<?php echo $data["passcode"]; ?>" readonly>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="latitude" class="col-sm-3 control-label">ละติจูด </label>
                                <input type="text" class="form-control" name="latitude" placeholder="ละติจูด" value="<?php echo $data["lat"]; ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="longitude" class="col-sm-3 control-label">ลองจิจูด </label>
                                <input type="text" class="form-control" name="longitude" placeholder="ลองจิจูด" value="<?php echo $data["lng"]; ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="department_id">สำนักงานเขตพื้นที่การศึกษา <red>*</red></label>
                                <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true" title="เลือกสำนักงานเขตพื้นที่การศึกษา" style="width: 100%;" readonly>
                                    <option value="">- เลือกสำนักงานเขตพื้นที่การศึกษา -</option>
                                    <?php
                                        $obj = $DATABASE->QueryObj("SELECT * FROM tb_department ORDER BY name");
                                        foreach($obj as $row) {
                                            $selected = "";
                                            echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                        }
                                    ?>
                                </select>
                                <br><small><red>เช่น สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน</red></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="area_id">สังกัด <red>*</red></label>
                                <select id="area_id" name="area_id" class="form-control selectpicker" data-live-search="true" title="เลือกสังกัด" style="width: 100%;" readonly>
                                    <option value="">- เลือกสังกัด -</option>
                                    <?php
                                        $obj = $DATABASE->QueryObj("SELECT * FROM tb_area ORDER BY name");
                                        foreach($obj as $row) {
                                            $selected = "";
                                            echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["name"].'</option>';
                                        }
                                    ?>
                                </select>
                                <br><small><red>เช่น สพป.นราธิวาส เขต 1</red></small>
                            </div>
                        </div>
                        <div class="row">                    
                            <div class="form-group col-md-6">
                                <label for="email">อีเมล <red>*</red></label>
                                <input type="email" class="form-control" name="email" placeholder="อีเมล" value="<?php echo $data["email"]; ?>" readonly>
                                <small><red>เช่น aaa@gmail.com</red></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="website">เว็บไซต์ <red>*</red></label>
                                <input type="text" class="form-control" name="website" placeholder="เว็บไซต์" value="<?php echo $data["website"]; ?>" readonly>
                                <small><red>เช่น http://yru.ac.th/</red></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tel">เบอร์โทรมือถือ / โทรสาร</label>
                            <input type="text" class="form-control" name="tel" placeholder="เบอร์โทรมือถือ" data-inputmask="'mask': '999-9999999'" value="<?php echo $data["tel"]; ?>" readonly>
                            <small><red>เช่น 011-2345699 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                                $arr = explode(",", $data['start_end_school']);
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
                        
                            <div class="form-group">
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
                        <div class="form-group">
                            <label for="prefix_id">คำนำหน้า <red>*</red></label>
                            <select id="prefix_id" name="prefix_id" class="form-control selectpicker" data-live-search="true" title="เลือกคำนำหน้า" style="width: 100%; " readonly>
                                <option value="">- เลือกคำนำหน้า -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_prefix ORDER BY name");
                                foreach($obj as $row) {
                                    $selected = "";
                                    echo '<option value="'.$row["name"].'" '.$selected.' >'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="boss_name">ชื่อภาษาไทย <red>*</red></label>
                            <input type="text" class="form-control" name="boss_name" placeholder="ชื่อภาษาไทย" readonly value="<?php echo $data["boss_name"]; ?>">
                            <small><red>เช่น เอบีซี</red></small>
                        </div>
                        <div class="form-group">
                            <label for="boss_lname">สกุลภาษาไทย <red>*</red></label>
                            <input type="text" class="form-control" name="boss_lname" placeholder="สกุลภาษาไทย" readonly value="<?php echo $data["boss_lname"]; ?>">
                            <small><red>เช่น ดีอีเอฟ</red></small>
                        </div>
                        <div class="form-group">
                            <label for="position">ตำแหน่ง <red>*</red></label>
                            <input type="text" class="form-control" name="position" placeholder="ตำแหน่ง" value="<?php echo $data["position"]; ?>" readonly>
                            <small><red>เช่น ผู้อำนวยการ (ป้อนชื่อเต็ม)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="note">หมายเหตุ</label>
                            <textarea class="form-control" rows="3" name="note" placeholder="หมายเหตุ" readonly><?php echo $data['note']; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" onclick="return confirm('คุณต้องการลบรายชื่อนี้ใช่ไหม ?')" class="btn btn-danger" title="ยืนยันการลบข้อมูล"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูล</button> 
            </div>
        </form>
    </div>
</section>
<?php
    } else {
        echo 'No data.';
    }
?>