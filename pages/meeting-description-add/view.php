<?php
    include("pages/meeting/meeting-date.php");
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_meeting_description WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
    $data = $obj[0];
?>
    <link href="pages/meeting-description-add/meeting.css" rel="stylesheet" type="text/css" />
    <script src="pages/book/view.js"></script>
    <script src="pages/book-add/view.js"></script>
    <script type="text/javascript">
        function ckange_fileupload() {
            if( confirm('คุณต้องการแก้ไขใช่ไหม?') ) {
                $("#fileupload_wrapper").html('\
                    <input type="file" name="filUpload_2">\
                    <p class="help-block">ยังไม่ได้เลือกไฟล์</p>\
                    ');
            }
        }
    </script>
    <script type="text/javascript">
        $(function () {
            CKEDITOR.replace('description');
            $(".textarea").wysihtml5();
        });
    </script>
    <section class="content-header">
        <h1><i class="glyphicon glyphicon-book"></i> ข้อมูลรายละเอียดวาระ<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
            <li><a href="?content=<?php echo $content; ?>">ข้อมูลรายละเอียดวาระ</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">แก้ไขข้อมูลรายละเอียดวาระ</h3>
            </div>
            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/book-edit/action.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                <a href="?content=meeting-description-add&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                <a class="btn btn-info btn" href="?content=book-show&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แสดงข้อมูล"><i class="fa fa-eye"></i> แสดงข้อมูล</a>
                <a class="btn btn-danger btn" href="?content=book-del&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="ลบข้อมูล"><i class="fa fa-trash"></i> ลบข้อมูล</a>
                <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
                <div class="box-body" style="margin-top: 0px;">
                    <div class="row">
                        <label><?php //echo $data["name"];?> <?php //echo $data["description"];?></label>
                        <textarea class="w3-input w3-animate-input" name="textarea" rows="6" cols="50">รายละเอียด</textarea><br>
                    </div>
                    <form class="form-horizontal">
                        <?php
                            $a_name = $DATABASE->QueryString("SELECT name FROM tb_admin WHERE id='".$_SESSION["data_id"]."'");
                            $a_lname = $DATABASE->QueryString("SELECT lname FROM tb_admin WHERE id='".$_SESSION["data_id"]."'");
                        ?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ชื่อผู้ใช้งาน : </label>
                            <div class="col-sm-9">
                                <?php echo $a_name;?> <?php echo $a_lname;?>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ชื่อผู้ใช้งาน : </label>
                            <div class="col-sm-9">
                                <select class="form-control selectpicker" name="type_book_id" data-live-search="true" required>
                                    <option value="">- เลือกชื่อผู้ใช้ -</option>
                                    <?php
                                        $obj = $DATABASE->QueryObj("SELECT * FROM tb_member ORDER BY name");
                                        foreach($obj as $row){
                                            echo '<option value="'.$row["id"].'">'.$row["name"].' '.$row["lname"].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    <label>รายละเอียด <red>*</red></label>
                    <textarea id="description" name="description" rows="15" cols="80">
                        กรุณากรอบข้อมูลที่นี้
                    </textarea><br>
                    <label>มติที่ประชุม</label>
                    <input class="w3-input w3-animate-input" type="text" style="width:90%"><br>
                    </div> 
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-default" title="รีเฟรส" onClick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <button type="submit" onclick="return confirm('คุณต้องการแก้ไขข้อมูลนี้ใช่ไหม ?')" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>   
                </div>
            </form>
        </div>
    </section>
    <?php
} else {
    echo 'ไม่พบข้อมูล';
}
?>