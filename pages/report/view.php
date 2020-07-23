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
                google.charts.load('current', {'packages':['calendar']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = new google.visualization.DataTable([
                        ['date_time', 'sum_price'],
                        <?php 
                            $sql = "
                                SELECT *
                                FROM tb_calender
                            ";
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql);
                            
                            if(sizeof($DATA)>0){
                                foreach($DATA as $key => $row){
                                    echo "['".$row['date_time']."','".$row['sum_price']."'],";
                                }
                            }
                        ?> 
                    ]);

                    var options = {
                        title: "Red Sox Attendance",
                        height: 350,
                    }; 
                    var chart = new google.visualization.Calendar(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
            </script>
                <div id="chart_div" style="width: 100%; height: 100%;"></div>
        </div>
    </div>
</section>