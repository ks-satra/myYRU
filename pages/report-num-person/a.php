
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>


<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<section class="content-header">
    <h1><i class="fa fa-file"></i> สรุปจำนวนบุคลากรแยกเป็นชายหญิง<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">สรุปจำนวนบุคลากรแยกเป็นชายหญิง</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> รายงานสรุปจำนวนบุคลากรแยกเป็นชายหญิง</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="report">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div id="container" style="height: 400px"></div>
            <table class="table table-striped">
                <thead>
                    <tr style="background-color: #780808; color: #fff;">
                        <td colspan="2" align="center" scope="col" >จำนวน / คน</td>
                    </tr>
                    <tr style="width: 100%">
                        <th scope="col" style="background-color: #e55f5f; color: #fff; text-align: center; width: 25%">ชาย</th>
                        <th scope="col" style="background-color: #aeaeae; color: #fff; text-align: center; width: 25%">หญิง</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #e55f5f; color: #fff; text-align: center;"><?php echo $province = $DATABASE->QueryString("
                            SELECT COUNT(id) FROM tb_teacher WHERE sex_id = 1
                        "); ?> คน</td>
                        <td style="background-color: #aeaeae; color: #fff; text-align: center;"><?php echo $province = $DATABASE->QueryString("
                            SELECT COUNT(id) FROM tb_teacher WHERE sex_id = 2
                        "); ?> คน</td>
                    </tr>
                </tbody>
            </table>
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
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                                color: '#e55f5f',
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
                                    WHERE tb_teacher.sex_id = '1'
                                "); ?>,
                                sliced: true,
                                selected: true
                            },
                            {
                                name: 'หญิง',
                                color: '#aeaeae',
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
                                    WHERE tb_teacher.sex_id = '2'
                                "); ?>,
                                sliced: true,
                                selected: true
                            }
                        ]
                    }]
                });
            </script>
            <br>
            <p style="text-align: right;"> จำนวนข้อมูลทั้งหมด <?php echo $province = $DATABASE->QueryString("
                SELECT COUNT(id) FROM tb_teacher
            "); ?> คน</p>
        </div>
    </div>
</section>