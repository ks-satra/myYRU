<?php
    if( $USER==null ) {
            LINKTO("login.php");
        }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
<section class="content-header">
    <h1><i class="fa fa-handshake-o"></i> ข้อมูลแบบตอบรับ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลแบบตอบรับ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลแบบตอบรับ</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="project-reply">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=project-reply-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=project-reply'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูลโครงการ" value="<?php echo $SERACHING; ?>" style="width: 423px;">
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
                            tb_project.`name`,
                            tb_activity.`name`,
                            tb_activity.qty,
                            tb_school.`name` As school_name,
                            tb_prefix.`name`
                        FROM
                            tb_person
                            INNER JOIN tb_project ON tb_person.project_id = tb_project.id
                            INNER JOIN tb_activity ON tb_person.activity_id = tb_activity.id
                            INNER JOIN tb_school ON tb_person.school_id = tb_school.id
                            INNER JOIN tb_prefix ON tb_person.prefix_id = tb_prefix.id
                        GROUP BY tb_school.`name`
                        -- WHERE 
                        --     tb_activity.id LIKE '%$SERACHING%' OR
                        --     tb_activity.`name` LIKE '%$SERACHING%' 
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_person.id LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr style="background-color: #760b0b; color: #fff;">
                            <th><center>ลำดับ</center></th>
                            <th>โรงเรียน (ตำบล อำเภอ จังหวัด)</th>
                            <th>จำนวน</th>
                            <th>ตรวจสอบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <tr>
                                    <td><center><?php echo $key+1; ?></center></td>
                                    <td><?php echo $row['school_name']; ?></td>
                                    <td><span class="badge badge-light" style="background-color: #0c950a;"><?php $data_school = $DATABASE->QueryString("SELECT COUNT(school_id) FROM tb_person WHERE school_id = '".$row['school_id']."'"); echo $data_school; ?> คน</span></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="?content=project-reply-show&page=<?php echo $PAGE; ?>&project_id=<?php echo $_GET['project_id']; ?>&activity_id=<?php echo $_GET['activity_id']; ?>&school_id=<?php echo $row['school_id']; ?>" title="ตรวจสอบข้อมูล"><i class="fa fa-eye"></i> ตรวจสอบข้อมูล</a>
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
                <div>จำนวนโรงเรียนทั้งหมด <?php echo $all;?> แห่ง</div>
                <div>จำนวนครูทั้งหมด <?php $data_school = $DATABASE->QueryString("SELECT COUNT(school_id) FROM tb_person"); echo $data_school; ?> คน</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=project-reply&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=project-reply&page='.($PAGE+1).$searhing.'"';
                    
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