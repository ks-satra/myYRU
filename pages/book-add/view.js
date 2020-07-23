function FILE_RENDER(ctrl,to) {
	var input = $(ctrl)[0];
	if (input.files && input.files[0]) {
		var name = input.files[0].name;
		var size = input.files[0].size;
		var type = input.files[0].type; // "image/jpeg" | image/png | image/gif | image/pjpeg
		var arr = name.split(".");
		var fType = (arr[arr.length-1]).toLowerCase();;
		if(arr.length >= 2 && (fType == "pdf")) {
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
var ON_FILE_ERROR = function(ctrl){
	$(ctrl).attr("src","images/user.png");
}
