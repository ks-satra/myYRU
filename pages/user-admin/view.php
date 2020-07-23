<?php
    if( $USER==null ) {
            LINKTO("login.php");
        }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
<section class="content-header">
    <h1><i class="fa fa-user"></i> ข้อมูลผู้ดูแลระบบ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้ดูแลระบบ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลผู้ดูแลระบบทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="user-admin">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=user-admin-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=user-admin'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาผู้ดูแลระบบหรือเจ้าหน้าที่" value="<?php echo $SERACHING; ?>" style="width: 423px;">
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
                        tb_admin.id As id,
                        tb_admin.prefix_id,
                        tb_admin.`name`,
                        tb_admin.lname,
                        tb_admin.position_id,
                        tb_admin.status_id,
                        tb_position.id As position_id,
                        tb_position.`name` As position_name,
                        tb_status.id As status_id,
                        tb_status.`name` As status_name,
                        tb_prefix.id As prefix_id,
                        tb_prefix.`name` As prefix_name
                    FROM tb_admin
                        INNER JOIN tb_position ON tb_admin.position_id = tb_position.id
                        INNER JOIN tb_prefix ON tb_admin.prefix_id = tb_prefix.id
                        INNER JOIN tb_status ON tb_admin.status_id = tb_status.id
                    WHERE 
                        tb_admin.id LIKE '%$SERACHING%' OR
                        tb_prefix.`name` LIKE '%$SERACHING%' OR
                        tb_admin.`name` LIKE '%$SERACHING%' OR
                        tb_admin.lname LIKE '%$SERACHING%' OR
                        tb_position.`name` LIKE '%$SERACHING%' OR
                        tb_status.`name` LIKE '%$SERACHING%'
                ";
                $all = $DATABASE->QueryNumRow($sql);
                $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_admin.id LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>ลำดับ</center></th>
                            <th>ชื่อ-สกุล</th>
                            <th>สิทธิการใช้งาน</th>
                            <th style="text-align: right;">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <tr>
                                    <td><center><?php echo $key+1;//$row['id']; ?></center></td>
                                    <td><?php echo $row['prefix_name']; ?> <?php echo $row['name']; ?> <?php echo $row['lname']; ?></td>
                                    <td><?php echo $row['status_name']; ?></td>
                                    <td style="text-align: right;">
                                        <a class="btn btn-info btn-sm" href="?content=user-admin-show&id=<?php echo $row['id'];?>&page=<?php echo $PAGE; ?>" title="แสดงข้อมูล"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-warning btn-sm" href="?content=user-admin-edit&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" href="?content=user-admin-del&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="ลบข้อมูล"><i class="fa fa-trash"></i></a>
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
                <div style="text-align: right;">จำนวนข้อมูลผู้ดูแลระบบ / เจ้าหน้าที่ทั้งหมด <?php echo $all;?> คน</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=user-admin&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=user-admin&page='.($PAGE+1).$searhing.'"';
                    
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