<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<section class="content-header">
    <h1>ตั้งค่าข้อมูลชนิดหนังสือ<small>การจัดการข้อมูลชนิดหนังสือ</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> การจัดการข้อมูลชนิดหนังสือ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
          	<h3 class="box-title">การจัดการข้อมูลชนิดหนังสือ</h3>
        </div>
        <div class="box-body"> 
            <a href="?content=book-add" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
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
        					location.href="./?content=setting-type-book";
        				</script>
        			';
        		}

        		if( isset($_POST["btnAdd"]) ) {
        			$id = $DATABASE->QueryMaxId("tb_type_book","id");
        			$name = $_POST["name"];
        			$sql = "
						INSERT INTO tb_type_book (
							id,
							name
						) VALUES (
							'".$id."',
							'".$name."'
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
        			$sql = "
						UPDATE tb_type_book SET
							name='".$name."'
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
						DELETE FROM tb_type_book WHERE id='".$id."'
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
        	<form class="form-horizontal" action="./?content=setting-type-book" method="POST" onsubmit="return onSubmit();">
			  	<div class="form-group">
			    	<label for="id" class="col-sm-2 control-label">รหัสชนิดหนังสือ</label>
			    	<div class="col-sm-6">
			      		<input type="text" class="form-control" id="id" name="id" placeholder="รหัสชนิดหนังสือ" readonly="readonly">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="name" class="col-sm-2 control-label">ชื่อชนิดหนังสือ</label>
			    	<div class="col-sm-6">
			      		<input type="text" class="form-control" id="name" name="name" placeholder="ชื่อชนิดหนังสือ" required="required">
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
		            <th>ชื่อสถานะ</th>
		            <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        		$sql = "SELECT * FROM tb_type_book ORDER BY id";
		            $obj = $DATABASE->QueryObj($sql);
		            foreach($obj as $row){
		            	echo '
							<tr data-json="'.htmlspecialchars( json_encode($row) ).'">
					            <td>'.$row["id"].'</td>
					            <td>'.$row["name"].'</td>
					            <td>
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