$(document).ready(function (){
    $(".show_btn").click(function (){
        if($(".top_banner").css("display")=="block"){
            $(".top_banner").slideUp(1200);
            $("#arrow").attr("src", "http://pji.innoi.kr/themes/demo/assets/images/under_array.png");
        }else{
            $(".top_banner").slideDown(1200);    
            $("#arrow").attr("src", "http://pji.innoi.kr/themes/demo/assets/images/up_array.png");
        }
    })
    $("#aside_show_btn").click(function (){
        if($(".aside").css("width")=="3%"){
            $(".aside").animate({"width":"30%"},1000);
        }else{
             $(".aside").animate({"width":"3%"},1000);
        }
    })
})