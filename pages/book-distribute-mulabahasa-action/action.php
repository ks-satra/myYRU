<?php
	include("pages/book-distribute-mulabahasa/function.php");
    //PRINTR($_POST);
	
	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

    date_default_timezone_set("Asia/Bangkok");
    date_default_timezone_get();
    $date_start = date_create('now')->format('Y-m-d H:i:s');

    $id = $DATABASE->QueryMaxId("tb_get_book","id");
 	$table_ = getValue("table_");
    $details = array();
    
    try {
        $details = json_decode($table_, true);
        //var_dump($details);
    } catch(Exception $e) { }

    foreach ($details as $key => $value) {
        $sql = "
            INSERT INTO `tb_get_book`(
                id,
                type_book_id,
                book_id,
                school_id,
                teacher_id,
                qty,
                note,
                date_start
            ) VALUES (
                '".$id++."',
                '".$value["type_book_id"]."',
                '".$value["book_id"]."',
                '".$value["school_id"]."',
                '".$value["teacher_id"]."',
                '".$value["qty"]."',
                '".$value["note"]."',
                '".$date_start."'
            )
        ";
        $DATABASE->Query($sql);
    }
?>
<style>
    .body-success {
        text-align: center;
        font-size: 20px;
        padding: 50px;
    }
    .body-success i {
        font-size: 40px;
        margin-bottom: 20px;
        color: #26a506;
    }
    .desc-link {
        margin-top: 8px;
        font-size: 16px;
    }
</style>
<script type="text/javascript">
    $(function() {
        var time = 5;
        setInterval(function() {
            time--;
            $(".desc-link span").html(time);
            if( time==0 ) {
                window.location.href = "?content=book-distribute-mulabahasa";
            }
        }, 1000);
    })
</script>
<section class="content">
    <div class="box box-danger">
        <div class="box-body body-success">
            <i class="fa fa-check-circle-o"></i>
            <div class="message">เพิ่มข้อมูลสำเร็จ</div>
            <div class="desc-link">กรุณารอสักครู่ ระบบกำลังจะนำทางไปยังหน้าแรก <span></span> วินาที</div>
        </div>
    </div>
</section>






