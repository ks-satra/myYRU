<?php
if( $USER==null ) {
    LINKTO("login.php");
}
$PROJECT_ID = $_GET['project_id'];
$SERACHING = @$_GET['searhing'];
$PAGE = isset($_GET["page"])?$_GET["page"]:"1";
?>
<script>
    $(function() {
        $("#type_book_id").change(function() {
            var v = $(this).val();


            $.post("pages/book-distribute-add/get-data.php", {
                type_book_id: v
            }, function(data) {
                $("#show-data").html(data);
            });

            //

            //alert(v);

            //location.href = "./?content=book-distribute-add&type_book_id="+v;
        });
        $("#show-data").on("click", ".mycheckbok-all", function() {
            var chkall = $(".mycheckbok-all").prop("checked");
            $(".mycheckbok").prop("checked", chkall);
        });
    });
</script>
<section class="content-header">
    <h1><i class="fa fa-file"></i> ข้อมูลผู้เข้าร่วมโครงการ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลผู้เข้าร่วมโครงการ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลผู้เข้าร่วมโครงการ</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="project-activity-class-add">
                    <input type="hidden" name="project_id" value="<?php echo $PROJECT_ID; ?>">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=project-class&project_id=<?php echo $PROJECT_ID; ?>&activity_id=<?php echo $_GET['activity_id']; ?>&page=<?php echo $PAGE; ?>" class="btn btn-default" title="กลับ"><i class="fa fa-arrow-left"></i> กลับ</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=project-activity-class-add&project_id=<?php echo $PROJECT_ID;?>&page=<?php echo $PAGE; ?>'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาข้อมูลผู้เข้าร่วมโครงการ" value="<?php echo $SERACHING; ?>" style="width: 400px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                    <input type="date" class="form-control" name="date_start" placeholder="วันที่เริ่มต้น" value="<?php echo $DATE_START; ?>" style="width: 200px;" min="2019-01-01" max="2019-12-31">
                    <input type="date" class="form-control" name="date_end" placeholder="วันที่สิ้นสุด" value="<?php echo $DATE_END; ?>" style="width: 200px;" min="2019-01-01" max="2019-12-31">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <div class="table-responsive" id="show-data">
                <?php

                $sql = "                
                SELECT * 
                FROM tb_person
                ";
                $all = $DATABASE->QueryNumRow($sql);
                $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_person.id DESC");
                ?>
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr style="background: #861010; color: #fff;">
                            <th width="10%"><center>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input mycheckbok-all" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">เลือก</label>
                                </div>
                            </center></th>
                            <th width="40%">ชื่อ - สกุล</th>
                            <th width="50%">โรงเรียน (ตำบล อำเภอ จังหวัด)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($DATA)>0){
                            foreach($DATA as $key=>$row){
                                ?>
                                <tr>
                                    <td>
                                        <center>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input mycheckbok" id="customCheck2_<?php echo $key; ?>" name="books[]">
                                                <label class="custom-control-label" for="customCheck2_<?php echo $key; ?>"></label>
                                            </div>
                                        </center>
                                    </td>
                                    <td><span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; display: inline-block;width:220px" ><?php echo $row['name_thai']; ?> <?php echo $row['lname_thai']; ?></span></td>
                                    <td><?php echo $row['school_id']; ?></td>
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
            <?php
                $searhing = "";
                if( $SERACHING!="" ) {
                    $searhing = '&searhing='.$SERACHING;
                }

                $disabled1 = '';
                $disabled2 = '';
                $href1 = 'href="?content=project-activity-class-add&project_id='.$PROJECT_ID.'&page='.($PAGE-1).$searhing.'"';
                $href2 = 'href="?content=project-activity-class-add&project_id='.$PROJECT_ID.'&page='.($PAGE+1).$searhing.'"';
            ?>
        </div>
    </div>
</section>