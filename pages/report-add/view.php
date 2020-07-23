<?php 
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<section class="content-header">
    <h1><i class="fa fa-bar-chart-o"></i> รายงานต่างๆ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">รายงานต่างๆ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มรายงานต่างๆ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/report-add/action.php" method="post">
            <a href="?content=report" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <div class="form-horizontal">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="report_id">
                            <a href='./?content=setting-report' title="ตั้งค่า"> 
                                <i class="fa fa-cog" style="color:rgb"></i>
                            </a> รายงาน <red>*</red>
                        </label>
                            <select class="form-control" name="report_id" required>
                                <option value="">- เลือกรายงาน -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_report ORDER BY name");
                                foreach($obj as $row){  
                                    echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fileupload">เอกสารแนบ <red>*</red></label>
                        <!-- <input type="file" id="fileupload" name="fileupload"> -->
                        <div style="position:relative;">
                            <a class='btn btn-success' href='javascript:;'>
                                Choose File... 
                                <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="fileupload" id="fileupload" size="40"  onchange='$("#upload-file-info").html($(this).val());' required>
                            </a>
                            &nbsp;
                            <span class='label label-success' id="upload-file-info"></span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-default" title="รีเฟรส" onClick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <button type="submit" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</section>