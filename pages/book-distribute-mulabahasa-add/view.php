<?php
    include("pages/book-distribute-mulabahasa/function.php");
?>
<script type="text/javascript">
    var $template;
    $(function() {
        $('#school_id').select2().change(function(event) {
            var school_id = $(this).val();
            $.post("pages/book-distribute-mulabahasa-add/get-school.php", {
                school_id: school_id
            }, function(data) {
                var arr = JSON.parse( data );
                $("#teacher_id").html('<option value="">- เลือกบุคลากร -</option>');
                $.each(arr, function(i, v) {
                    var $option = $("<option></option>");
                    $option
                        .attr("value",v.id)
                        .attr("data-json", JSON.stringify(v))
                        .html(v.prefix_name+v.name_thai+" "+v.lname_thai);
                    $("#teacher_id").append($option);
                });
            });
        }); 
        $('#teacher_id').select2().change(function(event) {
            var v = $(this).val();
            var data = $(this).find("option[value='"+v+"']").attr("data-json");
            try {
                var arr = JSON.parse(data);
            } catch(e) { }
        });

        $('#type_book_id').select2().change(function(event) {
            var type_book_id = $(this).val();
            $.post("pages/book-distribute-mulabahasa-add/get-data.php", {
                type_book_id: type_book_id
            }, function(data) {
                var arr = JSON.parse( data );
                $("#book_id").html('<option value="">- เลือกหนังสือ -</option>');
                $.each(arr, function(i, v) {
                    var $option = $("<option></option>");
                    $option
                        .attr("value",v.id)
                        .attr("data-json", JSON.stringify(v))
                        .html(v.name_thai);
                    $("#book_id").append($option);
                });
            });
        }); 
        $('#book_id').select2().change(function(event) {
            var v = $(this).val();
            var data = $(this).find("option[value='"+v+"']").attr("data-json");
            var price = 0;
            try {
                var arr = JSON.parse(data);
                price = arr.price;
            } catch(e) { }
        });

        $template = $(".template").clone();
        $(".template").remove();
        resetData();

        $("#btn-add").click(function(event) {
            addData();
        });
        $("#btn-edit").click(function(event) {
            editData();
        });
        $("#btn-cancel").click(function(event) {
            resetData();
        });
        $('.btn-edit').click(function(event) {
            showEditData(this);
        });
        $('.btn-del').click(function(event) {
            delData(this);
        });
    });
    function addToPostTable(value) {
        var data = $("[name='table_']").val();
        try { data = JSON.parse(data); } catch(e) { data=[]; }
        data.push(value);
        $("[name='table_']").val( JSON.stringify(data) );
    }
    function delToPostTable(idx) {
        var data = $("[name='table_']").val();
        try { data = JSON.parse(data); } catch(e) { data=[]; }
        data.splice(idx,1);
        $("[name='table_']").val( JSON.stringify(data) );
    }
    function editToPostTable(idx, value) {
        var data = $("[name='table_']").val();
        try { data = JSON.parse(data); } catch(e) { data=[]; }
        data[idx] = value;
        $("[name='table_']").val( JSON.stringify(data) );
    }
    function addData() {
        if( $("#school_id").val()=="" ) { alert("คุณยังไม่ได้ใสโรงเรียน"); $("#school_id").focus(); return; }
        if( $("#teacher_id").val()=="" ) { alert("คุณยังไม่ได้ใสบุคลากร"); $("#teacher_id").focus(); return; }
        if( $("#type_book_id").val()=="" ) { alert("คุณยังไม่ได้ใสชนิดหนังสือ"); $("#type_book_id").focus(); return; }
        if( $("#book_id").val()=="" ) { alert("คุณยังไม่ได้ใสหนังสือ"); $("#book_id").focus(); return; }
        if( $("#qty").val()==0 ) { alert("คุณยังไม่ได้ใส่จำนวน"); $("#qty").focus(); return; }
        // if( $("#note").val()=="" ) { alert("คุณยังไม่ได้ใส่ชื่อรายการ"); $("#note").focus(); return; }

        var $clone = $template.clone();
        $clone.find('.order').html( $("#table tr:not(.notfound)").length+1 );

        $clone.find('.school_name')
        .attr("data-value", $("#school_id").val() )
        .html( $("#school_id option:selected").html() );
        $clone.find('.teacher_name')
        .attr("data-value", $("#teacher_id").val() )
        .html( $("#teacher_id option:selected").html() );

        $clone.find('.type_book_name')
        .attr("data-value", $("#type_book_id").val() )
        .html( $("#type_book_id option:selected").html() );
        $clone.find('.criterion_name')
        .attr("data-value", $("#book_id").val() )
        .html( $("#book_id option:selected").html() );
        $clone.find('.qty').html( $("#qty").val() );
        $clone.find('.note').html( $("#note").val() );

        addToPostTable({
            'school_id':$("#school_id").val(),
            'school_name':$("#school_id option:selected").html(),
            'teacher_id':$("#teacher_id").val(),
            'teacher_name':$("#teacher_id option:selected").html(),
            'type_book_id':$("#type_book_id").val(),
            'type_book_name':$("#type_book_id option:selected").html(),
            'book_id':$("#book_id").val(),
            'criterion_name':$("#book_id option:selected").html(),
            'qty':$("#qty").val(),
            'note': $("#note").val()
        });

        $clone.find('.btn-edit').click(function(event) {
            showEditData(this);
        });
        $clone.find('.btn-del').click(function(event) {
            delData(this);
        });
        $clone.appendTo('#table');
        resetData();
    }
    function resetData() {
        $("#order").val( $("#table tr:not(.notfound)").length+1 );
        // $("#school_id").val( $("#school_id option:first").attr("value") ).trigger('change');
        // $("#teacher_id").val( $("#teacher_id option:first").attr("value") ).trigger('change');
        // $("#type_book_id").val( $("#type_book_id option:first").attr("value") ).trigger('change');
        $("#book_id").val( $("#book_id option:first").attr("value") ).trigger('change');
        $("#note").val("");
        $("#qty").val(1);
        if( $("#table tr:not(.notfound)").length==0 ) {
            $("#table").html("<tr class='notfound'><td colspan='7' align='center'>ไม่พบข้อมูล</td></tr>");
        } else {
            $("#table tr.notfound").remove();
        }
        $("#btn-add").show();
        $("#btn-edit").hide();
        $("#btn-cancel").hide();
    }
    function showEditData(ctrl) {
        var $tr = $(ctrl).closest('tr');
        $("#order").val( $tr.find('.order').html() );
        $("#school_id").val( $tr.find('.school_name').attr("data-value") ).trigger('change');
        $("#teacher_id").val( $tr.find('.teacher_name').attr("data-value") ).trigger('change');

        $("#type_book_id").val( $tr.find('.type_book_name').attr("data-value") ).trigger('change');
        $("#book_id").val( $tr.find('.criterion_name').attr("data-value") ).trigger('change');
        $("#qty").val( $tr.find('.qty').html() );
        $("#note").val( $tr.find('.note').html() );
        $("#btn-add").hide();
        $("#btn-edit").show();
        $("#btn-cancel").show();
    }
    function editData() {
        if( $("#school_id").val()=="" ) { alert("คุณยังไม่ได้ใสโรงเรียน"); $("#school_id").focus(); return; }
        if( $("#teacher_id").val()=="" ) { alert("คุณยังไม่ได้ใสบุคลากร"); $("#teacher_id").focus(); return; }
        if( $("#type_book_id").val()=="" ) { alert("คุณยังไม่ได้ใสชนิดหนังสือ"); $("#type_book_id").focus(); return; }
        if( $("#book_id").val()=="" ) { alert("คุณยังไม่ได้ใสหนังสือ"); $("#book_id").focus(); return; }
        if( $("#qty").val()==0 ) { alert("คุณยังไม่ได้ใส่จำนวน"); $("#qty").focus(); return; }
        
        var order = $("#order").val();
        var $tr = $("#table tr:eq("+(order-1)+")");
        $tr.find('.order').html( $("#order").val() );
        $tr.find('.school_name')
        .attr("data-value", $("#school_id").val() )
        .html( $("#school_id option:selected").html() );
        $tr.find('.teacher_name')
        .attr("data-value", $("#teacher_id").val() )
        .html( $("#teacher_id option:selected").html() );

        $tr.find('.type_book_name')
        .attr("data-value", $("#type_book_id").val() )
        .html( $("#type_book_id option:selected").html() );
        $tr.find('.criterion_name')
        .attr("data-value", $("#book_id").val() )
        .html( $("#book_id option:selected").html() );
        $tr.find('.note').html( $("#note").val() );
        $tr.find('.qty').html( $("#qty").val() );
        editToPostTable(order-1,{
            'school_id':$("#school_id").val(),
            'school_name':$("#school_id option:selected").html(),
            'teacher_id':$("#teacher_id").val(),
            'teacher_name':$("#teacher_id option:selected").html(),

            'type_book_id':$("#type_book_id").val(),
            'type_book_name':$("#type_book_id option:selected").html(),
            'book_id':$("#book_id").val(),
            'criterion_name':$("#book_id option:selected").html(),
            'qty':$("#qty").val(),
            'note': $("#note").val()
        });
        resetData();
    }
    function delData(ctrl) {
        if( confirm("คุณต้องการลบรายการนี้ใช่ไหม?") ) {
            var $tr = $(ctrl).closest('tr');
            var idx = $tr.find('.order').html()-1;
            delToPostTable(idx);
            $tr.remove();
            resetData();
        }
    }
