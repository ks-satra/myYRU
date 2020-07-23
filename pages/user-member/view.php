<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?> 
<section class="content-header">
    <h1><i class="fa fa-users"></i> ข้อมูลผู้จัดการ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้จัดการ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลผู้จัดการทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="user-member">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <?php if($USER["status_id"]=="1") {?>
                        <a href="?content=user-member-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <?php } ?>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=user-member'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูล" value="<?php echo $SERACHING; ?>" style="width: 423px;">
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
                        tb_member.id As id,
                        tb_member.prefix_id As prefix_id,
                        tb_member.name,
                        tb_member.lname,
                        tb_member.position_member_id As position_id,
                        tb_prefix.id As prefix_id,
                        tb_prefix.`name` As prefix_name,
                        tb_group_member.id As department_id,
                        tb_group_member.`name` As dep_name,
                        tb_position_member.id As position_id,
                        tb_position_member.`name` As position_name
                    FROM
                        tb_member
                        INNER JOIN tb_prefix ON tb_member.prefix_id = tb_prefix.id
                        INNER JOIN tb_position_member ON tb_member.position_member_id = tb_position_member.id
                        INNER JOIN tb_group_member ON tb_member.group_member_id = tb_group_member.id
                    WHERE 
                        tb_member.id LIKE '%$SERACHING%' OR
                        tb_prefix.`name` LIKE '%$SERACHING%' OR
                        tb_member.`name` LIKE '%$SERACHING%' OR
                        tb_member.`lname` LIKE '%$SERACHING%' OR
                        tb_position_member.`name` LIKE '%$SERACHING%' 
                ";
                $all = $DATABASE->QueryNumRow("SELECT * FROM tb_member");
                $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_member.id DESC LIMIT $start,$SHOW ");
                ?>

                <table id="myTable" class="table table-hover">
                    <thead> 
                        <tr style="background-color: #7a0c0c; color: #fff;">
                            <th class="text-left">ลำดับ</th>
                            <th>ชื่อ - สกุล</th>
                            <th>ตำแหน่ง</th>
                            <th class="text-right">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key => $row){
                                ?>
                                <tr>
                                    <td class="text-left"><?php echo $key+1;//$row['id']; ?></td>
                                    <td><?php echo $row['prefix_name']; ?> <?php echo $row['name']; ?> <?php echo $row['lname']; ?></td>
                                    <td><?php echo $row['position_name']; ?></td>
                                    <?php if($USER["status_id"]=="1") {?>
                                    <td class="text-right">
                                        <a class="btn btn-info btn-sm" href="?content=user-member-edit&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a>
                                    </td>
                                    <?php } else { ?>
                                    <td class="text-right">
                                        <a class="btn btn-info btn-sm" href="?content=user-member-show&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="แสดงข้อมูล"><i class="fa fa-eye"></i> แสดงข้อมูล</a>
                                    </td>
                                    <?php 
                                    }
                                }
                        }else{
                                echo "<tr><td colspan='6' align='center'><i>ไม่พบข้อมูล</i></td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <div style="text-align: right;">จำนวนข้อมูลสมาชิกทั้งหมด <?php echo $all;?> คน</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=user-member&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=user-member&page='.($PAGE+1).$searhing.'"';

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
