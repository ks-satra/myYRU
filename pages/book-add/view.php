<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
    <script src="pages/book/view.js"></script>
    <script src="pages/book-add/view.js"></script>
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
                <h3 class="box-title">เพิ่มข้อมูลหนังสือ</h3>
            </div>
            <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/book-add/action.php" method="post">
                <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                <a href="?content=book" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
                <div class="form-horizontal">
                    <div class="col-md-6">
                        <div class="form-group" align="center">
                            <div class="col-sm-offset-3 col-sm-9">
                                <a href="#" class="thumbnail" style="width: 250px; height: 250px; margin: 0px;">
                                    <img id="img_1" style="width: 100%;height: 100%;" src="files/img_teacher/<?php echo $data['photo']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)">
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
                                    foreach($obj as $row){
                                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group"> 
                            <label>ชื่อหนังสือ (ภาษาไทย) <red>*</red></label>
                            <input type="text" class="form-control" id="name_thai" placeholder="ชื่อหนังสือ (ภาษาไทย)" name="name_thai" required>
                        </div>
                        <div class="form-group"> 
                            <label>ชื่อหนังสือ (ภาษาอังกฤษ)</label>
                            <input type="text" class="form-control" id="name_eng" placeholder="ชื่อหนังสือ (ภาษาอังกฤษ)" name="name_eng">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>จำนวนหนังสือ / เล่ม </label>
                                <input type="number" class="form-control" name="qty" placeholder="จำนวนหนังสือ / เล่ม" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <!-- <label>ยอดคงเหลือ </label>
                                <input type="number" class="form-control" name="all" placeholder="ยอดคงเหลือ" required=""> -->
                            </div>
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
                                                กรุณากรอบข้อมูลที่นี้
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="btn0-group">
                                <label>เลือกไฟล์เอกสาร</label>
                                <input type="file" name="fileupload" id="fileupload" accept="file/*" onchange="FILE_RENDER(this, '#file_')">
                            </div>
                        </div>                        
                    </div>
                </div> 
                <div class="text-right">
                    <button type="button" class="btn btn-default" title="รีเฟรส" onClick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <button type="submit" onclick="return confirm('คุณต้องการเพิ่มข้อมูลนี้ใช่ไหม ?')" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>   
                </div>
            </form>
        </div>
    </section>