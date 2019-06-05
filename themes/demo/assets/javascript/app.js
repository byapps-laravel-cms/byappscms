$(function (){
    fileDropDown($(".file_dropzone"));
});
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
 *파일 업로드
*/

function fileDropDown(dropZone){
    //Drag기능
    dropZone.on('dragleave',function(e){
        e.stopPropagation();
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css({'background-color':'#fff','background':'','box-shadow': ''});
    });
    dropZone.on('dragover',function(e){
        e.stopPropagation();
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css({"background":"url(https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-cloud-upload-outline-256.png)", 'background-repeat' : 'no-repeat', 'background-position':'center','box-shadow': 'inset 0 0 8px 1px black'});
    });
    dropZone.on('drop',function(e){
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css({'background':'url(https://cdn1.iconfinder.com/data/icons/hawcons/32/698830-icon-104-folder-checked-256.png)','background-repeat' : 'no-repeat', 'background-position':'center','box-shadow': ''});

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

function selectFile(fileObject,target){
    var files = null;

    if(fileObject != null){
        files = fileObject;
    }else{
        files = $('#multipaartFileList_' + fileIndex)[0].files;
    }
    addFileList(files[0],target);
}
function addFileList(file,target){
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
        success : function(data) {
            target.css('background-image',`url('${data}')`)
            target.text('');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            target.css('background-image',`url('${jqXHR.responseText}')`);
            target.text('');
        }
    });
}
/*
 * Application
 */
$(document).tooltip({
    selector: "[data-toggle=tooltip]"
})
/*
 * Auto hide navbar
 */
jQuery(document).ready(function($){
    var $header = $('.navbar-autohide'),
        scrolling = false,
        previousTop = 0,
        currentTop = 0,
        scrollDelta = 10,
        scrollOffset = 150

    $(window).on('scroll', function(){
        if (!scrolling) {
            scrolling = true

            if (!window.requestAnimationFrame) {
                setTimeout(autoHideHeader, 250)
            }
            else {
                requestAnimationFrame(autoHideHeader)
            }
        }
    })

    function autoHideHeader() {
        var currentTop = $(window).scrollTop()
        // Scrolling up
        if (previousTop - currentTop > scrollDelta) {
            $header.removeClass('is-hidden');
            $("#sidebar, #sidebar-toggle").css({"top":$(".navbar-header").height()});
        }
        else if (currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
            // Scrolling down
            $header.addClass('is-hidden');
            $("#sidebar, #sidebar-toggle").css({"top":'0'});
        } else if ( currentTop > 100 ) {
            $( '.top_btn' ).fadeIn();
        } else {
            $( '.top_btn' ).fadeOut();
        }
        previousTop = currentTop
        scrolling = false
    }
});