<link href="assets/font/sarabun/bootstrap/css?family=Sarabun&display=swap" rel="stylesheet" />  
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<?php
    include("pdf_start.php");
    include("../../php/autoload.php");
    $id = $_GET["id"];
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
            WHERE tb_teacher.id = '".$id."' AND tb_get_book.type_book_id = '1'
    ";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)>=1 ) {
        $data = $obj[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body style="font-family: Garuda;">
    <p align="center"><img src="../../files/img/aa.gif" alt="" width="12%" height="15%" /></p>
    <p align="center" style="padding-top: -20px; font-size: 14px;"><b>เอกสารรับมอบหนังสือนิทาน</b></p>
    <p style="padding-top: -20px; font-size: 14px;" align="center"><b>ชุดนิทานคุณธรรมจากวรรณกรรมในฝักกริช</b></p>
    <div style="padding-top: -20px;"></div>
    <table style="height: 51px; width: 100%; border-collapse: collapse;" border="0">
        <tbody>
            <tr style="height: 17px;">
                <td style="width: 50%; height: 35px;">
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
                <td style="width: 25%; height: 35px;" colspan="2"><strong>สังกัดสถานศึกษา</strong><font style="BORDER-BOTTOM: #000 1px dotted"> <?php echo $data["school_name"];?></font>
                </td>
            </tr>
            <tr style="height: 17px;">
                <td style="width: 25%; height: 35px;"><strong>ที่อยู่</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["no"];?>&emsp;หมู่ที่ <?php echo $data["mu"];?>&emsp;</font>
                </td>
                <td style="width: 25%; height: 35px;"><strong>ตำบล</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["district_name"];?></font>
                </td>
                <td style="width: 25%; height: 35px;"><strong>อำเภอ</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["amphur_name"];?></font></td>
                <td style="width: 25%; height: 35px;"><strong>จังหวัด</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["province_name"];?></font></td>
            </tr>
            <tr>
                <td style="width: 25%; height: 35px;"><strong>รหัสไปรษณีย์</strong> <font style="BORDER-BOTTOM: #000 1px dotted"><?php echo $data["passcode"];?></font></td>
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
                        <th width="40%"  height="40" bgcolor="#D5D5D5"><center>แนวทางการนำไปใช้ประโยชน์</center></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><center>1</center></td>
                        <td height="30" style="padding-left: 5px">อีกากับเทวดา</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='1' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>2</center></td>
                        <td height="30" style="padding-left: 5px">ช้างคู่บุญ</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='2' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>3</center></td>
                        <td height="30" style="padding-left: 5px">มัสยิดกรือเซะ</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='3' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>4</center></td>
                        <td height="30" style="padding-left: 5px">ตาสากับยายโส</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='4' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>5</center></td>
                        <td height="30" style="padding-left: 5px">ยักษ์หน้าถ้ำ</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='5' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>6</center></td>
                        <td height="30" style="padding-left: 5px">มัสยิด 100 เสา</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='6' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>7</center></td>
                        <td height="30" style="padding-left: 5px">เจ๊ะเห</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='7' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>8</center></td>
                        <td height="30" style="padding-left: 5px">เจ๊ะบูงอกับเจ๊ะมือลอ</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='8' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>9</center></td>
                        <td height="30" style="padding-left: 5px">นางฟ้าผมหอม</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='9' AND teacher_id = '".$id."'");?></td>
                    </tr>
                    <tr>
                        <td><center>10</center></td>
                        <td height="30" style="padding-left: 5px">ปันตน</td>
                        <td height="30" align="center"><?php echo $book_name_1 = $DATABASE->QueryString("SELECT Count(qty) FROM tb_get_book WHERE book_id ='10' AND teacher_id = '".$id."'");?></td>
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
                <td style="width: 43.1785%; height: 35px; text-align: left; font-size: 14px;"><strong>&nbsp; &nbsp; &nbsp;ลงชื่อ</strong>&nbsp;<span style="border-bottom: #000 1px dotted;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span></td>
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
                <td style="width: 43.1785%; height: 35px; padding-left: 59px; font-size: 14px;"><strong>ตำแหน่ง</strong>&nbsp;</td>
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
</html>
<?php
    }
    include("pdf_end.php");
?>