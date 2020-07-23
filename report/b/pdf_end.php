<?php
	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->WriteHTML($html);
	$mpdf->WriteHTML($html);
	// JAVASCRIPT FOR WHOLE DOCUMENT
	$mpdf->SetJS('
	function TwoPages() {
		this.layout="TwoColumnRight";
		this.zoomType = zoomtype.fitW;
	}
	function OnePage() {
		this.layout="SinglePage";
		this.zoom = 100;
	}
	');
	$mpdf->Output();
?>