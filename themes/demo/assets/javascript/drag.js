$(function(){
    $('.drag').draggable({
        drag:function(event,ui){
            $(this).css({'background':'red'});
        },
        revert:true,
        cursor: "move",
        opacity: 0.7
    });
    $('.drop').droppable({ 
        drop:function(event,ui) {
            $(this).droppable({disabled:true});
            $(ui.draggable).draggable({revert:false,disabled:false}).css({'cursor':'default','background':'green'});
        } 
    });
});