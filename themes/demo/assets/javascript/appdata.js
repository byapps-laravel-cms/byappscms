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
})