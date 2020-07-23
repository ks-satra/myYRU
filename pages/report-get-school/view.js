var ON_IMAGE_ERROR = function(ctrl){
    $(ctrl).attr("src","images/picture.png");
}

// $(function() {
//     function loadDp() {
//         $.post('pages/school/services.php', { Ln: "loadDp" }, function(DATA) {
//             var arrey = JSON.parse(DATA);
//             $("[name='department_id_']").html('<option value="">- เลือกสำนักงานเขตพื้นที่การศึกษา -</option>');
//             $.each(arrey, function(i, v) {
//                $("[name='department_id_']").append('<option value="'+v.id+'">'+v.name+'</option>');
//             });
//         });
//     }
//     function loadAr() {
//         var dp_id = $("[name='department_id_']").val();
//         $.post('pages/school/services.php', { Ln: "loadAr", dp_id: dp_id }, function(DATA) {
//             var arrey = JSON.parse(DATA);
//             $("[name='area_id_']").html('<option value="">- เลือกสังกัด -</option>');
//             $.each(arrey, function(i, v) {
//                $("[name='area_id_']").append('<option value="'+v.id+'">'+v.name+'</option>');
//             });
//         });
//     }
//     loadDp();
//     $("[name='area_id_']").change(function(event) {
//     });
// });