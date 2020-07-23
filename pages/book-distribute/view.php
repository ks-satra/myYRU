<?php
    if( $USER==null ) {
            LINKTO("login.php");
        }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";

?>
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
            <h3 class="box-title"> ข้อมูลการแจกจ่ายหนังสือ</h3> > หนังสือนิทานวรรณกรรมในฝักกริซ
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="book-distribute">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=book-distribute-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=book-distribute'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูล" value="<?php echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                    <!-- <a class="btn btn-success btn" href="report/report-teacher-all/view.php" title="พิมพ์ข้อมูล" style="background-color: #ff65a5; border-color: #ff65a5;"><i class="fa fa-print"></i> พิมพ์ข้อมูลทัั้งหมด
                    </a> -->
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive">
                <?php
                    $SHOW = 30;
                    $start = ($PAGE-1)*$SHOW;
                    $condition = "";
                        if( $SERACHING==NULL ) $condition = " AND tb_get_book.type_book_id = '1' OR tb_get_book.type_book_id = '2'  
                    ";
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
                            tb_type_book.`name` as type_book_name,
                            tb_book.book_type_id,
                            tb_book.name_thai,
                            tb_book.name_eng,
                            tb_book.photo,
                            tb_book.fileupload,
                            tb_teacher.school_id,
                            tb_teacher.card,
                            tb_teacher.prefix_id,
                            tb_teacher.name_thai as teacher_name,
                            tb_teacher.lname_thai as teacher_lname,
                            tb_teacher.name_eng,
                            tb_teacher.lname_eng,
                            tb_teacher.sex_id,
                            tb_teacher.tel,
                            tb_teacher.birthday,
                            tb_teacher.position,
                            tb_teacher.email,
                            tb_teacher.idline,
                            tb_teacher.alumni,
                            tb_teacher.buddhist_era_start,
                            tb_teacher.buddhist_era_end,
                            tb_teacher.faculty,
                            tb_teacher.branch,
                            tb_teacher.`level`,
                            tb_teacher.topics,
                            tb_teacher.school_address,
                            tb_teacher.note,
                            tb_teacher.date_start,
                            tb_teacher.time_start,
                            tb_teacher.`no`,
                            tb_teacher.mu,
                            tb_teacher.alley,
                            tb_teacher.byway,
                            tb_teacher.village,
                            tb_teacher.district_id,
                            tb_teacher.amphur_id,
                            tb_teacher.province_id,
                            tb_teacher.passcode,
                            tb_teacher.photo,
                            tb_school.`code`,
                            tb_school.`name` as school_name,
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
                            tb_prefix.`name` as prefix_name,
                            tb_prefix.name_eng,
                            tb_prefix.abbreviation,
                            tb_province.`name` as province_name,
                            tb_amphur.`name` as amphur_name,
                            tb_amphur.passcode,
                            tb_district.`name` as district_name,
                            tb_area.`name`,
                            tb_department.`name`,
                            CONCAT( tb_teacher.name_thai, ' ' ,tb_teacher.lname_thai) As full_name
                        FROM
                            tb_get_book
                            INNER JOIN tb_type_book ON tb_get_book.type_book_id = tb_type_book.id
                            INNER JOIN tb_book ON tb_get_book.book_id = tb_book.id
                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                            INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                            INNER JOIN tb_prefix ON tb_teacher.prefix_id = tb_prefix.id
                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                            INNER JOIN tb_area ON tb_school.area_id = tb_area.id
                            INNER JOIN tb_department ON tb_school.department_id = tb_department.id
                        WHERE (
                            tb_school.`name` LIKE '%$SERACHING%' OR
                            tb_teacher.name_thai LIKE '%$SERACHING%' OR
                            tb_teacher.lname_thai LIKE '%$SERACHING%' OR
                            tb_province.`name` LIKE '%$SERACHING%' OR
                            tb_amphur.`name` LIKE '%$SERACHING%' OR
                            tb_district.`name` LIKE '%$SERACHING%' OR
                            CONCAT( tb_teacher.name_thai, ' ' ,tb_teacher.lname_thai) LIKE '%$SERACHING%' OR
                            CONCAT( tb_prefix.`name`, tb_teacher.name_thai, ' ' ,tb_teacher.lname_thai) LIKE '%$SERACHING%'
                            ) ".$condition."
                        GROUP BY tb_get_book.school_id , tb_get_book.teacher_id
                        ";
                        $all = $DATABASE->QueryNumRow($sql);
                        $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_get_book.id DESC LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr style="background-color: #780808; color: #fff;">
                            <th><center>ลำดับ</center></th>
                            <th>ชื่อ - สกุล</th>
                            <th>โรงเรียน (ตำบล อำเภอ จังหวัด)</th>
                            <th style="text-align: right;">ตรวจสอบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <tr>
                                    <td><center><?php echo $key+1; ?></center></td>
                                    <td><?php echo $row['prefix_name']; ?><?php echo $row['teacher_name']; ?> <?php echo $row['teacher_lname']; ?></td>
                                    <td title="<?php echo $row['school_name'];?> <?php echo $row['district_name'];?> <?php echo $row['amphur_name'];?> <?php echo $row['province_name'];?>"><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px"><?php echo $row['school_name'];?> <?php echo $row['district_name'];?> <?php echo $row['amphur_name'];?> <?php echo $row['province_name'];?></span></td>
                                    <td style="margin-right: 3px; text-align: right;">
                                        <a class="btn btn-info btn" href="?content=book-person&id=<?php echo $row['teacher_id'];?>&school_id=<?php echo $row['school_id'];?>&page=<?php echo $PAGE; ?>" title="ตรวจสอบข้อมูล"><i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn" href="report/report-teacher/view.php?id=<?php echo $row['teacher_id'];?>" title="พิมพ์ข้อมูล" style="background-color: #ff65a5; border-color: #ff65a5;" target="_blank"><i class="fa fa-print"></i>
                                        </a>
                                    </td>             
                                </tr>
                                <?php 
                            }
                        }else{
                            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div style="text-align: right;">จำนวนข้อมูลครู <?php echo $all;?> คน</div>
                <div style="text-align: right;">จำนวนข้อมูลหนังสือ <?php echo $COUNT_BOOK = $DATABASE->QueryString("SELECT COUNT(id) FROM tb_get_book");?> เล่ม</div>

                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=book-distribute&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=book-distribute&page='.($PAGE+1).$searhing.'"';
                    
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