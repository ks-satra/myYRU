<script type="text/javascript" src="assets/orgchart/jsapi.js"></script>
<script type="text/javascript" src="assets/orgchart/loader.js"></script>
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
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['map'],
                    'mapsApiKey': 'AIzaSyDVorLvHctD5wbBG1ghZnDNOFizhDerS8E'
                });
                google.charts.setOnLoadCallback(drawMap);
                
                function drawMap() {
                    var data = google.visualization.arrayToDataTable([
                        ['Address','Location'],

                        <?php 
                            $sql = "
                                SELECT *
                                FROM tb_map2
                            ";
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql);
                            if(sizeof($DATA)>0){
                                foreach($DATA as $key => $row){
                                    echo "['".$row['Address']."','".$row['Location']."'],";
                                }
                            }
                        ?> 
                        ]);

                    var options = {
                        mapType: 'styledMap',
                        zoomLevel: 12,
                        showTooltip: true,
                        showInfoWindow: true,
                        useMapTypeControl: true,
                        maps: {
                            styledMap: {
                                name: 'Styled Map', 
                                styles: [
                                    {featureType: 'poi.attraction',
                                        stylers: [{color: '#fce8b2'}]
                                    },
                                    {featureType: 'road.highway',
                                        stylers: [{hue: '#0277bd'}, {saturation: -50}]
                                    },
                                    {featureType: 'road.highway',
                                        elementType: 'labels.icon',
                                        stylers: [{hue: '#000'}, {saturation: 100}, {lightness: 50}]
                                    },
                                    {featureType: 'landscape',
                                        stylers: [{hue: '#259b24'}, {saturation: 10}, {lightness: -22}]
                                    }
                                ]
                            }  
                        }
                    };

                    var map = new google.visualization.Map(document.getElementById('map_div'));
                    map.draw(data, options);
                }
            </script>
                <div id="map_div" style="width: 100%; height: 100%;"></div>
        </div>
    </div>
</section>