<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?> 
<section class="content-header">
    <h1><i class="fa fa-registered"></i> ข้อมูลผู้ลงทะเบียน<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้ลงทะเบียน</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลผู้ลงทะเบียนทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="person">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=person-add" class="btn btn-success" title="เพิ่มข้อมูล">
                    <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=person'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูล" value="<?php echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                    <input type="date" class="form-control" name="date_start" placeholder="วันที่เริ่มต้น" value="<?php echo $DATE_START; ?>" style="width: 200px;" min="2019-01-01" max="2019-12-31">
                    <input type="date" class="form-control" name="date_end" placeholder="วันที่สิ้นสุด" value="<?php echo $DATE_END; ?>" style="width: 200px;" min="2019-01-01" max="2019-12-31">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive">
                <?php
                $SHOW = 10;
                $start = ($PAGE-1)*$SHOW;
                $sql = "
                   SELECT
                        tb_person.id,
                        tb_person.project_id,
                        tb_person.activity_id,
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
                        tb_project.`name`,
                        tb_activity.`name`,
                        tb_activity.date_start,
                        tb_activity.date_end,
                        tb_activity.description,
                        tb_activity.qty,
                        tb_activity.time_start,
                        tb_activity.time_end,
                        tb_school.`code`,
                        tb_school.`name` As school_name,
                        tb_school.`no`,
                        tb_school.mu,
                        tb_school.road,
                        tb_school.alley,
                        tb_school.village,
                        tb_school.district_id,
                        tb_school.amphur_id,
                        tb_school.province_id,
                        tb_school.postcode,
                        tb_school.lat,
                        tb_school.lng,
                        tb_school.department_id,
                        tb_school.area_id,
                        tb_school.email,
                        tb_school.web,
                        tb_school.tel,
                        tb_school.start_end_school,
                        tb_school.prefix_name,
                        tb_school.boss_name,
                        tb_school.boss_lname,
                        tb_school.position,
                        tb_prefix.`name`,
                        tb_prefix.name_eng,
                        tb_prefix.abbreviation
                    FROM
                        tb_person
                        INNER JOIN tb_project ON tb_person.project_id = tb_project.id
                        INNER JOIN tb_activity ON tb_person.activity_id = tb_activity.id
                        INNER JOIN tb_school ON tb_person.school_id = tb_school.id
                        INNER JOIN tb_prefix ON tb_person.prefix_id = tb_prefix.id
                    WHERE 
                        tb_school.`name` LIKE '%$SERACHING%' 
                ";
                $all = $DATABASE->QueryNumRow($sql);
                $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_school.`name` LIMIT $start,$SHOW ");
                ?>

                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th>ชื่อ - สกุล</th>
                            <th>ตำแหน่ง</th>
                            <th>โรงเรียน</th>
                            <th class="text-right">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <tr>
                                    <td class="text-left"><center><?php echo $key+1; ?></center></td>
                                    <td><?php echo $row['prefix_name']; ?> <?php echo $row['name_thai']; ?> <?php echo $row['lname_thai']; ?></td>
                                    <td><?php echo $row['position']; ?></td>
                                    <td><?php echo $row['school_name']; ?></td>
                                    <td class="text-right">
                                        <a class="btn btn-info btn-sm" href="?content=person-edit&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a>
                                    </td>
                                    <?php 
                                }
                        }else{
                                echo "<tr><td colspan='6' align='center'><i>ไม่พบข้อมูล</i></td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <div>จำนวนข้อมูลสมาชิกทั้งหมด <?php echo $all;?> คน</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=person&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=person&page='.($PAGE+1).$searhing.'"';

                    if($PAGE==1){
                        $disabled1 = "disabled";
                        $href1 = "";
                    }
                    if($PAGE*$SHOW>=$all){
                        $disabled2 = "disabled";
                        $href2 = "";
                    }
                ?>
                <nav>
                    <ul class="pager">
                        <li class="<?php echo $disabled1;?>"><a <?php echo $href1;?>>ก่อนหน้า</a></li>
                        <?php echo $PAGE;?>/<?php echo ceil($all/$SHOW);?>
                        <li class="<?php echo $disabled2;?>"><a <?php echo $href2;?>>ถัดไป</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
