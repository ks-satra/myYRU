<?php
    if( $USER==null ) {
            LINKTO("login.php");
        }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
<section class="content-header">
    <h1><i class="fa fa-user"></i> ข้อมูลสังกัดโครงการ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลสังกัดโครงการ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลสังกัดโครงการ</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="user-admin">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=user-member-add" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                    <a href="?content=group-member-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=user-admin'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูลกลุ่มเกษตรกร" value="<?php echo $SERACHING; ?>" style="width: 423px;">
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
                        *
                    FROM tb_group_member
                    -- WHERE 
                    --     tb_admin.id LIKE '%$SERACHING%' OR
                    --     tb_prefix.`name` LIKE '%$SERACHING%' OR
                    --     tb_admin.`name` LIKE '%$SERACHING%' OR
                    --     tb_admin.lname LIKE '%$SERACHING%' OR
                    --     tb_position.`name` LIKE '%$SERACHING%' OR
                    --     tb_status.`name` LIKE '%$SERACHING%'
                ";
                $all = $DATABASE->QueryNumRow($sql);
                $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_group_member.id LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">ลำดับ</th>
                            <th>ชื่อกลุ่ม</th>
                            <th>รายละเอียด</th>
                            <th class="text-right">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $row){
                                ?>
                                <tr>
                                    <td class="text-left"><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td class="text-right">
                                        <a class="btn btn-info btn-sm" href="?content=group-member-edit&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a>
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
                <div>จำนวนข้อมูลกลุ่มเกตรกรทั้งหมด <?php echo $all;?> กลุ่ม</div>
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