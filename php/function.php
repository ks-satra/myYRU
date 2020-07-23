<?php
	function LINKTO($url) {
		echo '
			<script>
				window.location.href = "'.$url.'";
			</script>
		';
		exit();
	}
	function PRINTR($data) {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	function UPLOAD_FILE_TEMP($filetemp,$filedir) { 
		// Example.
		// UPLOAD_FILE_TEMP( $_FILE['userfile']['tmp_name'], 'dir/file001.jpg' )
		if( file_exists($filedir) ) unlink($filedir);
		move_uploaded_file($filetemp,$filedir);
	}
	function MOVE_FILE($oldfile,$newfile) {
		// Example.
		// MOVE_FILE( 'dir1/file00.jpg', 'dir2/file001.jpg' )
		if( file_exists($newfile) ) unlink($newfile);
		rename( $oldfile,$newfile );
	}