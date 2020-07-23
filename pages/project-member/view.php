<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?> 
<section class="content-header">
    <h1><i class="fa fa-users"></i> ผู้รับผิดชอบโครงการ<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php //echo $content; ?>">ผู้รับผิดชอบโครงการ</a></li>
    </ol> -->
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ผู้รับผิดชอบโครงการ</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="project-member">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <label>ชื่อผู้รับผิดชอบโครงการ <red>*</red> 
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                    </label> 
                    <div class="pull-right box-tools">
                        <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
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
                            tb_project_member.id,
                            tb_project_member.project_id,
                            tb_project_member.admin_id,
                            tb_project.name_thai,
                            tb_admin.`name`,
                            tb_admin.lname,
                            tb_prefix.`name` As prefix_name
                        FROM
                            tb_project_member
                            INNER JOIN tb_project ON tb_project_member.project_id = tb_project.id
                            INNER JOIN tb_admin ON tb_project_member.admin_id = tb_admin.id
                            INNER JOIN tb_prefix ON tb_admin.prefix_id = tb_prefix.id
                        WHERE
                        tb_project_member.project_id = '".$_GET['project_id']."'
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_project_member.id LIMIT $start,$SHOW ");
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>ลำดับ</center></th>
                            <th>ชื่อโครการ</th>
                            <th><center>ชื่อ - สกุล ผู้รับผิดชอบโครงการ</center></th>
                            <th class="text-right">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <tr>
                                    <?php $row['id']; ?>
                                    <td><center><?php echo $key+1; ?></center></td>
                                    <td><?php echo $row['name_thai']; ?> </td>
                                    <td><center><?php echo $row['prefix_name']; ?> <?php echo $row['name']; ?> <?php echo $row['lname']; ?></center></td>
                                    <td class="text-right">
                                        <a class="btn btn-danger" href="?content=project-member-del&id=<?php echo $row['id']; ?>&project_id=<?php echo $row['project_id']; ?>&page=<?php echo $PAGE; ?>" title="ลบข้อมูล"><i class="fa fa-trash"></i> ลบข้อมูล</a>
                                        <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del"><i class="fa fa-trash"></i> ลบข้อมูล</button> -->
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
            </div>
        </div>
        <form class="box-body" id="frm-data" enctype="multipart/form-data" action="pages/project-member-add/action.php" method="post">
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <?php include("pages/project-member-add/view.php");?>
            </div>
        </form>
    </div>
</section>
