// const a = [$(".ui-state-default").eq(1),$(".ui-state-default").eq(2),$(".ui-state-default").eq(3)];
// remove($(".ui-state-default"));
// for(var i=0; i<a.length; i++){
//   $(".sortable ui-sortable").append(a[session]);       
// }

$( ".sortable" ).sortable({
  stop: function(event, ui) {saveLayout()}
});
$( ".sortable" ).disableSelection();

//레이아웃 수정시

function getLayout (){
  var formData = new Object();
  for(var i = 0,j = 0 ; i < $( ".sortable>li" ).length ; i ++, j ++){
    if(!$( ".sortable>li" ).eq(i).attr('id')) {j--;continue;}
    formData[$( ".sortable>li" ).eq(i).attr('id')] = j;
  }    
  return formData;
}
function saveLayout (){
  $.request('onLayoutChange', {
    data:getLayout(),
    success: function(data) {
      console.log(data);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText)
    }
  })
}