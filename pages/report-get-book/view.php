<script src="assets/highcharts/highcharts.js"></script>
<script src="assets/highcharts/data.js"></script>
<script src="assets/highcharts/exporting.js"></script>
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
                    <input type="hidden" name="content" value="report_type_book_1">
                    <input type="hidden" name="content" value="report_type_book_2">
                    <input type="hidden" name="content" value="report_type_book_3">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div id="report_type_book_1" style="height: 300px"></div>
            <br>
            <p style="text-align: right;"> จำนวนข้อมูลทั้งหมด <?php echo $report_type_book_1 = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '1'"); ?> เล่ม</p>
            <script type="text/javascript">
                Highcharts.chart('report_type_book_1', {
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
                    "series":[{
                        "name": "<b>หนังสือ : </b>",
                        "colorByPoint": true,
                        <?php 
                            $sql = "
                                SELECT *
                                FROM
                                    tb_book
                                WHERE
                                    book_type_id = '1'
                            ";
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_book.id");
                        ?>
                        "data":[
                            <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $key => $row){
                            ?>
                                {
                                    "name":"<?php echo $row["name_thai"];?>",
                                    "y": <?php echo $qty = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '1' AND tb_get_book.book_id='".$row['id']."' ");?>
                                },
                            <?php 
                                    }
                                }else{
                                    echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                }
                            ?>
                        ],
                    }]
                });
            </script>

            <div id="report_type_book_2" style="height: 300px"></div>
            <br>
            <p style="text-align: right;"> จำนวนข้อมูลทั้งหมด <?php echo $report_type_book_2 = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '2'"); ?> เล่ม</p>
            <script type="text/javascript">
                Highcharts.chart('report_type_book_2', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'สรุปข้อมูลสมุดธนาคาร '
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
                    "series":[{
                        "name": "<b>หนังสือ : </b>",
                        "colorByPoint": true,
                        <?php 
                            $sql = "
                                SELECT *
                                FROM
                                    tb_book
                                WHERE
                                    book_type_id = '2'
                            ";
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_book.id");
                        ?>
                        "data":[
                            <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $key => $row){
                            ?>
                                {
                                    "name":"<?php echo $row["name_thai"];?>",
                                    "y":<?php echo $qty = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '2' AND tb_get_book.book_id = '".$row["id"]."';");?>
                                },
                            <?php 
                                    }
                                }else{
                                    echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                }
                            ?>
                        ],
                    }]
                });
            </script>

            <div id="report_type_book_3" style="height: 300px"></div>
            <br>
            <p style="text-align: right;"> จำนวนข้อมูลทั้งหมด <?php echo $report_type_book_3 = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '3'"); ?> เล่ม</p>
            <script type="text/javascript">
                Highcharts.chart('report_type_book_3', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'สรุปข้อมูลหนังสือเรียนมูลาบาฮาซา ภาษาไทย ป.1 - ป.6'
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
                    "series":[{
                        "name": "<b>หนังสือ : </b>",
                        "colorByPoint": true,
                        <?php 
                            $sql = "
                                SELECT *
                                FROM
                                    tb_book
                                WHERE
                                    book_type_id = '3'
                            ";
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_book.id");
                        ?>
                        "data":[
                            <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $key => $row){
                            ?>
                                {
                                    "name":"<?php echo $row["name_thai"];?>",
                                    "y":<?php echo $qty = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '3' AND tb_get_book.book_id = '".$row["id"]."';");?>
                                },
                            <?php 
                                    }
                                }else{
                                    echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                }
                            ?>
                        ],
                    }]
                });
            </script>
        </div>
    </div>
</section>