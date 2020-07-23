<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
<section class="content-header">
    <h1><i class="fa fa-user-circle-o" aria-hidden="true"></i> ข้อมูลบุคลากร<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลบุคลากร</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลบุคลากรทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="teacher">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=teacher-add" class="btn btn-success" title="เพิ่มข้อมูล">
                    <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=teacher'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูล" value="<?php echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
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
                       tb_teacher.id,
                       tb_teacher.school_id,
                       tb_teacher.card,
                       tb_teacher.prefix_id,
                       tb_teacher.name_thai,
                       tb_teacher.lname_thai,
                       tb_teacher.name_eng,
                       tb_teacher.lname_eng,
                       tb_teacher.position as teacher_position,
                       tb_teacher.district_id,
                       tb_teacher.amphur_id,
                       tb_teacher.province_id,
                       tb_teacher.passcode,
                       tb_teacher.photo,
                       tb_school.`code`,
                       tb_school.`name` as school_name,
                       tb_school.position as school_position,
                       tb_prefix.`name` as prefix_name,
                       tb_prefix.name_eng,
                       tb_prefix.abbreviation,
                       tb_district.`name` as district_name,
                       tb_amphur.`name` as amphur_name,
                       tb_amphur.passcode,
                       tb_province.`name` as province_name,
                       tb_sex.`name`,
                       CONCAT( name_thai, ' ' ,lname_thai) As full_name
                    FROM
                       tb_teacher
                       INNER JOIN tb_school ON tb_teacher.school_id = tb_school.id
                       INNER JOIN tb_prefix ON tb_teacher.prefix_id = tb_prefix.id
                       INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                       INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                       INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                       INNER JOIN tb_sex ON tb_teacher.sex_id = tb_sex.id
                    WHERE 
                        tb_teacher.id LIKE '%$SERACHING%' OR
                        tb_teacher.name_thai LIKE '%$SERACHING%' OR
                        tb_teacher.lname_thai LIKE '%$SERACHING%' OR
                        tb_school.`name` LIKE '%$SERACHING%' OR
                        CONCAT( name_thai, ' ' ,lname_thai) LIKE '%$SERACHING%' OR
                        CONCAT( tb_prefix.`name`, tb_teacher.name_thai, ' ' ,tb_teacher.lname_thai) LIKE '%$SERACHING%'
                ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_teacher.id DESC,tb_teacher.name_thai LIMIT $start,$SHOW ");
                ?>

                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr style="background-color: #780808; color: #fff;">
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
                                    <td><?php echo $row['prefix_name']; ?><?php echo $row['name_thai']; ?> <?php echo $row['lname_thai']; ?></td>
                                    <td><?php echo $row['teacher_position']; ?></td>
                                    <td><?php echo $row['school_name']; ?> (ต. <?php echo $row['district_name']; ?> อ. <?php echo $row['amphur_name']; ?> จ. <?php echo $row['province_name']; ?>)</td>
                                    <td class="text-right">
                                        <a class="btn btn-info btn-sm" href="?content=teacher-show&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a>
                                    </td>
                                    <?php 
                                }
                        }else{
                                echo "<tr><td colspan='6' align='center'><i>ไม่พบข้อมูล</i></td></tr>";
                                
                        }
                    ?>
                    </tbody>
                </table>
                <div style="text-align: right;">จำนวนข้อมูลบุคลากรทั้งหมด <?php echo $all;?> คน</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=teacher&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=teacher&page='.($PAGE+1).$searhing.'"';

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
