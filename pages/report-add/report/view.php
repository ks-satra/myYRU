
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
            <div id="container" style="height: 400px"></div>
            <table class="table table-striped">
                <thead>
                    <tr style="background-color: #780808; color: #fff;">
                        <td colspan="2" align="center" scope="col" >จำนวน / คน</td>
                    </tr>
                    <tr style="width: 100%">
                        <th scope="col" style="background-color: #0f5906; color: #fff; text-align: center; width: 25%">ชาย</th>
                        <th scope="col" style="background-color: #898686; color: #fff; text-align: center; width: 25%">หญิง</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #0f5906; color: #fff; text-align: center;"><?php echo $province = $DATABASE->QueryString("
                                SELECT
                                    COUNT(tb_teacher.sex_id)
                                FROM
                                    tb_get_book
                                    INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                WHERE tb_teacher.sex_id = '1'
                        "); ?></td>
                        <td style="background-color: #898686; color: #fff; text-align: center;"><?php echo $province = $DATABASE->QueryString("
                                SELECT
                                    COUNT(tb_teacher.sex_id)
                                FROM
                                    tb_get_book
                                    INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                WHERE tb_teacher.sex_id = '2'
                        "); ?></td>
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
                                color: '#0f5906',
                                y: <?php echo $province = $DATABASE->QueryString("
                                SELECT
                                    COUNT(tb_teacher.sex_id)
                                FROM
                                    tb_get_book
                                    INNER JOIN tb_teacher ON tb_get_book.teacher_id = tb_teacher.id
                                WHERE tb_teacher.sex_id = '1'
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
                                WHERE tb_teacher.sex_id = '2'
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
</section>