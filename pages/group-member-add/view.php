<?php 
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<script src="pages/group-member-add/view.js"></script>
<section class="content-header">
    <h1><i class="fa fa-user"></i> ข้อมูลกลุ่มเกษตรกร<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลกลุ่มเกษตรกร</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มข้อมูลกลุ่มเกษตรกร</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/group-member-add/action.php" method="post">
            <a href="?content=user-admin" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">ชื่อ <red>*</red></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="ชื่อ" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label"> รายละเอียด <red>*</red>
                        </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" name="description" placeholder="รายละเอียด" required="required"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-default" title="รีเฟรส" onClick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                <button type="submit" onclick="return confirm('คุณต้องการเพิ่มรายชื่อนี้ใช่ไหม ?')" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>   
            </div>
        </form>
    </div>
</section>