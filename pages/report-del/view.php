<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_fileupload_report WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
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
            <h3 class="box-title">ลบรายงานต่างๆ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/report-del/action.php" method="post">
            <a href="?content=report" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <div class="form-horizontal">
                <div class="col-md-12" style="margin-top: 8px;">
                    <div class="form-group">
                        <label for="report_id">รายงาน</label>
                            <select class="form-control" name="report_id" readonly>
                                <option value="">- เลือกรายงาน -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_report ORDER BY name");
                                foreach($obj as $row) {
                                        $selected = "";
                                        if( $data["report_id"]==$row["id"] ) $selected = "selected";
                                        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                    }
                                ?>
                            </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fileupload">เอกสารแนบ</label>
                        <div style="position:relative;">
                            <?php
                                if( $data['fileupload']!='' ) {
                                    echo '
                                    <div>
                                    <a href="files/file_report/'.$data['fileupload'].'" target="_blank">'.$data['fileupload'].'</a>
                                    
                                    </div>';
                                } else {
                                    echo '
                                    <input type="file" name="fileupload">
                                    ';
                                }
                            ?>
                        </div>
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