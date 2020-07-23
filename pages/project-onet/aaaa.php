<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php
    if( $USER==null ) {
        LINKTO("login.php");
    }
?>
<section class="content-header">
    <h1><i class="fa fa-file"></i> ข้อมูลการศึกษาไทย<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลการศึกษาไทย</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"> ข้อมูลการศึกษาไทยทั้งหมด</h3>
            <div style="margin-top: 15px;">
                <form action="./" method="get" class="form-inline">
                    <input type="hidden" name="content" value="project">
                    <input type="hidden" name="page" value="<?php echo $PAGE; ?>">
                    <a href="?content=project-add" class="btn btn-success" title="เพิ่มข้อมูล">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                    <button type="button" class="btn btn-default" onClick="location.href='?content=project'" title="รีเฟรส"><i class="fa fa-refresh"></i> รีเฟรส</button>
                    <input type="text" class="form-control" name="searhing" placeholder="ค้นหาโครงการ" value="<?php echo $SERACHING; ?>" style="width: 423px;">
                    <button type="submit" class="btn btn-primary" title="ค้นหา">
                        <i class="fa fa-search"></i> ค้นหา</button><a class="color-red"></a>
                </form>
            </div>
        </div>
        <div class="box-body" style="margin-top: 0px;">
            <script type="text/javascript" src="js/pdfobject.js"></script>
        <script type="text/javascript">
            window.onload = function (){
                var myPDF = new PDFObject({ 
                    url: "pdf/พาจิตกลับบ้าน.pdf",
                    id: "myPDF",
                    width: "650px",
                    height: "700px",
                    pdfOpenParams: {
                        navpanes: 1,
                        statusbar: 0,
                        view: "FitH",
                        pagemode: "thumbs"
                    }
                }).embed('pdfplace');
            };
        </script>
   
        <?php
        include 'connection.php';
        $file_pdf="";
        if(isset($_GET['id']) && $_GET['id']!=""){
            $myb = $_GET['id'];
            $sql = "SELECT * FROM pdf_name WHERE id='".$myb."'";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            $file_pdf ="myfilepdf/".$row['pdf_name'];
        }
        ?>

        <div id="pdfplace">
            ไม่ได้ติดตั้งโปรแกรม Adobe Reader หรือบราวเซอร์ไม่รองรับการแสดงผล PDF 
            <a href="<?=$file_pdf?>">คลิกที่นี้เพื่อดาวน์โหลดไฟล์ PDF</a>
        </div>

        <script type="text/javascript" src="js/pdfobject.js"></script>
        <script type="text/javascript">
            window.onload = function (){
                var myPDF = new PDFObject({ 
                    url: "<?=$file_pdf?>",
                    id: "myPDF",
                    width: "650px",
                    height: "700px",
                    pdfOpenParams: {
                        navpanes: 1,
                        statusbar: 0,
                        view: "FitH",
                        pagemode: "thumbs"
                    }
                }).embed('pdfplace');
            };
        </script>
            <div id="container" style="height: 300px"></div>
            <script type="text/javascript" >
                Highcharts.chart('container', {
                chart: {
                type: 'column'
                },
                        title: {
                        text: 'กราฟ',
                                style: {
                                fontSize: '20px',
                                        fontWeight: 'bold',
                                        textTransform: 'uppercase'
                                }
                        },
                        subtitle: {
                        text: 'จำนวนหนังสือที่ได้รับไปทั้งหมด'
                        },
                        xAxis: {
                        categories: [
                                'ความสามารถด้านภาษา',
                                'ความสามารด้านคำนวณ',
                                'ความสามารถด้านวิเคราะห์',
                        ],
                                crosshair: true
                        },
                        yAxis: {
                        min: 0,
                                title: {
                                text: 'ระดับ (คะแนน)'
                                }
                        },
                        tooltip: {
                        headerFormat: '<span style="font-size:18px;font-family: thai_sans_literegular, san-serif, arial !important;">{point.key}</span><table>',
                                pointFormat: '<tr><td style="font-size:18px;font-family: thai_sans_literegular, san-serif, arial !important;color : {series.color};padding:0"> {series.name} : </td>' +
                                        ' <td style="padding:0" > <b>{point.y:.1f} คะแนน</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                        },
                        plotOptions: {
                        column: {
                        pointPadding: 0.1,
                                borderWidth: 0
                        }
                        },
                        series: [
<?php
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
                        ";
                        $all = $DATABASE->QueryNumRow($sql);
                        $DATA = $DATABASE->QueryObj($sql." ORDER BY tb_book.id DESC");
                        if(sizeof($DATA)>0){ 
                            foreach($DATA as $key => $row){
?>
                            {
                            name: '<?= $row["book_name"]; ?> (<?= $row["book_name"]; ?>)',
                                    data: [<?= $row["id"]; ?>, <?= $row["id"]; ?>, <?= $row["id"]; ?>]

                            },
<?php } }  ?>],
                        navigation: {
                        buttonOptions: {
                        theme: {
                        // Good old text links
                        style: {
                        color: '#039',
                                textDecoration: 'underline'
                        }
                        }
                        }
                        },
                        exporting: {
                        buttons: {
                        contextButton: {
                        enabled: false
                        },
                                printButton: {
                                text: 'พิมพ์',
                                        onclick: function () {
                                        this.print();
                                        }
                                }
                        }
                        }
                });
    </script>
            
        </div>
    </div>
</section>