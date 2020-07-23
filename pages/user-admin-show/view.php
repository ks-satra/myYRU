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
            <h3 class="box-title">แสดงข้อมูลผู้ดูแลระบบ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id_" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <?php if($USER["status_id"]=="1") {?>
                <a href="?content=user-admin&page=<?php echo $PAGE;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <?php } ?>
            <a class="btn btn-warning" href="?content=user-admin-edit&id=<?php echo $_SESSION["data_id"]; ?>" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>
            <div class="row form-horizontal" style="padding-top: 11px;">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-12">
                            <a href="#" class="thumbnail" style="width: 200px; height: 200px; margin: 0px;">
                                <img id="img_" style="width: 100%;height: 100%;" src="files/img_admin/<?php echo $data['fileupload']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prefix_id_" class="col-sm-3 control-label">คำนำหน้า</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="prefix_id_" disabled="true">
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
                        <label for="name_" class="col-sm-3 control-label">ชื่อ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name_" placeholder="ชื่อ" value="<?php echo $data['name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname_" class="col-sm-3 control-label">สกุล</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lname_" placeholder="สกุล" value="<?php echo $data['lname']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position_id_" class="col-sm-3 control-label">ตำแหน่ง</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="position_id_" disabled="true">
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
                        <label for="tel_" class="col-sm-3 control-label">เบอร์มือถือ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tel_" placeholder="เบอร์มือถือ" data-inputmask="'mask': '999-9999999'" value="<?php echo $data['tel']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_id_" class="col-sm-3 control-label">สิทธิการใช้งา</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status_id_" disabled="true">
                                <option value="">- เลือกสิทธิการใช้งาน -</option>
                                <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_status ORDER BY name");
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
                        <label for="province_id_" class="col-sm-3 control-label">จังหวัด</label>
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
                        <label for="amphur_id_" class="col-sm-3 control-label">แขวง / อำเภอ</label>
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
                        <label for="district_id_" class="col-sm-3 control-label">ตำบล</label>
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
                        <label for="username_" class="col-sm-3 control-label">ชื่อผู้ใช้</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username_" placeholder="ชื่อผู้ใช้" value="<?php echo $data['username']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_" class="col-sm-3 control-label">รหัสผ่าน</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password_" placeholder="รหัสผ่าน" value="<?php echo $data['password']; ?>" readonly>
                        </div>
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