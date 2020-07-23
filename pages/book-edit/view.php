<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_book WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
    $data = $obj[0];
?>
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
        <h1><i class="glyphicon glyphicon-book"></i> ข้อมูลหนังสือ<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
            <li><a href="?content=<?php echo $content; ?>">ข้อมูลหนังสือ</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">แก้ไขข้อมูลหนังสือ</h3>
            </div>
            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/book-edit/action.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                <a href="?content=book-show&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                <a class="btn btn-info btn" href="?content=book-show&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แสดงข้อมูล"><i class="fa fa-eye"></i> แสดงข้อมูล</a>
                <a class="btn btn-danger btn" href="?content=book-del&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="ลบข้อมูล"><i class="fa fa-trash"></i> ลบข้อมูล</a>
                <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
                <div class="form-horizontal">
                    <div class="col-md-6">
                        <div class="form-group" align="center">
                            <div class="col-sm-offset-3 col-sm-9">
                                <a href="#" class="thumbnail" style="width: 300px; height: 300px; margin: 0px;">
                                    <img id="img_1" style="width: 100%;height: 100%;" src="files/img_book/<?php echo $data['photo']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)"> 
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="position:relative;">
                                <a class='btn btn-info' href='javascript:;'>
                                    เลือกภาพหลัก... 
                                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="filUpload_1" id="filUpload_1" size="40" accept="image/*" onchange="IMAGE_RENDER(this, '#img_1').val();">
                                </a>
                                &nbsp;
                                <span class='label label-success' id="upload-file-info"></span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">   
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="type_book_id" class="control-label">
                                <a href='./?content=setting-type-book' title="ตั้งค่า"> 
                                    <i class="fa fa-cog" style="color:rgb"></i>
                                </a> ชนิดหนังสือ <red>*</red>
                            </label>
                            <select class="form-control selectpicker" name="type_book_id" data-live-search="true" required>
                                <option value="">- เลือกชนิดหนังสือ -</option>
                                <?php
                                    $obj = $DATABASE->QueryObj("SELECT * FROM tb_type_book ORDER BY name");
                                    foreach($obj as $row) {
                                        $selected = "";
                                        if( $data["book_type_id"]==$row["id"] ) $selected = "selected";
                                        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group"> 
                            <label>ชื่อหนังสือ (ภาษาไทย) <red>*</red></label>
                            <input type="text" class="form-control" id="name_thai" placeholder="ชื่อหนังสือ (ภาษาไทย)" name="name_thai" value="<?php echo $data['name_thai'];?>" required>
                        </div>
                        
                        <div class="form-group"> 
                            <label>ชื่อหนังสือ (ภาษาอังกฤษ)</label>
                            <input type="text" class="form-control" id="name_eng" placeholder="ชื่อหนังสือ (ภาษาอังกฤษ)" name="name_eng" value="<?php echo $data['name_eng'];?>">
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>จำนวนหนังสือ / เล่ม </label>
                                <input type="number" class="form-control" name="qty" placeholder="จำนวนหนังสือ / เล่ม" required="" value="<?php echo $data['qty'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <!-- <label>ยอดคงเหลือ </label>
                                <input type="number" class="form-control" name="all" placeholder="ยอดคงเหลือ" required=""> -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#description">รายละเอียด</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="description" class="tab-pane fade in active">
                                        <div class="form-group">
                                            <div class='box-body pad'>
                                                <label>รายละเอียด <red>*</red></label>
                                                <textarea id="description" name="description" rows="15" cols="80">
                                                    <?php echo $data['description'];?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fileupload">เลือกไฟล์เอกสาร</label>
                            <div id="fileupload_wrapper">
                            <?php
                                if( $data['fileupload']!="" ) {
                                    echo '
                                    <div>
                                        <a href="files/file_book/'.$data['fileupload'].'" target="_blank">'.$data['fileupload'].'</a>
                                         <button type="button" href="javascript: " onclick="ckange_fileupload()" class="btn btn-warning btn-sm" title="แก้ไข"><i class="fa fa-edit"></i></button>
                                        
                                    </div>';
                                } else {
                                    // echo '
                                    //     <input type="file" name="filUpload_2">
                                    // ';
                                ?>
                                <input type="file" name="filUpload_2" id="filUpload_2" accept="file/*" onchange="FILE_RENDER(this, '#file_')">
                                <?php
                                }
                            ?>
                            </div>
                        </div>
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