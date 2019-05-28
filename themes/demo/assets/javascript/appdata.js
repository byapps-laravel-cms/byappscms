$(document).ready(function (){
    $(".show_btn").click(function (){
        if($(".top_banner").css({"display":"block"})){
            $(".top_banner").slideUp(1500);
        }else{
            $(".top_banner").slideDown(1500);    
        }
    })
})