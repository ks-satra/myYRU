<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    date_default_timezone_set("Asia/Bangkok");
    date_default_timezone_get();
    $date = date_create('now')->format('Y-m-d H:i:s');
    $today = date('d-m-Y');
    $today2 = date('Y-m-d');  
?>
<?php if($USER["status_id"]=="1"||$USER["status_id"]=="3") {?>
    <section class="content-header">
        <h1><i class="fa fa-home"></i> สรุปแผนที่แสดงโรงเรียนที่รับหนังสือนิทานทั้งหมด<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">การสืบค้นข้อมูล</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <?php 
                            $id = $DATABASE->QueryMaxId("tb_counter_ipaddress_member","id");
                            $ip_addr = $_SERVER['REMOTE_ADDR'];
                            // if ($_SERVER['HTTP_X_FORWARDED_FOR']){ 
                            //     $ip_addr = $_SERVER['HTTP_X_FORWARDED_FOR'];
                            //     } 
                            // else {
                            //     $ip_addr = $_SERVER['REMOTE_ADDR']; 
                            // } 
                            date_default_timezone_set("Asia/Bangkok");
                            date_default_timezone_get();
                            $now = date_create('now')->format('Y-m-d H:i:s');
                            if($_SESSION["table"] == "tb_member"){
                                $data_id = $_SESSION["data_id"];    
                            
                                "<b><font face=\"MS Sans Serif\" size=\"1\" color=\"#000080\">IP Address $ip_addr;</font></b>";

                                $sql = "SELECT * FROM tb_counter_ipaddress_member";
                                $all = $DATABASE->QueryNumRow($sql);
                                $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_counter_ipaddress_member.id DESC");
                                $sql = "INSERT INTO tb_counter_ipaddress_member (id,member_id,ipaddress,date_time) VALUES('$id','$data_id','$ip_addr','$now')";
                                $result = $DATABASE->Query($sql);
                                 if(sizeof($DATA)>0){ 
                                    foreach($DATA as $key => $row){
                                        if($row['member_id'] == Null) {
                                            $sql = "INSERT INTO tb_counter_ipaddress_member (id,member_id,ipaddress,date_time) VALUES('$id','$data_id','$ip_addr','$now')";
                                            $result = $DATABASE->Query($sql);
                                        }else{
                                            $sql = "DELETE FROM tb_counter_ipaddress_member WHERE member_id='".$data_id."'";
                                            $result = $DATABASE->Query($sql);

                                            $sql = "INSERT INTO tb_counter_ipaddress_member (id,member_id,ipaddress,date_time) VALUES('$id','$data_id','$ip_addr','$now')";
                                            $result = $DATABASE->Query($sql);
                                        }
                                    }
                                }
                            }
                        ?>
                        <div class="box-body">
                            <form action="./" method="get" class="form-inline">
                                <input type="hidden" name="content" value="report-get-school-map-all">
                                <button type="button" class="btn btn-default" onClick="location.href='?content=report-get-school-map-all'" title="รีเฟรส" style="background-color: #18c4c4;color: #fff;"><i class="fa fa-refresh"></i> รีเฟรส</button>
                                    <a href="?content=report-get-school-map" class="btn btn-success" title="ค้นหาข้อมูล" style="background-color: #ff16a2e0; color: #fff; border-color: #ff32ad;"><i class="fa fa-eye"></i> ค้นหาข้อมูล</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php
                        include("php/config.map.php");
                        include("php/mysql.map.php");
                        $mysql = new J_MYSQL;
                        $mysql->J_Connect();
                        $mysql->set_char_utf8();
                        $sql = "
                            SELECT
                                tb_get_book.id,
                                tb_get_book.type_book_id,
                                tb_get_book.book_id,
                                tb_get_book.qty,
                                tb_get_book.teacher_id,
                                tb_get_book.school_id as school_id,
                                tb_get_book.note,
                                tb_get_book.date_start,
                                tb_school.`name`,
                                tb_school.id,
                                tb_school.`code` as code,
                                tb_school.`no`,
                                tb_school.mu,
                                tb_school.road,
                                tb_school.alley,
                                tb_school.village,
                                tb_school.district_id,
                                tb_school.amphur_id,
                                tb_school.province_id,
                                tb_school.passcode,
                                tb_school.lat,
                                tb_school.lng,
                                tb_school.area_id,
                                tb_school.department_id,
                                tb_school.email,
                                tb_school.website,
                                tb_school.tel,
                                tb_school.start_end_school,
                                tb_school.prefix_name,
                                tb_school.boss_name,
                                tb_school.boss_lname,
                                tb_school.position,
                                tb_school.note,
                                tb_school.fileupload
                            FROM
                                tb_get_book
                                INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                            GROUP BY tb_get_book.school_id

                        ";
                        $all = $DATABASE->QueryNumRow($sql);
                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_get_book.id DESC ");
                    ?>
                    <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVorLvHctD5wbBG1ghZnDNOFizhDerS8E&callback=initMap&fbclid=IwAR074V9BuItRIx7PIYMkq_AwthYQGXxGT_SvF0kDcJWimJj2fqlERwlZmXQ&callback=initMap">
                    </script>
                    <script language="JavaScript">
                        var map,infowindow;
                        function initMap() { 
                            var myOptions = {
                                zoom: 5.90,
                                center: new google.maps.LatLng(13.8867083,98.9965289),
                            };
                            map = new google.maps.Map(document.getElementById('map_canvas'),
                                myOptions);
                            infowindow = new google.maps.InfoWindow({
                                map:map,
                        });
                        selectLocation();
                        }
                        
                        
                        var icons = {
                            <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $row){
                                        if($row['province_id'] == 74 ){
                                        ?>
                                        <?php echo $row['province_id'];?>:{
                                            icon: 'images/1.png'
                                        },
                                        <?php } else if($row['province_id'] == 75 ){
                                        ?>
                                        <?php echo $row['province_id'];?>:{
                                            icon: 'images/2.png'
                                        },
                                        <?php } else if($row['province_id'] == 76 ){
                                        ?>
                                        <?php echo $row['province_id'];?>:{
                                            icon: 'images/3.png'
                                        },
                                        <?php } else if($row['province_id'] != 74 || $row['province_id'] != 75 || $row['province_id'] != 76){
                                        ?>
                                        <?php echo $row['province_id'];?>:{
                                            icon: 'images/4.png'
                                        },
                                        <?php    
                                        }
                                    }
                                }else{
                                    echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                }
                            ?>
                        };

                        function selectLocation(){
                            $.ajax({
                                type:"POST",
                                url: "pages/report-get-school-map-all/view.js.php",
                            }).done(function(text){
                                var json = $.parseJSON(text);
                                for(var i = 0 ;i<json.length;i++){
                                    var lat = json[i].lat;
                                    var lng = json[i].lng;
                                    var school_id = json[i].school_id;
                                    var name =  json[i].name;
                                    var province_id =  json[i].province_id;
                                    var latlng = new google.maps.LatLng(lat,lng);
                                    var type = json[i].province_id;

                                    var html = '<B><i class="fa fa-map-marker"></i> '+ name +'</B></br></br>';
                                    html += '<h5 class="mt-0"><i class="glyphicon glyphicon-calendar"></i>' + ' &nbsp;' + 'ตำบล' + json[i].district + ' &nbsp;' + 'อำเภอ' + json[i].amphur + ' &nbsp;' + 'จังหวัด' + json[i].province + ' &nbsp;' + json[i].passcode +  '</h5>'
                                    html += '<h5 class="mt-0"><i class="fa fa-phone "></i>' + ' &nbsp;' + json[i].tel + '</h5>'
                                    html += '<h5 class="mt-0"><i class="fa fa-map "></i>' + ' &nbsp;' + 'พิกัด' + '&nbsp; '+ json[i].lat + ' - ' + json[i].lng + '</h5>'
                                    html += '<center><h5 class="mt-0">' + ' &nbsp;' +'<a href="?content=school-show&id=' + json[i].school_id + '"> เพิ่มเติม...</a>' + '</h5></center>'
                                    // html += '<center><h5 class="mt-0">' + ' &nbsp;' +'<a href="?content=school-show&id=' + json[i].school_id +'&school_name=' + json[i].name +' &latitude='+ json[i].lat + '&longitude='+ json[i].lng + '"> เพิ่มเติม...</a>' + '</h5></center>'

                                    var makeroption = {
                                        map:map,
                                        html:html,
                                        position:latlng,
                                        icon: icons[type].icon
                                    };
                                    var marker = new google.maps.Marker(makeroption);

                                    google.maps.event.addListener(marker,'click',function(e){
                                        infowindow.setContent(this.html);
                                        infowindow.open(map,this);
                                    });

                                }
                            });
                        }
                    </script>
                    <?php 
                        $count_farmer = $DATABASE->QueryString("SELECT id FROM tb_school");
                        if($count_farmer == NULL){

                    } else { ?>
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">สรุปแผ่นที่โรงเรียน</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="map_canvas" style="width:100%;height:100vh"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>