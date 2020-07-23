<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $sql = "SELECT * FROM tb_teacher WHERE id='".$id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)==1 ) {
        $data = $obj[0];
        $prefix_name = $DATABASE->QueryString("SELECT name FROM tb_prefix WHERE id='".$data['prefix_id']."'");
?>
<script src="pages/user-admin-edit/view.js"></script>
<section class="content-header">
    <h1><i class="fa fa-registered"></i> ข้อมูลสมาชิก<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลสมาชิก</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">แก้ไขข้อมูลสมาชิก</h3>
            <i class="fa fa-angle-right"></i> <a href="Javascript:location.reload();"><?php echo $prefix_name ." ". $data['name_thai'] ." ". $data['lname_thai'];?></a>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/teacher-del/action.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <input type="hidden" name="photo" value="<?php echo $data['photo']; ?>">
            <a href="?content=teacher&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <a class="btn btn-warning btn" href="?content=teacher-edit&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>
            <a class="btn btn-info btn" href="?content=teacher-show&id=<?php echo $data['id']; ?>&page=<?php echo $PAGE; ?>" title="แสดงข้อมูล"><i class="fa fa-eye"></i> แสดงข้อมูล</a>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-default" style="background-color: #dbd6d6; height: 220px;">
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
                                include("pages/date.php");
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
                        <div class="box box-default" style="background-color: #dbd6d6; height: 220px;">
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
                        <div class="box box-default" style="background-color: #dbd6d6; height: 220px;">
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
                        <div class="box box-default" style="background-color: #dbd6d6; height: 250px;">
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
                        <div class="box box-default" style="background-color: #dbd6d6; height: 250px;">
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
                        <div class="box box-default" style="background-color: #dbd6d6; height: 250px;">
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
            </div>
            <div class="text-right">
                <button type="submit" onclick="return confirm('คุณต้องการลบรายชื่อนี้ใช่ไหม ?')" class="btn btn-danger" title="ยืนยันการลบข้อมูล"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูล</button> 
            </div>
        </form>
    </div>
</section>
<?php
    } else {
        //echo 'No data.';
        echo "
                <script>
                    location.href = '?content=pagenotfound';
                </script>
            ";
    }
?>