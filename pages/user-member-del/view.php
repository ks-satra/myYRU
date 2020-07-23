<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_member WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
        $prefix_name = $DATABASE->QueryString("SELECT name FROM tb_prefix WHERE id='".$data['prefix_id']."'");
?>
    <section class="content-header">
        <h1><i class="fa fa-users"></i> ข้อมูลผู้จัดการ<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
            <li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้จัดการ</a></li>
            <li><a href="?content=user-member-edit&id=<?php echo $id;?>">แก้ไขข้อมูลผู้จัดการ</a></li>
            <li><a href="?content=<?php echo $content; ?>&id=<?php echo $id;?>">ลบข้อมูลผู้จัดการ</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">ลบข้อมูลผู้จัดการ</h3>
                <i class="fa fa-angle-right"></i> <a href="Javascript:location.reload();"><?php echo $prefix_name ." ". $data['name'] ." ". $data['lname'];?></a>
            </div> 
            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/user-member-del/action.php" method="post">
                <input type="hidden" name="id_" value="<?php echo $data['id']; ?>">
                <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                <input type="hidden" name="fileupload" value="<?php echo $data['fileupload']; ?>">
                <a href="?content=user-member-edit&id=<?php echo $id;?>&page=<?php echo $PAGE;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                <div class="row form-horizontal" style="padding-top: 13px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <a href="#" class="thumbnail" style="width: 200px; height: 200px; margin: 0px;">
                                    <img id="img_" style="width: 100%;height: 100%;" src="files/img_member/<?php echo $data['fileupload']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-horizontal" style="padding-top: 13px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_" class="col-sm-3 control-label">ชื่อหน่วยงาน </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name_" placeholder="ชื่อหน่วยงาน" value="<?php echo $data['name']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dep_id_" class="col-sm-3 control-label">สังกัด </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="dep_id_" disabled="true">
                                    <option value="">- เลือกสังกัด -</option>
                                    <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_department ORDER BY id");
                                    foreach($obj as $row) {
                                        $selected = "";
                                        if( $data["dep_id"]==$row["id"] ) $selected = "selected";
                                        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prefix_id_" class="col-sm-3 control-label">คำนำหน้า </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="prefix_id_" disabled="true" >
                                    <option value="">- เลือกคำนำหน้า -</option>
                                    <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_prefix ORDER BY id");
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
                            <label for="office_boss_name_" class="col-sm-3 control-label">ชื่อ </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="office_boss_name_" placeholder="ชื่อ" value="<?php echo $data['name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="surname_boss_name_" class="col-sm-3 control-label">สกุล </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="surname_boss_name_" placeholder="สกุล" value="<?php echo $data['lname']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="position_id_" class="col-sm-3 control-label">ตำแหน่ง </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="position_id_" disabled="true">
                                    <option value="">- เลือกตำแหน่ง -</option>
                                    <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_position_member ORDER BY id");
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
                            <label for="number_" class="col-sm-3 control-label">เบอร์มือถือ </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="number_" placeholder="เบอร์มือถือ" data-inputmask="'mask': '999-9999999'" value="<?php echo $data['number']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="province_id_" class="col-sm-3 control-label">จังหวัด </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="province_id_" disabled="true">
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
                            <label for="amphur_id_" class="col-sm-3 control-label">แขวง / อำเภอ </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="amphur_id_" disabled="true">
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
                            <label for="district_id_" class="col-sm-3 control-label">ตำบล </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="district_id_" disabled="true">
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
                            <label for="status_id_" class="col-sm-3 control-label">สิทธิการใช้งาน </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status_id_" disabled="true">
                                    <option value="">- เลือกสิทธิการใช้งาน -</option>
                                    <?php
                                        $obj = $DATABASE->QueryObj("SELECT * FROM tb_status ORDER BY id");
                                        foreach($obj as $row){
                                            $selected = "";
                                            if( $data["status_id"]==$row["id"] ) $selected = "selected";
                                            echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username_" class="col-sm-3 control-label">ชื่อผู้ใช้ </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username_" placeholder="ชื่อผู้ใช้" value="<?php echo $data['username']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_" class="col-sm-3 control-label">รหัสผ่าน </label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password_" placeholder="รหัสผ่าน" value="<?php echo $data['password']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password_" class="col-sm-3 control-label">ยืนยันรหัสผ่าน </label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="confirm_password_" placeholder="ยืนยันรหัสผ่าน" value="<?php echo $data['confirm_password']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">

                        </div>
                        <div class="text-right" >
                            <button type="submit" onclick="return confirm('คุณต้องการลบรายชื่อนี้ใช่ไหม ?')" class="btn btn-danger" title="ยืนยันการลบข้อมูล"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูล</button> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
} else {
    echo 'No data.';
}
?>