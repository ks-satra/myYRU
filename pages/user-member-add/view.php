<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<script src="pages/user-member-add/view.js"></script>
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
    <h1><i class="fa fa-users"></i> ข้อมูลผู้จัดการ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้จัดการ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มข้อมูลผู้จัดการ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/user-member-add/action.php" method="post" onsubmit="return alertPassword()">
            <a href="?content=user-member" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <div class="row form-horizontal">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <a href="#" class="thumbnail" style="width: 200px; height: 200px; margin: 0px;">
                                <img id="img_" style="width: 100%;height: 100%;" src="" alt="User image" onerror="ON_IMAGE_ERROR(this)">
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
                        <label for="dep_id_" class="col-sm-3 control-label">
                            <a href='./?content=group-member' title="ตั้งค่า"> 
                                <i class="fa fa-cog" style="color:rgb"></i>
                            </a> สังกัดโครงการ <red>*</red>
                        </label>
                        <div class="col-sm-9">
                            <select id="group_member_id_" name="group_member_id_" class="form-control selectpicker" data-live-search="true" title="เลือกสังกัดโครงการ" style="width: 100%; background-color: #fff;" required>
                                <option value="">- เลือกสังกัดโครงการ -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_group_member ORDER BY id");
                                foreach($obj as $row){
                                    echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prefix_id_" class="col-sm-3 control-label">
                            คำนำหน้า <red>*</red>
                        </label>
                        <div class="col-sm-9">
                            <select id="prefix_id_" name="prefix_id_" class="form-control selectpicker" data-live-search="true" title="เลือกคำนำหน้า" style="width: 100%; background-color: #fff;" required>
                                <option value="">- เลือกคำนำหน้า -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_prefix ORDER BY id");
                                foreach($obj as $row){
                                    echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="office_boss_name_" class="col-sm-3 control-label">ชื่อ <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="office_boss_name_" placeholder="ชื่อ" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="surname_boss_name_" class="col-sm-3 control-label">สกุล <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="surname_boss_name_" placeholder="สกุล" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position_id_" class="col-sm-3 control-label">
                            ตำแน่ง <red>*</red>
                        </label>
                        <div class="col-sm-9">
                            <select id="position_id_" name="position_id_" class="form-control selectpicker" data-live-search="true" title="เลือกตำแหน่ง" style="width: 100%; background-color: #fff;" required>
                                <option value="">- เลือกตำแหน่ง -</option>
                                <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_position_member ORDER BY id");
                                    foreach($obj as $row){  
                                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="number_" class="col-sm-3 control-label">เบอร์มือถือ <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="number_" placeholder="เบอร์มือถือ" data-inputmask="'mask': '999-9999999'" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">อีเมล <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" placeholder="อีเมล" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="province_id_" class="col-sm-3 control-label">จังหวัด <red>*</red></label>
                        <div class="col-sm-9">
                            <select id="province_id_" name="province_id_" class="form-control selectpicker" data-live-search="true" title="เลือกจังหวัด" style="width: 100%; background-color: #fff;" required>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amphur_id_" class="col-sm-3 control-label">แขวง / อำเภอ <red>*</red></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="amphur_id_" required>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district_id_" class="col-sm-3 control-label">ตำบล <red>*</red></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="district_id_" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="post_" class="col-sm-3 control-label">รหัสไปรษณีย์ </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control disabled" name="passcode_" placeholder="รหัสไปรษณีย์" readonly>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="status_id_" class="col-sm-3 control-label">
                            </a> สิทธิการใช้งาน <red>*</red>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status_id_" required>
                                <option value="">- เลือกสิทธิการใช้งาน -</option>
                                <?php
                                    // $obj = $DATABASE->QueryObj("SELECT * FROM tb_status ORDER BY id");
                                    // foreach($obj as $row){
                                    //     echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                    // }
                                ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="username_" class="col-sm-3 control-label">ชื่อผู้ใช้ <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" value="<?php echo $DATABASE->QueryMaxId("tb_member","username","PTS-",4); ?>" disabled>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="username_" class="col-sm-3 control-label">ชื่อผู้ใช้ <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username_" placeholder="ชื่อผู้ใช้" maxlength="10">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="password_" class="col-sm-3 control-label">รหัสผ่าน <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password_" placeholder="รหัสผ่าน" maxlength="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password_" class="col-sm-3 control-label">ยืนยันรหัสผ่าน <red>*</red></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="confirm_password_" placeholder="ยืนยันรหัสผ่าน" maxlength="10">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-default" title="รีเฟรส" onClick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                <button type="submit" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button> 
                
                <!-- <button type="submit" onclick="return confirm('คุณต้องการเพิ่มรายชื่อนี้ใช่ไหม ?')" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>    -->
            </div>
        </form>
    </div>
</section>