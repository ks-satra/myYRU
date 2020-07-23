<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<section class="content-header">
    <h1><i class="fa fa-file"></i> ข้อมูลการศึกษาไทย<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลการศึกษาไทย</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลการศึกษาไทยทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="report">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <?php
                $sql = "        
                    SELECT
                        tb_book.id,
                        tb_book.book_type_id,
                        tb_book.name_thai As book_name,
                        tb_book.name_eng,
                        tb_book.fileupload,
                        tb_type_book.`name` As type_book_name
                    FROM
                        tb_book
                        INNER JOIN tb_type_book ON tb_book.book_type_id = tb_type_book.id
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_book.id DESC");
                    if(sizeof($DATA)>0){ 
                        foreach($DATA as $key => $row){
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div id="report" style="height: 300px;"></div>
                </div>
                <div class="col-md-6">
                    <div id="container" style="height: 400px"></div>
                </div>
            </div>
            <script type="text/javascript">
                Highcharts.chart('report', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'สรุปข้อมูลหนังสือที่ได้รับมาก - น้อยสุด'
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
                                format: '{point.y:.1f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point}</b> เล่ม<br/>'
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
                                            WHERE tb_get_book.book_id = 1 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "อีกากับเทวดา"
                                },
                                {
                                    "name": "ช้างคู่บุญ",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 2 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "ช้างคู่บุญ"
                                },
                                {
                                    "name": "มัสยิดกรือเซะ",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 3 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "มัสยิดกรือเซะ"
                                },
                                {
                                    "name": "ตาสากับยายโส",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 4 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "ตาสากับยายโส"
                                },
                                {
                                    "name": "ยักษ์หน้าถ้ำ",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 5 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "ยักษ์หน้าถ้ำ"
                                },
                                {
                                    "name": "มัสยิด 100 เสา",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 6 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "มัสยิด 100 เสา"
                                },
                                {
                                    "name": "เจ๊ะเห",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 7 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "เจ๊ะเห"
                                },
                                {
                                    "name": "เจ๊ะบูงอกับเจ๊ะมือลอ",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 8 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "เจ๊ะบูงอกับเจ๊ะมือลอ"
                                },
                                {
                                    "name": "นางฟ้าผมหอม",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 9 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "นางฟ้าผมหอม"
                                },
                                {
                                    "name": "ปันตน",
                                    "y": <?php echo $booK_1 = $DATABASE->QueryString("
                                            SELECT COUNT(book_id)
                                            FROM tb_get_book 
                                            WHERE tb_get_book.book_id = 10 AND tb_get_book.school_id = '".$_GET["id"]."'
                                        ");?>,
                                    "drilldown": "ปันตน"
                                }
                            ]
                        }
                    ],
                    "drilldown": {
                        "series": [
                            {
                                "name": "อีกากับเทวดา",
                                "id": "อีกากับเทวดา",
                                "data": [
                                    [
                                        "v65.0",
                                        0.1
                                    ],
                                    [
                                        "v64.0",
                                        1.3
                                    ],
                                    [
                                        "v63.0",
                                        53.02
                                    ],
                                    [
                                        "v62.0",
                                        1.4
                                    ],
                                    [
                                        "v61.0",
                                        0.88
                                    ],
                                    [
                                        "v60.0",
                                        0.56
                                    ],
                                    [
                                        "v59.0",
                                        0.45
                                    ],
                                    [
                                        "v58.0",
                                        0.49
                                    ],
                                    [
                                        "v57.0",
                                        0.32
                                    ],
                                    [
                                        "v56.0",
                                        0.29
                                    ],
                                    [
                                        "v55.0",
                                        0.79
                                    ],
                                    [
                                        "v54.0",
                                        0.18
                                    ],
                                    [
                                        "v51.0",
                                        0.13
                                    ],
                                    [
                                        "v49.0",
                                        2.16
                                    ],
                                    [
                                        "v48.0",
                                        0.13
                                    ],
                                    [
                                        "v47.0",
                                        0.11
                                    ],
                                    [
                                        "v43.0",
                                        0.17
                                    ],
                                    [
                                        "v29.0",
                                        0.26
                                    ]
                                ]
                            },
                            {
                                "name": "ช้างคู่บุญ",
                                "id": "ช้างคู่บุญ",
                                "data": [
                                    [
                                        "v58.0",
                                        1.02
                                    ],
                                    [
                                        "v57.0",
                                        7.36
                                    ],
                                    [
                                        "v56.0",
                                        0.35
                                    ],
                                    [
                                        "v55.0",
                                        0.11
                                    ],
                                    [
                                        "v54.0",
                                        0.1
                                    ],
                                    [
                                        "v52.0",
                                        0.95
                                    ],
                                    [
                                        "v51.0",
                                        0.15
                                    ],
                                    [
                                        "v50.0",
                                        0.1
                                    ],
                                    [
                                        "v48.0",
                                        0.31
                                    ],
                                    [
                                        "v47.0",
                                        0.12
                                    ]
                                ]
                            },
                            {
                                "name": "มัสยิดกรือเซะ",
                                "id": "มัสยิดกรือเซะ",
                                "data": [
                                    [
                                        "v11.0",
                                        6.2
                                    ],
                                    [
                                        "v10.0",
                                        0.29
                                    ],
                                    [
                                        "v9.0",
                                        0.27
                                    ],
                                    [
                                        "v8.0",
                                        0.47
                                    ]
                                ]
                            },
                            {
                                "name": "ตาสากับยายโส",
                                "id": "ตาสากับยายโส",
                                "data": [
                                    [
                                        "v11.0",
                                        3.39
                                    ],
                                    [
                                        "v10.1",
                                        0.96
                                    ],
                                    [
                                        "v10.0",
                                        0.36
                                    ],
                                    [
                                        "v9.1",
                                        0.54
                                    ],
                                    [
                                        "v9.0",
                                        0.13
                                    ],
                                    [
                                        "v5.1",
                                        0.2
                                    ]
                                ]
                            },
                            {
                                "name": "ยักษ์หน้าถ้ำ",
                                "id": "ยักษ์หน้าถ้ำ",
                                "data": [
                                    [
                                        "v16",
                                        2.6
                                    ],
                                    [
                                        "v15",
                                        0.92
                                    ],
                                    [
                                        "v14",
                                        0.4
                                    ],
                                    [
                                        "v13",
                                        0.1
                                    ]
                                ]
                            },
                            {
                                "name": "มัสยิด 100 เสา",
                                "id": "มัสยิด 100 เสา",
                                "data": [
                                    [
                                        "v50.0",
                                        0.96
                                    ],
                                    [
                                        "v49.0",
                                        0.82
                                    ],
                                    [
                                        "v12.1",
                                        0.14
                                    ]
                                ]
                            },
                            {
                                "name": "เจ๊ะเห",
                                "id": "เจ๊ะเห",
                                "data": [
                                    [
                                        "v11.0",
                                        6.2
                                    ],
                                    [
                                        "v10.0",
                                        0.29
                                    ],
                                    [
                                        "v9.0",
                                        0.27
                                    ],
                                    [
                                        "v8.0",
                                        0.47
                                    ]
                                ]
                            },
                            {
                                "name": "เจ๊ะบูงอกับเจ๊ะมือลอ",
                                "id": "เจ๊ะบูงอกับเจ๊ะมือลอ",
                                "data": [
                                    [
                                        "v11.0",
                                        3.39
                                    ],
                                    [
                                        "v10.1",
                                        0.96
                                    ],
                                    [
                                        "v10.0",
                                        0.36
                                    ],
                                    [
                                        "v9.1",
                                        0.54
                                    ],
                                    [
                                        "v9.0",
                                        0.13
                                    ],
                                    [
                                        "v5.1",
                                        0.2
                                    ]
                                ]
                            },
                            {
                                "name": "นางฟ้าผมหอม",
                                "id": "นางฟ้าผมหอม",
                                "data": [
                                    [
                                        "v16",
                                        2.6
                                    ],
                                    [
                                        "v15",
                                        0.92
                                    ],
                                    [
                                        "v14",
                                        0.4
                                    ],
                                    [
                                        "v13",
                                        0.1
                                    ]
                                ]
                            },
                            {
                                "name": "ปันตน",
                                "id": "ปันตน",
                                "data": [
                                    [
                                        "v50.0",
                                        0.96
                                    ],
                                    [
                                        "v49.0",
                                        0.82
                                    ],
                                    [
                                        "v12.1",
                                        0.14
                                    ]
                                ]
                            }
                        ]
                    }
                });
            </script>
            <?php 
                    } 
                }  
            ?>
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
                        tb_teacher.name_thai,
                        tb_teacher.lname_thai,
                        tb_teacher.sex_id
                    FROM
                        tb_get_book
                        INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                        GROUP BY tb_get_book.teacher_id
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_book.id DESC");
            ?>
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
                    series: [<?php if(sizeof($DATA)>0){ 
                        foreach($DATA as $key => $row){ ?>{
                        type: 'pie',
                        name: 'จำนวน',
                        data: [
                            {
                                name: 'ชาย',
                                color: '#0f5906',
                                y: <?php echo $province = $DATABASE->QueryString("
                                    SELECT
                                        COUNT(tb_teacher.sex_id)
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
                                    WHERE tb_teacher.sex_id = 2 AND tb_school.id = 3
                                        GROUP BY tb_prefix.id , tb_teacher.id 
                                "); ?>,
                                sliced: true,
                                selected: true
                            },
                            {
                                name: 'หญิง',
                                color: '#898686',
                                y: <?php echo $province = $DATABASE->QueryString("
                                SELECT
                                    COUNT(tb_teacher.sex_id)
                                FROM
                                    tb_get_book
                                    INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                WHERE tb_teacher.sex_id = '2' AND tb_get_book.school_id = '".$_GET["id"]."'
                                "); ?>,
                                sliced: true,
                                selected: true
                            }
                        ]
                    } <?php } }  ?>]
                });
            </script>
        </div>
    </div>
</section>