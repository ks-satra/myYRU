<?php
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["project_id"];
?>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="page" value="<?php echo $PAGE; ?>">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มผู้รับผิดชอบโครงการ</h5>
            <div class="pull-right box-tools" style="margin-top: -25px;">
                <button type="button" class="btn btn-info btn-sm" title="ปิด" onClick="location.reload()"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="modal-body">
            <div class="row form-horizontal">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="admin_id" class="col-sm-3 control-label">
                            ชื่อ - สกุล <red>*</red>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" name="admin_id" required>
                                <option value="">- เลือกผู้รับผิดชอบ -</option>
                                <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_admin ORDER BY name");
                                foreach($obj as $row){
                                    echo '<option value="'.$row["id"].'">'.$row["name"].' '.$row["lname"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>   
            </div>
        </div>
    </div>
</div>
