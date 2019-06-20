var temp;
/*
 * 긴 이름 자르기
*/
var tdCount = $('#example tr:first-child td').length;
for(var i = 0 ; i < $('#example td').length ; i += tdCount){
  var item = $('#example td a').eq(i);
  var temp = item.text().trim();
  if(temp.length > 30){
    item.text(`${temp.substr(0,28)}...`);
  }
}
/*
 *검색 카테고리 유지
*/
if(Util.getCookie('searchType')){
  $('.select_comm_1 option').eq(Util.getCookie('searchType')*1).attr('selected','selected')
}
$('.select_comm_1').change(function() {
  document.cookie = `searchType=${$('.select_comm_1 option:selected').index()};path=/`;
});
/*
 *팝업
*/
function view_user (){
  $("#popup_update").bPopup(); 
}
//앱 상세 더보기
$(".show_btn").click(function (){
  if($(".top_banner").css("display")=="block"){
    $(".top_banner").slideUp(500);
    $(".show_btn").css({"background-color":"#c6c6c6"});
  }else{
    $(".top_banner").slideDown(500); 
    $(".show_btn").css({"background-color":"#d9edf7"});   
  }
});
//home 만료예정업체
$(".app_box_cover").eq(0).css({"display":"block"}); 
$(".app_select div").eq(0).css({"background-color":"#c2d4ef"});
//click
$(".app_select div").click(function (){
  var index = $(".app_select div").index(this);
  $(".app_box_cover").css({"display":"none"});
  $(".app_select div").css({"background-color":"#c6c6c6"});
  $(".app_box_cover").eq(index).css({"display":"block"}); 
  $(".app_select div").eq(index).css({"background-color":"#c2d4ef"});
});
//앱 상세 첫 ㅍ시 화면
$(".develop_info_select li").eq(0).css({"background-color":"#c2d4ef"});
$(".develop_info").eq(0).css({"display":"block"});
//click
$(".develop_info_select li").click(function (){
  var index = $(".develop_info_select li").index(this);
  //초기화
  $(".develop_info_select li").css({"background-color":"#c6c6c6"});
  $(".develop_info").css({"display":"none"});
  //변경
  $(".develop_info_select li").eq(index).css({"background-color":"#c2d4ef"});
  $(".develop_info").eq(index).css({"display":"block"});
});
/*
 *파일 업로드
*/
fileDropDown($(".file_dropzone"));

function fileDropDown (dropZone){
  //Drag기능
  dropZone.on('dragleave',function (e){
    e.stopPropagation();
    e.preventDefault();
    // 드롭다운 영역 css
    $(this).css({
      'background-color':'#fff',
      'background':'',
      'box-shadow': ''});
       $(this).html("<div style='height:100%;line-height:1100%;text-align:center;'>drop here</div>");
  });
  dropZone.on('dragover',function (e){
    e.stopPropagation();
    e.preventDefault();
    // 드롭다운 영역 css
    $(this).css({
      "background":"url(https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-cloud-upload-outline-256.png)",
      'background-repeat':'no-repeat',
      'background-position':'center',
      'background-size':'cover',
      'box-shadow':'inset 0 0 8px 1px black'
    });
    $(this).empty();
  });
  dropZone.on('drop',function (e){
    e.preventDefault();
    // 드롭다운 영역 css
    $(this).css({
      'box-shadow':''
    });

  var files = e.originalEvent.dataTransfer.files;
    if(files != null){
      if(files.length < 1){
        alert("폴더 업로드 불가");
        return;
      }
      selectFile(files,$(this))
    }else{
      alert("ERROR");
      }
  });
}
function selectFile (fileObject,target){
  var files = null;
  
  if(fileObject != null){
    files = fileObject;
  }else{
    files = $('#multipaartFileList_' + fileIndex)[0].files;
  }
  sendFile(files[0],target);
  showThumbnail(files[0],target);
}
function sendFile (file,target){
  formData = new FormData($('form').eq(0));
  formData.append('file',file);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('[name="_token"]').attr('value')
    }
  });
  $.ajax({
    url:'./',
    data:formData,
    type:'POST',
    enctype:'multipart/form-data',
    processData:false,
    contentType:false,
    dataType:'json',
    cache:false,
    success : function (data) {
      target.css('background-image',`url('${data}')`)
    },
    error: function (jqXHR, textStatus, errorThrown) {
      target.css('background-image',`url('${jqXHR.responseText}')`);
    }
  });
}
function showThumbnail (file,target) {
  var reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = function  () {
    target.css({
      'background-image':`url('${reader.result}')`,
      'background-size':'cover'
    })
    target.text('');
  };
};
/*
 * Auto hide navbar
 */
var $header = $('.navbar-autohide'),
  scrolling = false,
  previousTop = 0,
  currentTop = 0,
  scrollDelta = 10,
  scrollOffset = 150

$(window).on('scroll', function (){
  if (!scrolling) {
    scrolling = true
    if (!window.requestAnimationFrame) {
      setTimeout(autoHideHeader, 250)
    }else {
      requestAnimationFrame(autoHideHeader)
    }
  }
})
function autoHideHeader () {
  var currentTop = $(window).scrollTop()
  // Scrolling up
  if (previousTop - currentTop > scrollDelta) {
    $header.removeClass('is-hidden');
   // $("#sidebar, #sidebar-toggle").css({"top":$("#layout-nav").height()});
  }else if (currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
    // Scrolling down
    $header.addClass('is-hidden');
    //$("#sidebar, #sidebar-toggle").css({"top":'0'});
  }else if ( currentTop > 100 ) { 
    $('.top_btn').fadeIn();
  } else {
    $('.top_btn').fadeOut();
  }
    previousTop = currentTop
    scrolling = false
  }