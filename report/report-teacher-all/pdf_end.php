<?php
	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->WriteHTML($html);
	$mpdf->Output();
?>