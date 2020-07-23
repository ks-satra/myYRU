<?php 
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $PROVINCE_ID = $_GET['province_id'];
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    $ALL = "all";
    include ("pages/date.php");
    spl_autoload_extensions('.php');
    spl_autoload_register();

    use classes\thai as thai;
?> 
<section class="content-header">
    <h1><i class="fa fa-globe"></i> ข้อมูลโรงเรียน<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลโรงเรียน</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลโรงเรียนทั้งหมด</h3><small> > <?php if($PROVINCE_ID==$ALL){
                echo "ต่างจังหวัด";
            }else {
                echo "จังหวัด";
                echo $province = $DATABASE->QueryString("
                SELECT
                    name
                FROM
                    tb_province
                WHERE id = '".$_GET['province_id']."'
            "); 
            }?></small>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="report-get-school">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <input type="hidden" name="province_id" value="<?php echo $PROVINCE_ID; ?>">
                    <a href="?content=report-book-province&page=<?php echo $PAGE;?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=report-get-school&province_id=<?php echo $_GET['province_id'];?>'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูลโรงเรียน" value="<?php echo $SERACHING; ?>" style="width: 423px;">
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
                    if ($PROVINCE_ID==$ALL) {
                        $condition = "";
                            $condition = " AND tb_province.id != '74' AND tb_province.id != '75' AND tb_province.id != '76' 
                        ";
                    }
                    else {
                        $condition = "";
                            $condition = " AND tb_province.id = '".$PROVINCE_ID."' 
                        ";
                    }
                    $sql = "                
                        SELECT
                            tb_school.id as school_id,
                            tb_school.`code`,
                            tb_school.`name`,
                            tb_school.`no`,
                            tb_school.mu,
                            tb_school.road,
                            tb_school.alley,
                            tb_school.village,
                            tb_district.`name` as district_name,
                            tb_amphur.`name` as amphur_name,
                            tb_province.`name` as province_name,
                            tb_school.passcode,
                            tb_amphur.id,
                            tb_province.id
                        FROM
                            tb_get_book
                            INNER JOIN tb_school ON tb_get_book.school_id = tb_school.id
                            INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                            INNER JOIN tb_amphur ON tb_school.amphur_id = tb_amphur.id
                            INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                        WHERE  (
                            tb_school.id LIKE '%$SERACHING%' OR
                            tb_school.`name` LIKE '%$SERACHING%' 
                            ) ".$condition."
                        GROUP BY tb_school.id , tb_amphur.id
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_province.id DESC LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr style="background-color: #780808; color: #fff;">
                            <th><center>ลำดับ</center></th>
                            <th>ชื่อโรงเรียน</th>
                            <th>ที่อยู่โรงเรียน</th>
                            <th><center>ตรวจสอบข้อมูล</center></th>
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
                                        <td><center>
                                            <a class="btn btn-info btn-sm" href="?content=report-get-school-person&province_id=<?php echo $PROVINCE_ID;?>-<?php echo $row['school_id'];?>&school_id=<?php echo $row['school_id'];?>&page=<?php echo $PAGE; ?>" title="แสดงข้อมูล"><i class="fa fa-eye"></i> แสดงข้อมูล</a>
                                        </center></td>            
                                    </tr>
                                    <?php 
                                }
                            }else{
                                echo "<tr><td colspan='6' align='center'><i>ไม่มีข้อมูล</i></td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <div style="text-align: right;">จำนวนข้อมูลโรงเรียนทั้งหมด <?php echo $all;?> แห่ง</div>
                <?php
                    $searhing = "";
                    if( $SERACHING!="" ) {
                        $searhing = '&searhing='.$SERACHING;
                    }

                    $disabled1 = '';
                    $disabled2 = '';
                    $href1 = 'href="?content=report-get-school&page='.($PAGE-1).$searhing.'&province_id='.$PROVINCE_ID.' "';
                    $href2 = 'href="?content=report-get-school&page='.($PAGE+1).$searhing.'&province_id='.$PROVINCE_ID.' "';

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
  