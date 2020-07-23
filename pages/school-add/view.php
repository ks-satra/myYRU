<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    // $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    include("pages/date.php"); 
?>
<script src="pages/user-admin-add/view.js"></script>
<!-- <script src="pages/school/view.js"></script> -->
<script type="text/javascript">
    var ON_IMAGE_ERROR = function(ctrl){
    $(ctrl).attr("src","images/picture.png");
}
$(function() {
    $('#department_id_').select2().change(function(event) {
        var department_id_ = $(this).val();
        $.post("pages/school/services.php", {
            department_id_: department_id_
        }, function(data) {
            var arr = JSON.parse( data );
            $("#area_id_").html('<option value="">- เลือกบุคลากร -</option>');
            $.each(arr, function(i, v) {
                var $option = $("<option></option>");
                $option
                    .attr("value",v.id)
                    .attr("data-json", JSON.stringify(v))
                    .html(v.name+" "+v.name);
                $("#area_id_").append($option);
            });
        });
    }); 
    $('#area_id_').select2().change(function(event) {
        var v = $(this).val();
        var data = $(this).find("option[value='"+v+"']").attr("data-json");
        try {
            var arr = JSON.parse(data);
        } catch(e) { }
    });
});

</script>
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
            <h3 class="box-title">เพิ่มข้อมูลโรงเรียน</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/school-add/action.php" method="post">
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
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
                            <input type="text" class="form-control" name="code" id="code" placeholder="รหัสโรงเรียน" data-inputmask="'mask': '9999999999'" required>
                            <small><red>เช่น 1234567890 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                        <div class="form-group">
                            <label for="name">ชื่อโรงเรียน <red>*</red></label>
                            <input type="text" class="form-control" name="name" placeholder="ชื่อโรงเรียน" required>
                            <small><red>เช่น โรงเรียนบ้านยะลา</red></small>
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
                                <label for="road">ซอย</label>
                                <input type="text" class="form-control" name="road" placeholder="ซอย">
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
                                <select id="province_id_" name="province_id_" class="form-control selectpicker" data-live-search="true" title="เลือกจังหวัด" style="width: 100%; background-color: #fff;" required>
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
                            <label for="passcode_" class="col-sm-3 control-label">รหัสไปรษณีย์ </label>
                            <input type="text" class="form-control disabled" name="passcode_" placeholder="รหัสไปรษณีย์" readonly>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="latitude" class="col-sm-3 control-label">ละติจูด </label>
                                <input type="text" class="form-control" name="latitude" placeholder="ละติจูด" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="longitude" class="col-sm-3 control-label">ลองจิจูด </label>
                                <input type="text" class="form-control" name="longitude" placeholder="ลองจิจูด" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="department_id">สำนักงานเขตพื้นที่การศึกษา <red>*</red></label>
                                <select id="department_id" name="department_id" required class="form-control selectpicker" data-live-search="true" title="เลือกสำนักงานเขตพื้นที่การศึกษา" style="width: 100%;" required>
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
                                <select id="area_id" name="area_id" required class="form-control selectpicker" data-live-search="true" title="เลือกสังกัด" style="width: 100%;" required>
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
                                <input type="email" class="form-control" name="email" placeholder="อีเมล" required>
                                <small><red>เช่น aaa@gmail.com</red></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="website">เว็บไซต์ <red>*</red></label>
                                <input type="text" class="form-control" name="website" placeholder="เว็บไซต์" required>
                                <small><red>เช่น http://yru.ac.th/</red></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tel">เบอร์โทรมือถือ / โทรสาร</label>
                            <input type="text" class="form-control" name="tel" placeholder="เบอร์โทรมือถือ" data-inputmask="'mask': '999-9999999'">
                            <small><red>เช่น 011-2345699 (ไม่ต้องใส่ขีด -)</red></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="chkLevel[]">สอนระดับชั้น</label>
                            <?php
                            $obj = $DATABASE->QueryObj("SELECT * FROM tb_level ORDER BY id");
                            foreach($obj as $row) {
                                $selected = "";
                                echo '<br><input type="checkbox" name="level[]" value="'.$row["name"].'"> '.$row["name"].'';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="prefix_id">คำนำหน้า <red>*</red></label>
                            <select id="prefix_id" name="prefix_id" class="form-control selectpicker" data-live-search="true" title="เลือกคำนำหน้า" style="width: 100%; " required>
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
                            <input type="text" class="form-control" name="boss_name" placeholder="ชื่อภาษาไทย" required>
                            <small><red>เช่น เอบีซี</red></small>
                        </div>
                        <div class="form-group">
                            <label for="boss_lname">สกุลภาษาไทย <red>*</red></label>
                            <input type="text" class="form-control" name="boss_lname" placeholder="สกุลภาษาไทย" required>
                            <small><red>เช่น ดีอีเอฟ</red></small>
                        </div>
                        <div class="form-group">
                            <label for="position">ตำแหน่ง <red>*</red></label>
                            <input type="text" class="form-control" name="position" placeholder="ตำแหน่ง" required>
                            <small><red>เช่น ผู้อำนวยการ (ป้อนชื่อเต็ม)</red></small>
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