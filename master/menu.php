<?php
    if($USER!=null){
?>
    <div class="user-panel">
        <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2"||$USER["status_id"]=="3") {?>
            <?php
                if( $_SESSION["table"]=="tb_admin" ) {
            ?>
                <div class="pull-left image">
                    <img src="files/img_admin/<?php echo $USER["fileupload"];?>" class="img-circle" onerror="ON_IMAGE_ERROR(this)" alt="User Image" />
                </div>
            <?php } else { ?>
                <div class="pull-left image">
                    <img src="files/img_member/<?php echo $USER["fileupload"];?>" class="img-circle" onerror="ON_IMAGE_ERROR(this)" alt="User Image" />
                </div>
            <?php } ?>
            <div class="pull-left info">
                <p><?php echo $USER["name"]."  ".$USER["lname"];?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> ออนไลน์<br></a>
            </div>
        <?php } ?>
    </div>
<ul class="sidebar-menu">
    <li class="header"><center><b>เมนู</b></center></li>
    <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2"||$USER["status_id"]=="3"){?>
    <li class="treeview <?php if($content=='home') echo 'active'; ?>">
        <a href="./"> 
            <i class="glyphicon glyphicon-home"></i> <span>หน้าหลัก</span>
        </a>
    </li>
    <?php } ?>
    <?php 
        $submenu = array(
            "user-admin",
            "user-admin-add",
            "user-admin-del",
            "user-admin-edit",
            "user-admin-show",
            "setting-position-admin",
            "setting-prefix-admin",
            "user-member",
            "user-member-add",
            "user-member-del",
            "user-member-edit",
            "user-member-show"
        );
    ?>
    <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2"){?>
    <li class="treeview <?php if( in_array($content,$submenu) ) echo 'active'; ?>">
        <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2"){?> 
        <a href="#"> 
            <i class="fa fa-group"></i> <span>จัดการข้อมูลผู้ใช้งาน</span>
        </a>
        <ul class="treeview-menu">
            <?php if($USER["status_id"]=="1"){?>
            <li class="<?php if($content=='user-admin'||$content=='user-admin-add'||$content=='user-admin-del'||$content=='user-admin-edit'||$content=='user-admin-show'||$content=='setting-position-admin'||$content=='setting-prefix-admin'||$content=='setting-status') echo 'active'; ?>">
                    <a href="?content=user-admin"><i class="fa fa-circle-o"></i> ข้อมูลผู้ดูแลระบบ</a>
            </li>
            <?php }?>
            <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2"){?>
            <li class="<?php if($content=='user-member'||$content=='user-member-add'||$content=='user-member-del'||$content=='user-member-edit'||$content=='user-member-show'||$content=='group-member'||$content=='group-member-add'||$content=='group-member-del'||$content=='group-member-edit'||$content=='farmer'||$content=='farmer-add'||$content=='farmer-del'||$content=='farmer-edit'||$content=='farmer-show') echo 'active'; ?>">
                <a href="?content=user-member"><i class="fa fa-circle-o"></i> ข้อมูลผู้จัดการ</a>
            </li>
            <?php }?>
        </ul>
        <?php }?>
    </li>
    <?php }?>

    <?php 
        $submenu = array(
            "school",
            "school-add",
            "school-show",
            "school-edit",
            "school-del",
            "school-list",
            "book",
            "book-add",
            "book-show",
            "book-edit",
            "book-del"
        );
    ?>
    <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2"){?>
    <li class="treeview <?php if( in_array($content,$submenu) ) echo 'active'; ?>">
        <a href="#"> 
            <i class="fa fa-clipboard"></i> <span>จัดการข้อมูลพื้นฐาน</span>
        </a>
        <ul class="treeview-menu">
            <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2"){?>
            <li class="<?php if($content=='school'||$content=='school-show'||$content=='school-add'||$content=='school-edit'||$content=='school-del') echo 'active'; ?>">
                <a href="?content=school"><i class="fa fa-circle-o"></i> โรงเรียน</a>
            </li>
            <?php }?>
            <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2"){?>
            <li class="<?php if($content=='book'||$content=='book-show'||$content=='book-add'||$content=='book-edit'||$content=='book-del') echo 'active'; ?>">
                <a href="?content=book"><i class="fa fa-circle-o"></i> หนังสือ</a>
            </li>
            <?php }?>
        </ul>
    </li>
    <?php }?>
</ul>
<br><br><br>
<?php } ?>