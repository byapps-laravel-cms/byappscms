if(Util.getCookie('aside') == 'on' && $('#sidebar').length != 0){
  $("html").toggleClass("open");
}
$('.top_btn').click( function () {
  $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
  return false;
});
function platform_chk (){
  var filter = "win16|win32|win64|mac|macintel"; 
  if ( navigator.platform ) {
    if ( filter.indexOf( navigator.platform.toLowerCase() ) < 0 ) { 
      $("#sidebar").css({"width":"58%"});
      return "mobile";
    } else { 
      $("#sidebar").css({"width":"41%"});
      return "pc";
    }
  }    
}

$("#sidebar-close,#sidebar-toggle").click(function (){
  $("html").toggleClass("open");
  platform_chk();
  if($("html").attr('class')=="open"){
  $(".container").css({"margin":"0"});
    document.cookie = "aside=on;path=/";
  }else{
    $(".container").css({"margin":""});
    document.cookie = "aside=off;path=/";   
  }
});