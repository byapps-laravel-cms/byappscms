var dropZone = $(".file_dropzone");

$(function (){
    // 파일 드롭 다운
    fileDropDown();
});

// 파일 드롭 다운
function fileDropDown(){
    //Drag기능
    dropZone.on('dragenter',function(e){
        e.stopPropagation();
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css('background-color','#E3F2FC');
    });
    dropZone.on('dragleave',function(e){
        e.stopPropagation();
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css('background-color','#fff');
    });
    dropZone.on('dragover',function(e){
        e.stopPropagation();
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css('background-color','blue');
    });
    dropZone.on('drop',function(e){
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css('background-color','#fff');

        var files = e.originalEvent.dataTransfer.files;
        if(files != null){
            if(files.length < 1){
                alert("폴더 업로드 불가");
                return;
            }
            selectFile(files)
        }else{
            alert("ERROR");
        }
    });
}

// 파일 선택시
function selectFile(fileObject){
    var files = null;

    if(fileObject != null){
        // 파일 Drag 이용하여 등록시
        files = fileObject;
    }else{
        // 직접 파일 등록시
        files = $('#multipaartFileList_' + fileIndex)[0].files;
    }
    addFileList(files[0]);
}

// 업로드 파일 목록 생성
function addFileList(file){
    console.log(file.name);
    $.ajax({
        url:"(업로드 경로)",
        data:file,
        type:'POST',
        enctype:'multipart/form-data',
        processData:false,
        contentType:false,
        dataType:'json',
        cache:false,
        success : function(data) { console.log(data); },
        error: function(jqXHR, textStatus, errorThrown) { console.log(jqXHR.responseText); }
    });
}