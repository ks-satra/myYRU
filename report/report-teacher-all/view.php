<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<?php
    include("../../php/autoload.php");
    include("../../pages/date.php"); 

    $strExcelFileName="Member-All.xls";
    header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
    header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
    header("Pragma:no-cache");

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
            WHERE tb_school.id = '2'
    ";
    $all = $DATABASE->QueryNumRow($sql);
    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_get_book.id DESC");
    
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="font-family: Garuda;">
    <?php
        if(sizeof($DATA)>0){
            foreach($DATA as $key => $row){
                $prefix_name = $row["prefix_name"];
                    $name_thai = $row["name_thai"];
                    $lname_thai = $row["lname_thai"];
                ?>
            <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto; height: 401px;" border="0">
                <tbody>
                    <tr>
                        <td></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display: block; margin-left: auto; margin-right: auto;" src="http://eduservice.yru.ac.th/entrance/images/yru-logo-transparent.gif" alt="" width="10%" height="16%" /></td>
                        <td></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr style="height: 17px;">
                        <td></td>
                        <td style="width: 668.4px; text-align: center; height: 40px;"><strong>เอกสารรับมอบหนังสือนิทาน</strong></td>
                        <td></td>
                    </tr>
                    <tr style="text-align: center;">
                        <td></td>
                        <td style="width: 700px; height: 51px;"><strong>ชุดนิทานคุณธรรมจากวรรณกรรมในฝักกริช</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <!-- <p align="center"><b>เอกสารรับมอบหนังสือนิทาน</b></p>
            <p style="padding-top: -20px" align="center"><b>ชุดนิทานคุณธรรมจากวรรณกรรมในฝักกริช</b></p> -->
            <table style="height: 51px; width: 100%; border-collapse: collapse;" border="0">
                <tbody>
                    <tr style="height: 17px;">
                        <td style="width: 25%; height: 35px;">
                            <strong>วันที่ 
                                <?php
                                    $strDate = $row["date_start"];
                                    echo $day = DateThai($strDate);
                                ?>
                            </strong>
                        </td>
                        <td style="width: 25%; height: 35px;">&nbsp;</td>
                    </tr>
                    <tr style="height: 17px;">
                        <td style="width: 25%; height: 35px;" colspan="2"><strong>ข้าพเจ้า</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;<?php echo $row["prefix_name"];?><?php echo $row["name_thai"];?>  <?php echo $row["lname_thai"];?>&emsp;</font>
                        </td>
                        <td style="width: 25%; height: 35px;" colspan="2"><strong>สังกัดสถานศึกษา</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;&emsp;<?php echo $row["school_name"];?>&emsp;</font>
                        </td>
                    </tr>
                    <tr style="height: 17px;">
                        <td style="width: 25%; height: 35px;"><strong>ที่อยู่</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["no"];?>&emsp;หมู่ที่ <?php echo $row["mu"];?>&emsp;</font>
                        </td>
                        <td style="width: 25%; height: 35px;"><strong>ตำบล</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["district_name"];?></font>
                        </td>
                        <td style="width: 25%; height: 35px;"><strong>อำเภอ</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["amphur_name"];?></font></td>
                        <td style="width: 25%; height: 35px;"><strong>จังหวัด</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["province_name"];?></font></td>
                    </tr>
                    <tr>
                        <td style="width: 25%; height: 35px;"><strong>รหัสไปรษณีย์</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["passcode"];?></font></td>
                        <td style="width: 25%; height: 35px;" colspan="3"><strong>เบอร์โทร</strong> <font style="BORDER-BOTTOM: #000 1px dotted">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</font></td>
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
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='1' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>2</center></td>
                                <td height="30" style="padding-left: 5px">ช้างคู่บุญ</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='2' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>3</center></td>
                                <td height="30" style="padding-left: 5px">มัสยิดกรือเซะ</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='3' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>4</center></td>
                                <td height="30" style="padding-left: 5px">ตาสากับยายโส</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='4' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>5</center></td>
                                <td height="30" style="padding-left: 5px">ยักษ์หน้าถ้ำ</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='5' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>6</center></td>
                                <td height="30" style="padding-left: 5px">มัสยิด 100 เสา</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='6' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>7</center></td>
                                <td height="30" style="padding-left: 5px">เจ๊ะเห</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='7' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>8</center></td>
                                <td height="30" style="padding-left: 5px">เจ๊ะบูงอกับเจ๊ะมือลอ</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='8' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>9</center></td>
                                <td height="30" style="padding-left: 5px">นางฟ้าผมหอม</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='9' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                            <tr>
                                <td><center>10</center></td>
                                <td height="30" style="padding-left: 5px">ปันตน</td>
                                <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='10' AND teacher_id = '".$row['teacher_id']."'");?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br>
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
                        <td style="width: 43.1785%; height: 35px; text-align: center;">(<span style="border-bottom: #000 1px dotted;"><?php echo $prefix_name;?><?php echo $name_thai;?>  <?php echo $name_thai;?></span>)</td>
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

            <!-- เริ่ง Bookbank -->
            <table style="width: 100%; border-collapse: collapse;" border="0" style="padding-top: 60px">
                <tbody>
                    <tr>
                        <td width="10%"></td>
                        <td width="10%"></td>
                        <td align="center"><img style="display: block; margin-left: auto; margin-right: auto;" src="http://eduservice.yru.ac.th/entrance/images/yru-logo-transparent.gif" alt="" width="10%" height="16%"/></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br><br><br><br><br><br>
            <p align="center"><b>เอกสารรับมอบสมุดธนาคารหนังสือนิทาน</b></p>
            <p style="padding-top: -20px" align="center"><b>ชุดสมุดธนาคารนิทานคุณธรรมจากวรรณกรรมในฝักกริช (Bookbank)</b></p>
            <table style="height: 51px; width: 100%; border-collapse: collapse;" border="0">
                <tbody>
                    <tr style="height: 17px;">
                        <td style="width: 25%; height: 35px;">
                            <strong>วันที่ 
                                <?php
                                    $strDate = $row["date_start"];
                                    echo $day = DateThai($strDate);
                                ?>
                            </strong>
                        </td>
                        <td style="width: 25%; height: 35px;">&nbsp;</td>
                    </tr>
                    <tr style="height: 17px;">
                        <td style="width: 25%; height: 35px;" colspan="2"><strong>ข้าพเจ้า</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;<?php echo $row["prefix_name"];?><?php echo $row["name_thai"];?>  <?php echo $row["lname_thai"];?>&emsp;</font>
                        </td>
                        <td style="width: 25%; height: 35px;" colspan="2"><strong>สังกัดสถานศึกษา</strong><font style="BORDER-BOTTOM: #000 1px dotted">&emsp;&emsp;<?php echo $row["school_name"];?>&emsp;</font>
                        </td>
                    </tr>
                    <tr style="height: 17px;">
                        <td style="width: 25%; height: 35px;"><strong>ที่อยู่</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["no"];?>&emsp;หมู่ที่ <?php echo $row["mu"];?>&emsp;</font>
                        </td>
                        <td style="width: 25%; height: 35px;"><strong>ตำบล</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["district_name"];?></font>
                        </td>
                        <td style="width: 25%; height: 35px;"><strong>อำเภอ</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["amphur_name"];?></font></td>
                        <td style="width: 25%; height: 35px;"><strong>จังหวัด</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["province_name"];?></font></td>
                    </tr>
                    <tr>
                        <td style="width: 25%; height: 35px;"><strong>รหัสไปรษณีย์</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $row["passcode"];?></font></td>
                        <td style="width: 25%; height: 35px;" colspan="3"><strong>เบอร์โทร</strong> <font style="BORDER-BOTTOM: #000 1px dotted">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</font></td>
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
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
                        <td style="width: 43.1785%; height: 35px; text-align: center;">(<span style="border-bottom: #000 1px dotted;"><?php echo $prefix_name;?><?php echo $name_thai;?>  <?php echo $lname_thai;?></span>)</td>
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

    <?php 
            }
        }else{
            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
        }
    ?>
    <script>
        window.onbeforeunload = function(){return false;};
        setTimeout(function(){window.close();}, 10000);
    </script>
</body>
</html>