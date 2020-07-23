<script src="pages/project-onet/fileupload.js"></script>
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
                    <input type="hidden" name="content" value="project">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <!-- <a href="?content=project-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=project'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาโครงการ" value="<?php //echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a> -->
                </form>
            </div>
        </div>
        <style type="text/css">
            #container {
                height: 500px; 
                min-width: 310px; 
                max-width: 800px; 
                margin: 0 auto; 
            }
            .loading {
                margin-top: 10em;
                text-align: center;
                color: gray;
            }
        </style>
        <div class="box-body" style="margin-top: 0px;">
            <script src="https://code.highcharts.com/maps/highmaps.js"></script>
            <script src="https://code.highcharts.com/maps/modules/data.js"></script>
            <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
            <script src="https://code.highcharts.com/mapdata/custom/world.js"></script>

            <div id="container">
                <div class="loading">
                    <i class="icon-spinner icon-spin icon-large"></i>
                    Loading data from Google Spreadsheets...
                </div>
            </div>
            <script type="text/javascript">
                // Load the data from a Google Spreadsheet
                // https://docs.google.com/spreadsheets/d/1WBx3mRqiomXk_ks1a5sEAtJGvYukguhAkcCuRDrY1L0/pubhtml
                Highcharts.data({
                    googleSpreadsheetKey: '1WBx3mRqiomXk_ks1a5sEAtJGvYukguhAkcCuRDrY1L0',

                    // Custom handler when the spreadsheet is parsed
                    parsed: function (columns) {

                        // Read the columns into the data array
                        var data = [];
                        Highcharts.each(columns[0], function (code, i) {
                            data.push({
                                code: code.toUpperCase(),
                                value: parseFloat(columns[2][i]),
                                name: columns[1][i]
                            });
                        });

                        // Initiate the chart
                        Highcharts.mapChart('container', {
                            chart: {
                                map: 'custom/world',
                                borderWidth: 1
                            },

                            colors: ['rgba(19,64,117,0.05)', 'rgba(19,64,117,0.2)', 'rgba(19,64,117,0.4)',
                                'rgba(19,64,117,0.5)', 'rgba(19,64,117,0.6)', 'rgba(19,64,117,0.8)', 'rgba(19,64,117,1)'],

                            title: {
                                text: 'Population density by country (/km²)'
                            },

                            mapNavigation: {
                                enabled: true
                            },

                            legend: {
                                title: {
                                    text: 'Individuals per km²',
                                    style: {
                                        color: ( // theme
                                            Highcharts.defaultOptions &&
                                            Highcharts.defaultOptions.legend &&
                                            Highcharts.defaultOptions.legend.title &&
                                            Highcharts.defaultOptions.legend.title.style &&
                                            Highcharts.defaultOptions.legend.title.style.color
                                        ) || 'black'
                                    }
                                },
                                align: 'left',
                                verticalAlign: 'bottom',
                                floating: true,
                                layout: 'vertical',
                                valueDecimals: 0,
                                backgroundColor: ( // theme
                                    Highcharts.defaultOptions &&
                                    Highcharts.defaultOptions.legend &&
                                    Highcharts.defaultOptions.legend.backgroundColor
                                ) || 'rgba(255, 255, 255, 0.85)',
                                symbolRadius: 0,
                                symbolHeight: 14
                            },

                            colorAxis: {
                                dataClasses: [{
                                    to: 3
                                }, {
                                    from: 3,
                                    to: 10
                                }, {
                                    from: 10,
                                    to: 30
                                }, {
                                    from: 30,
                                    to: 100
                                }, {
                                    from: 100,
                                    to: 300
                                }, {
                                    from: 300,
                                    to: 1000
                                }, {
                                    from: 1000
                                }]
                            },

                            series: [{
                                data: data,
                                joinBy: ['iso-a3', 'code'],
                                animation: true,
                                name: 'Population density',
                                states: {
                                    hover: {
                                        color: '#a4edba'
                                    }
                                },
                                tooltip: {
                                    valueSuffix: '/km²'
                                },
                                shadow: false
                            }]
                        });
                    },
                    error: function () {
                        document.getElementById('container').innerHTML = '<div class="loading">' +
                            '<i class="icon-frown icon-large"></i> ' +
                            'Error loading data from Google Spreadsheets' +
                            '</div>';
                    }
                });
            </script>
        </div>
    </div>
</section>