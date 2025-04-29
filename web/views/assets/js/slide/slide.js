/**
 * JD SLIDER
 */

$('.jd-slider').jdSlider({
    isLoop: true,
    speed:500,
});


/**
 * ESCONDER EL SLIDE
 */

let toogle = false;

$(document).on("click","#btnSlide", function(){

    if (!toogle) {
        $(".jd-slider").slideUp("fast");
        $("#btnSlide").html('<i class="fa fa-angle-down"></i>');
        toogle = true;
    }else{
        $(".jd-slider").slideDown("fast");
        $("#btnSlide").html('<i class="fa fa-angle-up"></i>');
        toogle = false;
    }
});