</script>
<section class="content-header">
    <h1><i class="fa fa-file"></i> ข้อมูลการแจกจ่ายหนังสือ<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
        <li><a href="?content=<?php echo $content; ?>">ข้อมูลการแจกจ่ายหนังสือ</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">เพิ่มข้อมูลการแจกจ่ายหนังสือ</h3>
        </div>
            <form  id="myForm" class="box-body" method="post" enctype="multipart/form-data">
            <?php
                $thisFrom = array(
                    'table_'
                    );
                foreach ($_POST as $key => $value) {
                    if( chkForm($thisFrom, $key) ) continue;
                    echo '<input type="hidden" name="'.$key.'" value="'.$DATABASE->Escape($value,'display').'">';
                }
            ?>
            <input type="hidden" name="table_" value="<?php echo $DATABASE->Escape(getValue("table_"),'display'); ?>">
            <div class="box-body" style="margin-top: 0px;">
                <div class="row">
                    <div align="center">
                        <p ><img src="files/img/aa.gif" alt="" width="12%" height="15%" /></p>
                        <h5 style="padding-top: -20px;"><b>เอกสารรับมอบหนังสือนิทาน</b></h5>
                        <h5 style="padding-top: -20px;"><b>ชุดนิทานคุณธรรมจากวรรรณกรรมในฝักกริช</b></h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td><input type="text" id="order" class="form-control" disabled="disabled"></td>
                                <!-- <td>
                                    <select class="form-control" id="school_id" style="width: 250px;">
                                        <option value="">- เลือกโรงเรียน -</option>
                                        <?php
                                            // $sql = "SELECT * FROM tb_school";
                                            // $obj = $DATABASE->QueryObj($sql);
                                            // foreach ($obj as $key => $value) {
                                            //     echo '<option value="'.$value["id"].'" data-json="'.$DATABASE->Escape(json_encode($value),'display').'">'.$value["name"].' </option>';
                                            // }
                                        ?>
                                    </select>
                                </td> -->
                                <td>
                                    <select class="form-control" id="school_id" style="width: 200px;">
                                        <option value="">- เลือกโรงเรียน -</option>
                                        <?php
                                            $sql = "SELECT
                                                        tb_school.id,
                                                        tb_school.`name`,
                                                        tb_amphur.`name` As amphur_name,
                                                        tb_district.`name` As district_name,
                                                        tb_province.`name` As province_name
                                                    FROM
                                                        tb_school
                                                        INNER JOIN tb_amphur ON tb_amphur.id = tb_school.amphur_id
                                                        INNER JOIN tb_district ON tb_school.district_id = tb_district.id
                                                        INNER JOIN tb_province ON tb_school.province_id = tb_province.id
                                                        ORDER BY name";
                                            $obj = $DATABASE->QueryObj($sql);
                                            foreach ($obj as $key => $value) {
                                                echo '<option value="'.$value["id"].'" data-json="'.$DATABASE->Escape(json_encode($value),'display').'">'.$value["name"].' (ต. '.$value["district_name"].' อ. '.$value["amphur_name"].' จ. '.$value["province_name"].') </option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="teacher_id" style="width: 150px;">
                                        <option value="">- เลือกบุคลากร -</option>
                                        <?php
                                            // $sql = "SELECT * FROM tb_teacher";
                                            // $obj = $DATABASE->QueryObj($sql);
                                            // foreach ($obj as $key => $value) {
                                            //     echo '<option value="'.$value["id"].'" data-json="'.$DATABASE->Escape(json_encode($value),'display').'">'.$value["name_thai"].' '.$value["lname_thai"].' </option>';
                                            // }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="type_book_id" style="width: 100px;">
                                        <option value="">- เลือกชนิดหนังสือ -</option>
                                        <?php
                                        $sql = "SELECT * FROM tb_type_book";
                                        $obj = $DATABASE->QueryObj($sql);
                                        foreach ($obj as $key => $value) {
                                            echo '<option value="'.$value["id"].'" data-json="'.$DATABASE->Escape(json_encode($value),'display').'">'.$value["name"].' </option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="book_id" style="width: 200px;">
                                        <option value="">- เลือกหนังสือ -</option>
                                        <?php
                                            /*$sql = "SELECT * 
                                                    FROM tb_criterion 
                                                    WHERE year_id='".$_POST["year_id_"]."' 
                                                    ORDER BY year_id
                                            ";
                                            $obj = $DATABASE->QueryObj($sql);
                                            foreach ($obj as $key => $value) {
                                                echo '<option value="'.$value["id"].'" data-json="'.$DATABASE->Escape(json_encode($value),'display').'">'.$value["name"].' </option>';
                                            }*/
                                        ?>
                                    </select>
                                </td>
                                <td style="width: 100px;"><input type="number" class="form-control" id="qty"></td>
                                <td style="width: 250px;"><input type="text" class="form-control" id="note" placeholder="เช่น ใช้สอนนักเรียน"></td>
                                <td style="width: 150px;">
                                    <button type="button" id="btn-add" class="btn btn-success" title="เพิ่มข้อมูล"><i class="fa fa-plus"></i></button>
                                    <button type="button" id="btn-edit" class="btn btn-warning" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i></button>
                                    <button type="button" id="btn-cancel" class="btn btn-default" title="ลบข้อมูล"><i class="fa fa-undo"></i></button>
                                </td>
                            </tr>
                            <tr style="background-color: #861010; color: #fff;">
                                <th style="width: 10px;">ลำดับ</th>
                                <th style="width: 20px;">โรงเรียน</th>
                                <th style="width: 10px;">บุคลากร</th>
                                <th style="width: 20px;">ชนิดหนังสือ</th>
                                <th style="width: 20px;">หนังสือ</th>
                                <th style="width: 10px;">จำนวน</th>
                                <th style="width: 10px;">หมายเหตุ</th>
                                <th style="width: 10px;">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="table">
                            <tr class="template">    
                                <td class="order">1</td>
                                <td class="school_name">โรงเรียน</td>
                                <td class="teacher_name">บุคลากร</td>
                                <td class="type_book_name">ชนิดหนังสือ</td>
                                <td class="criterion_name">หนังสือ</td>
                                <td class="qty">จำนวน</td>
                                <td class="note">หมายเหตุ</td>
                                <td style="padding: 3px; text-align: center;" >
                                    <button type="button" class="btn-edit btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn-del btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                            <?php
                            $table_ = array();
                            // if( getValue("table_")!="" ) $table_ = json_decode( getValue("table_"), true );
                                //echo sizeof($table_);
                            foreach ($table_ as $key => $value) {
                                echo '
                                <tr>
                                    <td class="order">'.($key+1).'</td>
                                    <td class="school_id">'.$value['school_name'].'</td>
                                    <td class="teacher_id">'.$value['teacher_name'].'</td>
                                    <td class="note">'.$value['note'].'</td>
                                    <td class="type_book_name" data-value="'.$value['type_book_id'].'" >'.$value['type_book_name'].'</td>
                                    <td class="criterion_name" data-value="'.$value['book_id'].'" >'.$value['criterion_name'].'</td>
                                    <td class="qty">'.$value['qty'].'</td>
                                    <td style="padding: 3px; text-align: center;">
                                        <button type="button" class="btn-edit btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn-del btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="box-footer text-right">
                        <button type="button" class="btn btn-default" title="รีเฟรส" onClick="location.reload()"><i class="fa fa-refresh"></i> รีเฟรส</button>
                        <button type="button" onclick="goStep('action')" class="btn btn-primary" title="บันทึก"><i class="fa fa-check"></i> บันทึก</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>