<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<link href="pages/meeting-description-add/meeting.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>ตั้งค่าข้อมูลวาระ<small>การจัดการข้อมูลวาระ</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> การจัดการข้อมูลวาระ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">การจัดการข้อมูลวาระ</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <a href="?content=meeting-add" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a><br><br>
                <script>
                    var action = "";

                    function init() {
                        $("[name='btnEdit']").attr("disabled","disabled");
                        $("[name='btnDel']").attr("disabled","disabled");
                        action = "";
                    }

                    function onSubmit() {
                        var message = "";
                        if(action=="add") {
                            message = "คุณต้องการเพิ่มข้อมูลนี้ใช่ไหม ?";
                        } else if(action=="edit") {
                            message = "คุณต้องการแก้ไขข้อมูลนี้ใช่ไหม ?";
                        } else if(action=="del") {
                            message = "คุณต้องการลบข้อมูลนี้ใช่ไหม ?";
                        } else {
                            return false;
                        }
                        return confirm( message );
                    }

                    function fnReset() {
                        $("[name='btnAdd']").removeAttr("disabled");
                        $("[name='btnEdit']").attr("disabled","disabled");
                        $("[name='btnDel']").attr("disabled","disabled");
                    }

                    function fnManage(ctrl) {
                        var data = JSON.parse( $(ctrl).closest('tr').attr("data-json") );
                        $("[name='id']").val( data.id );
                        $("[name='name']").val( data.name );
                        $("[name='description']").val( data.description );
                        $("[name='btnAdd']").attr("disabled","disabled");
                        $("[name='btnEdit']").removeAttr("disabled");
                        $("[name='btnDel']").removeAttr("disabled");
                    }

                    $(function() {
                        init();
                        $("[name='btnAdd']").click(function() {
                            action = "add";
                        });
                        $("[name='btnEdit']").click(function() {
                            action = "edit";
                        });
                        $("[name='btnDel']").click(function() {
                            action = "del";
                        });
                    });
                </script>
                <?php

                    function showAlert($message) {
                        echo '
                            <script>
                                alert("'.$message.'");
                                location.href="./?content=meeting-agenda-add";
                            </script>
                        ';
                    }

                    if( isset($_POST["btnAdd"]) ) {
                        $id = $DATABASE->QueryMaxId("tb_meeting_agenda","id");
                        $name = $_POST["name"];
                        $description = $_POST["description"];
                        $sql = "
                            INSERT INTO tb_meeting_agenda (
                                id,
                                name,
                                description
                            ) VALUES (
                                '".$id."',
                                '".$name."',
                                '".$description."'
                            )
                        ";
                        $message = "";
                        if( $DATABASE->Query($sql) ) {
                            $message = "เพิ่มข้อมูลเรียบร้อยแล้ว.";
                        } else {
                            $message = "SQL Query Error !! ";
                        }
                        showAlert($message);
                    }
                    if( isset($_POST["btnEdit"]) ) {
                        $id = $_POST["id"];
                        $name = $_POST["name"];
                        $description = $_POST["description"];
                        $sql = "
                            UPDATE tb_meeting_agenda SET
                                name='".$name."',
                                description='".$description."'
                            WHERE id='".$id."'
                        ";
                        $message = "";
                        if( $DATABASE->Query($sql) ) {
                            $message = "แก้ไขข้อมูลเรียบร้อยแล้ว.";
                        } else {
                            $message = "SQL Query Error !! ";
                        }
                        showAlert($message);
                    }
                    if( isset($_POST["btnDel"]) ) {
                        $id = $_POST["id"];
                        $sql = "
                            DELETE FROM tb_meeting_agenda WHERE id='".$id."'
                        ";
                        $message = "";
                        if( $DATABASE->Query($sql) ) {
                            $message = "ลบข้อมูลเรียบร้อยแล้ว.";
                        } else {
                            $message = "SQL Query Error !! ";
                        }
                        showAlert($message);
                    }
                ?>
                <form class="form-horizontal" action="./?content=meeting-agenda-add" method="POST" onsubmit="return onSubmit();">
                    <div class="form-group col-md-12" align="center">
                        <input class="w3-input w3-animate-input text-center" id="name" name="name" type="text" align="center" style="width:90%" title="วาระที่" placeholder="วาระที่">
                    </div>
                    <div class="form-group col-md-12" align="center">
                        <input class="w3-input w3-animate-input text-center" id="description" name="description" type="text" align="center" style="width:90%" title="ชื่อวาระ" placeholder="ชื่อวาระ">
                    </div>
                    <div class="text-left" style="padding-left: 20px">
                        <button type="reset" name="btnReset" class="btn btn-default" onclick="fnReset()">ล้างข้อมูล</button>
                        <button type="submit" name="btnAdd" class="btn btn-success">ยืนยันเพิ่ม</button>
                        <button type="submit" name="btnEdit" class="btn btn-warning">ยืนยันการแก้ไข</button>
                        <button type="submit" name="btnDel" class="btn btn-danger">ยืนยันการลบ</button>
                    </div>
                </form>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-left">วาระที่</th>
                                    <th width="80%">ชื่อวาระ</th>
                                    <th class="text-right">จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM tb_meeting_agenda ORDER BY name";
                                    $obj = $DATABASE->QueryObj($sql);
                                    foreach($obj as $row){
                                        echo '
                                            <tr data-json="'.htmlspecialchars( json_encode($row) ).'">
                                                <td>'.$row["name"].'</td>
                                                <td>'.$row["description"].'</td>
                                                <td class="text-right" style="padding-right: 20px;">
                                                    <button class="btn btn-default btn-sm" onClick="fnManage(this)">จัดการ</button>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
