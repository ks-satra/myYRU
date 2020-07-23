<?php 
    include("pages/meeting/meeting-date.php");
    spl_autoload_extensions('.php');
    spl_autoload_register();

    use classes\thai as thai;
?>
<link href="pages/meeting/meeting.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1><i class="fa fa-file"></i> ระเบียบวาระการประชุม<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ระเบียบวาระการประชุม</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มระเบียบวาระการประชุม</h3>
        </div>
        <form  id="myForm" class="meeting-container" action="pages/meeting-add/action.php" method="post" enctype="multipart/form-data">
            <div class="box-body" style="margin-top: 0px;">
                <input type="hidden" name="content" value="meeting-add">
                <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                <div class="row">
                    <div align="center">
                        <p>
                            <img src="files/img/yru_01.png" alt="" width="9%" height="10%" />
                            <img src="files/img/pts_01.png" alt="" width="8%" height="10%" />
                        </p>
                        <input class="w3-input w3-animate-input text-center" type="text" align="center" style="width:90%" title="ชื่อเรื่อง" placeholder="ชื่อเรื่อง" name="title" required>
                        <input class="w3-input w3-animate-input text-center" type="text" align="center" style="width:90%" title="ชื่อเรื่องย่อย" placeholder="ชื่อเรื่องย่อย" name="title_small" required>
                        <select id="meeting_qty_id" name="meeting_qty_id" class="w3-select selectpicker text-center" data-live-search="true" title="ครั้งที่" required>
                            <?php
                                $obj = $DATABASE->QueryObj("SELECT * FROM tb_meeting_qty ORDER BY qty");
                                foreach($obj as $row) {
                                    $selected = "";
                                    echo '<option value="'.$row["id"].'" '.$selected.' >'.$row["qty"].'</option>';
                                }
                            ?>
                        </select>
                        <?php
                            $mydate = new DateTime();
                                //echo thai::date_format($mydate, 'วันlที่ d F พ.ศ. Y H:i:s');
                        ?>
                        <input class="w3-input w3-animate-input text-center" type="date" style="width:160px" title="วันที่" placeholder="วันที่" id="date_start" name="date_start" required>
                        <input class="w3-input w3-animate-input text-center" type="text" style="width:90%" title="ห้องประชุม" placeholder="ห้องประชุม" name="room"><br>
                        <div class="text-right">
                            <button type="button" class="btn btn-default" title="รีเฟรส" onclick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                            <button type="submit" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>   
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>