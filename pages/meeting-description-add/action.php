<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $_REQUEST['id'];
	$type_book_id = $_REQUEST['type_book_id'];
	$name_thai = $_REQUEST['name_thai'];
	$name_eng = $_REQUEST['name_eng'];


	$photo = $_FILES["filUpload_1"]["name"];
	if($photo != null){
		$update_photo = "";
		if( isset( $photo ) !="" ) {
			// remove image
			$sql = "SELECT * FROM tb_book WHERE id='".$id."'";
			$obj = $DATABASE->QueryObj($sql);
			unlink("../../files/img_book/".$obj[0]["photo"]);

			$file_dir = "../../files/img_book/";
			$ext = pathinfo($photo, PATHINFO_EXTENSION);
		    $photo = "photo".$id.'.'.$ext;
		    $update_photo = $photo;
		    $no_photo = "photo".$id.'.';
		    if($photo == $no_photo){	 
		    	$update_photo = "";
		    }
			move_uploaded_file( $_FILES["filUpload_1"]["tmp_name"], $file_dir.$update_photo );
		}
	} else {
		$PHOTO = $DATABASE->QueryString("SELECT photo FROM tb_book WHERE id='".$id."'");
		$update_photo = $PHOTO;
	}

	$fileupload = $_FILES["filUpload_2"]["name"];
	if($fileupload != null){
		$update_fileupload = "";
		if( isset( $fileupload ) !="" ) {
			// remove image
			$sql = "SELECT * FROM tb_book WHERE id='".$id."'";
			$obj = $DATABASE->QueryObj($sql);
			unlink("../../files/file_book/".$obj[0]["fileupload"]);

			$file_dir = "../../files/file_book/";
			$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
		    $fileupload = "fileupload".$id.'.'.$ext;
		    $update_fileupload = $fileupload;
		    $no_fileupload = "fileupload".$id.'.';
		    if($fileupload == $no_fileupload){	 
		    	$update_fileupload = "";
		    }
			move_uploaded_file( $_FILES["filUpload_2"]["tmp_name"], $file_dir.$update_fileupload );
		}
	} else {
		$FILEUPLOAD = $DATABASE->QueryString("SELECT fileupload FROM tb_book WHERE id='".$id."'");
		$update_fileupload = $FILEUPLOAD;
	}

	$sql = "
		UPDATE tb_book SET 
			book_type_id = '$type_book_id',
			name_thai = '$name_thai',
			name_eng = '$name_eng',
			photo = '$update_photo',
			fileupload = '$update_fileupload'
			WHERE id = '$id'
		";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=book&id=".$id."&page=".$page."';
			</script>
		";
	}
?>