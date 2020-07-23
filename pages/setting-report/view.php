<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?> 
<section class="content-header">
    <h1><i class="fa fa-bar-chart-o"></i> ตั้งค่าข้อมูลรายงาน<small>การจัดการข้อมูลรายงาน</small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">การจัดการข้อมูลรายงาน</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
          	<h3 class="box-title">การจัดการข้อมูลรายงาน</h3>
        </div>
        <div class="box-body"> 
            <a href="?content=report-add" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
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
                    $("[name='year']").val( data.year );
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
        					location.href="./?content=setting-report";
        				</script>
        			';
        		}

        		if( isset($_POST["btnAdd"]) ) {
        			$id = $DATABASE->QueryMaxId("tb_report","id");
        			$name = $_POST["name"];
                    $year = $_POST["year"];
        			$sql = "
						INSERT INTO tb_report (
							id,
							name,
                            year
						) VALUES (
							'".$id."',
							'".$name."',
                            '".$year."'
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
                    $year = $_POST["year"];
        			$sql = "
						UPDATE tb_report SET
							name='".$name."',
                            year='".$year."'
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
						DELETE FROM tb_report WHERE id='".$id."'
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
        	<form class="form-horizontal" action="./?content=setting-report" method="POST" onsubmit="return onSubmit();">
			  	<div class="form-group">
			    	<label for="id" class="col-sm-2 control-label">ลำดับ</label>
			    	<div class="col-sm-6">
			      		<input type="text" class="form-control" id="id" name="id" placeholder="รหัสตำแหน่ง" readonly="readonly">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="name" class="col-sm-2 control-label">ชื่อรายงาน</label>
			    	<div class="col-sm-6">
			      		<input type="text" class="form-control" id="name" name="name" placeholder="ชื่อตำแหน่ง" required="required">
			    	</div>
			  	</div>
                <div class="form-group">
                    <label for="year" class="col-sm-2 control-label">ประจำปี</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" id="year" name="year" placeholder="ประจำปี" required="required">
                    </div>
                </div>
			  	<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				    	<button type="reset" name="btnReset" class="btn btn-default" onclick="fnReset()">ล้างข้อมูล</button>
				      	<button type="submit" name="btnAdd" class="btn btn-success">ยืนยันเพิ่ม</button>
				      	<button type="submit" name="btnEdit" class="btn btn-warning">ยืนยันการแก้ไข</button>
				      	<button type="submit" name="btnDel" class="btn btn-danger">ยืนยันการลบ</button>
				    </div>
				</div>
			</form>
        	<table class="table table-hover">
	        <thead>
	            <tr>
		            <th>ลำดับ</th>
		            <th>ชื่อรายงาน</th>
		            <th>ประจำปี</th>
                    <th class="text-right"></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        		$sql = "SELECT * FROM tb_report ORDER BY id";
		            $obj = $DATABASE->QueryObj($sql);
		            foreach($obj as $row){
		            	echo '
							<tr data-json="'.htmlspecialchars( json_encode($row) ).'">
					            <td>'.$row["id"].'</td>
					            <td>'.$row["name"].'</td>
                                <td>'.$row["year"].'</td>
					            <td class="text-right">
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
</section>