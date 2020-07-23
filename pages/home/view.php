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
        <h1><i class="fa fa-home"></i> หน้าหลัก<small>ภาพรวมของระบบ</small></h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $count_admin = $DATABASE->QueryString("SELECT COUNT(id) FROM tb_admin");?></h3>
                            <p>จำนวนเจ้าหน้าที่ทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                            <a href="?content=user-admin" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $count_member = $DATABASE->QueryString("SELECT COUNT(id) FROM tb_member");?></h3>
                            <p>จำนวนผู้จัดการทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                            <a href="?content=user-member" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <?php 
                        $id = $DATABASE->QueryMaxId("tb_counter_website_back","id");
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
                        $data_id = $_SESSION["data_id"];
                        "<b><font face=\"MS Sans Serif\" size=\"1\" color=\"#000080\">IP Address $ip_addr;</font></b>";
                        $sql = "INSERT INTO tb_counter_website_back (id,date_visit,ip_visit,visit) VALUES('$id','$today2','$ip_addr','1')";
                        $result = $DATABASE->Query($sql);

                    ?>
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $c_id_visit = $DATABASE->QueryString("SELECT COUNT(ip_visit)  FROM tb_counter_website_back");?></h3>
                            <p>จำนวนผู้เข้าชมระบบทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                            <a href="?content=home" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $c_id_visit = $DATABASE->QueryString("SELECT COUNT(ip_visit)  FROM tb_counter_website_home");?></h3>
                            <p>จำนวนผู้เข้าชมเว็บไซต์ทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                            <a href="?content=home" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?php 
                                    $report_type_book_1 = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '1'"); 
                                    echo number_format($report_type_book_1,0)
                                ?></h3>
                            <p>จำนวนข้อมูลหนังสือชุดนิทานวรรณกรรมฯ</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                            <a href="?content=user-admin" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner" style="background-color: #e913b1;">
                            <h3><?php 
                                    $report_type_book_2 = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '2'"); 
                                    echo number_format($report_type_book_2,0)
                                ?></h3>
                            <p>จำนวนข้อมูลธนาคารหนังสือ</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                            <a href="?content=user-member" class="small-box-footer" style="background-color: #b80480;">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner" style="background-color: #165900;">
                            <h3><?php 
                                    $report_type_book_3 = $DATABASE->QueryString("SELECT COUNT(tb_get_book.book_id) FROM tb_get_book WHERE tb_get_book.type_book_id = '3'"); 
                                    echo number_format($report_type_book_3,0)
                                    ?></h3>
                            <p>จำนวนหนังสือเรียนแบบมูลาบาฮาซา</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                            <a href="?content=home" class="small-box-footer" style="background-color: #133607;">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner" style="background-color: #b01111;">
                            <h3>0</h3>
                            <p>จำนวน</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                            <a href="?content=home" class="small-box-footer" style="background-color: #860909;">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">สมาชิกล่าสุด</h3>
                            <div class="box-tools pull-right">
                                <span class="label label-danger"></span>
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <?php
                            $SERACHING = @$_GET['searhing'];
                            $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
                            $SHOW = 12;
                            $start = ($PAGE-1)*$SHOW;
                            $sql = "
                                SELECT *
                                FROM tb_member
                        ";
                        $all = $DATABASE->QueryNumRow($sql);
                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_member.id DESC LIMIT $start,$SHOW");
                        ?>
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $key => $row){
                                        ?>
                                        <li>
                                            <?php 
                                            if( $row['fileupload'] == null){
                                                ?>
                                                <img id="img_" style="width: 79%;height: 79%;" src="images/user.png" alt="User image" onerror="ON_IMAGE_ERROR(this)">
                                            <?php }else { ?>
                                                <img src="files/img_member/<?php echo $row['fileupload'];?>" alt="User Image"> 
                                            <?php } ?>
                                            <a class="users-list-name" href="?content=user-member-show&id=<?php echo $row['id'];?>"><?php echo $row['name'];?> <?php echo $row['lname'];?></a>
                                            <span class="users-list-date"></span>
                                        </li>
                                        <?php 
                                    }
                                } else {
                                    echo "<div align='center'><i>ไม่มีข้อมูล</i></div>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="box-footer text-center">
                            <?php if($_SESSION["table"]=="tb_admin" ) { ?>
                                <a href="?content=user-member" class="uppercase">เพิ่มเติม</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ประวัติผู้ใช้งานวันนี้</h3>
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
                            <?php
                                $SERACHING = @$_GET['searhing'];
                                $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
                                $SHOW = 12;
                                $start = ($PAGE-1)*$SHOW;
                                $sql = "
                                    SELECT 
                                        tb_counter_ipaddress_member.id,
                                        tb_prefix.`name` AS prefix_name,
                                        tb_member.id as member_id,
                                        tb_member.`name`,
                                        tb_member.lname,
                                        tb_counter_ipaddress_member.id,
                                        ipaddress,
                                        date_time
                                    FROM tb_counter_ipaddress_member
                                        INNER JOIN tb_member ON tb_member.id = tb_counter_ipaddress_member.member_id
                                        INNER JOIN tb_prefix ON tb_member.prefix_id = tb_prefix.id
                                        GROUP BY member_id
                                ";
                                $all = $DATABASE->QueryNumRow($sql);
                                $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_counter_ipaddress_member.date_time DESC LIMIT $start,$SHOW");
                            ?>
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ผู้ใช้</th>
                                            <th>สถานะ</th>
                                            <th>วันที่และเวลา</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(sizeof($DATA)>0){
                                            foreach($DATA as $key => $row){
                                                $date_time_desc = $DATABASE->QueryString("SELECT date_time FROM tb_counter_ipaddress_back ORDER BY id DESC");
                                                $cutToday = substr($row['date_time'],0,10);
                                            if($cutToday == $today2){
                                        ?>
                                                <tr>
                                                    <td><a href="?content=user-member-show&id=<?php echo $row["member_id"];?>"><?php echo $key+1;?></a></td>
                                                    <td><?php echo $row['prefix_name'];?> <?php echo $row['name'];?> <?php echo $row['lname'];?></td>
                                                    <td><span class="label label-success"><?php echo $row['ipaddress'];?></span></td>
                                                    <td><?php echo $row['date_time'];?></td>
                                                    <!-- <td><?php //echo $cutToday = substr($row['date_time'],0,10);?>
                                                    </td> -->
                                                </tr>
                                                <?php }
                                            }
                                        }else{
                                            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
                                zoom: 9,
                                center: new google.maps.LatLng(6.3163972,101.2541504),
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
                                url: "pages/home/view.js.php",
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
                            <h3 class="box-title">โรงเรียนที่รับหนังสือ</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="map_canvas" style="width:100%;height:70vh"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <?php 
                    // if ($_SERVER['HTTP_X_FORWARDED_FOR']){ 
                    //     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    //     } 
                    // else {
                    //     $ip = $_SERVER['REMOTE_ADDR']; 
                    // }
                    // "Your IP Address is ".$ip.""; 
                ?>  
            </div>
        </div>
    </section>
<?php } ?>