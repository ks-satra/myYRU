<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<?php
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 300);
    ini_set('pcre.backtrack_limit', 90000000000000000000000000000000000000000000000000000);
    include("pdf_start.php");
    include("../../php/autoload.php");
    include("../../pages/date.php");   
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body style="font-family: Garuda;">
    <?php
        if(sizeof($DATA)>0){
            foreach($DATA as $key => $row){
                ?>
            <p align="center"><img src="../../files/img/aa.gif" alt="" width="12%" height="15%" /></p>
            <p align="center"><b>เอกสารรับมอบหนังสือนิทาน</b></p>
            <p style="padding-top: -20px" align="center"><b>ชุดนิทานคุณธรรมจากวรรณกรรมในฝักกริช</b></p>
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
    <?php 
            }
        }else{
            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
        }
    ?>
</body>
</html>
<?php
    include("pdf_end.php");
?>