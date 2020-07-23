$(function() {
    function loadCw() {
        $.post('pages/criterion-edit/services.php', { fn: "loadCw" }, function(data) {
            var arr = JSON.parse(data);
            $("[name='province_id_']").html('<option value="">- เลือกจังหวัด -</option>');
            $.each(arr, function(i, v) {
               $("[name='province_id_']").append('<option value="'+v.id+'">'+v.name+'</option>');
            });
        });
    }
    function loadAp() {
        var cw_id = $("[name='province_id_']").val();
        $.post('pages/criterion-edit/services.php', { fn: "loadAp", cw_id: cw_id }, function(data) {
            var arr = JSON.parse(data);
            $("[name='amphur_id_']").html('<option value="">- เลือกแขวง / อำเภอ -</option>');
            $.each(arr, function(i, v) {
               $("[name='amphur_id_']").append('<option value="'+v.id+'">'+v.name+'</option>');
            });
        });
    }
    function loadTb() {
        var cw_id = $("[name='province_id_']").val();
        var ap_id = $("[name='amphur_id_']").val();
        $.post('pages/criterion-edit/services.php', { fn: "loadTb", cw_id:cw_id, ap_id: ap_id }, function(data) {
            var arr = JSON.parse(data);
            $("[name='district_id_']").html('<option value="">- เลือกตำบล -</option>');
            $.each(arr, function(i, v) {
               $("[name='district_id_']").append('<option value="'+v.id+'">'+v.name+'</option>');
            });
        });
    }
    function loadPc() {
        var cw_id = $("[name='province_id_']").val();
        var ap_id = $("[name='amphur_id_']").val();
        $.post('pages/user-commit-edit/services.php', { fn: "loadPc", cw_id:cw_id, ap_id: ap_id }, function(data) {
            $("[name='passcode_']").val(data);
        });
    }
    //loadCw();
    $("[name='province_id_']").change(function(event) {
        loadAp();
        $("[name='district_id_']").html('<option value="">- เลือกตำบล -</option>');
        $("[name='passcode_']").val("");
    });
    $("[name='amphur_id_']").change(function(event) {
        loadTb();
        $("[name='passcode_']").val("");
    });
    $("[name='district_id_']").change(function(event) {
        loadPc();
    });
});
function IMAGE_RENDER(ctrl,to) {
    var input = $(ctrl)[0];
    if (input.files && input.files[0]) {
        var name = input.files[0].name;
        var size = input.files[0].size;
        var type = input.files[0].type; // "image/jpeg" | image/png | image/gif | image/pjpeg
        var arr = name.split(".");
        var fType = (arr[arr.length-1]).toLowerCase();;
        if(arr.length >= 2 && (fType == "jpg" || fType == "png" || fType == "gif")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(to).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            alert("รูปแบบไม่รองรับ");
            $(ctrl).val('');
            $(to).attr('src', "");
        }
    } else {
        alert("รูปแบบไม่รองรับ");
        $(ctrl).val('');
        $(to).attr('src', "");
    }
}
var ON_IMAGE_ERROR = function(ctrl){
    $(ctrl).attr("src","images/picture.png");
}

$(function() {
    $("[data-inputmask]").inputmask();
});
