<?php 
    if( $USER==null ) {
        LINKTO("login.php");
    }
    $SERACHING = @$_GET['searhing'];
    $PAGE = isset($_GET["page"])?$_GET["page"]:"1";
    // spl_autoload_extensions('.php');
    // spl_autoload_register();

    // use classes\thai as thai;
?>
<section class="content-header">
    <h1><i class="glyphicon glyphicon-book"></i> ข้อมูลหนังสือ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลหนังสือ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลหนังสือทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="book">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <?php if($USER["status_id"]=="1"||$USER["status_id"]=="2") {?>
                        <a href="?content=book-add&page=<?php echo $PAGE; ?>" class="btn btn-success" title="เพิ่มข้อมูล"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <?php } ?>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=book'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูลกิจกรรม" value="<?php echo $SERACHING; ?>" style="width: 423px;">
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
                        tb_book.id,
                        tb_book.book_type_id,
                        tb_book.name_thai As book_name,
                        tb_book.name_eng,
                        tb_book.fileupload,
                        tb_type_book.`name` As type_book_name
                    FROM
                        tb_book
                        INNER JOIN tb_type_book ON tb_book.book_type_id = tb_type_book.id
                    WHERE  
                        tb_book.id LIKE '%$SERACHING%' OR
                        tb_book.name_thai LIKE '%$SERACHING%' OR
                        tb_book.name_eng LIKE '%$SERACHING%' OR
                        tb_type_book.`name` LIKE '%$SERACHING%' 
                    ";
                    $all = $DATABASE->QueryNumRow($sql);
                    $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_book.id DESC LIMIT $start,$SHOW ");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>ลำดับ</center></th>
                            <th>หัวข้อ</th>
                            <th>ชนิดหนังสือ</th>
                            <th style="text-align: right;">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(sizeof($DATA)>0){ 
                                foreach($DATA as $key => $row){
                                    ?>
                                    <tr>
                                        <td><center><?php echo $key+1; ?></center></td>
                                        <td><?php echo $row['book_name']; ?></span></td>
                                        <td><?php echo $row['type_book_name']; ?></td>
                                        <td style="text-align: right;">
                                            <a class="btn btn-info btn-sm" href="?content=book-show&id=<?php echo $row['id']; ?>&page=<?php echo $PAGE; ?>" title="จัดการข้อมูล"><i class="fa fa-cog"></i> จัดการข้อมูล</a>
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
                    $href1 = 'href="?content=book&page='.($PAGE-1).$searhing.'"';
                    $href2 = 'href="?content=book&page='.($PAGE+1).$searhing.'"';

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