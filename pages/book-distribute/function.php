<?php
    function getValue($d) {
        if( isset($_POST[$d]) ) return $_POST[$d];
        return "";
    }
    function getActiveStep() { 
        $step2 = array(
            "table_"
        );
        
        $activeStep = 2;
        //$activeStep++;
        foreach ($step2 as $key => $value) {
            if( !isset($_POST[$value])||$_POST[$value]=="" ) return $activeStep;
        }
        return $activeStep;
    }
    function chkForm($form, $d) {
        foreach ($form as $key => $value) { if($d==$value) return true; } return false;
    }
    function setStepClass($active, $step) {
        if( $active==$step ) return "active";
        if( $active>$step ) return "complete";
        return "disabled";
    }
    function createViewLinkStep($activeStep, $currStep) {
        if(setStepClass($activeStep, $currStep)!='disabled') {
            return 'onclick="goStep('.$currStep.')"';
        }
        return "";
    }
    function setCurrentStep($currStep) {
        $content = $_GET["content"];
        if( $content=="book-distribute".$currStep ) return "current";
        return "";
    }
    function createViewStep($activeStep) {
        return '
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-xs-3 bs-wizard-step '.setStepClass($activeStep, 1).' '.setCurrentStep(2).'"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">ขั้นที่ 2</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="javascript:" '.createViewLinkStep($activeStep, 1).' class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"> ข้อมูลครุภัณฑ์คอมพิวเตอร์</div>
                </div>
    
            </div>
        ';
    }
 ?>
 <script type="text/javascript">
    var currStep = null;
    $(function() {
        var url = window.location.href;
        var arr = url.split("/");
        var content = arr[ arr.length-1 ];
        if( content=="?content=book-distribute-add" ) currStep = 2;

    });

    function goStep(step) {
        if( step>currStep ) {
            if( currStep==2 ) {
                var data = [];
                try { data = JSON.parse( $("[name='table_']").val() ); } catch(e) { }
                if(data.length==0) {
                    alert("กรุณาเพิ่มข้อมูลหนังสือ อย่างน้อย 1 เรื่อง");
                    $("#book_id").focus();
                    return;
                }
            }  
        }
        $("#myForm").attr("action","?content=book-distribute-"+step);
        $("#myForm").trigger('submit');
    }

</script>