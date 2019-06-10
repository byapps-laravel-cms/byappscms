// const a = [$(".ui-state-default").eq(1),$(".ui-state-default").eq(2),$(".ui-state-default").eq(3)];
// remove($(".ui-state-default"));
// for(var i=0; i<a.length; i++){
//   $(".sortable ui-sortable").append(a[session]);       
// }

$( ".sortable" ).sortable();
$( ".sortable" ).disableSelection();

//레이아웃 수정시
$( ".sortable" ).mouseup(function(){
  $.ajax({
    url:'./',
    data:'chart_data',
    type:'GET',
    processData:false,
    contentType:false,
    dataType:'text',
    cache:false,
    success : function (data) {
      console.log(data)
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText)
    }
  });
})