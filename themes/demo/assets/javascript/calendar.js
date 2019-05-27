$(document).ready(function (){
    var now = new Date();
 
    var yy = now.getFullYear();
    var mm = now.getMonth() + 1;
    var dd = now.getDate();        
    var result;
    for(var i = dd-3;i<i+5;i++){
        result +="<li>"+i+"</li>";
    }
    $('.date_slide').html(result);
    
})