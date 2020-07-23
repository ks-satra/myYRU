<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h4 class="box-title"><i class="fa fa-search" style="color:#000;"></i> รายงานแบบสืบค้นข้อมูลโรงเรียนที่รับหนังสือ</h4>
        </div>
        <div class="box-body">
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVorLvHctD5wbBG1ghZnDNOFizhDerS8E&callback=initMap&fbclid=IwAR074V9BuItRIx7PIYMkq_AwthYQGXxGT_SvF0kDcJWimJj2fqlERwlZmXQ&callback=initMap">
            </script>
            <?php
                include("php/config.map.php");
                include("php/mysql.map.php");
                $mysql = new J_MYSQL;
                $mysql->J_Connect();
                $mysql->set_char_utf8();
                $sql = "
                    SELECT * FROM tb_get_book
            ";
            $all = $DATABASE->QueryNumRow($sql);
            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_get_book.id DESC ");
            ?>
            <script language="JavaScript">
                var map,infowindow;
                function initMap() { 
                    var myOptions = {
                        zoom: 9,
                        center: new google.maps.LatLng(6.1951049,100.8800613),
                    };
                    map = new google.maps.Map(document.getElementById('map_canvas'),
                        myOptions);
                    infowindow = new google.maps.InfoWindow({
                        map:map,
                    });
                }
                var icons = {
                    74:{
                        icon: 'images/1.png'
                    },
                    75:{
                        icon: 'images/2.png'
                    },
                    76:{
                        icon: 'images/3.png'
                    }
                };
                function sarchLocation(){
                    var keyword = $("#keyword").val();
                    $.ajax({
                        type:"POST",
                        data: {keyword:keyword},
                        url: "pages/report-get-school-map/view.js.php",
                    }).done(function(text){
                        var json = $.parseJSON(text);
                        if(json.length > 0){
                            removeMarker();
                            var t="";
                            for(var i = 0 ;i<json.length;i++){
                                var lat = json[i].lat;
                                var lng = json[i].lng;
                                var code =  json[i].code;
                                var school_name =  json[i].school_name;
                                var school_id =  json[i].school_id;
                                var district =  json[i].district;
                                var amphur =  json[i].amphur;
                                var province =  json[i].province;
                                var passcode =  json[i].passcode;
                                var tel =  json[i].tel;
                                var latlng = new google.maps.LatLng(lat,lng);
                                var type = json[i].province_id;
                                
                                var html = '<h5 class="mt-0"><i class="fa fa-map-marker"></i>' + ' ' + ' <B> ชื่อโรงเรียน : ' + json[i].name + '</B></h5>';
                                    html += '<h5 class="mt-0"><i class="glyphicon glyphicon-calendar"></i> ตำบล : '+ json[i].district + ' &nbsp; อำเภอ ' + json[i].amphur + ' &nbsp; จังหวัด ' + json[i].province + ' &nbsp; ' + json[i].passcode +'</h5>'
                                    html += '<h5 class="mt-0"><i class="glyphicon glyphicon-phone"></i> โทร : '+ json[i].tel +'</h5>'
                                    html += '<h5 class="mt-0"><i class="fa fa-map"></i> พิกัด : '+ json[i].lat + ' - '+ json[i].lng +'</h5>'
                                    html += '<center><h5 class="mt-0">' + ' &nbsp;' +'<a href="?content=school-show&id=' + json[i].school_id +'"> เพิ่มเติม...</a>' + '</h5></center>'

                                var makeroption = {
                                    map:map,
                                    html:html, 
                                    position:latlng,
                                    icon: icons[type].icon
                                };
                                var marker = new google.maps.Marker(makeroption);
                                markers.push(marker);   
                                google.maps.event.addListener(marker,'click',function(e){
                                    infowindow.setContent(this.html);
                                    infowindow.open(map,this);
                                });
                                t +=           '<div class="control-group">';
                                t +='                   <div class="media">';
                                t +='                       <div class="media-body">';
                                t +='                           <h5 class="mt-0"><i class="fa fa-map-marker"></i> ชื่อโรงเรียน : '+ json[i].name + '</h5>';
                                t +='                           <h5 class="mt-0"><i class="glyphicon glyphicon-calendar"></i> ตำบล : '+ json[i].district + ' &nbsp; อำเภอ ' + json[i].amphur + ' &nbsp; จังหวัด ' + json[i].province + ' &nbsp; ' + json[i].passcode +'</h5>';
                                t +='                           <h5 class="mt-0"><i class="glyphicon glyphicon-phone"></i> โทร : '+ json[i].tel +'</h5>';
                                t +='                           <h5 class="mt-0"><i class="fa fa-map"></i> พิกัด : '+ json[i].lat + ' - '+ json[i].lng +'</h5>';
                                t +='                       </div>';
                                t +='                   </div>';
                                t +='           </div> <hr/>';
                                $("#divDetail").html(t);
                                }
                                $("#divContent").css("display","");
                                }else{
                                    $("#divDetail").html('ไม่พบข้อมูล');
                                }
                            });
                }

                var markers = [];
                function removeMarker(){
                    for(var i =0;i<markers.length;i++){
                        markers[i].setMap(null);
                    }
                    markers = [];
                }
            </script>
            <div class="row">
                <div class="col-md-12">
                    <div style="margin-top: 15px;">
                        <form action="./" method="get" class="form-inline">
                            <input type="hidden" name="content" value="report-get-school-map">
                            <button type="button" class="btn btn-default" onClick="location.href='?content=report-get-school-map'" title="รีเฟรส" style="background-color: #18c4c4;color: #fff;"><i class="fa fa-refresh"></i> รีเฟรส</button>
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="ค้นหาข้อมูล" style="width: 423px;">
                            <button type="button" class="btn btn-primary" onclick="sarchLocation()" title="ค้นหา" style="background-color: #ff16a2e0; color: #fff; border-color: #ff32ad;">
                                <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                            <a href="?content=report-get-school-map-all" class="btn btn-success" title="ตรวจสอบโรงเรียนที่รับหนังสือทั้งหมด" style="background-color: #f39c12; border-color: #f39c12;"><i class="fa fa-eye"></i> ตรวจสอบโรงเรียนที่รับหนังสือทั้งหมด</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 12px;">
                <div class="col-md-9" style="margin-top: 0px;">
                    <div id="map_canvas" style="width:100%;height:100vh"></div>
                </div>
                <div class="col-md-3">
                    <div id="divContent" style="display:none">
                        <fieldset >
                            <label>ผลจากการค้นหาข้อมูล</label>
                            <div id="divDetail"></div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>