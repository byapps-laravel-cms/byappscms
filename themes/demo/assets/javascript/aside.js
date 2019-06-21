if(Util.getCookie('aside') == 'on' && $('#sidebar').length != 0){
  $("html").toggleClass("open");
}
$('.top_btn').click( function () {
  $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
  return false;
});


$("#sidebar-close,#sidebar-toggle").click(function (){
  $("html").toggleClass("open");
  if($("html").attr('class')=="open"){
   
    $('#content').attr("class","col-md-8");
    $("#sidebar").attr("class","col-md-4");
    document.cookie = "aside=on;path=/";
  }else{
    $('#content').attr("class","col-md-12");
    $("#sidebar").attr("class","col-md-0");
   
    document.cookie = "aside=off;path=/";   
  }
});