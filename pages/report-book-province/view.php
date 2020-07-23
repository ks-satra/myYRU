<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<section class="content-header">
    <h1><i class="fa fa-file"></i> สรุปข้อมูลโรงเรียนที่รับหนังสือแยกแต่ละจังหวัด<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">สรุปข้อมูลโรงเรียนที่รับหนังสือแยกแต่ละจังหวัด</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> รายงานสรุปข้อมูลโรงเรียนที่รับหนังสือแยกแต่ละจังหวัด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="report">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div id="container"></div>
            <table class="table table-striped">
                <thead>
                    <tr style="background-color: #780808; color: #fff;">
                        <td colspan="4" align="center" scope="col" >จำนวน / เล่ม</td>
                    </tr>
                    <tr style="width: 100%">
                        <th scope="col" style="background-color: #ed6161; color: #fff; text-align: center; width: 25%"><a href="?content=report-get-school&province_id=<?php echo $province_nr = $DATABASE->QueryString("
                            SELECT id FROM tb_province WHERE id = '76' "); ?>" title="นราธิวาส" style="color: #fff;"> <i class="fa fa-eye"></i> นราธิวาส</a></th>
                        <th scope="col" style="background-color: #efa7e0; color: #fff; text-align: center; width: 25%"><a href="?content=report-get-school&province_id=<?php echo $province_yl = $DATABASE->QueryString("
                            SELECT id FROM tb_province WHERE id = '75' "); ?>" title="ยะลา" style="color: #fff;"> <i class="fa fa-eye"></i> ยะลา</a></th>
                        <th scope="col" style="background-color: #7ab9e5; color: #fff; text-align: center; width: 25%"><a href="?content=report-get-school&province_id=<?php echo $province_pn = $DATABASE->QueryString("
                            SELECT id FROM tb_province WHERE id = '74' "); ?>" title="ปัตตานี" style="color: #fff;"> <i class="fa fa-eye"></i> ปัตตานี</a></th>
                        <th scope="col" style="background-color: #73ce87; color: #fff; text-align: center; width: 25%"><a href="?content=report-get-school&province_id=all" title="อื่น ๆ" style="color: #fff;"> <i class="fa fa-eye"></i> อื่น ๆ</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #ed6161; color: #fff; text-align: center;"><?php echo $province = $DATABASE->QueryString("
                            SELECT
                                COUNT(DISTINCT tb_school.id)
                            FROM
                                tb_get_book
                                INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                                INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                            WHERE
                                    tb_school.province_id = '76'
                        "); ?></td>
                        <td style="background-color: #efa7e0; color: #fff; text-align: center;"><?php echo $province = $DATABASE->QueryString("
                            SELECT
                                COUNT(DISTINCT tb_school.id)
                            FROM
                                tb_get_book
                                INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                                INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                            WHERE
                                    tb_school.province_id = '75'
                        "); ?></td>
                        <td style="background-color: #7ab9e5; color: #fff; text-align: center;"><?php echo $province = $DATABASE->QueryString("
                            SELECT
                                COUNT(DISTINCT tb_school.id)
                            FROM
                                tb_get_book
                                INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                                INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                            WHERE
                                    tb_school.province_id = '74'
                        "); ?></td>
                        <td style="background-color: #73ce87; color: #fff; text-align: center;"><?php echo $province = $DATABASE->QueryString("
                            SELECT
                                COUNT(DISTINCT tb_school.id)
                            FROM
                                tb_get_book
                                INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                                INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                            WHERE
                                tb_school.province_id != '74' AND tb_school.province_id != '75' AND tb_school.province_id != '76'
                        "); ?></td>
                    </tr>
                </tbody>
            </table>
            <script type="text/javascript">
                Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'สรุปข้อมูลโรงเรียนที่รับหนังสือแยกแต่ละจังหวัด'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'จำนวน',
                        colorByPoint: true,
                        data: [{
                            name: '<b>นราธิวาส</b>',
                            y: <?php echo $province = $DATABASE->QueryString("
                                        SELECT
                                            COUNT(DISTINCT tb_school.id)
                                        FROM
                                            tb_get_book
                                            INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                                        WHERE
                                            tb_school.province_id = '76'
                                    "); ?>,
                            color: '#ed6161',
                            sliced: true,
                            selected: true
                        }, {
                            name: '<b>ยะลา</b>',
                            y: <?php echo $province = $DATABASE->QueryString("
                                        SELECT
                                            COUNT(DISTINCT tb_school.id)
                                        FROM
                                            tb_get_book
                                            INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                                        WHERE
                                            tb_school.province_id = '75'
                                    "); ?>,
                            color: '#efa7e0'
                        }, {
                            name: '<b>ปัตตานี</b>',
                            y: <?php echo $province = $DATABASE->QueryString("
                                        SELECT
                                            COUNT(DISTINCT tb_school.id)
                                        FROM
                                            tb_get_book
                                            INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                                        WHERE
                                            tb_school.province_id = '74'
                                    "); ?>,
                            color: '#7ab9e5'
                        }, {
                            name: '<b>อื่น ๆ</b>',
                            y: <?php echo $province = $DATABASE->QueryString("
                                        SELECT
                                            COUNT(DISTINCT tb_school.id)
                                        FROM
                                            tb_get_book
                                            INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                                        WHERE
                                            tb_school.province_id != '74' AND tb_school.province_id != '75' AND tb_school.province_id != '76'
                                    "); ?>,
                            color: '#73ce87'
                        }]
                    }]
                });
            </script>
            <br>
            <p style="text-align: right;"> จำนวนข้อมูลโรงเรียนทั้งหมด <?php echo $province = $DATABASE->QueryString("
                SELECT
                    COUNT(DISTINCT tb_school.id)
                FROM
                    tb_get_book
                    INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                    INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                    INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                    INNER JOIN tb_province ON tb_school.province_id = tb_province.id
            "); ?> แห่ง</p>
        </div>
    </div>
</section>