$(document).ready(function (){
    var view_height = $("#layout-content").height()+$(".container").height();
    $(".aside").css({"height":view_height+"px"});
    $(".aside_open_btn").css({"height":view_height+"px"});
    
    $(".show_btn").click(function (){
        if($(".top_banner").css("display")=="block"){
            $(".top_banner").slideUp(500);
            $("#arrow").attr("src", "http://pji.innoi.kr/themes/demo/assets/images/under_array.png");
        }else{
            $(".top_banner").slideDown(500);    
            $("#arrow").attr("src", "http://pji.innoi.kr/themes/demo/assets/images/up_array.png");
        }
    });
    $(".aside_open_btn").click(function (){
        $(".aside").fadeIn(500);
        $(".container").animate({"margin-left": "5vw"},500);
    })
    $(".aside_close_btn").click(function (){
        $(".aside").fadeOut(500);
        $(".container").css({"margin": "0 auto"});
    })
})