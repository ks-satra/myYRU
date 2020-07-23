<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    include("pages/date.php"); 
    $PROJECT_ID = $_GET["project_id"];
    $PROJECT_NAME = $DATABASE->QueryString("SELECT name FROM tb_project WHERE id= '".$PROJECT_ID."'");
    $ACTIVITY_ID = $_GET["activity_id"];
    $ACTIVITY_NAME = $DATABASE->QueryString("SELECT name FROM tb_activity WHERE id= '".$ACTIVITY_ID."'");
    $SCHOOL_ID = $_GET["school_id"];
    $PERSON_ID = $DATABASE->QueryString("SELECT school_id FROM tb_person WHERE school_id= '".$SCHOOL_ID."'");
    $sql = "
            SELECT
                tb_person.id,
                tb_person.school_id,
                tb_person.card,
                tb_person.prefix_id,
                tb_person.name_thai,
                tb_person.lname_thai,
                tb_person.name_eng,
                tb_person.lname_eng,
                tb_person.tel,
                tb_person.birthday,
                tb_person.position,
                tb_person.facebook,
                tb_person.email,
                tb_person.idline,
                tb_person.alumni,
                tb_person.buddhist_era_start,
                tb_person.buddhist_era_end,
                tb_person.faculty,
                tb_person.branch,
                tb_person.address,
                tb_person.`level`,
                tb_person.topics,
                tb_person.note,
                tb_person.date_start,
                tb_person.time_start,
                tb_person.autograph,
                tb_school.prefix_name AS boss_prefix_name,
                tb_school.boss_name,
                tb_school.boss_lname,
                tb_school.`no`,
                tb_school.mu,
                tb_school.road,
                tb_school.alley,
                tb_school.village,
                tb_school.tel AS school_tel,
                tb_school.position AS boss_position,
                tb_school.email AS school_email,
                tb_school.`code`,
                tb_school.`name` AS school_name,
                tb_district.`name` AS district_name,
                tb_amphur.`name` AS amphur_name,
                tb_school.postcode,
                tb_prefix.`name` AS prefix_name,
                tb_province.`name` AS province_name,
                tb_project.`name`,
                tb_activity.id,
                tb_activity.project_id,
                tb_activity.`name`,
                tb_activity.date_start As date_start,
                tb_activity.date_end As date_end,
                tb_activity.description,
                tb_activity.qty,
                tb_activity.time_start As activity_time_start,
                tb_activity.time_end As activity_time_end
            FROM
                tb_person
                INNER JOIN tb_school ON tb_person.school_id = tb_school.id
                INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                INNER JOIN tb_prefix ON tb_person.prefix_id = tb_prefix.id
                INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                INNER JOIN tb_project ON tb_person.project_id = tb_project.id
                INNER JOIN tb_activity ON tb_person.activity_id = tb_activity.id
            WHERE tb_person.school_id = '".$SCHOOL_ID."'
    ";
    $obj =$DATABASE->QueryObj($sql);
    if( sizeof($obj)>=1 ) {
        $data = $obj[0];
?>
<script>
    $(function() {
        $("#project_id").change(function() {
            var v = $(this).val();


            $.post("pages/person-add/get-data.php", {
                project_id: v
            }, function(data) {
                $("#show-data").html(data);
            });
        });
        $("#show-data").on("click", ".mycheckbok-all", function() {
            var chkall = $(".mycheckbok-all").prop("checked");
            $(".mycheckbok").prop("checked", chkall);
        });
    });
</script>
<section class="content-header">
    <h1><i class="fa fa-handshake-o"></i> ข้อมูลแบบตอบรับโครงการ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลแบบตอบรับโครงการ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มข้อมูลแบบตอบรับโครงการ</h3>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
            <?php if($USER["status_id"]=="1") {?>
                <a href="?content=project-reply&page=<?php echo $PAGE;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                <a href="?content=farmer&id=<?php echo $id;?>" class="btn btn-info" title="พิมพ์ข้อมูล" style="background-color: #00008B; border-color: #00008B;"><i class="fa fa-print"></i> พิมพ์ข้อมูล</a>
            <?php } ?>
            <div class="panel-body">
                <div class="row">
                    <div align="center">
                        <p ><img src="files/img/aa.gif" alt="" width="12%" height="15%" /></p>
                        <p style="padding-top: -20px;">แบบตอบรับเข้าร่วม</p>
                        <p style="padding-top: -20px;">กิจกรรม : <?php echo $ACTIVITY_NAME;?></p>
                        <p style="padding-top: -20px;"><?php echo $PROJECT_NAME;?></p>
                        <?php
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_person.id");
                            if(sizeof($DATA)>0){
                                foreach($DATA as $row){
                                    $DATE_START = $row['date_start'];
                                    DateThai($DATE_START);
                                    $DATE_END = $row['date_end'];
                                    DateThai($DATE_END);
                                }
                            }
                        ?>
                        <?php 
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_person.id");
                            if(sizeof($DATA)>0){
                                foreach($DATA as $row){
                                    $a_t_s = $row['activity_time_start'];
                                    $cutSTART = substr($a_t_s,0,5);
                                    $cutSTART;
                                    $a_t_e = $row['activity_time_end'];
                                    $cutEND = substr($a_t_e,0,5);
                                    $cutEND;
                                }
                            }
                        ?>
                        <p style="padding-top: -20px;">ระหว่างวันที่ <?php echo DateThai($DATE_START);?> - <?php echo DateThai($DATE_END);?></p>
                        <p style="padding-top: -20px;"><?php echo $DATE_START = $data['activity_time_start'];?> - <?php echo $DATE_START = $data['activity_time_end'];?> น.</p>
                        <p style="padding-top: -20px;">ณ ห้องประชุม ติง เซียง ชั้น 2 อาคารสังคมศาสตร์ มหาวิทยาลัยราชภัฏยะลา</p>
                        <p style="padding-top: -20px;">**********************</p>
                    </div>
                    <p style="padding-top: -20px;" align="left">ข้าพเจ้า <span class="dotshed"><?php echo $data['boss_prefix_name'];?> <?php echo $data['boss_name'];?> <?php echo $data['boss_lname'];?></span> ตำแหน่ง <span class="dotshed"><?php echo $data['boss_position'];?></span></p>
                    <p style="padding-top: -20px;" align="left">หน่วยงาน / สถาบัน <span class="dotshed"><?php echo $data['school_name'];?></span></p>
                    <p style="padding-top: -20px;" align="left">สถานที่ติดต่อได้สะดวกรวดเร็ว <span class="dotshed"> บ้านเลขที่ <?php echo $data['no'];?> หมู่ที่ <?php echo $data['mu'];?> ถนน <?php echo $data['alley'];?> หมู่บ้าน <?php echo $data['village'];?></span></p>
                    <p style="padding-top: -20px;" align="left">ตำบล / แขวง <span class="dotshed"><?php echo $data['district_name'];?></span> อำเภอ / เขต <span class="dotshed"><?php echo $data['amphur_name'];?></span> จังหวัด <span class="dotshed"><?php echo $data['province_name'];?></span></p>
                    <p style="padding-top: -20px;" align="left">รหัสไปรษณีย์ <span class="dotshed"><?php echo $data['postcode'];?></span> โทรศัพท์ <span class="dotshed"><?php echo $data['school_tel'];?></span> โทรศัพท์มือถือ <span class="dotshed" style="padding-left: 200px;"></span></p>
                    <p style="padding-top: -20px;" align="left">โทรสาร  <span class="dotshed" style="padding-left: 200px;"></span> E-mail <span class="dotshed"><?php echo $data['school_email'];?></span></p>
                    <p style="padding-top: -30px;">&nbsp;</p>
                    <p style="padding-top: -20px;" align="left">ขอแจ้งความประสงค์เข้าร่วมอบรมปฏิบัติการ</p>
                    <?php
                        $all = $DATABASE->QueryNumRow($sql);
                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_person.id");
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <ol>
                                    <style type="text/css">
                                    .dotshed { border-bottom: 1px dotted;  }
                                    </style>
                                    <div style="padding-top: 10px;" align="left"><?php echo $key+1;?>. ชื่อ-สกุล <span class="dotshed"><?php echo $row['prefix_name'];?> <?php echo $row['name_thai'];?> <?php echo $row['lname_thai'];?></span> ครูระดับชั้นประถมศึกษาปีที่ <span class="dotshed"><?php echo $row['level'];?></span> โทรศัพท์มือถือ <span class="dotshed"><?php echo $row['tel'];?></span>
                                    </div>
                                </ol>
                                <?php 
                            }
                        }else{
                            echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                        }
                    ?>
                    <div align="center">
                        <p>&nbsp;</p>
                        <p style="padding-top: -20px;">ลงชื่อ................................................................ลงชื่อ</p>
                        <p style="padding-top: -20px;">(<span class="dotshed"><?php echo $data['prefix_name'];?> <?php echo $data['name_thai'];?> <?php echo $data['lname_thai'];?></span>) <button type="button" class="btn btn-info sm" data-toggle="modal" data-target="#myModal" style="background-color: #dfc510;color: #000; border-color: #dfc510;"><i class="fa fa-pencil-square-o" aria-hidden="true" ></i>Try it</button></p>
                        <p style="padding-top: -20px;">วันที่....................../......................./....................</p>
                        <p style="padding-top: -30px;">&nbsp;</p>
                    </div>
                    <div class="container">
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #db8a10;">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">เปลี่ยนชื่อผู้เซ็นสำเนา</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group col-md-12">
                                            <label for="autograph">เลือกชื่อสำเนา</label>
                                            <?php
                                            $obj = $DATABASE->QueryObj("SELECT * FROM tb_person ORDER BY id");
                                            foreach($obj as $row) {
                                                $selected = "";
                                                if( $row["id"]==$data['autograph'] ) $selected = "checked";
                                                echo '<br><input type="radio" name="autograph" value="'.$row["id"].'" '.$selected.'> '.$row["name_thai"].' '.$row["lname_thai"].'';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">เปลี่ยนข้อมูล</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p style="padding-top: -20px;" align="left"><u>หมายเหตุ</u>&nbsp; :&nbsp; &nbsp;&nbsp; กรุณาส่งกลับมายัง</p>
                    <p style="padding-top: -20px;" align="left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; โครงการจัดตั้งสถาบันพัฒนาครูและบุคลากรทางการศึกษาชายแดนใต้</p>
                    <p style="padding-top: -20px;" align="left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; อาคาร 4 (ชั้น 1) มหาวิทยาลัยราชภัฏยะลา</p>
                    <p style="padding-top: -20px;" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เลขที่ 133&nbsp; ถนนเทศบาล 3&nbsp; ต.สะเตง&nbsp; อ.เมือง&nbsp;&nbsp; จ.ยะลา&nbsp; 95000</p>
                    <p style="padding-top: -20px;" align="left">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; นางสาวไลลา ลาเตะ โทรศัพท์เคลื่อนที่ 082-821-9053 &nbsp;</p>
                    <p style="padding-top: -20px;" align="left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; E-mail : Rejina.604@gmail.com</p>
                    <p style="padding-top: -20px;" align="left">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ภายในวันที่ 1 มกราคม 2562</p>
                    <p>&nbsp;</p>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
    }
?>