<?php 
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    include ("pages/date.php");
?> 
<section class="content-header">
    <h1><i class="fa fa-hospital-o"></i> ข้อมูลโรงเรียน<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลโรงเรียน</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลโรงเรียนทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="school">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2") {?>
                        <a href="?content=school-add&page=<?php echo $PAGE; ?>" class="btn btn-success" title="เพิ่มข้อมูล"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <?php } ?>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=school'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูลโรงเรียน" value="<?php echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                    <a href="?content=school-map&page=<?php echo $PAGE; ?>" class="btn btn-success" title="มุมมองรายงาน" style="background-color: #76be16; border-color: #76be16;"><i class="fa fa-search-plus"></i> มุมมองรายงาน</a>
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive">
                <?php
                    $SHOW = 30;
                    $start = ($PAGE-1)*$SHOW;
                    
                    $sql = "                
                        SELECT
                            tb_district.`name` as district_name,
                            tb_amphur.`name` as amphur_name,
                            tb_amphur.passcode,
                            tb_province.`name` as province_name,
                            tb_school.id,
                            tb_school.`code`,
                            tb_school.`name`,
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
                            tb_school.department_id,
                            tb_school.area_id,
                            tb_school.email,
                            tb_school.website,
                            tb_school.tel,
                            tb_school.start_end_school,
                            tb_school.prefix_name,
                            tb_school.boss_name,
                            tb_school.boss_lname,
                            tb_school.position
                        FROM
                            tb_school
                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                    WHERE  
                        tb_school.id LIKE '%$SERACHING%' OR
                        tb_school.`name` LIKE '%$SERACHING%' 
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_school.id DESC LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr style="background-color: #7a0c0c; color: #fff;">
                            <th><center>ลำดับ</center></th>
                            <th>ชื่อโรงเรียน</th>
                            <th>ที่อยู่โรงเรียน</th>
                            <th>ผู้อำนวยการ</th>
                            <th><center>จัดการข้อมูล</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(sizeof($DATA)>0){ 
                                foreach($DATA as $key => $row){
                                    ?>
                                    <tr>
                                        <td><center><?php echo $key+1; ?></center></td>
                                        <td><?php echo $row['name']; ?></span></td>
                                        <td>ตำบล <?php echo $row['district_name']; ?> อำเภอ <?php echo $row['amphur_name']; ?> จังหวัด <?php echo $row['province_name']; ?></td>
                                        <td><?php echo $row['prefix_name']; ?> <?php echo $row['boss_name']; ?> <?php echo $row['boss_lname']; ?></td>
                                        <td class="text-right">
                                            <center><a class="btn btn-info btn-sm" href="?content=school-show&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a></center>
                                        </td>            
                                    </tr>
                                    <?php 
                                }
                            }else{
                                echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <div style="text-align: right;">จำนวนข้อมูลทั้งหมด <?php echo $all;?> แห่ง</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=school&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=school&page='.($PAGE+1).$searhing.'"';

                    if($PAGE==1) {
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
  