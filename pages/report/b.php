
<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/maps/modules/map.js"></script>
<script src="https://code.highcharts.com/maps/modules/data.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/th/th-all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" type="text/css" />
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
            
            <div id="container">
                <div class="loading">
                    <i class="icon-spinner icon-spin icon-large"></i>
                    Loading data from Google Spreadsheets...
                </div>
            </div>
            <style type="text/css">
                #container {
                    height: 500px; 
                    min-width: 310px; 
                    max-width: 600px; 
                    margin: 0 auto; 
                }
                .loading {
                    margin-top: 10em;
                    text-align: center;
                    color: gray;
                } 
            </style>
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
                // Load the data from a Google Spreadsheet
                // https://docs.google.com/spreadsheets/d/14632VxDAT-TAL06ICnoLsV_JyvjEBXdVY-J34br5iXY/pubhtml
                Highcharts.data({
                    googleSpreadsheetKey: '14632VxDAT-TAL06ICnoLsV_JyvjEBXdVY-J34br5iXY',

                    // Custom handler for columns
                    parsed: function (columns) {

                        /**
                         * Event handler for clicking points. Use jQuery UI to pop up
                         * a pie chart showing the details for each state.
                         */
                        function pointClick() {
                            var row = this.options.row,
                                $div = $('<div></div>')
                                    .dialog({
                                        title: this.name,
                                        width: 320,
                                        height: 300
                                    });

                            window.chart = new Highcharts.Chart({
                                chart: {
                                    renderTo: $div[0],
                                    type: 'pie',
                                    width: 290,
                                    height: 240
                                },
                                title: {
                                    text: null
                                },
                                series: [{
                                    name: 'Votes',
                                    data: [{
                                        name: 'Trump',
                                        color: '#0200D0',
                                        y: parseInt(columns[1][row], 1)
                                    }, {
                                        name: 'Clinton',
                                        color: '#C40401',
                                        y: parseInt(columns[2][row], 2)
                                    }],
                                    dataLabels: {
                                        format: '<b>{point.name}</b> {point.percentage:.1f}%'
                                    }
                                }]
                            });
                        }

                        // Make the columns easier to read

                        var keys = columns[0],
                            names = columns[1],
                            percent = columns[7],
                            mapData = Highcharts.maps['countries/th/th-all'],
                            // Build the chart options
                            options = {
                                chart: {
                                    type: 'map',
                                    map: mapData,
                                    renderTo: 'container',
                                    borderWidth: 1
                                },

                                title: {
                                    text: 'TH presidential election 2019 results'
                                },
                                subtitle: {
                                    text: 'Source: <a href="https://transition.fec.gov/pubrec/fe2016/2016presgeresults.pdf">Federal Election Commission</a>'
                                },

                                legend: {
                                    align: 'right',
                                    verticalAlign: 'top',
                                    x: -100,
                                    y: 70,
                                    floating: true,
                                    layout: 'vertical',
                                    valueDecimals: 0,
                                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255, 255, 255, 0.85)'
                                },

                                mapNavigation: {
                                    enabled: true,
                                    enableButtons: false
                                },

                                colorAxis: {
                                    dataClasses: [{
                                        from: -100,
                                        to: 0,
                                        color: '#C40401',
                                        name: 'Clinton'
                                    }, {
                                        from: 0,
                                        to: 100,
                                        color: '#0200D0',
                                        name: 'Trump'
                                    }]
                                },

                                series: [{
                                    data: [],
                                    joinBy: 'postal-code',
                                    dataLabels: {
                                        enabled: true,
                                        color: '#FFFFFF',
                                        format: '{point.postal-code}',
                                        style: {
                                            textTransform: 'uppercase'
                                        }
                                    },
                                    name: 'Republicans margin',
                                    point: {
                                        events: {
                                            click: pointClick
                                        }
                                    },
                                    tooltip: {
                                        ySuffix: ' %'
                                    },
                                    cursor: 'pointer'
                                }, {
                                    name: 'Separators',
                                    type: 'mapline',
                                    nullColor: 'silver',
                                    showInLegend: false,
                                    enableMouseTracking: false
                                }]
                            };
                        keys = keys.map(function (key) {
                            return key.toUpperCase();
                        });
                        Highcharts.each(mapData.features, function (mapPoint) {
                            if (mapPoint.properties['postal-code']) {
                                var postalCode = mapPoint.properties['postal-code'],
                                    i = $.inArray(postalCode, keys);
                                options.series[0].data.push(Highcharts.extend({
                                    value: parseFloat(percent[i]),
                                    name: names[i],
                                    'postal-code': postalCode,
                                    row: i
                                }, mapPoint));
                            }
                        });

                        // Initiate the chart

                        window.chart = new Highcharts.Map(options);
                    },

                    error: function () {
                        $('#container').html('<div class="loading">' +
                            '<i class="icon-frown icon-large"></i> ' +
                            '<p>Error loading data from Google Spreadsheets</p>' +
                            '</div>');
                    }
                });
            </script>
        </div>
    </div>
</section>