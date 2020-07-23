<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    include("pages/date.php");
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $school_id = $_GET["school_id"];
    $sql = "SELECT * FROM tb_teacher WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
?>
<section class="content-header">
    <h1><i class="glyphicon glyphicon-book"></i> รายละเอียดคนที่รับหนังสือ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">รายละเอียดคนที่รับหนังสือ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">แดสดงรายละเอียดคนที่รับหนังสือ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/person-add/action.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <a href="?content=book-distribute&school_id=<?php echo $data['school_id']; ?>&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <a class="btn btn-warning btn" href="?content=teacher-edit&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>

            <?php 
                $DEL_PERSON = $DATABASE->QueryString("SELECT teacher_id FROM tb_get_book WHERE teacher_id='".$data['id']."'");
                if($DEL_PERSON != Null){
              
            ?>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-trash"></i> ลบข้อมูล
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #780808; color: #fff;">
                                <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <script type="text/javascript" src="//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
                                <center><h4><i class="glyphicon glyphicon-trash"></i> กรุณาลบข้อมูลรายการหนังสือก่อน</h4></center>
                            </div>
                            <div class="modal-footer" style="background-color: #780808; color: #fff;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
               } else {
            ?>
                <a class="btn btn-danger btn" href="?content=teacher-del&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="ลบข้อมูล"><i class="fa fa-trash"></i> ลบข้อมูล</a>
            <?php    
                }
            ?>
            
            <a class="btn btn-success btn" href="report/report-teacher/view.php?id=<?php echo $id;?>" title="พิมพ์ข้อมูล" style="background-color: #ff65a5; border-color: #ff65a5;"><i class="fa fa-print"></i> พิมพ์ข้อมูล</a>
            <div class="panel-body" style="margin-top: 10px;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-user" aria-hidden="true"></i> ข้อมูลบุคลากร</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href="#" class="thumbnail" style="width: 150px; height: 150px; margin: 0px;">
                                                <img id="img_" style="width: 100%;height: 100%;" src="files/img_teacher/<?php echo $data['photo']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)"> 
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $data['card']; ?></p>
                                        <p><?php
                                        $PREFIX_NAME = $DATABASE->QueryString("SELECT name FROM tb_prefix WHERE id='".$data['prefix_id']."'");
                                        echo $PREFIX_NAME;
                                        ?><?php echo $data['name_thai']; ?> <?php echo $data['lname_thai']; ?>
                                    </p>
                                    <p><?php
                                        $PREFIX_NAME_ENG = $DATABASE->QueryString("SELECT abbreviation FROM tb_prefix WHERE id='".$data['prefix_id']."'");
                                        ?><?php echo $PREFIX_NAME_ENG; ?><?php echo $data['name_eng']; ?> <?php echo $data['lname_eng']; ?>
                                    </p>
                                    <p>เพศ <?php 
                                        $SEX_NAME = $DATABASE->QueryString("SELECT name FROM tb_sex WHERE id='".$data['sex_id']."'");
                                            echo $SEX_NAME;?></p>
                                    <p>วันเกิด : <?php
                                        $all = $DATABASE->QueryNumRow($sql);
                                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_teacher.id");
                                        if(sizeof($DATA)>0){
                                            foreach($DATA as $row){
                                                $strDate = $row['birthday'];
                                                echo DateThai($strDate);
                                            }
                                        }
                                    ?></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-phone" aria-hidden="true"></i> การติดต่อ</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#"><i class="fa fa-phone" aria-hidden="true" style="color: #bc1616;"></i> <b>มือถือ :</b> <?php echo $data['tel']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true" style="color: #0f6c09;"></i> <b>อีเมล :</b> <?php echo $data['email']; ?></a></li>
                                                <li><a href="#"><img src="files/img/line.png" style="width: 5%; height: 5%;"><b>ไลน์ :</b>  lll</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-home" aria-hidden="true"></i> ที่อยู่ตามสำเนา</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><i class="fa fa-home" aria-hidden="true"></i> <b>ที่อยู่ :</b> <?php echo $data['no']; ?> <b>หมู่ที่ :</b> <?php echo $data['mu']; ?> <b>หมู่บ้าน :</b> <?php echo $data['village']; ?> </p>
                                        <p><b>ตรอก / ซอย :</b> 
                                            <?php 
                                                echo $data['alley']; 
                                            ?> / <?php echo $data['byway']; ?> <b>ตำบล : </b>  
                                            <?php 
                                                $DISTRICT_NAME = $DATABASE->QueryString("SELECT name FROM tb_district WHERE id='".$data['district_id']."'");
                                                echo $DISTRICT_NAME; 
                                            ?> <b>อำเภอ : </b>  
                                            <?php 
                                                $AMPHUR_NAME = $DATABASE->QueryString("SELECT name FROM tb_amphur WHERE id='".$data['amphur_id']."'");
                                                echo $AMPHUR_NAME; 
                                            ?> <b>จังหวัด : </b>  
                                            <?php 
                                                $PROVINCE_NAME = $DATABASE->QueryString("SELECT name FROM tb_province WHERE id='".$data['province_id']."'");
                                                echo $PROVINCE_NAME; 
                                            ?> <?php echo $data['passcode'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-history" aria-hidden="true"></i> ประวัติโดยย่อ</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#"><i class="fa fa-circle-o text-black" aria-hidden="true"></i> <b>จบจากสถาบัน : </b> <?php echo $data['alumni']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-circle-o text-red" aria-hidden="true"></i> <b>จากปี : </b> <?php echo $data['buddhist_era_start']; ?> <b>ถึงปี : </b> <?php echo $data['buddhist_era_end']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-circle-o text-green" aria-hidden="true"></i> <b>คณะ : </b> <?php echo $data['faculty']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-circle-o text-orange" aria-hidden="true"></i> <b>สาขา : </b> <?php echo $data['branch']; ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-history" aria-hidden="true"></i> ประวัติการสอน</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#"><i class="fa fa-circle-o text-black" aria-hidden="true"></i>  <b>สอนระดับชั้น :</b> <?php echo $data['level']; ?></a></li>
                                                <li><a href="#"><i class="fa fa-circle-o text-red" aria-hidden="true"></i> <b>กลุ่มสาระวิชา :</b> <?php echo $data['topics']; ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 400px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-building" aria-hidden="true"></i> โรงเรียน</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <?php
                                                    $sql = "
                                                        SELECT
                                                            tb_school.id,
                                                            tb_school.`code`,
                                                            tb_school.`name`,
                                                            tb_school.`no`,
                                                            tb_school.mu,
                                                            tb_school.road,
                                                            tb_school.alley,
                                                            tb_school.village,
                                                            tb_school.district_id,
                                                            tb_school.amphur_id,
                                                            tb_school.province_id,
                                                            tb_school.passcode,
                                                            tb_school.lat,
                                                            tb_school.lng,
                                                            tb_school.department_id,
                                                            tb_school.area_id,
                                                            tb_school.email,
                                                            tb_school.website,
                                                            tb_school.tel,
                                                            tb_school.start_end_school,
                                                            tb_school.prefix_name,
                                                            tb_school.boss_name,
                                                            tb_school.boss_lname,
                                                            tb_school.position,
                                                            tb_district.`name` as school_district_name,
                                                            tb_amphur.`name` as school_amphur_name,
                                                            tb_amphur.passcode,
                                                            tb_province.`name` As school_province_name
                                                        FROM
                                                            tb_school
                                                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                                                        WHERE tb_school.id = '".$data['school_id']."'";
                                                    $all = $DATABASE->QueryNumRow($sql);
                                                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_school.id");
                                                    if(sizeof($DATA)>0){
                                                        foreach($DATA as $row){
                                                ?>
                                                <li>
                                                    <a href="#"><i class="fa fa-building" aria-hidden="true"></i> <b>ชื่อโรงเรียน : </b> 
                                                        <?php echo $row['name'];?>
                                                    </a>
                                                </li>
                                                 <li>
                                                    <a href="#"><i class="fa fa-circle-o text-black"></i> <b>รหัสโรงเรียน : </b> 
                                                        <?php echo $row['code'];?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fa fa-circle-o text-green"></i> <b>ที่อยู่ :</b> <?php echo $row['no']; ?> <b>หมู่ที่ : </b> <?php echo $row['mu']; ?> <?php echo $row['village']; ?> <b>ตรอก / ซอย : </b>  <?php echo $row['alley']; ?> / <?php echo $row['road']; ?> <b>ตำบล : </b> <?php echo $row['school_district_name']; ?> <b>อำเภอ : </b>  <?php echo $row['school_amphur_name']; ?> <b>จังหวัด : </b>  <?php echo $row['school_province_name']; ?>
                                                    </a>
                                                </li>
                                                <?php 
                                                        }
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid" style="background-color: #dbd6d6;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-book" aria-hidden="true"></i> ชื่อหนังสือ 
                                </h4>
                                <?php $type_book_id = $DATABASE->QueryString("SELECT type_book_id FROM tb_get_book WHERE teacher_id = '".$data['id']."'"); ?>
                                <?php $book_id = $DATABASE->QueryString("SELECT book_id FROM tb_get_book WHERE teacher_id = '".$data['id']."'"); ?>
                                <a class="btn btn-warning btn-sm" href="?content=book-distribute-edit&id=<?php echo $data['id']; ?>&school_id=<?php echo $data['school_id']; ?>&page=<?php echo $PAGE; ?>" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i></a>
                                <div class="box-tools text-right">
                                    <p><?php 
                                        $COUNT_BOOK = $DATABASE->QueryString("SELECT COUNT(DISTINCT (book_id)) FROM tb_get_book WHERE teacher_id = '".$data['id']."'");
                                        $COUNT_QTY = $DATABASE->QueryString("SELECT SUM(QTY) FROM tb_get_book WHERE teacher_id = '".$data['id']."'");
                                        echo $COUNT_BOOK;
                                    ?> เรื่อง <?php echo $COUNT_QTY;?> เล่ม</p>
                                </div>
                            </div>
                            <?php
                                $sql = "
                                    SELECT
                                        tb_get_book.id,
                                        tb_get_book.type_book_id,
                                        tb_get_book.book_id,
                                        tb_get_book.qty,
                                        tb_get_book.teacher_id,
                                        tb_get_book.school_id,
                                        tb_get_book.note,
                                        tb_get_book.date_start,
                                        Count(tb_get_book.qty) As BOOK_QTY,
                                        tb_book.name_thai As BOOK_THAI,
                                        tb_book.name_eng
                                    FROM
                                        tb_get_book
                                        INNER JOIN tb_book ON tb_get_book.book_id = tb_book.id
                                    WHERE tb_get_book.teacher_id = '".$data['id']."'
                                    GROUP BY tb_get_book.book_id
                                    ";
                                $all = $DATABASE->QueryNumRow($sql);
                                $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_get_book.id DESC");
                                if(sizeof($DATA)>0){ 
                                    foreach($DATA as $key => $row){
                            ?>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked"> 
                                    <?php
                                        if($row['BOOK_QTY'] == 1){
                                    ?>
                                        <?php if($row['qty'] == 1) { ?>
                                            <li><a href="#" style="color: #00a65a;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                            <span class="label label-success pull-right"><?php echo $row['qty'];?></span></a></li>
                                        <?php } else if ($row['qty'] == 2){ ?>
                                            <li><a href="#" style="color: #f8b621;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                            <span class="label label-warning pull-right" style="background-color: #f8b621;"><?php echo $row['qty'];?></span></a></li>
                                        <?php } else if ($row['qty'] == 3){ ?>
                                            <li><a href="#" style="color: #d9750b;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                            <span class="label label-warning pull-right" style="background-color: #d9750b;"><?php echo $row['qty'];?></span></a></li>
                                        <?php } else { ?>
                                            <li><a href="#" style="color: #ff0023;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                            <span class="label label-danger pull-right" style="background-color: #ff0023;"><?php echo $row['qty'];?></span></a></li>
                                        <?php } ?> 
                                    <?php
                                        } else {
                                    ?>
                                        <?php if($row['BOOK_QTY'] == 1) { ?>
                                            <li><a href="#" style="color: #00a65a;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                            <span class="label label-success pull-right"><?php echo $row['BOOK_QTY'];?></span></a></li>
                                        <?php } else if ($row['BOOK_QTY'] == 2){ ?>
                                            <li><a href="#" style="color: #f8b621;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                            <span class="label label-warning pull-right" style="background-color: #f8b621;"><?php echo $row['BOOK_QTY'];?></span></a></li>
                                        <?php } else if ($row['BOOK_QTY'] == 3){ ?>
                                            <li><a href="#" style="color: #d9750b;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                            <span class="label label-warning pull-right" style="background-color: #d9750b;"><?php echo $row['BOOK_QTY'];?></span></a></li>
                                        <?php } else { ?>
                                            <li><a href="#" style="color: #ff0023;"><i class="fa fa-file-text-o"></i> <?php echo $row['BOOK_THAI'];?>
                                            <span class="label label-danger pull-right" style="background-color: #ff0023;"><?php echo $row['BOOK_QTY'];?></span></a></li>
                                        <?php } ?> 
                                    <?php
                                        } 
                                    ?>
                                </ul>
                            </div>
                            <?php 
                                }
                            }else{
                                echo '<br>';
                                echo "<div colspan='6' align='center'><i>ไม่มีข้อมูล</i></div>";
                                echo '<br>';
                            }
                        ?>
                        </div>
                    </div>
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