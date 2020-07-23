<?php
	include("../../php/autoload.php");
	$page = $_REQUEST['page'];
	$id = $DATABASE->QueryMaxId("tb_book","id");	
	$type_book_id = $_REQUEST['type_book_id'];
	$type_book_id = $_REQUEST['type_book_id'];
	// $book_id = $DATABASE->QueryString("SELECT MAX(book_id) FROM tb_book WHERE book_type_id = '".$type_book_id."'");
	// $book_id = $book_id+1;
	$name_thai = $_REQUEST['name_thai'];
	$name_eng = $_REQUEST['name_eng'];

	$photo = $_FILES["filUpload_1"]["name"];	
	if( isset( $photo ) !="" ) {
		$temp_dir = "../../files/temp/";
		$file_dir = "../../files/img_book/";
		$ext = pathinfo($photo, PATHINFO_EXTENSION);
	    $photo = "photo".$id.'.'.$ext;
	    $no_photo = "photo".$id.'.';
	    if($photo == $no_photo){	 
	    	$photo = "";
	    }
		move_uploaded_file( $_FILES["filUpload_1"]["tmp_name"], $file_dir.$photo );
	}

	$fileupload = $_FILES["filUpload_2"]["name"];
	if( isset( $fileupload ) !="" ) {
		$temp_dir = "../../files/temp/";
		$file_dir = "../../files/file_book/";
		$ext = pathinfo($fileupload, PATHINFO_EXTENSION);
	    $fileupload = "fileupload".$id.'.'.$ext;
	    $no_fileupload = "fileupload".$id.'.';
	    if($fileupload == $no_fileupload){
	    	$fileupload = "";
	    }
		move_uploaded_file( $_FILES["filUpload_2"]["tmp_name"], $file_dir.$fileupload );
	}

	echo $sql = "INSERT INTO tb_book (id,book_type_id,name_thai,name_eng,photo,fileupload) VALUES('$id','$type_book_id','$name_thai','$name_eng','$photo','$fileupload')";
	$result = $DATABASE->Query($sql);
	if($result){
		echo "
			<script>
				location.href = '../../?content=book'; 
			</script>
		";
	}
?>