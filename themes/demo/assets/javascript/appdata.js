$(".show_btn").click(function (){
    if($(".top_banner").css("display")=="block"){
        $(".top_banner").slideUp(500);
        $("#arrow").attr("src", "http://pji.innoi.kr/themes/demo/assets/images/under_array.png");
    }else{
        $(".top_banner").slideDown(500);    
        $("#arrow").attr("src", "http://pji.innoi.kr/themes/demo/assets/images/up_array.png");
    }
});
//사이드 배너 슬라이드
$(".aside_open_btn").click(function (){
    $(".aside").fadeIn(500);
    $(".container").animate({"margin-left": "5vw"},500);
    $(".top_btn").animate({"margin-left": "-27vw"},400);
    document.cookie = "aside=on;path=/";
})
$(".aside_close_btn").click(function (){
    $(".aside").fadeOut(500);
    $(".container").css({"margin": "0 auto"});
    $(".top_btn").css({"margin-left": "0"});
    document.cookie = "aside=off;path=/";
})
if(Util.getCookie('aside') == 'on'){
    $(".aside").fadeIn(0);
    $(".container").css({"margin-left": "5vw"});
    $(".top_btn").css({"margin-left": "-27vw"});
}
//home 만료예정업체
$(".app_box_cover").eq(0).css({"display":"block"}); 
$(".app_select li").eq(0).css({"background-color":"#c2d4ef"});
//click
$(".app_select li").click(function (){
    var index = $(".app_select li").index(this);
    $(".app_box_cover").css({"display":"none"});
    $(".app_select li").css({"background-color":"#fff"});
    $(".app_box_cover").eq(index).css({"display":"block"}); 
    $(".app_select li").eq(index).css({"background-color":"#c2d4ef"});
})