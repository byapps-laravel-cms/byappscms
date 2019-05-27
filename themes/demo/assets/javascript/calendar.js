$(document).ready(function (){
    var now = new Date();
    var beforeDate = new Date();
    
    var yy = now.getFullYear();
    var mm = now.getMonth() + 1;
    var dd = now.getDate();
    
    if (mm.length = 1) {mm = '0' + mm;}
    if (dd.length = 1) {dd = '0' + dd;}
    
    var result="";
    var last_num = 7;
    var new_num = 3;
    
    for(var i=0; i<7;i++){
        beforeDate.setFullYear(yy, mm, dd-7+i);
        result +="<li>"+beforeDate.getFullYear()+beforeDate.getMonth()+beforeDate.getDate()+"</li>";
    }
    $('.date_slide ul').html(result);
    
    $('.slide_left_btn').click(function (){
        last_num++;
        now.setFullYear(yy, mm, dd-last_num);
        var y = now.getFullYear();
        var m = now.getMonth();
        var d = now.getDate();
        
        $('.date_slide ul').prepend("<li>"+y+m+d+"</li>");
    });
    
    $('.slide_right_btn').click(function (){
        new_num++;
        now.setFullYear(yy, mm, dd+new_num);
        var y = now.getFullYear();
        var m = now.getMonth();
        var d = now.getDate();
        
        $('.date_slide ul').append("<li>"+y+m+d+"</li>");
        $('.date_slide li').animate({'left':'+=100px'});
    });
})