<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<section class="content-header">
    <h1><i class="fa fa-file"></i> สรุปข้อมูลหนังสือที่ได้รับมาก - น้อยสุด<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">สรุปข้อมูลหนังสือที่ได้รับมาก - น้อยสุด</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> รายงานสรุปข้อมูลหนังสือที่ได้รับมาก - น้อยสุด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="report1">
                    <input type="hidden" name="content" value="report2">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div id="report1" style="height: 300px"></div>
            <br>
            <p style="text-align: right;"> จำนวนข้อมูลทั้งหมด <?php echo $province = $DATABASE->QueryString("
                SELECT
                    COUNT(tb_province.id)
                FROM
                    tb_get_book
                    INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                    INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                    INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                    INNER JOIN tb_province ON tb_school.province_id = tb_province.id
            "); ?> เล่ม</p>
            <script type="text/javascript">
                Highcharts.chart('report1', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'สรุปข้อมูลหนังสือนิทานวรรณกรรมในฝักกริซ'
                    },
                    subtitle: {
                        text: ''
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
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> เล่ม<br/> <b>เพศที่รับหนังสือ : </b><br> {point.sex_man}: {point.no_man} เล่ม<br>{point.sex_woman}: {point.no_woman} เล่ม'
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
                                            WHERE tb_get_book.book_id = 1
                                        ");?>,
                                    "drilldown": "อีกากับเทวดา",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '1' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '1' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "ช้างคู่บุญ",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 2
                                        ");?>,
                                    "drilldown": "ช้างคู่บุญ",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '2' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '2' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "มัสยิดกรือเซะ",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 3
                                        ");?>,
                                    "drilldown": "มัสยิดกรือเซะ",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '3' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '3' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "ตาสากับยายโส",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 4
                                        ");?>,
                                    "drilldown": "ตาสากับยายโส",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '4' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '4' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "ยักษ์หน้าถ้ำ",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 5
                                        ");?>,
                                    "drilldown": "ยักษ์หน้าถ้ำ",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '5' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '5' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "มัสยิด 100 เสา",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 6
                                        ");?>,
                                    "drilldown": "มัสยิด 100 เสา",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '6' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '6' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "เจ๊ะเห",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 7
                                        ");?>,
                                    "drilldown": "เจ๊ะเห",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '7' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '7' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "เจ๊ะบูงอกับเจ๊ะมือลอ",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 8
                                        ");?>,
                                    "drilldown": "เจ๊ะบูงอกับเจ๊ะมือลอ",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '8' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '8' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "นางฟ้าผมหอม",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 9
                                        ");?>,
                                    "drilldown": "นางฟ้าผมหอม",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '9' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '9' AND tb_teacher.sex_id = '2';
                                        ");?>
                                },
                                {
                                    "name": "ปันตน",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 10
                                        ");?>,
                                    "drilldown": "ปันตน",
                                    "sex_man": "ชาย",
                                    "no_man": <?php echo $SEX_MAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '10' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "sex_woman": "หญิง",
                                    "no_woman": <?php echo $SEX_WOMAN = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.book_id = '10' AND tb_teacher.sex_id = '2';
                                        ");?>
                                }
                            ]
                        }
                    ] 
                });
            </script>
            <div id="report2" style="height: 300px"></div>
            <br>
            <p style="text-align: right;"> จำนวนข้อมูลทั้งหมด <?php echo $province = $DATABASE->QueryString("
                SELECT
                    COUNT(tb_get_book.type_book_id)
                FROM
                        tb_get_book
                WHERE type_book_id = '2'
            "); ?> เล่ม</p>
            <script type="text/javascript">
                Highcharts.chart('report2', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'สรุปข้อมูลธนาคารหนังสือ (Bookbank)'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'จำนวนธนาคารหนังสือ (Bookbank)'
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
                                    "name": "ชาย",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT
                                                COUNT(tb_get_book.type_book_id)
                                            FROM
                                                    tb_get_book
                                            INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                            WHERE tb_get_book.type_book_id = '2' AND tb_teacher.sex_id = '1';
                                        ");?>,
                                    "drilldown": "ชาย"
                                },
                                {
                                    "name": "หญิง",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                                SELECT
                                                    COUNT(tb_get_book.type_book_id)
                                                FROM
                                                        tb_get_book
                                                INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                                WHERE tb_get_book.type_book_id = '2' AND tb_teacher.sex_id = '2';

                                        ");?>,
                                    "drilldown": "หญิง"
                                }
                            ]
                        }
                    ] 
                });
            </script>
        </div>
    </div>
</section>