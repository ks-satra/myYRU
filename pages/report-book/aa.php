<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $id = $DATABASE->QueryMaxId("tb_counter_website_back","id");
    // $date  = date("d-m-Y");
    date_default_timezone_set("Asia/Bangkok");
    date_default_timezone_get();
    $date = date_create('now')->format('Y-m-d H:i:s');
    $ip_addr = $_SERVER['REMOTE_ADDR']; 
    $sql = "INSERT INTO tb_counter_website_back(id,date_visit,ip_visit,visit) VALUES('$id','$date', '$ip_addr', '1')";
    $result = $DATABASE->Query($sql);

    $today = date('d-m-Y'); 
    $c_visit = $DATABASE->QueryString("SELECT COUNT(ip_visit)  FROM tb_counter_website_back");
    $c_id_visit = $DATABASE->QueryString("SELECT COUNT(visit)  FROM tb_counter_website_back");
    $openpage =  str_pad($c_visit,2,"0",STR_PAD_LEFT);

    $c_id_visit_website = $DATABASE->QueryString("SELECT COUNT(visit)  FROM tb_counter_website");
    $openpage_website =  str_pad($c_id_visit_website,2,"0",STR_PAD_LEFT);
?>
<?php if($USER["status_id"]=="1"||$USER["status_id"]=="2") {?>
    <section class="content-header">
        <h1><i class="fa fa-home"></i> หน้าหลัก<small>ภาพรวมของระบบ</small></h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box-body">
            <?php 
                $id = $DATABASE->QueryMaxId("tb_counter_ipaddress_back","id");
                $ip = $_SERVER['REMOTE_ADDR']; 
                date_default_timezone_set("Asia/Bangkok");
                date_default_timezone_get();
                $now = date_create('now')->format('Y-m-d H:i:s');
                $data_id = $_SESSION["data_id"];
                "<b><font face=\"MS Sans Serif\" size=\"1\" color=\"#000080\">IP Address $ip;</font></b>";

                $sql = "SELECT * FROM tb_counter_ipaddress_back";
                $all = $DATABASE->QueryNumRow($sql);
                $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_counter_ipaddress_back.id DESC");
                 if(sizeof($DATA)>0){ 
                    foreach($DATA as $key => $row){

		                if($row['admin_id'] == Null) {
		                	$sql = "INSERT INTO tb_counter_ipaddress_back (id,admin_id,ipaddress,date_time) VALUES('$id','$data_id','$ip','$now')";
		                	$result = $DATABASE->Query($sql);
		                }else{
		                	$sql = "DELETE FROM tb_counter_ipaddress_back WHERE admin_id='$data_id'";
							$result = $DATABASE->Query($sql);

							$sql = "INSERT INTO tb_counter_ipaddress_back (id,admin_id,ipaddress,date_time) VALUES('$id','$data_id','$ip','$now')";
		                	$result = $DATABASE->Query($sql);
		                }
		            }
		        }
            ?>
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $count_admin = $DATABASE->QueryString("SELECT COUNT(id) FROM tb_admin");?></h3>
                            <p>จำนวนเจ้าหน้าที่ทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="?content=user-admin" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $count_member = $DATABASE->QueryString("SELECT COUNT(id) FROM tb_member");?></h3>
                            <p>จำนวนสมาชิกทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="?content=user-member" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $openpage;?></h3>
                            <p>จำนวนผู้เข้าชมระบบทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="?content=home" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $openpage_website;?></h3>
                            <p>จำนวนผู้เข้าชมเว็บไซต์ทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="?content=home" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">สมาชิกล่าสุด</h3>
                            <div class="box-tools pull-right">
                                <span class="label label-danger"></span>
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <?php
                            $SERACHING = @$_GET['searhing'];
                            $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
                            $SHOW = 12;
                            $start = ($PAGE-1)*$SHOW;
                            $sql = "
                                SELECT *
                                FROM tb_member
                        ";
                        $all = $DATABASE->QueryNumRow($sql);
                        $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_member.id DESC LIMIT $start,$SHOW");
                        ?>
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                <?php
                                if(sizeof($DATA)>0){
                                    foreach($DATA as $key => $row){
                                        ?>
                                        <li>
                                            <?php 
                                            if( $row['fileupload'] == null){
                                                ?>
                                                <img id="img_" style="width: 79%;height: 79%;" src="images/user.png" alt="User image" onerror="ON_IMAGE_ERROR(this)">
                                            <?php }else { ?>
                                                <img src="files/img_member/<?php echo $row['fileupload'];?>" alt="User Image"> 
                                            <?php } ?>
                                            <a class="users-list-name" href="?content=user-member-show&id=<?php echo $row['id'];?>"><?php echo $row['name'];?> <?php echo $row['name'];?></a>
                                            <span class="users-list-date"></span>
                                        </li>
                                        <?php 
                                    }
                                } else {
                                    echo "<div align='center'><i>ไม่มีข้อมูล</i></div>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="box-footer text-center">
                            <a href="?content=user-member" class="uppercase">เพิ่มเติม</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ประวัติผู้ใช้งาน</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                                $SERACHING = @$_GET['searhing'];
                                $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
                                $SHOW = 12;
                                $start = ($PAGE-1)*$SHOW;
                                $sql = "
                                    SELECT 
                                        -- DISTINCT admin_id,
                                        tb_counter_ipaddress_back.id,
                                        tb_prefix.`name` AS prefix_name,
                                        tb_admin.`name`,
                                        tb_admin.lname,
                                        tb_counter_ipaddress_back.id,
                                        ipaddress,
                                        date_time
                                    FROM tb_counter_ipaddress_back
                                        INNER JOIN tb_admin ON tb_admin.id = tb_counter_ipaddress_back.admin_id
                                        INNER JOIN tb_prefix ON tb_admin.prefix_id = tb_prefix.id
                                        GROUP BY admin_id
                            ";
                            $all = $DATABASE->QueryNumRow($sql);
                            $DATA = $DATABASE->QueryObj($sql."ORDER BY tb_counter_ipaddress_back.date_time DESC LIMIT $start,$SHOW");
                            ?>
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ผู้ใช้</th>
                                            <th>สถานะ</th>
                                            <th>วันที่และเวลา</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(sizeof($DATA)>0){
                                            foreach($DATA as $key => $row){
                                                $date_time_desc = $DATABASE->QueryString("SELECT date_time FROM tb_counter_ipaddress_back ORDER BY id DESC");
                                                ?>
                                                <tr>
                                                    <td><a href="pages/examples/invoice.html"><?php echo $key+1;?></a></td>
                                                    <td><?php echo $row['prefix_name'];?> <?php echo $row['name'];?> <?php echo $row['lname'];?></td>
                                                    <td><span class="label label-success"><?php echo $row['ipaddress'];?></span></td>
                                                    <td><?php echo $row['date_time'];?></td>
                                                    <!-- <td><?php //echo $date_time_desc;?></td> -->
                                                </tr>
                                                <?php 
                                            }
                                        }else{
                                            echo "
                                                    <td><div align='center'><i>ไม่มีข้อมูล</i></div></td>
                                                  ";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- solid sales graph -->
                    <div class="box box-solid bg-teal-gradient">
                        <div class="box-header">
                            <i class="fa fa-th"></i>
                            <h3 class="box-title">Sales Graph</h3>
                            <div class="box-tools pull-right">
                                <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body border-radius-none">
                            <div class="chart" id="line-chart" style="height: 250px;"></div>
                        </div><!-- /.box-body -->
                        <div class="box-footer no-border">
                            <div class="row">
                                <div class="col-xs-2 text-center" style="border-right: 1px solid #f4f4f4">
                                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                    <div class="knob-label">Mail-Orders</div>
                                </div><!-- ./col -->
                                <div class="col-xs-2 text-center" style="border-right: 1px solid #f4f4f4">
                                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                    <div class="knob-label">Online</div>
                                </div><!-- ./col -->
                                <div class="col-xs-2 text-center">
                                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                    <div class="knob-label">In-Store</div>
                                </div><!-- ./col -->
                                <div class="col-xs-2 text-center">
                                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                    <div class="knob-label">In-Store</div>
                                </div><!-- ./col -->
                                <div class="col-xs-2 text-center">
                                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                    <div class="knob-label">In-Store</div>
                                </div><!-- ./col -->
                                <div class="col-xs-2 text-center">
                                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                    <div class="knob-label">In-Store</div>
                                </div><!-- ./col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
    </section>
<?php } ?>