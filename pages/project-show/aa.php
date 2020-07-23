<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["project_id"];
    $sql = "SELECT * FROM tb_project WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0]; 
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
            <h3 class="box-title">แสดงข้อมูลโครงการ</h3>
        </div>
            <form class="box-body" id="frm-data" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <a href="?content=project" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <a href="?content=project-edit&project_id=<?php echo $id;?>&page=<?php echo $PAGE;?>" class="btn btn-warning" title="แก้ไขข้อมูลโครงการ"><i class="fa fa-edit"></i> แก้ไขข้อมูลโครงการ</a>
            <a href="?content=project-del&project_id=<?php echo $id;?>&page=<?php echo $PAGE;?>" class="btn btn-danger" title="ลบข้อมูลโครงการ"><i class="fa fa-trash"></i> ลบข้อมูลโครงการ</a>
            <div class="form-group" style="margin-top: 10px;">
                <label>ชื่อโครงการไทย</label>
                <input type="text" class="form-control" name="name_thai" placeholder="ชื่อโครงการไทย" value="<?php echo $data['name_thai'];?>" readonly>
            </div>
            <div class="form-group">
                <label>ชื่อโครงการอังกฤษ</label>
                <input type="text" class="form-control" name="name_eng" placeholder="ชื่อโครงการอังกฤษ" value="<?php echo $data['name_eng'];?>" readonly>
            </div>
            <div class="form-group">
                <div class="table-responsive" >
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
                                    <label>วัตถุประสงค์ </label>
                                    <textarea id="p_objective" name="p_objective" rows="15" cols="80">
                                        <?php echo $data['p_objective'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <label>ขอบเขต </label>
                                    <textarea id="p_scope" name="p_scope" rows="15" cols="80">
                                        <?php echo $data['p_scope'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <label>ขั้นตอนการดำเนินงาน </label>
                                    <textarea id="p_operating" name="p_operating" rows="15" cols="80">
                                        <?php echo $data['p_operating'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <label>การวิเคราะห์ข้อมูล</label>
                                    <textarea id="p_data_analysis" name="p_data_analysis" rows="15" cols="80">
                                        <?php echo $data['p_data_send'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <label>ระยะเวลาการดำเนินงาน </label>
                                    <textarea id="p_processing_time" name="p_processing_time" rows="15" cols="80">
                                        <?php echo $data['p_processing_time'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu5" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <label>กิจกรรมต่าง ๆ </label>
                                    <textarea id="p_activity" name="p_activity" rows="15" cols="80">
                                        <?php echo $data['p_activity'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu6" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <label>ผลที่คาดว่าจะได้รับ </label>
                                    <textarea id="p_results" name="p_results" rows="15" cols="80">
                                        <?php echo $data['p_results'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu7" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <label>ตัวชี้วัด </label>
                                    <textarea id="p_indicators" name="p_indicators" rows="15" cols="80">
                                        <?php echo $data['p_indicators'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu8" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <label>งบประมาณ </label>
                                    <textarea id="p_budget" name="p_budget" rows="15" cols="80">
                                        <?php echo $data['p_budget'];?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div id="menu9" class="tab-pane fade">
                            <div class="form-group">
                                <div class='box-body pad'>
                                    <form>
                                        <label>รายละเอียด</label>
                                        <textarea id="description" name="description" rows="15" cols="80">
                                            <?php echo $data['description'];?>
                                        </textarea>
                                    </form>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                function fileupload() {
                    if( confirm('คุณต้องการแก้ไขใช่ไหม?') ) {
                        $("#fileupload").html('\
                            <input type="file" name="fileupload">\
                            <p class="help-block">ยังไม่ได้เลือกไฟล์</p>\
                            ');
                    }
                }
            </script>
            <div class="form-group" style="margin: 23px; margin-top: -25px;">
                <label for="fileupload">เอกสารแนบ</label>
                <div id="fileupload">
                    <?php
                    if( $data['fileupload']!='' ) {
                        echo '
                        <div>
                        <a href="files/file_project/'.$data['fileupload'].'" target="_blank">'.$data['fileupload'].'</a>
                        </div>';
                    } else {
                        echo '
                        <input type="file" name="fileupload">
                        ';
                    }
                    ?>
                </div>
            </div>
            <?php include("pages/project-member/view.php");?>
            <div style="color: #fff;">p</div>
        </form>
    </div>
</section>

<?php
    } else {
        echo 'No data.';
    }
?>