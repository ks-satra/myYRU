<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $id = $_GET["id"];
    $school_id = $_GET["school_id"];
    $sql = "SELECT * FROM tb_get_book WHERE teacher_id='".$id."' AND school_id='".$school_id."'";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)>0 ) {
        $data = $obj[0];
?>
<script type="text/javascript">
    function alertPassword() {
        if( $("[name='password_']").val() == "" ) {
            alert('กรุณาไม่ป้อนรหัสผ่าน');
            $("[name='password_']").focus();
            return false;
        }
        if( $("[name='confirm_password_']").val() == "" ) {
            alert('กรุณาไม่ป้อนยืนยันรหัสผ่าน');
            $("[name='confirm_password_']").focus();
            return false;
        }
        if( $("[name='password_']").val() != $("[name='confirm_password_']").val() ) {
            alert('รหัสผ่านไม่ตรงกัน');
            $("[name='password_']").focus();
            return false;
        }
        return true;
    }
</script>
<section class="content-header">
    <h1><i class="fa fa-file"></i> ข้อมูลการแจกจ่ายหนังสือ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลการแจกจ่ายหนังสือ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">แก้ไขข้อมูลสมาชิก</h3>
            <i class="fa fa-angle-right"></i> <a href="Javascript:location.reload();"></a>
        </div>
        <div class="box-body">
            <input type="hidden" name="id" value="<?php echo $data['teacher_id']; ?>">
            <input type="hidden" name="school_id" value="<?php echo $data['school_id']; ?>">
            <input type="hidden" name="get_book" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">

            <a href="?content=book-get-show&id=<?php echo $id;?>&school_id=<?php echo $school_id;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
            <a href="?content=book-distribute-add" class="btn btn-success" title="เพิ่มข้อมูล"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
            
            <div class="row">
                <div align="center">
                    <p ><img src="files/img/aa.gif" alt="" width="12%" height="15%" /></p>
                    <h5 style="padding-top: -20px;"><b>เอกสารรับมอบหนังสือนิทาน</b></h5>
                    <h5 style="padding-top: -20px;"><b>ชุดหนังสือที่ส่งมอบทั้งหมด</b></h5>
                </div>
            </div>
            <div class="row">   
                <div class="col-md-12">
                    <div class="form-group">
                        <?php
                            include("pages/date.php");
                            $strDate = $data['date_start'];
                        ?>
                        <label for="type_book_id" class="control-label">
                            วันที่
                        </label>
                        <span class="dotshed"> <?php echo DateThai($strDate);?></span>
                    </div>
                    <style type="text/css">
                        .dotshed { border-bottom: 1px dotted;  }
                    </style>
                    <?php 
                        $sql = "
                            SELECT
                                tb_teacher.id,
                                tb_teacher.name_thai,
                                tb_teacher.lname_thai,
                                tb_prefix.`name` as prefix_name,
                                tb_school.`code`,
                                tb_school.`name` as school_name,
                                tb_school.`no`,
                                tb_school.mu,
                                tb_school.road,
                                tb_school.alley,
                                tb_school.village,
                                tb_district.`name` as district_name,
                                tb_amphur.`name` as amphur_name,
                                tb_province.`name` as province_name,
                                tb_school.passcode,
                                tb_school.tel
                            FROM
                                tb_teacher
                                INNER JOIN tb_prefix ON tb_teacher.prefix_id = tb_prefix.id
                                INNER JOIN tb_school ON tb_teacher.school_id = tb_school.id
                                INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                            WHERE tb_teacher.id = '".$data['teacher_id']."'";
                        $all = $DATABASE->QueryNumRow($sql);
                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_teacher.id");
                        if(sizeof($DATA)>0){
                            foreach($DATA as $row) { 
                    ?>
                    <div class="row">
                        <div class="form-group col-md-6"> 
                            <label for="type_book_id" class="control-label">
                                ข้าพเจ้า
                            </label>
                            <span class="dotshed">
                                <?php echo $row['prefix_name'];?> <?php echo $row['name_thai'];?> <?php echo $row['lname_thai'];?>
                            </span>
                        </div>
                        <div class="form-group col-md-6"> 
                            <label for="type_book_id" class="control-label">
                                สังกัดสถานศึกษา
                            </label>
                            <span class="dotshed">
                                <?php echo $row['school_name'];?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2"> 
                            <label for="type_book_id" class="control-label">
                                ที่อยู่
                            </label>
                            <span class="dotshed">
                                <?php echo $row['no'];?>
                            </span>
                        </div>
                        <div class="form-group col-md-2"> 
                            <label for="type_book_id" class="control-label">
                                หมุ่ที่
                            </label>
                            <span class="dotshed">
                                <?php echo $row['mu'];?> / 
                                <?php echo $row['village'];?>
                            </span>
                        </div>
                        <div class="form-group col-md-2"> 
                            <label for="type_book_id" class="control-label">
                                ตรอก / ซอย
                            </label>
                            <span class="dotshed">
                                <?php echo $row['road'];?> / 
                                <?php echo $row['alley'];?>
                            </span>
                        </div>
                        <div class="form-group col-md-2"> 
                            <label for="type_book_id" class="control-label">
                                ตำบล
                            </label>
                            <span class="dotshed">
                                <?php echo $row['district_name'];?>
                            </span>
                        </div>
                        <div class="form-group col-md-2"> 
                            <label for="type_book_id" class="control-label">
                                อำเภอ
                            </label>
                            <span class="dotshed">
                                <?php echo $row['amphur_name'];?>
                            </span>
                        </div>
                        <div class="form-group col-md-2"> 
                            <label for="type_book_id" class="control-label">
                                จังหวัด
                            </label>
                            <span class="dotshed">
                                <?php echo $row['province_name'];?>
                            </span>
                        </div>
                    </div>
                    <?php 
                                }
                            }
                        ?>
                </div>
            </div> 
            <div class="table-responsive">
                <?php
                    $SHOW = 10;
                    $start = ($PAGE-1)*$SHOW;
                    $sql = "
                        SELECT
                            tb_get_book.id,
                            tb_get_book.type_book_id,
                            tb_get_book.book_id,
                            tb_get_book.qty,
                            tb_get_book.note,
                            tb_get_book.date_start,
                            tb_type_book.`name` as type_book_name,
                            tb_book.name_thai as book_name,
                            tb_book.book_type_id,
                            tb_prefix.`name` as prefix_name,
                            tb_teacher.id as teacher_id,
                            tb_teacher.name_thai as name_thai,
                            tb_teacher.lname_thai as lname_thai,
                            tb_school.id as school_id,
                            tb_school.`name` as school_name,
                            tb_school.`no`,
                            tb_school.mu,
                            tb_school.road,
                            tb_school.alley,
                            tb_school.village,
                            tb_district.`name` as district_name,
                            tb_amphur.`name` as amphur_name,
                            tb_amphur.passcode,
                            tb_province.`name` as province_name
                        FROM
                            tb_get_book
                            INNER JOIN tb_book ON tb_get_book.book_id = tb_book.id AND tb_get_book.type_book_id = tb_book.book_type_id
                            INNER JOIN tb_type_book ON tb_get_book.type_book_id = tb_type_book.id
                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                            INNER JOIN tb_prefix ON tb_teacher.prefix_id = tb_prefix.id
                            INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                        WHERE tb_teacher.id='".$id."' AND tb_school.id='".$school_id."'
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_get_book.type_book_id DESC LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr style="background-color: #780808; color: #fff;">
                            <th class="text-left" style="width: 10%;">ลำดับ</th>
                            <th style="width: 30%;">ชื่อนิทาน</th>
                            <th style="width: 10%; text-align: center;">จำนวน</th>
                            <th style="width: 50%;">แนวทางการนำไปใช้ประโยชน์</th>
                            <th style="width: 20%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                echo $id = $row['id'];
                                echo $school_id = $row['school_id'];
                                echo $teacher_id = $row['teacher_id'];
                                echo $book_id = $row['book_id'];
                                ?>
                                <tr data-json="<?php echo htmlspecialchars(json_encode($row));?>">
                                    <?php //echo $row['id']; ?>
                                    <td class="text-left" style="width: 10%;"><?php echo $key+1; ?></td>
                                    <td style="width: 30%;"><?php echo $row['book_name']; ?></td>
                                    <td style="width: 10%; text-align: center;"><?php echo $row['qty']; ?></td>
                                    <td style="width: 50%;"><?php echo $row['note']; ?></td>
                                    <td style="width: 20%;">
                                        <div class="btn-group" role="group" aria-label>
                                            <a href="#view<?php echo $row['id'];?>" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ลบข้อมูล</button></a>
                                        </div>
                                    </td>
                                </tr>
                                <div id="view<?php echo $id;?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #780808; color: #fff;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-trash"></i> ลบชื่อหนังสือ</h4>
                                            </div>
                                            <div class="modal-body">
                                                <b>ชื่อหนังสือ</b> : <small><?php echo $row['book_name']; ?></small><br>
                                                <b>จำนวน</b> : <small><?php echo $row['qty']; ?></small><br>
                                                <b>รายะเอียด</b>
                                                <p id="note"><?php echo $row['note']; ?></p><br>
                                            </div>
                                            <div class="modal-footer" style="background-color: #780808; color: #fff;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                <a href="?content=book-distribute-edit-action&id=<?php echo $row['id'];?>&teacher_id=<?php echo $row['teacher_id'];?>&school_id=<?php echo $row['school_id'];?>&book_id=<?php echo $row['book_id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i> ลบข้อมูล</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php 
                                }
                        }else{
                                echo "<tr><td colspan='6' align='center'><i>ไม่พบข้อมูล</i></td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=book-distribute-edit&id='.$_GET['id'].($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=book-distribute-edit&id='.$_GET['id'].($PAGE+1).$searhing.'"';

                    if($PAGE==1){
                        $disabled1 = "disabled";
                        $href1 = "";
                    }
                    if($PAGE*$SHOW>=$all){
                        $disabled2 = "disabled";
                        $href2 = "";
                    }
                ?>
                <nav>
                    <ul class="pager">
                        <li class="<?php echo $disabled1;?>"><a <?php echo $href1;?>>ก่อนหน้า</a></li>
                        <?php echo $PAGE;?>/<?php echo ceil($all/$SHOW);?>
                        <li class="<?php echo $disabled2;?>"><a <?php echo $href2;?>>ถัดไป</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<?php
    } else {
        echo "
            <script>
                location.href = '?content=book-distribute';
            </script>
        ";
    }
?>