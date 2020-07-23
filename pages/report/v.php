<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
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
                $SHOW = 10;
                $start = ($PAGE-1)*$SHOW;
                $sql = "
                    SELECT tb_get_book.id as id , MAX(tb_get_book.school_id) as school_id, tb_school.`name` as school_name,  COUNT(DISTINCT tb_get_book.teacher_id) as teacher_id, COUNT(tb_get_book.book_id) as book_id
                    FROM tb_get_book
                        INNER JOIN tb_type_book ON tb_get_book.type_book_id = tb_type_book.id
                        INNER JOIN tb_book ON tb_get_book.book_id = tb_book.id
                        INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                        INNER JOIN tb_prefix ON tb_teacher.prefix_id = tb_prefix.id
                        INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                        INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                        INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                        INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                    GROUP BY tb_get_book.school_id
                ";
                $all = $DATABASE->QueryNumRow($sql);
                $DATA = $DATABASE->QueryObj($sql."ORDER BY COUNT(DISTINCT tb_get_book.teacher_id) DESC LIMIT $start,$SHOW");
            ?>
            
            <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
            <script type="text/javascript">
                Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'โรงเรียนที่รับหนังสือสูงสุด - ต่ำสุด'
                },
                subtitle: {
                    text: 'นิทานชุดที่ 1'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'จำนวน'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
                },
                    series: [{
                        name: 'Population',
                        <?php
                            if(sizeof($DATA)>0){
                                foreach($DATA as $key => $row){
                                    ?>
                        data: [
                            ['<?php echo $row["school_name"];?>', <?php echo $row["teacher_id"];?>]
                        ],
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                        <?php 
                                }
                            }else{
                                echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                            }
                        ?>
                    }]
                });
            </script>
        </div>
    </div>
</section>