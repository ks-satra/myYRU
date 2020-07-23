<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<?php
    include("pdf_start.php");
    include("../../php/autoload.php");
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 300);
    ini_set('pcre.backtrack_limit', 90000000000000000000000000000000000000000000000000000);
?>
<section class="content">
    <div class="box box-danger">
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive">
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
                            tb_department.`name`
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
                        WHERE tb_get_book.school_id = '2'
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_get_book.id");
                ?>
                <section class="content">
    <div class="box box-danger">
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive">
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
                            tb_type_book.`name`,
                            tb_book.book_type_id,
                            tb_book.name_thai,
                            tb_book.name_eng,
                            tb_book.photo,
                            tb_book.fileupload,
                            tb_teacher.name_thai,
                            tb_teacher.lname_thai,
                            tb_teacher.card,
                            tb_prefix.`name` as prefix_name,
                            tb_district.`name` as district_name,
                            tb_amphur.`name` as amphur_name,
                            tb_province.`name` as province_name,
                            tb_school.passcode as passcode,
                            tb_school.district_id,
                            tb_school.amphur_id ,
                            tb_school.province_id,
                            tb_school.`code`,
                            tb_school.`name` as school_name,
                            tb_school.`no`,
                            tb_school.mu,
                            tb_school.road,
                            tb_school.alley,
                            tb_school.village
                        FROM
                            tb_get_book
                            INNER JOIN tb_type_book ON tb_get_book.type_book_id = tb_type_book.id
                            INNER JOIN tb_book ON tb_get_book.book_id = tb_book.id
                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                            INNER JOIN tb_prefix ON tb_teacher.prefix_id = tb_prefix.id
                            INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                        WHERE tb_school.id = '1'
                    ";
                    $obj =$DATABASE->QueryObj($sql);
                    if( sizeof($obj)>=1 ) {
                        $data = $obj[0];
                    
                ?>
                <body style="font-family: Garuda;">
                    <p align="center"><img src="../../files/img/aa.gif" alt="" width="12%" height="15%" /></p>
                    <p align="center"><b>เอกสารรับมอบหนังสือนิทาน</b></p>
                    <p style="padding-top: -20px" align="center"><b>ชุดนิทานคุณธรรมจากวรรณกรรมในฝักกริช</b></p>
                    <table style="height: 51px; width: 100%; border-collapse: collapse;" border="0">
                        <tbody>
                            <tr style="height: 17px;">
                                <td style="width: 25%; height: 35px;">
                                    <strong>วันที่ 
                                        <?php
                                            include("../../pages/date.php");
                                            $strDate = $data['date_start'];
                                            echo $day = DateThai($strDate);
                                            //echo substr(DateThai($strDate),0,2)."<br>";
                                        ?>
                                    </strong>
                                </td>
                                <td style="width: 25%; height: 35px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 17px;">
                                <td style="width: 25%; height: 35px;" colspan="2"><strong>ข้าพเจ้า</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;<?php echo $data["prefix_name"];?><?php echo $data["name_thai"];?>  <?php echo $data["lname_thai"];?>&emsp;</font>
                                </td>
                                <td style="width: 25%; height: 35px;" colspan="2"><strong>สังกัดสถานศึกษา</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;&emsp;<?php echo $data["school_name"];?>&emsp;</font>
                                </td>
                            </tr>
                            <tr style="height: 17px;">
                                <td style="width: 25%; height: 35px;"><strong>ที่อยู่</strong><font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["no"];?>&emsp;หมู่ที่ <?php echo $data["mu"];?>&emsp;</font>
                                </td>
                                <td style="width: 25%; height: 35px;"><strong>ตำบล</strong><font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["district_name"];?></font>
                                </td>
                                <td style="width: 25%; height: 35px;"><strong>อำเภอ</strong>&emsp;<font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["amphur_name"];?></font></td>
                                <td style="width: 25%; height: 35px;"><strong>จังหวัด</strong>&emsp;<font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["province_name"];?></font></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; height: 35px;"><strong>รหัสไปรษณีย์</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;<?php echo $data["passcode"];?></font></td>
                                <td style="width: 25%; height: 35px;" colspan="3"><strong>เบอร์โทร</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</font></td>
                            </tr>
                        </tbody>
                    </table><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="myTable" class="table table-hover" bordercolor="#424242" width="100%" height="100%" border="1"  align="center" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                        <th width="30%"  height="40" bgcolor="#D5D5D5"><center>รายการ</center></th>
                                        <th width="20%"  height="40" bgcolor="#D5D5D5"><center>จำนวน</center></th>
                                        <th width="40%"  height="40" bgcolor="#D5D5D5"><center>หมายเหตุ</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><center>1</center></td>
                                        <td height="30" style="padding-left: 5px">อีกากับเทวดา</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='1'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>2</center></td>
                                        <td height="30" style="padding-left: 5px">ช้างคู่บุญ</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='2'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>3</center></td>
                                        <td height="30" style="padding-left: 5px">มัสยิดกรือเซะ</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='3'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>4</center></td>
                                        <td height="30" style="padding-left: 5px">ตาสากับยายโส</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='4'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>5</center></td>
                                        <td height="30" style="padding-left: 5px">ยักษ์หน้าถ้ำ</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='5'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>6</center></td>
                                        <td height="30" style="padding-left: 5px">มัสยิด 100 เสา</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='6'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>7</center></td>
                                        <td height="30" style="padding-left: 5px">เจ๊ะเห</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='7'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>8</center></td>
                                        <td height="30" style="padding-left: 5px">เจ๊ะบูงอกับเจ๊ะมือลอ</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='8'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>9</center></td>
                                        <td height="30" style="padding-left: 5px">นางฟ้าผมหอม</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='9'");?></td>
                                    </tr>
                                    <tr>
                                        <td><center>10</center></td>
                                        <td height="30" style="padding-left: 5px">ปันตน</td>
                                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='10'");?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br><br><br><br>
                    <table style="height: 51px; width: 100%; border-collapse: collapse;" border="0">
                        <tbody>
                            <tr style="height: 35px;">
                                <td style="width: 16.4187%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 20.918%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 19.4848%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 43.1785%; height: 35px; text-align: left;"><strong>&nbsp; &nbsp; &nbsp;ลงชื่อ</strong>&nbsp;<span style="border-bottom: #000 1px dotted;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span></td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 16.4187%; text-align: center;">&nbsp;</td>
                                <td style="width: 20.918%; text-align: center;">&nbsp;</td>
                                <td style="width: 19.4848%; text-align: center;">&nbsp;</td>
                                <td style="width: 43.1785%; height: 35px; text-align: center;">(<span style="border-bottom: #000 1px dotted;"><?php echo $data["prefix_name"];?><?php echo $data["name_thai"];?>  <?php echo $data["lname_thai"];?></span>)</td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 16.4187%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 20.918%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 19.4848%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 43.1785%; height: 35px; text-align: center;"><strong>ตำแหน่ง</strong>&nbsp;</td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 16.4187%; text-align: center;">&nbsp;</td>
                                <td style="width: 20.918%; text-align: center;">&nbsp;</td>
                                <td style="width: 19.4848%; text-align: center;">&nbsp;</td>
                                <td style="width: 43.1785%; height: 35px; text-align: center;"><span style="border-bottom: #000 1px dotted;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <br><br><br><br><br><br>
                    <p align="center"><img src="../../files/img/aa.gif" alt="" width="12%" height="15%" /></p>
                    <p align="center"><b>เอกสารรับมอบสมุดธนาคารหนังสือนิทาน</b></p>
                    <p style="padding-top: -20px" align="center"><b>ชุดสมุดธนาคารนิทานคุณธรรมจากวรรณกรรมในฝักกริช (Bookbank)</b></p>
                    <table style="height: 51px; width: 100%; border-collapse: collapse;" border="0">
                        <tbody>
                            <tr style="height: 17px;">
                                <td style="width: 25%; height: 35px;">
                                    <strong>วันที่ 
                                        <?php
                                            $strDate = $data['date_start'];
                                            echo $day = DateThai($strDate);
                                        ?>
                                    </strong>
                                </td>
                                <td style="width: 25%; height: 35px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 17px;">
                                <td style="width: 25%; height: 35px;" colspan="2"><strong>ข้าพเจ้า</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;<?php echo $data["prefix_name"];?><?php echo $data["name_thai"];?>  <?php echo $data["lname_thai"];?>&emsp;</font>
                                </td>
                                <td style="width: 25%; height: 35px;" colspan="2"><strong>สังกัดสถานศึกษา</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;&emsp;<?php echo $data["school_name"];?>&emsp;</font>
                                </td>
                            </tr>
                            <tr style="height: 17px;">
                                <td style="width: 25%; height: 35px;"><strong>ที่อยู่</strong><font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["no"];?>&emsp;หมู่ที่ <?php echo $data["mu"];?>&emsp;</font>
                                </td>
                                <td style="width: 25%; height: 35px;"><strong>ตำบล</strong><font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["district_name"];?></font>
                                </td>
                                <td style="width: 25%; height: 35px;"><strong>อำเภอ</strong>&emsp;<font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["amphur_name"];?></font></td>
                                <td style="width: 25%; height: 35px;"><strong>จังหวัด</strong>&emsp;<font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["province_name"];?></font></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; height: 35px;"><strong>รหัสไปรษณีย์</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;<?php echo $data["passcode"];?></font></td>
                                <td style="width: 25%; height: 35px;" colspan="3"><strong>เบอร์โทร</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</font></td>
                            </tr>
                        </tbody>
                    </table><br>
                    <div class="row">
                        <div class="col-md-12">
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
                                        WHERE tb_get_book.type_book_id != '1'
                                        GROUP BY tb_get_book.book_id
                                        ";
                                    $all = $DATABASE->QueryNumRow($sql);
                                    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_get_book.id DESC");
                                ?>
                                    <table id="myTable" class="table table-hover" bordercolor="#424242" width="100%" height="100%" border="1"  align="center" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="10%"  height="40" bgcolor="#D5D5D5"><center>ลำดับ</center></th>
                                                <th width="30%"  height="40" bgcolor="#D5D5D5"><center>รายการ</center></th>
                                                <th width="20%"  height="40" bgcolor="#D5D5D5"><center>จำนวน</center></th>
                                                <th width="40%"  height="40" bgcolor="#D5D5D5"><center>หมายเหตุ</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(sizeof($DATA)>0){ 
                                                    foreach($DATA as $key => $row){
                                                        ?>
                                                        <tr>
                                                            <?php
                                                                if($row['BOOK_QTY'] == 1){
                                                            ?>
                                                                <?php if($row['qty'] == 1) { ?>
                                                                    <td><center><?php echo $key+1; ?></center></td>
                                                                    <td height="30" style="padding-left: 5px"><?php echo $row['BOOK_THAI'];?></td>
                                                                    <td height="30" align="center"><?php echo $row['qty'];?></td>
                                                                <?php } else if ($row['qty'] == 2){ ?>
                                                                    <td><center><?php echo $key+1; ?></center></td>
                                                                    <td height="30" style="padding-left: 5px"> <?php echo $row['BOOK_THAI'];?></td>
                                                                    <td height="30" align="center"><?php echo $row['qty'];?></td>
                                                                <?php } else if ($row['qty'] == 3){ ?>
                                                                    <td><center><?php echo $key+1; ?></center></td>
                                                                    <td height="30" style="padding-left: 5px"> <?php echo $row['BOOK_THAI'];?></td>
                                                                    <td height="30" align="center"><?php echo $row['qty'];?></td>
                                                                <?php } else { ?>
                                                                    <td><center><?php echo $key+1; ?></center></td>
                                                                    <td height="30" style="padding-left: 5px"> <?php echo $row['BOOK_THAI'];?></td>
                                                                    <td height="30" align="center"> <?php echo $row['qty'];?></td>
                                                                <?php } ?> 
                                                            <?php
                                                                } else {
                                                            ?>
                                                                <?php if($row['BOOK_QTY'] == 1) { ?>
                                                                    <td><center><?php echo $key+1; ?></center></td>
                                                                    <td height="30" style="padding-left: 5px"><?php echo $row['BOOK_THAI'];?></td>
                                                                    <td height="30"></a></td>
                                                                <?php } else if ($row['BOOK_QTY'] == 2){ ?>
                                                                    <td><center><?php echo $key+1; ?></center></td>
                                                                    <td height="30" style="padding-left: 5px"><?php echo $row['BOOK_THAI'];?></td>
                                                                    <td height="30" align="center"><?php echo $row['BOOK_QTY'];?></td>
                                                                <?php } else if ($row['BOOK_QTY'] == 3){ ?>
                                                                    <td><center><?php echo $key+1; ?></center></td>
                                                                    <td height="30" style="padding-left: 5px"> <?php echo $row['BOOK_THAI'];?></td>
                                                                    <td height="30" align="center"><?php echo $row['BOOK_QTY'];?></td>
                                                                <?php } else { ?>
                                                                    <td><center><?php echo $key+1; ?></center></td>
                                                                    <td height="30" style="padding-left: 5px"> <?php echo $row['BOOK_THAI'];?></td>
                                                                    <td height="30" align="center"><?php echo $row['BOOK_QTY'];?></td>
                                                                <?php } ?> 
                                                            <?php
                                                                } 
                                                            ?>
                                                        </tr>
                                            <?php 
                                                        }
                                                    }else{
                                                        echo "<tr><td colspan='6' height='30' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                                    }
                                                ?>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <table style="height: 51px; width: 100%; border-collapse: collapse;" border="0">
                        <tbody>
                            <tr style="height: 35px;">
                                <td style="width: 16.4187%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 20.918%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 19.4848%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 43.1785%; height: 35px; text-align: left;"><strong>&nbsp; &nbsp; &nbsp;ลงชื่อ</strong>&nbsp;<span style="border-bottom: #000 1px dotted;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span></td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 16.4187%; text-align: center;">&nbsp;</td>
                                <td style="width: 20.918%; text-align: center;">&nbsp;</td>
                                <td style="width: 19.4848%; text-align: center;">&nbsp;</td>
                                <td style="width: 43.1785%; height: 35px; text-align: center;">(<span style="border-bottom: #000 1px dotted;"><?php echo $data["prefix_name"];?><?php echo $data["name_thai"];?>  <?php echo $data["lname_thai"];?></span>)</td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 16.4187%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 20.918%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 19.4848%; text-align: center;"><strong>&nbsp;</strong></td>
                                <td style="width: 43.1785%; height: 35px; text-align: center;"><strong>ตำแหน่ง</strong>&nbsp;</td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 16.4187%; text-align: center;">&nbsp;</td>
                                <td style="width: 20.918%; text-align: center;">&nbsp;</td>
                                <td style="width: 19.4848%; text-align: center;">&nbsp;</td>
                                <td style="width: 43.1785%; height: 35px; text-align: center;"><span style="border-bottom: #000 1px dotted;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span></td>
                            </tr>
                        </tbody>
                    </table>
                </body>
                <?php
                    }
                    include("pdf_end.php");
                ?>
            </div>
        </div>
    </div>
</section>
                <?php include("pdf_end.php"); ?>
            </div>
        </div>
    </div>
</section>
