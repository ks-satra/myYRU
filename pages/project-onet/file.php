

<script src="pages/project-onet/fileupload.js"></script>
<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<section class="content-header">
    <h1><i class="fa fa-file"></i> ข้อมูลการศึกษาไทย<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลการศึกษาไทย</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลการศึกษาไทยทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="project">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <!-- <a href="?content=project-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=project'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาโครงการ" value="<?php //echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a> -->
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div class="form-group">
                <label for="fileupload" class="col-sm-3 control-label">เลือกเอกสาร </label>
                <div class="col-sm-9">
                    <input type="file" name="fileupload" id="fileupload" accept="file/*" onchange="FILE_RENDER(this, '#file_')">
                </div>
            </div>
        </div>
    </div>
</section>