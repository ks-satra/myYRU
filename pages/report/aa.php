<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js"></script>
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/th/th-all.js"></script>
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
            
            <div id="container"></div>
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
            <script type="text/javascript">
                var H = Highcharts,
                    map = H.maps['countries/th/th-all'],
                    chart;

                // Add series with state capital bubbles
                $.post("pages/report/th-capitals.php", function (data) {
                    var data = [];
                    $.each(data, function () {
                        this.z = this.population;
                        data.push(this);
                    });

                    chart = Highcharts.mapChart('container', {
                        title: {
                            text: 'Highmaps lat/lon demo'
                        },

                        tooltip: {
                            pointFormat: '{point.capital}, {point.parentState}<br>' +
                                'Lat: {point.lat}<br>' +
                                'Lon: {point.lon}<br>' +
                                'Population: {point.population}'
                        },

                        xAxis: {
                            crosshair: {
                                zIndex: 5,
                                dashStyle: 'dot',
                                snap: false,
                                color: 'gray'
                            }
                        },

                        yAxis: {
                            crosshair: {
                                zIndex: 5,
                                dashStyle: 'dot',
                                snap: false,
                                color: 'gray'
                            }
                        },

                        series: [{
                            name: 'Basemap',
                            mapData: map,
                            borderColor: '#606060',
                            nullColor: 'rgba(200, 200, 200, 0.2)',
                            showInLegend: false
                        }, {
                            name: 'Separators',
                            type: 'mapline',
                            data: H.geojson(map, 'mapline'),
                            color: '#101010',
                            enableMouseTracking: false,
                            showInLegend: false
                        }, {
                            type: 'mapbubble',
                            dataLabels: {
                                enabled: true,
                                format: '{point.capital}'
                            },
                            name: 'จังหวัด',
                            data: data,
                            maxSize: '12%',
                            color: H.getOptions().colors[0]
                        }]
                    });
                });

                // Display custom label with lat/lon next to crosshairs
                $('#container').mousemove(function (e) {
                    var position;
                    if (chart) {
                        if (!chart.lab) {
                            chart.lab = chart.renderer.text('', 0, 0)
                                .attr({
                                    zIndex: 5
                                })
                                .css({
                                    color: '#505050'
                                })
                                .add();
                        }

                        e = chart.pointer.normalize(e);
                        position = chart.fromPointToLatLon({
                            x: chart.xAxis[0].toValue(e.chartX),
                            y: chart.yAxis[0].toValue(e.chartY)
                        });

                        chart.lab.attr({
                            x: e.chartX + 5,
                            y: e.chartY - 22,
                            text: 'Lat: ' + position.lat.toFixed(2) + '<br>Lon: ' + position.lon.toFixed(2)
                        });
                    }
                });

                $('#container').mouseout(function () {
                    if (chart && chart.lab) {
                        chart.lab.destroy();
                        chart.lab = null;
                    }
                });

            </script>
        </div>
    </div>
</section>
