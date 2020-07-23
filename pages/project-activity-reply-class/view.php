<?php
    if( $USER==null ) {
            LINKTO("login.php");
        }
    $PROJECT_ID = $_GET['project_id'];
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
<section class="content-header">
    <h1><i class="fa fa-file"></i> ข้อมูลการเข้าร่วมโครงการ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลการเข้าร่วมโครงการ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลการเข้าร่วมโครงการ</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="project-activity-class">
                    <input type="hidden" name="project_id" value="<?php echo $PROJECT_ID; ?>">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=project-class&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                    <a href="?content=project-activity-class-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=project-activity-class&project_id=<?php echo $PROJECT_ID;?>&page=<?php echo $PAGE; ?>'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหากิจกรรม" value="<?php echo $SERACHING; ?>" style="width: 423px;">
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
                    $condition = " AND tb_activity.project_id = '".$_GET["project_id"]."' 
                    ";
                    $sql = "
                        SELECT
                            tb_activity.id,
                            tb_activity.project_id,
                            tb_activity.`name`,
                            tb_activity.date_start,
                            tb_activity.date_end,
                            tb_activity.description,
                            tb_activity.qty,
                            tb_project.`name` As project_name
                            FROM
                            tb_activity
                            INNER JOIN tb_project ON tb_activity.project_id = tb_project.id
                        WHERE 
                        (
                            tb_activity.id LIKE '%$SERACHING%' OR
                            tb_activity.`name` LIKE '%$SERACHING%'
                        ) ".$condition." 
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_activity.name LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>ลำดับ</center></th>
                            <th>ชื่อกิจกรรม</th>
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
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="?content=project-reply&project_id=<?php echo $PROJECT_ID;?>&activity_id=<?php echo $row['id'];?>&page=<?php echo $PAGE; ?>" title="ตรวจสอบกิจกรรม"><i class="fa fa-eye"></i> ตรวจสอบกิจกรรม</a>
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
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=project-activity-class&project_id='.$PROJECT_ID.'&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=project-activity-class&project_id='.$PROJECT_ID.'&page='.($PAGE+1).$searhing.'"';
                    
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