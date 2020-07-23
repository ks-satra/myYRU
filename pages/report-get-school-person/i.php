<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $PROVINCE_ID = $_GET['province_id'];
    $ALL = "all-";
    $SCHOOL_ID = $_GET['school_id'];
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<section class="content-header">
    <h1><i class="fa fa-file"></i> ข้อมูลโรงเรียน<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลโรงเรียน</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลโรงเรียนทั้งหมด</h3><small> > <?php echo $province = $DATABASE->QueryString("SELECT name FROM tb_school WHERE id = '".$_GET['school_id']."'");?></small>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="report-get-school-person">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <input type="hidden" name="province_id" value="<?php echo $PROVINCE_ID; ?>">
                    <input type="hidden" name="school_id" value="<?php echo $SCHOOL_ID; ?>">
                    <?php if($PROVINCE_ID == '74' OR $PROVINCE_ID == '75' OR $PROVINCE_ID == '76'){ $PROVINCE_ID = $PROVINCE_ID; ?>
                        <a href="?content=report-get-school&province_id=<?php echo $PROVINCE_ID;?>&page=<?php echo $PAGE;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                    <?php } else { $ALL = "all"; ?>
                        <a href="?content=report-get-school&province_id=<?php echo $ALL;?>&page=<?php echo $PAGE;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                    <?php
                        }
                    ?>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=report-get-school-person&province_id=<?php echo $PROVINCE_ID;?>&school_id=<?php echo $SCHOOL_ID;?>'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูล" value="<?php echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <?php
                $SHOW = 12;
                $start = ($PAGE-1)*$SHOW;
                $condition = "";
                    $condition = " AND tb_school.id = '".$SCHOOL_ID."' 
                ";
                $sql = "                
                    SELECT
                        tb_get_book.id,
                        tb_get_book.type_book_id,
                        tb_get_book.book_id,
                        tb_get_book.qty as qty,
                        tb_get_book.teacher_id,
                        tb_get_book.school_id,
                        tb_get_book.note,
                        tb_get_book.date_start,
                        tb_type_book.`name`,
                        tb_book.book_type_id,
                        tb_book.name_thai as book_name,
                        tb_book.name_eng,
                        tb_book.photo,
                        tb_book.fileupload,
                        tb_teacher.card,
                        tb_teacher.prefix_id,
                        tb_teacher.name_thai,
                        tb_teacher.lname_thai,
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
                        tb_prefix.`name` as prefix_name,
                        tb_prefix.name_eng,
                        tb_prefix.abbreviation,
                        tb_district.`name`,
                        tb_amphur.`name`,
                        tb_amphur.passcode,
                        tb_province.`name`,
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
                        INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                        INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                        INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                        INNER JOIN tb_area ON tb_school.area_id = tb_area.id
                        INNER JOIN tb_department ON tb_school.department_id = tb_department.id
                    WHERE (
                        tb_teacher.id LIKE '%$SERACHING%' OR
                        tb_teacher.name_thai LIKE '%$SERACHING%' OR
                        tb_teacher.lname_thai LIKE '%$SERACHING%' OR
                        CONCAT( tb_teacher.name_thai, ' ' ,tb_teacher.lname_thai) LIKE '%$SERACHING%' OR
                        CONCAT( tb_prefix.`name`, tb_teacher.name_thai, ' ' ,tb_teacher.lname_thai) LIKE '%$SERACHING%'
                    ) ".$condition." 
                    GROUP BY tb_prefix.id , tb_teacher.id
                ";
                $all = $DATABASE->QueryNumRow($sql);
                $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_get_book.id DESC LIMIT $start,$SHOW ");
            ?>
            <div class="row">
                <div class="col-md-6">
                    <?php
                        if(sizeof($DATA)>0){ 
                            foreach($DATA as $key => $row){
                                $teacher_id = $row["teacher_id"];
                    ?>
                            <div class="col-md-4">
                                <div class="form-group" align="center">
                                    <a href="#view<?php echo $row["teacher_id"];?>" class="thumbnail" style="width: 150px; height: 150px; margin: 0px;" data-toggle="modal">
                                        <img id="img_1" style="width: 100%;height: 100%;" src="files/img_teacher/<?php echo $row['photo']; ?>" alt="User image" onerror="ON_IMAGE_ERROR(this)">
                                    </a>
                                </div>
                                <small><center><?php echo $row["prefix_name"];?><?php echo $row["name_thai"];?> <?php echo $row["lname_thai"];?></center></small>
                                <br>
                            </div>
                            <div id="view<?php echo $teacher_id;?>" class="modal fade" tabindex="-1" role="dialog" id="dialog">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #780808; color: #fff;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><i class="fa fa-eye"></i> ตรวจสอบรายชื่อหนังสือ</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="modal-title" align="center">รายชื่อหนังสือที่ได้รับ</h5><br>
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
                                                        tb_book.id,
                                                        tb_book.book_type_id,
                                                        tb_book.name_thai as book_name,
                                                        tb_book.name_eng,
                                                        tb_book.photo,
                                                        tb_book.fileupload
                                                    FROM
                                                        tb_get_book
                                                        INNER JOIN tb_book ON tb_get_book.book_id = tb_book.id
                                                    WHERE tb_get_book.teacher_id = '".$teacher_id."'

                                                ";
                                                $all = $DATABASE->QueryNumRow($sql);
                                                $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_get_book.id ");
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-solid" style="background-color: #dbd6d6;">
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
                                                                WHERE tb_get_book.teacher_id = '".$teacher_id."'
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
                                            <p style="text-align: right;"> จำนวนข้อมูล 
                                                <?php 
                                                    $COUNT_BOOK = $DATABASE->QueryString("SELECT COUNT(DISTINCT (book_id)) FROM tb_get_book WHERE teacher_id = '".$teacher_id."'");
                                                    $COUNT_QTY = $DATABASE->QueryString("SELECT SUM(QTY) FROM tb_get_book WHERE teacher_id = '".$teacher_id."'");
                                                    echo $COUNT_BOOK;
                                                ?> เรื่อง <?php echo $COUNT_QTY;?> เล่ม
                                            </p>
                                        </div>
                                        <div class="modal-footer" style="background-color: #780808; color: #fff;">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" title="ปิด">ปิด</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php 
                            }
                        }else{
                            echo "<div align='center'><i>ไม่มีข้อมูล</i></div>";
                        }
                    ?>
                </div>
                <div class="col-md-6">
                    <div id="report" style="height: 300px"></div>
                    <div id="container" style="height: 400px"></div>
                    <script type="text/javascript">
                        Highcharts.chart('report', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'กราฟ'
                            },
                            subtitle: {
                                text: 'สรุปข้อมูลหนังสือที่ได้รับมาก - น้อยสุด'
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                title: {
                                    text: 'จำนวนหนังสือ'
                                }

                            },
                            legend: {
                                enabled: false
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            },

                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> เล่ม<br/>'
                            },
                            "series": [
                                {
                                    "name": "<b>หนังสือ : </b>",
                                    "colorByPoint": true,
                                    "data": [
                                        {
                                            "name": "อีกากับเทวดา",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 1 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "อีกากับเทวดา"
                                        },
                                        {
                                            "name": "ช้างคู่บุญ",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 2 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "ช้างคู่บุญ"
                                        },
                                        {
                                            "name": "มัสยิดกรือเซะ",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 3 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "มัสยิดกรือเซะ"
                                        },
                                        {
                                            "name": "ตาสากับยายโส",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 4 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "ตาสากับยายโส"
                                        },
                                        {
                                            "name": "ยักษ์หน้าถ้ำ",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 5 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "ยักษ์หน้าถ้ำ"
                                        },
                                        {
                                            "name": "มัสยิด 100 เสา",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 6 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "มัสยิด 100 เสา"
                                        },
                                        {
                                            "name": "เจ๊ะเห",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 7 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "เจ๊ะเห"
                                        },
                                        {
                                            "name": "เจ๊ะบูงอกับเจ๊ะมือลอ",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 8 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "เจ๊ะบูงอกับเจ๊ะมือลอ"
                                        },
                                        {
                                            "name": "นางฟ้าผมหอม",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 9 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "นางฟ้าผมหอม"
                                        },
                                        {
                                            "name": "ปันตน",
                                            "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                    SELECT COUNT(book_id)
                                                    FROM tb_get_book 
                                                    WHERE tb_get_book.book_id = 10 AND tb_get_book.school_id = '".$SCHOOL_ID."'
                                                ");?>,
                                            "drilldown": "ปันตน"
                                        }
                                    ]
                                }
                            ] 
                        });
                    </script>
                    <script type="text/javascript">
                        Highcharts.chart('container', {
                            chart: {
                                type: 'pie',
                                options3d: {
                                    enabled: true,
                                    alpha: 45,
                                    beta: 0
                                }
                            },
                            title: {
                                text: 'สรุปจำนวนบุคลากรแยกเป็นชายหญิง'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.y} คน</b>'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    depth: 35,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.name}'
                                    }
                                }
                            },
                            series: [{
                                type: 'pie',
                                name: 'จำนวน',
                                data: [
                                    {
                                        name: 'ชาย',
                                        color: '#0f5906',
                                        y: <?php echo $province = $DATABASE->QueryString("SELECT COUNT(id) FROM tb_teacher WHERE sex_id = '1' AND school_id = '".$SCHOOL_ID."'
                                        "); ?>,
                                        sliced: true,
                                        selected: true
                                    },
                                    {
                                        name: 'หญิง',
                                        color: '#898686',
                                        y: <?php echo $province = $DATABASE->QueryString("
                                        SELECT COUNT(id) FROM tb_teacher WHERE sex_id = '2' AND school_id = '".$SCHOOL_ID."'
                                        "); ?>,
                                        sliced: true,
                                        selected: true
                                    }
                                ]
                            }]
                        });
                    </script>
                </div>
            </div>
            <p style="text-align: right;"> จำนวนข้อมูลบุคคลทั้งหมด <?php echo $province = $DATABASE->QueryString("
                SELECT COUNT(sex_id)
                FROM
                tb_teacher
                WHERE school_id = '".$SCHOOL_ID."'
            "); ?> คน</p>
            <p style="text-align: right;"> จำนวนข้อมูลหนังสือทั้งหมด <?php echo $province = $DATABASE->QueryString("
                SELECT COUNT(book_id)
                FROM
                tb_get_book
                WHERE school_id = '".$SCHOOL_ID."'
            "); ?> เล่ม</p>
            <?php
                $province_id = '&province_id='.$PROVINCE_ID;
                $school_id = '&school_id='.$SCHOOL_ID;
                $searhing = "";
                if( $SERACHING!="" ) {
                    $searhing = '&searhing='.$SERACHING;
                }

                $disabled1 = '';
                $disabled2 = '';
                $href1 = 'href="?content=report-get-school-person&page='.($PAGE-1).$searhing.$province_id.$school_id.'"';
                $href2 = 'href="?content=report-get-school-person&page='.($PAGE+1).$searhing.$province_id.$school_id.'"';

                if($PAGE==1) {
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
</section>