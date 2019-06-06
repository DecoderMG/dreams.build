var $j=jQuery.noConflict();
$j(document).ready(function($) {
    var set = false;
    $j("#dr_add_reply").click(function(){
        if(set == false) {
            $j("#dr_reply").fadeIn();
            set = true;
        }else{
            $j("#dr_reply").fadeOut();
            set = false;
        }
    });

});
