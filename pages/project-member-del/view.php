<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $project_id = $_GET["project_id"];
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_project_member WHERE id='".$id."' AND project_id='".$project_id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
?> 
<section class="content-header">
    <h1><i class="fa fa-users"></i> ผู้รับผิดชอบโครงการ<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php //echo $content; ?>">ผู้รับผิดชอบโครงการ</a></li>
    </ol> -->
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">ลบรายงานต่างๆ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/project-member-del/action.php" method="post">
            <a href="?content=report" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <div class="form-horizontal">
                <div class="col-md-12" style="margin-top: 8px;">
                    <div class="form-group">
                        <label for="admin_id">ชื่อ - สกุล</label>
                            <select class="form-control" name="admin_id" readonly>
                                <option value="">- เลือกรายงาน -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_admin ORDER BY name");
                                foreach($obj as $row) {
                                        $selected = "";
                                        if( $data["admin_id"]==$row["id"] ) $selected = "selected";
                                        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].' '.$row["lname"].'</option>';
                                    }
                                ?>
                            </select>
                    </div>
                </div>
                <div class="text-right" >
                    <button type="submit" onclick="return confirm('คุณต้องการลบข้อมูลนี้ใช่ไหม ?')" class="btn btn-danger" title="ยืนยันการลบข้อมูล"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูล</button> 
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