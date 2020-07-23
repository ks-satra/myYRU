<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_admin WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0]; 
?>
<script src="pages/user-admin-edit/view.js"></script>
<script type="text/javascript">
    function alertPassword() {
        if( $("[name='password_']").val() == "" ) {
            alert('กรุณาไม่ป้อนรหัสผ่าน');
            $("[name='password_']").focus();
            return false;
        }
        if( $("[name='confirm_password_']").val() == "" ) {
            alert('กรุณาไม่ป้อนยืนยันรหัสผ่าน');
            $("[name='confirm_password_']").focus();
            return false;
        }
        if( $("[name='password_']").val() != $("[name='confirm_password_']").val() ) {
            alert('รหัสผ่านไม่ตรงกัน');
            $("[name='password_']").focus();
            return false;
        }
        return true;
    }
</script>
<section class="content-header">
    <h1><i class="fa fa-user"></i> ข้อมูลผู้ดูแลระบบ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้ดูแลระบบ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">แก้ไขข้อมูลผู้ดูแลระบบ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/user-admin-edit/action.php" method="post" onsubmit="return alertPassword()">
            <input type="hidden" name="id_" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <?php if($USER["status_id"]=="1") {?>
                <a href="?content=user-admin&page=<?php echo $PAGE;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <?php } ?>
            <?php if($USER["status_id"]!="1") {?>
                <a href="?content=user-admin-show&id=<?php echo $id;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <?php } ?>
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <div class="row form-horizontal">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <a href="#" class="thumbnail" style="width: 200px; height: 200px; margin: 0px;">
                                <img id="img_" style="width: 100%;height: 100%;" src="files/img_admin/<?php echo $data['fileupload']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)">
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prefix_id_" class="col-sm-3 control-label">เลือกโปรไฟล์ </label>
                        <div class="col-sm-9">
                            <input type="file" name="filUpload" id="filUpload" accept="image/*" onchange="IMAGE_RENDER(this, '#img_')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prefix_id_" class="col-sm-3 control-label">คำนำหน้า <red>*</red></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="prefix_id_" required>
                                <option value="">- เลือกคำนำหน้า -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_prefix ORDER BY name");
                                foreach($obj as $row) {
                                    $selected = "";
                                    if( $data["prefix_id"]==$row["id"] ) $selected = "selected";
                                    echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_" class="col-sm-3 control-label">ชื่อ <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name_" placeholder="ชื่อ" value="<?php echo $data['name']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname_" class="col-sm-3 control-label">สกุล <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lname_" placeholder="สกุล" value="<?php echo $data['lname']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position_id_" class="col-sm-3 control-label">ตำแหน่ง <red>*</red></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="position_id_" required>
                                <option value="">- เลือกตำแหน่ง -</option>
                                <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_position ORDER BY name");
                                    foreach($obj as $row) {
                                        $selected = "";
                                        if( $data["position_id"]==$row["id"] ) $selected = "selected";
                                        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tel_" class="col-sm-3 control-label">เบอร์มือถือ <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tel_" placeholder="เบอร์มือถือ" data-inputmask="'mask': '999-9999999'" value="<?php echo $data['tel']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_id_" class="col-sm-3 control-label">สิทธิการใช้งาน<red>*</red></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status_id_" >
                                <option value="">- เลือกสิทธิการใช้งาน -</option>
                                <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_status WHERE id = 1 OR id = 2 ORDER BY id");
                                    foreach($obj as $row){
                                        $selected = "";
                                        if( $data["status_id"]==$row["id"] ) $selected = "selected";
                                        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="province_id_" class="col-sm-3 control-label">จังหวัด <red>*</red></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="province_id_" required>
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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amphur_id_" class="col-sm-3 control-label">แขวง / อำเภอ <red>*</red></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="amphur_id_" required>
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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district_id_" class="col-sm-3 control-label">ตำบล <red>*</red></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="district_id_" required>
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
                        <label for="post_" class="col-sm-3 control-label">รหัสไปรษณีย์ </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control disabled" name="passcode_" placeholder="รหัสไปรษณีย์" value="<?php echo $data['passcode']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username_" class="col-sm-3 control-label">ชื่อผู้ใช้</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username_" placeholder="ชื่อผู้ใช้" value="<?php echo $data['username']; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_" class="col-sm-3 control-label">รหัสผ่าน <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password_" placeholder="รหัสผ่าน" value="<?php echo $data['password']; ?>" maxlength="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password_" class="col-sm-3 control-label">ยืนยันรหัสผ่าน <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="confirm_password_" placeholder="ยืนยันรหัสผ่าน" value="<?php echo $data['password']; ?>" maxlength="10">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-default" title="รีเฟรส" onClick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                <button type="submit" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>   
            </div>
        </form>
    </div>
</section>
<?php
    } else {
        echo 'No data.';
    }
?>