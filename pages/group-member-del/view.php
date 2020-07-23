<?php
	if( $USER==null ) {
        LINKTO("login.php");
    }
    
	$PAGE = isset($_GET["page"])?$_GET["page"]:"1";
	$id = $_GET["id"];
	$sql = "SELECT * FROM tb_group_member WHERE id='".$id."'";
	$obj =$DATABASE->QueryObj($sql);
	if( sizeof($obj)==1 ) {
		$data = $obj[0];
?>
	<script src="pages/group-member-edit/view.js"></script>
	<section class="content-header">
		<h1><i class="fa fa-user"></i> ข้อมูลผู้ดูแลระบบ<small></small></h1>
		<ol class="breadcrumb">
			<li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
			<li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้ดูแลระบบ</a></li>
		</ol>
	</section>
	<section class="content">
		<div class="box box-danger">
			<div class="box-header">
				<h3 class="box-title">ลบข้อมูลผู้ดูแลระบบ</h3>
			</div>
			<form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/group-member-del/action.php" method="post">
				<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
				<input type="hidden" name="page" value="<?php echo $PAGE; ?>">
				<a href="?content=group-member-edit&id=<?php echo $data['id'];?>&page=<?php echo $PAGE;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
				<div class="row form-horizontal" style="padding-top: 13px;">
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<a href="#" class="thumbnail" style="width: 200px; height: 200px; margin: 0px;">
									<img id="img_" style="width: 100%;height: 100%;" src="files/img_admin/<?php echo $data['fileupload']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)">
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row form-horizontal">
					<div class="col-md-12">
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">ชื่อ <red>*</red></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" placeholder="ชื่อ" value="<?php echo $data['name']; ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="col-sm-2 control-label"> รายละเอียด <red>*</red>
							</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="description" placeholder="รายละเอียด" required="required"><?php echo $data['description'];?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="text-right">
					<button type="submit" onclick="return confirm('คุณต้องการลบรายชื่อนี้ใช่ไหม ?')" class="btn btn-danger" title="ยืนยันการลบข้อมูล"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูล</button> 
				</div>
			</form>
		</div>
	</section>
	<?php
} else {
	echo 'No data.';
}
?>