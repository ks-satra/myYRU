<?php 
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<script src="pages/project-add/view.js"></script>
<section class="content-header">
    <h1><i class="fa fa-book"></i> ข้อมูลโครงการ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลโครงการ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มข้อมูลโครงการ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/project-add/action.php" method="post">
            <a href="?content=project" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <p class="text-right color-red">* กรุณากรอกข้อมูลให้สมบูรณ์</p>
            <div class="form-horizontal">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>ชื่อโครงการไทย <red>*</red></label>
                        <input type="text" class="form-control" name="name_thai" placeholder="ชื่อโครงการไทย" required>
                    </div>
                    <div class="form-group">
                        <label>ชื่อโครงการอังกฤษ <red>*</red></label>
                        <input type="text" class="form-control" name="name_eng" placeholder="ชื่อโครงการอังกฤษ" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h2>ข้อมูลโครงการ</h2>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">วัตถุประสงค์</a></li>
                            <li><a data-toggle="tab" href="#menu1">ขอบเขต</a></li>
                            <li><a data-toggle="tab" href="#menu2">ขั้นตอนการดำเนินงาน</a></li>
                            <li><a data-toggle="tab" href="#menu4">ระยะเวลาการดำเนินงาน</a></li>
                            <li><a data-toggle="tab" href="#menu5">กิจกรรมต่าง ๆ</a></li>
                            <li><a data-toggle="tab" href="#menu6">ผลที่คาดว่าจะได้รับ</a></li>
                            <li><a data-toggle="tab" href="#menu7">ตัวชี้วัด</a></li>
                            <li><a data-toggle="tab" href="#menu8">งบประมาณ</a></li>
                            <li><a data-toggle="tab" href="#menu9">รายละเอียด</a></li>
                            <li><a data-toggle="tab" href="#menu3">สิ่งที่ส่งให้ สกว.</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>วัตถุประสงค์ <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_objective" name="p_objective" placeholder="วัตถุประสงค์" required="required"></textarea> -->
                                        <textarea id="p_objective" name="p_objective" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>ขอบเขต <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_scope" name="p_scope" placeholder="ขอบเขต" required="required"></textarea> -->
                                        <textarea id="p_scope" name="p_scope" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>ขั้นตอนการดำเนินงาน <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_operating" name="p_operating" placeholder="ขั้นตอนการดำเนินงาน" required="required"></textarea> -->
                                        <textarea id="p_operating" name="p_operating" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>การวิเคราะห์ข้อมูล <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_data_analysis" name="p_data_analysis" placeholder="การวิเคราะห์ข้อมูล" required="required"></textarea> -->
                                        <textarea id="p_data_analysis" name="p_data_analysis" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu4" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>ระยะเวลาการดำเนินงาน <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_processing_time" name="p_processing_time" placeholder="ระยะเวลาการดำเนินงาน" required="required"></textarea> -->
                                        <textarea id="p_processing_time" name="p_processing_time" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu5" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>กิจกรรมต่าง ๆ <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_activity" name="p_activity" placeholder="กิจกรรมต่าง ๆ" required="required"></textarea> -->
                                        <textarea id="p_activity" name="p_activity" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu6" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>ผลที่คาดว่าจะได้รับ <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_results" name="p_results" placeholder="ผลที่คาดว่าจะได้รับ" required="required"></textarea> -->
                                        <textarea id="p_results" name="p_results" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu7" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>ตัวชี้วัด <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_indicators" name="p_indicators" placeholder="ตัวชี้วัด" required="required"></textarea> -->
                                        <textarea id="p_indicators" name="p_indicators" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu8" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <label>งบประมาณ  <red>*</red></label>
                                        <!-- <textarea class="form-control" rows="15" id="p_budget" name="p_budget" placeholder="งบประมาณ" required="required"></textarea> -->
                                        <textarea id="p_budget" name="p_budget" rows="15" cols="80">
                                            กรุณาป้อนข้อมูลในกล่องนี้
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="menu9" class="tab-pane fade">
                                <div class="form-group">
                                    <div class='box-body pad'>
                                        <form>
                                            <label>รายละเอียด <red>*</red></label>
                                            <textarea id="description" name="description" rows="15" cols="80">
                                                กรุณาป้อนข้อมูลในกล่องนี้
                                            </textarea>
                                        </form>
                                    </div>
                                </div>  
                            </div>
                        </div>
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